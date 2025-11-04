<?php
session_start();
require_once 'connectdb.php';

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: oscord_studentControlLogin.php?error=Please login first");
    exit();
}

$studentID = $_SESSION['student_id'];
$message = '';

// Debug log function
function logDebug($message) {
    $log = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
    file_put_contents('debug.log', $log, FILE_APPEND);
}

// Check database connection
if ($conn->connect_error) {
    $error = "Database connection failed: " . $conn->connect_error;
    logDebug($error);
    $message = "Database connection error. Please try again later.";
}

// Fetch student details
$query = "SELECT studentName, studentEmail, studentBirthday, studentPhone, studentCountry, studentTelegram, studentPassword FROM oscord_student WHERE studentID = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    $error = "Failed to prepare student query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching student details.";
}

// Fetch courses enrolled by the student
$query = "SELECT c.courseID, c.courseName 
          FROM oscord_course c 
          JOIN oscord_studentxcourse sc ON c.courseID = sc.courseID 
          WHERE sc.studentID = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare courses query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching enrolled courses.";
}

// Fetch available courses not enrolled by the student
$query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_studentxcourse WHERE studentID = ?)";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare available courses query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching available courses.";
}

// Handle passcode verification via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'verify_passcode') {
    $enteredPasscode = $_POST['passcode'];
    $query = "SELECT studentPassword FROM oscord_student WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result && password_verify($enteredPasscode, $result['studentPassword'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect passcode.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
    exit();
}

// Handle adding existing courses (register courses)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_courses']) && isset($_POST['passcode_verified']) && $_POST['passcode_verified'] == 'true') {
    if (!empty($_POST['courses']) && is_array($_POST['courses'])) {
        $stmt = $conn->prepare("INSERT INTO oscord_studentxcourse (studentID, courseID, enrollDate) VALUES (?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("ii", $studentID, $courseID);
            $success = true;
            foreach ($_POST['courses'] as $courseID) {
                $courseID = intval($courseID); // Ensure courseID is an integer
                if (!$stmt->execute()) {
                    $success = false;
                    logDebug("Failed to register courseID $courseID for studentID $studentID: " . $stmt->error);
                }
            }
            $stmt->close();
            $message = $success ? "Courses registered successfully." : "Error registering some courses.";
            // Refresh courses list
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_studentxcourse sc ON c.courseID = sc.courseID 
                      WHERE sc.studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
            // Refresh available courses
            $query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_studentxcourse WHERE studentID = ?)";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
        } else {
            $error = "Failed to prepare register course query: " . $conn->error;
            logDebug($error);
            $message = "Error preparing course registration.";
        }
    } else {
        $message = "Please select at least one course to register.";
    }
}

// Handle dropping courses
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['drop_courses']) && isset($_POST['passcode_verified']) && $_POST['passcode_verified'] == 'true') {
    if (!empty($_POST['courses']) && is_array($_POST['courses'])) {
        $stmt = $conn->prepare("DELETE FROM oscord_studentxcourse WHERE studentID = ? AND courseID = ?");
        if ($stmt) {
            $stmt->bind_param("ii", $studentID, $courseID);
            $success = true;
            foreach ($_POST['courses'] as $courseID) {
                $courseID = intval($courseID); // Ensure courseID is an integer
                if (!$stmt->execute()) {
                    $success = false;
                    logDebug("Failed to drop courseID $courseID for studentID $studentID: " . $stmt->error);
                }
            }
            $stmt->close();
            $message = $success ? "Courses dropped successfully." : "Error dropping some courses.";
            // Refresh courses list
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_studentxcourse sc ON c.courseID = sc.courseID 
                      WHERE sc.studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
            // Refresh available courses
            $query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_studentxcourse WHERE studentID = ?)";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
        } else {
            $error = "Failed to prepare drop course query: " . $conn->error;
            logDebug($error);
            $message = "Error dropping courses.";
        }
    } else {
        $message = "Please select at least one course to drop.";
    }
}

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['passcode_verified']) && $_POST['passcode_verified'] == 'true') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $telegram = $_POST['telegram'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($birthday) || empty($phone) || empty($country)) {
        $message = "All fields except password and Telegram are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        // Prepare update query
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE oscord_student SET studentName = ?, studentEmail = ?, studentPassword = ?, studentBirthday = ?, studentPhone = ?, studentCountry = ?, studentTelegram = ? WHERE studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sssssssi", $name, $email, $hashedPassword, $birthday, $phone, $country, $telegram, $studentID);
            }
        } else {
            $query = "UPDATE oscord_student SET studentName = ?, studentEmail = ?, studentBirthday = ?, studentPhone = ?, studentCountry = ?, studentTelegram = ? WHERE studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssssssi", $name, $email, $birthday, $phone, $country, $telegram, $studentID);
            }
        }

        if ($stmt && $stmt->execute()) {
            $message = "Profile updated successfully.";
            $_SESSION['student_name'] = $name;
            $query = "SELECT studentName, studentEmail, studentBirthday, studentPhone, studentCountry, studentTelegram, studentPassword FROM oscord_student WHERE studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $student = $stmt->get_result()->fetch_assoc();
                $stmt->close();
            }
        } else {
            $error = "Failed to update profile: " . ($stmt ? $stmt->error : $conn->error);
            logDebug($error);
            $message = "Error updating profile.";
        }
    }
}

// Check for redirect message
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #0d0d2b 0%, #2a0a4e 100%);
            min-height: 100vh;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
            color: #e0e0ff;
        }
        canvas#particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .cyber-card {
            background: rgba(20, 20, 40, 0.3);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            border: 2px solid rgba(255, 20, 147, 0.5);
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .cyber-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.5);
        }
        .btn-cyber {
            background: linear-gradient(45deg, #ff1493, #00ffea);
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: 700;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            display: inline-block;
            text-align: center;
            width: 100%;
            margin-bottom: 0.5rem;
        }
        .btn-cyber:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 234, 0.7);
        }
        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            border-radius: 50%;
        }
        .btn-cyber:hover::before {
            width: 300%;
            height: 300%;
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .profile-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff1493, #00ffea);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fff;
        }
        .input-group {
            position: relative;
            margin-bottom: 1.75rem;
        }
        .input-field {
            background: rgba(255, 255, 255, 0.05);
            color: #e0e0ff;
            border: 2px solid rgba(255, 20, 147, 0.4);
            border-radius: 0.5rem;
            padding: 0.8rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            outline: none;
            border-color: #00ffea;
            box-shadow: 0 0 15px rgba(0, 255, 234, 0.5);
        }
        .input-label {
            position: absolute;
            top: 0.8rem;
            left: 1rem;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .input-field:focus + .input-label,
        .input-field:not(:placeholder-shown) + .input-label {
            top: -1rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: #00ffea;
            background: rgba(20, 20, 40, 0.8);
            padding: 0 0.3rem;
        }
        .alert-cyber {
            animation: glitch 0.3s ease;
            background: rgba(255, 20, 147, 0.2);
            border: 2px solid #ff1493;
            color: #ffccff;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, 0); }
            80% { transform: translate(2px, 2px); }
            100% { transform: translate(0); }
        }
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #00ffea;
            transition: color 0.3s ease;
        }
        .password-toggle:hover {
            color: #ff1493;
        }
        .course-button {
            background: rgba(40, 40, 60, 0.4);
            border: 1px solid rgba(0, 255, 234, 0.3);
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            color: #e0e0ff;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .course-button:hover {
            border-color: #00ffea;
            transform: translateX(5px);
            background: rgba(0, 255, 234, 0.1);
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .checkbox-field {
            width: 1.25rem;
            height: 1.25rem;
            accent-color: #00ffea;
        }
        .checkbox-label {
            color: #e0e0ff;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: rgba(20, 20, 40, 0.9);
            padding: 2rem;
            border-radius: 1rem;
            border: 2px solid #ff1493;
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.5);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .modal-content input {
            background: rgba(255, 255, 255, 0.05);
            color: #e0e0ff;
            border: 2px solid rgba(255, 20, 147, 0.4);
            border-radius: 0.5rem;
            padding: 0.8rem;
            width: 100%;
            margin-bottom: 1rem;
        }
        .modal-content input:focus {
            border-color: #00ffea;
            box-shadow: 0 0 10px rgba(0, 255, 234, 0.5);
            outline: none;
        }
        .modal-content .btn-cyber {
            width: auto;
            padding: 0.8rem 2rem;
            margin: 0.5rem;
        }
        @media (max-width: 640px) {
            body{
                background:black;
                width : 89%;
               margin: 0 auto;
                
            }

            *{
                font-size : 0.999999999em;
                margin-left : 0px;
            }

            .cyber-card {
                padding: 1.5rem;
            }
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            .profile-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container mx-auto">
        <!-- Passcode Verification Modal -->
        <div id="passcodeModal" class="modal">
            <div class="modal-content">
                <h3 class="text-xl font-bold text-white mb-4">Enter Your Passcode</h3>
                <input type="password" id="passcodeInput" class="input-field" placeholder="Enter your passcode">
                <p id="passcodeError" class="text-red-400 hidden mb-4"></p>
                <div class="flex justify-center space-x-4">
                    <button class="btn-cyber" onclick="verifyPasscode()">Submit</button>
                    <button class="btn-cyber" onclick="closePasscodeModal()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="cyber-card">
            <div class="profile-header">
                <div class="profile-icon"><?php echo strtoupper(substr($student['studentName'], 0, 1)); ?></div>
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2"><?php echo htmlspecialchars($student['studentName']); ?></h2>
                    <p class="text-gray-400">Email: <?php echo htmlspecialchars($student['studentEmail']); ?></p>
                    <p class="text-gray-400">Phone: <?php echo htmlspecialchars($student['studentPhone']); ?></p>
                    <p class="text-gray-400">Birthday: <?php echo htmlspecialchars($student['studentBirthday']); ?></p>
                    <p class="text-gray-400">Country: <?php echo htmlspecialchars($student['studentCountry']); ?></p>
                    <p class="text-gray-400">Telegram: <?php echo htmlspecialchars($student['studentTelegram'] ?: 'Not set'); ?></p>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="oscord_home.php" class="btn-cyber mt-4 inline-block text-center">Back to Home</a>
                <button onclick="toggleEditForm()" class="btn-cyber mt-4 inline-block text-center">Edit Profile</button>
            </div>

            <!-- Edit Profile Form (Hidden by default) -->
            <div id="editForm" class="mt-6 hidden">
                <?php if (!empty($message) && !isset($_POST['add_courses']) && !isset($_POST['drop_courses'])): ?>
                    <div class="alert-cyber">
                        <span><?php echo htmlspecialchars($message); ?></span>
                        <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                    </div>
                <?php endif; ?>
                <form id="profileForm" method="POST" action="">
                    <input type="hidden" name="passcode_verified" id="profilePasscodeVerified" value="false">
                    <div class="input-group">
                        <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($student['studentName']); ?>" class="input-field">
                        <label for="name" class="input-label">Name</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($student['studentEmail']); ?>" class="input-field">
                        <label for="email" class="input-label">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder=" " class="input-field">
                        <label for="password" class="input-label">New Password (optional)</label>
                        <span class="password-toggle" onclick="togglePassword()">⚡️</span>
                    </div>
                    <div class="input-group">
                        <input type="date" name="birthday" id="birthday" required value="<?php echo htmlspecialchars($student['studentBirthday']); ?>" class="input-field">
                        <label for="birthday" class="input-label">Birthday</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="phone" id="phone" required value="<?php echo htmlspecialchars($student['studentPhone']); ?>" class="input-field">
                        <label for="phone" class="input-label">Phone</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="country" id="country" required value="<?php echo htmlspecialchars($student['studentCountry']); ?>" class="input-field">
                        <label for="country" class="input-label">Country</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="telegram" id="telegram" value="<?php echo htmlspecialchars($student['studentTelegram']); ?>" class="input-field">
                        <label for="telegram" class="input-label">Telegram (optional)</label>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="btn-cyber" onclick="return showPasscodeModal('profileForm')">Save Changes</button>
                        <button type="button" onclick="toggleEditForm()" class="btn-cyber">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Courses Section -->
        <div class="cyber-card">
            <h3 class="text-2xl font-bold text-white mb-6">Courses Dashboard</h3>
            <div class="flex space-x-4 mb-6">
                <button onclick="toggleCourses()" class="btn-cyber">Your Courses</button>
            </div>

            <!-- Courses List (Hidden by default) -->
            <div id="coursesSection" class="hidden">
                <?php if (!empty($message) && (isset($_POST['add_courses']) || isset($_POST['drop_courses']))): ?>
                    <div class="alert-cyber">
                        <span><?php echo htmlspecialchars($message); ?></span>
                        <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                    </div>
                <?php endif; ?>
                <?php if (empty($courses)): ?>
                    <p class="text-gray-400 mb-4">You are not enrolled in any courses.</p>
                <?php else: ?>
                    <div class="flex flex-wrap gap-4 mb-4">
                        <?php foreach ($courses as $course): ?>
                            <div class="course-button"><?php echo htmlspecialchars($course['courseName']); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="flex space-x-4 mb-4">
                    <button onclick="toggleAddCourseForm()" class="btn-cyber">Register Course</button>
                    <button onclick="toggleDropCourseForm()" class="btn-cyber">Drop Course</button>
                </div>

                <!-- Register Course Form (Hidden by default) -->
                <div id="addCourseForm" class="mt-6 hidden">
                    <form id="addCourseFormElement" method="POST" action="">
                        <input type="hidden" name="add_courses" value="true">
                        <input type="hidden" name="passcode_verified" id="addCoursePasscodeVerified" value="false">
                        <h4 class="text-xl font-semibold text-cyan-400 mb-4">Select Courses to Register</h4>
                        <?php if (empty($availableCourses)): ?>
                            <p class="text-gray-400 mb-4">No available courses to register.</p>
                        <?php else: ?>
                            <?php foreach ($availableCourses as $course): ?>
                                <div class="checkbox-group">
                                    <input type="checkbox" name="courses[]" value="<?php echo htmlspecialchars($course['courseID']); ?>" id="course_<?php echo htmlspecialchars($course['courseID']); ?>" class="checkbox-field">
                                    <label for="course_<?php echo htmlspecialchars($course['courseID']); ?>" class="checkbox-label"><?php echo htmlspecialchars($course['courseName']); ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="flex space-x-4">
                                <button type="submit" class="btn-cyber" onclick="return showPasscodeModal('addCourseFormElement')">Register Selected Courses</button>
                                <button type="button" onclick="toggleAddCourseForm()" class="btn-cyber">Cancel</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Drop Course Form (Hidden by default) -->
                <div id="dropCourseForm" class="mt-6 hidden">
                    <form id="dropCourseFormElement" method="POST" action="">
                        <input type="hidden" name="drop_courses" value="true">
                        <input type="hidden" name="passcode_verified" id="dropCoursePasscodeVerified" value="false">
                        <h4 class="text-xl font-semibold text-cyan-400 mb-4">Select Courses to Drop</h4>
                        <?php if (empty($courses)): ?>
                            <p class="text-gray-400 mb-4">No courses to drop.</p>
                        <?php else: ?>
                            <?php foreach ($courses as $course): ?>
                                <div class="checkbox-group">
                                    <input type="checkbox" name="courses[]" value="<?php echo htmlspecialchars($course['courseID']); ?>" id="drop_course_<?php echo htmlspecialchars($course['courseID']); ?>" class="checkbox-field">
                                    <label for="drop_course_<?php echo htmlspecialchars($course['courseID']); ?>" class="checkbox-label"><?php echo htmlspecialchars($course['courseName']); ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="flex space-x-4">
                                <button type="submit" class="btn-cyber" onclick="return showPasscodeModal('dropCourseFormElement')">Drop Selected Courses</button>
                                <button type="button" onclick="toggleDropCourseForm()" class="btn-cyber">Cancel</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ensure DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM fully loaded and parsed');

            // Particle animation
            const canvas = document.getElementById('particles');
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const particles = [];
            const particleCount = 50;

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 3 + 1;
                    this.speedX = Math.random() * 1 - 0.5;
                    this.speedY = Math.random() * 1 - 0.5;
                }
                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;
                    if (this.size > 0.2) this.size -= 0.05;
                    if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                    if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
                }
                draw() {
                    ctx.fillStyle = 'rgba(0, 255, 234, 0.5)';
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            function initParticles() {
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach((particle, index) => {
                    particle.update();
                    particle.draw();
                    if (particle.size <= 0.2) {
                        particles.splice(index, 1);
                        particles.push(new Particle());
                    }
                });
                requestAnimationFrame(animateParticles);
            }

            initParticles();
            animateParticles();

            window.addEventListener('resize', () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            });

            // Toggle edit form visibility
            function toggleEditForm() {
                try {
                    const editForm = document.getElementById('editForm');
                    if (!editForm) {
                        console.error('Edit form element not found');
                        return;
                    }
                    editForm.classList.toggle('hidden');
                    console.log('Toggled edit form, hidden:', editForm.classList.contains('hidden'));
                } catch (error) {
                    console.error('Error in toggleEditForm:', error);
                }
            }

            // Toggle courses section visibility
            function toggleCourses() {
                try {
                    const coursesSection = document.getElementById('coursesSection');
                    if (!coursesSection) {
                        console.error('coursesSection element not found');
                        return;
                    }
                    coursesSection.classList.toggle('hidden');
                    document.getElementById('addCourseForm')?.classList.add('hidden');
                    document.getElementById('dropCourseForm')?.classList.add('hidden');
                    console.log('Toggled courses section, hidden:', coursesSection.classList.contains('hidden'));
                } catch (error) {
                    console.error('Error in toggleCourses:', error);
                }
            }

            // Toggle register course form visibility
            function toggleAddCourseForm() {
                try {
                    const addCourseForm = document.getElementById('addCourseForm');
                    if (!addCourseForm) {
                        console.error('addCourseForm element not found');
                        return;
                    }
                    addCourseForm.classList.toggle('hidden');
                    document.getElementById('dropCourseForm')?.classList.add('hidden');
                    console.log('Toggled add course form, hidden:', addCourseForm.classList.contains('hidden'));
                } catch (error) {
                    console.error('Error in toggleAddCourseForm:', error);
                }
            }

            // Toggle drop course form visibility
            function toggleDropCourseForm() {
                try {
                    const dropCourseForm = document.getElementById('dropCourseForm');
                    if (!dropCourseForm) {
                        console.error('dropCourseForm element not found');
                        return;
                    }
                    dropCourseForm.classList.toggle('hidden');
                    document.getElementById('addCourseForm')?.classList.add('hidden');
                    console.log('Toggled drop course form, hidden:', dropCourseForm.classList.contains('hidden'));
                } catch (error) {
                    console.error('Error in toggleDropCourseForm:', error);
                }
            }

            // Password toggle
            function togglePassword() {
                try {
                    const passwordInput = document.getElementById('password');
                    const toggleIcon = document.querySelector('.password-toggle');
                    if (!passwordInput || !toggleIcon) {
                        console.error('Password input or toggle icon not found');
                        return;
                    }
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.textContent = '🔒';
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.textContent = '⚡️';
                    }
                    console.log('Toggled password visibility');
                } catch (error) {
                    console.error('Error in togglePassword:', error);
                }
            }

            // Passcode Modal Functions
            let currentFormId = null;

            function showPasscodeModal(formId) {
                try {
                    currentFormId = formId;
                    const modal = document.getElementById('passcodeModal');
                    const passcodeInput = document.getElementById('passcodeInput');
                    const passcodeError = document.getElementById('passcodeError');
                    if (!modal || !passcodeInput || !passcodeError) {
                        console.error('Modal elements not found');
                        return false;
                    }
                    passcodeInput.value = '';
                    passcodeError.classList.add('hidden');
                    modal.style.display = 'flex';
                    passcodeInput.focus();
                    console.log('Showing passcode modal for form:', formId);
                    return false; // Prevent form submission
                } catch (error) {
                    console.error('Error in showPasscodeModal:', error);
                    return false;
                }
            }

            function closePasscodeModal() {
                try {
                    const modal = document.getElementById('passcodeModal');
                    if (!modal) {
                        console.error('Passcode modal not found');
                        return;
                    }
                    modal.style.display = 'none';
                    currentFormId = null;
                    console.log('Closed passcode modal');
                } catch (error) {
                    console.error('Error in closePasscodeModal:', error);
                }
            }

            function verifyPasscode() {
                try {
                    const passcodeInput = document.getElementById('passcodeInput');
                    const passcodeError = document.getElementById('passcodeError');
                    if (!passcodeInput || !passcodeError) {
                        console.error('Passcode input or error element not found');
                        return;
                    }
                    const passcode = passcodeInput.value;

                    if (!passcode) {
                        passcodeError.textContent = 'Please enter your passcode.';
                        passcodeError.classList.remove('hidden');
                        console.log('Passcode input is empty');
                        return;
                    }

                    console.log('Verifying passcode');
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=verify_passcode&passcode=${encodeURIComponent(passcode)}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const form = document.getElementById(currentFormId);
                                if (!form) {
                                    console.error('Form not found for ID:', currentFormId);
                                    passcodeError.textContent = 'Form not found.';
                                    passcodeError.classList.remove('hidden');
                                    return;
                                }
                                const passcodeVerifiedInput = form.querySelector('[name="passcode_verified"]');
                                if (!passcodeVerifiedInput) {
                                    console.error('Passcode verified input not found in form');
                                    passcodeError.textContent = 'Form error.';
                                    passcodeError.classList.remove('hidden');
                                    return;
                                }
                                passcodeVerifiedInput.value = 'true';
                                console.log('Passcode verified, submitting form:', currentFormId);
                                form.submit();
                            } else {
                                passcodeError.textContent = data.message || 'Incorrect passcode.';
                                passcodeError.classList.remove('hidden');
                                console.log('Passcode verification failed:', data.message);
                            }
                        })
                        .catch(error => {
                            passcodeError.textContent = 'Error verifying passcode. Please try again.';
                            passcodeError.classList.remove('hidden');
                            console.error('Verification error:', error);
                        });
                } catch (error) {
                    console.error('Error in verifyPasscode:', error);
                    const passcodeError = document.getElementById('passcodeError');
                    if (passcodeError) {
                        passcodeError.textContent = 'An error occurred. Please try again.';
                        passcodeError.classList.remove('hidden');
                    }
                }
            }

            // Expose functions to global scope for inline onclick handlers
            window.toggleEditForm = toggleEditForm;
            window.toggleCourses = toggleCourses;
            window.toggleAddCourseForm = toggleAddCourseForm;
            window.toggleDropCourseForm = toggleDropCourseForm;
            window.togglePassword = togglePassword;
            window.showPasscodeModal = showPasscodeModal;
            window.closePasscodeModal = closePasscodeModal;
            window.verifyPasscode = verifyPasscode;
        });
    </script>
</body>
</html>