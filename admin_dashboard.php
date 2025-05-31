<?php
session_start();
require_once 'connectdb.php';

// Check if instructor is logged in
if (!isset($_SESSION['instructor_id'])) {
    header("Location: oscord_instructorControlLogin.php?error=Please login first");
    exit();
}

$instructorID = $_SESSION['instructor_id'];
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

// Fetch instructor details
$query = "SELECT instructorName, instructorEmail, instructorBirthday, instructorPhone, instructorPin FROM oscord_instructor WHERE instructorID = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $instructor = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    $error = "Failed to prepare instructor query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching instructor details.";
}

// Fetch courses taught by the instructor
$query = "SELECT c.courseID, c.courseName 
          FROM oscord_course c 
          JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
          WHERE ic.instructorID = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare courses query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching courses.";
}

// Fetch available courses not taught by the instructor
$query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_instructorxcourse WHERE instructorID = ?)";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $instructorID);
    $stmt->execute();
    $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare available courses query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching available courses.";
}

// Fetch all students
$query = "SELECT * FROM oscord_student";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->execute();
    $students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare students query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching student data.";
}

// Handle adding existing courses (register courses)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_courses'])) {
    if (!empty($_POST['courses']) && is_array($_POST['courses'])) {
        $stmt = $conn->prepare("INSERT INTO oscord_instructorxcourse (instructorID, courseID) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ii", $instructorID, $courseID);
            $success = true;
            foreach ($_POST['courses'] as $courseID) {
                if (!$stmt->execute()) {
                    $success = false;
                    logDebug("Failed to register courseID $courseID: " . $stmt->error);
                }
            }
            $stmt->close();
            $message = $success ? "Courses registered successfully." : "Error registering some courses.";
            // Refresh courses list
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
                      WHERE ic.instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $instructorID);
                $stmt->execute();
                $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
            // Refresh available courses
            $query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_instructorxcourse WHERE instructorID = ?)";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $instructorID);
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['drop_courses'])) {
    if (!empty($_POST['courses']) && is_array($_POST['courses'])) {
        $stmt = $conn->prepare("DELETE FROM oscord_instructorxcourse WHERE instructorID = ? AND courseID = ?");
        if ($stmt) {
            $stmt->bind_param("ii", $instructorID, $courseID);
            $success = true;
            foreach ($_POST['courses'] as $courseID) {
                if (!$stmt->execute()) {
                    $success = false;
                    logDebug("Failed to drop courseID $courseID: " . $stmt->error);
                }
            }
            $stmt->close();
            $message = $success ? "Courses dropped successfully." : "Error dropping some courses.";
            // Refresh courses list
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
                      WHERE ic.instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $instructorID);
                $stmt->execute();
                $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
            // Refresh available courses
            $query = "SELECT courseID, courseName FROM oscord_course WHERE courseID NOT IN (SELECT courseID FROM oscord_instructorxcourse WHERE instructorID = ?)";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $instructorID);
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

// Handle adding a new course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_course'])) {
    $courseName = trim($_POST['course_name']);
    $courseDescription = trim($_POST['course_description']);
    $courseFee = trim($_POST['course_fee']);
    $coursePeriod = trim($_POST['course_period']);
    $courseFblink = trim($_POST['course_fblink']);

    // Log received POST data for debugging
    logDebug("Received POST data: courseName=$courseName, courseFee=$courseFee, coursePeriod=$coursePeriod, courseFblink=$courseFblink");

    // Validate inputs
    if (empty($courseName) || empty($courseDescription) || empty($courseFee) || empty($coursePeriod) || empty($courseFblink)) {
        $message = "All course fields are required.";
        logDebug("Validation failed: Missing required fields.");
    } elseif (!filter_var($courseFblink, FILTER_VALIDATE_URL)) {
        $message = "Invalid Facebook link format.";
        logDebug("Validation failed: Invalid Facebook link.");
    } else {
        try {
            // Insert into oscord_course
            $query = "INSERT INTO oscord_course (courseName, courseDescription, courseFee, coursePeriod, courseFblink) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Failed to prepare course query: " . $conn->error);
            }
            $stmt->bind_param("sssss", $courseName, $courseDescription, $courseFee, $coursePeriod, $courseFblink);
            if (!$stmt->execute()) {
                throw new Exception("Failed to insert course: " . $stmt->error);
            }
            $courseID = $stmt->insert_id;
            $stmt->close();
            logDebug("Course inserted successfully, courseID=$courseID");

            // Redirect to prevent duplicate submission on reload
            header("Location: admin_dashboard.php?message=" . urlencode("New course added successfully. You can register it from the Register Course section."));
            exit();
        } catch (Exception $e) {
            $message = "Error adding new course: " . $e->getMessage();
            logDebug("Error adding course: " . $e->getMessage());
        }
    }
}

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pin = $_POST['pin'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($pin) || empty($birthday) || empty($phone)) {
        $message = "All fields except password are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{6}$/", $pin)) {
        $message = "Pin must be a 6-digit number.";
    } else {
        // Prepare update query
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE oscord_instructor SET instructorName = ?, instructorEmail = ?, instructorPassword = ?, instructorPin = ?, instructorBirthday = ?, instructorPhone = ? WHERE instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sssissi", $name, $email, $hashedPassword, $pin, $birthday, $phone, $instructorID);
            }
        } else {
            $query = "UPDATE oscord_instructor SET instructorName = ?, instructorEmail = ?, instructorPin = ?, instructorBirthday = ?, instructorPhone = ? WHERE instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssissi", $name, $email, $pin, $birthday, $phone, $instructorID);
            }
        }

        if ($stmt && $stmt->execute()) {
            $message = "Profile updated successfully.";
            $_SESSION['instructor_name'] = $name;
            $query = "SELECT instructorName, instructorEmail, instructorBirthday, instructorPhone, instructorPin FROM oscord_instructor WHERE instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $instructorID);
                $stmt->execute();
                $instructor = $stmt->get_result()->fetch_assoc();
                $stmt->close();
            }
        } else {
            $error = "Failed to update profile: " . ($stmt ? $stmt->error : $conn->error);
            logDebug($error);
            $message = "Error updating profile.";
        }
        if ($stmt) {
            $stmt->close();
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
    <title>Admin Dashboard - Oscord</title>
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
        @media (max-width: 640px) {
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
        <!-- Instructor Profile -->
        <div class="cyber-card">
            <div class="profile-header">
                <div class="profile-icon"><?php echo strtoupper(substr($instructor['instructorName'], 0, 1)); ?></div>
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2"><?php echo htmlspecialchars($instructor['instructorName']); ?></h2>
                    <p class="text-gray-400">Email: <?php echo htmlspecialchars($instructor['instructorEmail']); ?></p>
                    <p class="text-gray-400">Phone: <?php echo htmlspecialchars($instructor['instructorPhone']); ?></p>
                    <p class="text-gray-400">Birthday: <?php echo htmlspecialchars($instructor['instructorBirthday']); ?></p>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="oscord_home.php" class="btn-cyber mt-4 inline-block text-center">Back to Home</a>
                <button onclick="toggleEditForm()" class="btn-cyber mt-4 inline-block text-center">Edit Profile</button>
            </div>

            <!-- Edit Profile Form (Hidden by default) -->
            <div id="editForm" class="mt-6 hidden">
                <?php if (!empty($message) && !isset($_POST['add_courses']) && !isset($_POST['drop_courses']) && !isset($_POST['new_course'])): ?>
                    <div class="alert-cyber">
                        <span><?php echo htmlspecialchars($message); ?></span>
                        <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="input-group">
                        <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($instructor['instructorName']); ?>" class="input-field">
                        <label for="name" class="input-label">Name</label>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($instructor['instructorEmail']); ?>" class="input-field">
                        <label for="email" class="input-label">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder=" " class="input-field">
                        <label for="password" class="input-label">New Password (optional)</label>
                        <span class="password-toggle" onclick="togglePassword()">⚡️</span>
                    </div>
                    <div class="input-group">
                        <input type="number" name="pin" id="pin" required value="<?php echo htmlspecialchars($instructor['instructorPin']); ?>" class="input-field">
                        <label for="pin" class="input-label">Pin (6 digits)</label>
                    </div>
                    <div class="input-group">
                        <input type="date" name="birthday" id="birthday" required value="<?php echo htmlspecialchars($instructor['instructorBirthday']); ?>" class="input-field">
                        <label for="birthday" class="input-label">Birthday</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="phone" id="phone" required value="<?php echo htmlspecialchars($instructor['instructorPhone']); ?>" class="input-field">
                        <label for="phone" class="input-label">Phone</label>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="btn-cyber">Save Changes</button>
                        <button type="button" onclick="toggleEditForm()" class="btn-cyber">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Courses and Students Section -->
        <div class="cyber-card">
            <h3 class="text-2xl font-bold text-white mb-6">Dash Board</h3>
            <div class="flex space-x-4 mb-6">
                <button onclick="toggleCourses()" class="btn-cyber">Your Courses</button>
                <button onclick="toggleNewCourseForm()" class="btn-cyber">Add New Course</button>
                <button onclick="toggleStudents()" class="btn-cyber">Manage Students</button>
            </div>

            <!-- Add New Course Form (Hidden by default) -->
            <div id="newCourseForm" class="mt-6 hidden">
                <?php if (!empty($message) && isset($_GET['message'])): ?>
                    <div class="alert-cyber">
                        <span><?php echo htmlspecialchars($message); ?></span>
                        <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <h4 class="text-xl font-semibold text-cyan-400 mb-4">Add New Course</h4>
                    <div class="input-group">
                        <input type="text" name="course_name" id="course_name" required class="input-field">
                        <label for="course_name" class="input-label">Course Name</label>
                    </div>
                    <div class="input-group">
                        <textarea name="course_description" id="course_description" required class="input-field" rows="4"></textarea>
                        <label for="course_description" class="input-label">Course Description</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="course_fee" id="course_fee" required class="input-field" placeholder="e.g., 270000 MMK">
                        <label for="course_fee" class="input-label">Course Fee</label>
                    </div>
                    <div class="input-group">
                        <input type="text" name="course_period" id="course_period" required class="input-field">
                        <label for="course_period" class="input-label">Course Period</label>
                    </div>
                    <div class="input-group">
                        <input type="url" name="course_fblink" id="course_fblink" required class="input-field">
                        <label for="course_fblink" class="input-label">Facebook Link</label>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" name="new_course" class="btn-cyber">Add Course</button>
                        <button type="button" onclick="toggleNewCourseForm()" class="btn-cyber">Cancel</button>
                    </div>
                </form>
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
                    <p class="text-gray-400 mb-4">No courses assigned to you.</p>
                <?php else: ?>
                    <div class="flex flex-wrap gap-4 mb-4">
                        <?php foreach ($courses as $course): ?>
                            <a href="instructor_specificCourse.php?instructorID=<?php echo urlencode($instructorID); ?>&courseID=<?php echo urlencode($course['courseID']); ?>" 
                               class="course-button"><?php echo htmlspecialchars($course['courseName']); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="flex space-x-4 mb-4">
                    <button onclick="toggleAddCourseForm()" class="btn-cyber">Register Course</button>
                    <button onclick="toggleDropCourseForm()" class="btn-cyber">Drop Course</button>
                </div>

                <!-- Register Course Form (Hidden by default) -->
                <div id="addCourseForm" class="mt-6 hidden">
                    <form method="POST" action="">
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
                                <button type="submit" name="add_courses" class="btn-cyber">Register Selected Courses</button>
                                <button type="button" onclick="toggleAddCourseForm()" class="btn-cyber">Cancel</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Drop Course Form (Hidden by default) -->
                <div id="dropCourseForm" class="mt-6 hidden">
                    <form method="POST" action="">
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
                                <button type="submit" name="drop_courses" class="btn-cyber">Drop Selected Courses</button>
                                <button type="button" onclick="toggleDropCourseForm()" class="btn-cyber">Cancel</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Students List (Hidden by default) -->
            <div id="studentsSection" class="hidden">
                <h4 class="text-xl font-semibold text-cyan-400 mb-4">Manage Students</h4>
                <?php if (empty($students)): ?>
                    <p class="text-gray-400 mb-4">No students found.</p>
                <?php else: ?>
                    <?php foreach ($students as $student): ?>
                        <a href="instructor_handleStudent.php?instructorID=<?php echo urlencode($instructorID); ?>&studentID=<?php echo urlencode($student['studentID']); ?>" 
                           class="btn-cyber">
                            <?php echo htmlspecialchars($student['studentName']); ?> 
                            <?php echo htmlspecialchars($student['studentEmail']); ?> 
                            
                            (<?php echo $student['studentApprove'] ? '✔️' : '❌'; ?>)
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
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
            const editForm = document.getElementById('editForm');
            editForm.classList.toggle('hidden');
            console.log('Toggled edit form');
        }

        // Toggle courses section visibility
        function toggleCourses() {
            const coursesSection = document.getElementById('coursesSection');
            if (!coursesSection) {
                console.error('coursesSection element not found');
                return;
            }
            coursesSection.classList.toggle('hidden');
            // Hide other sections
            document.getElementById('newCourseForm').classList.add('hidden');
            document.getElementById('studentsSection').classList.add('hidden');
            document.getElementById('addCourseForm').classList.add('hidden');
            document.getElementById('dropCourseForm').classList.add('hidden');
            console.log('Toggled courses section, hidden:', coursesSection.classList.contains('hidden'));
        }

        // Toggle register course form visibility
        function toggleAddCourseForm() {
            const addCourseForm = document.getElementById('addCourseForm');
            if (!addCourseForm) {
                console.error('addCourseForm element not found');
                return;
            }
            addCourseForm.classList.toggle('hidden');
            // Hide other forms
            document.getElementById('newCourseForm').classList.add('hidden');
            document.getElementById('dropCourseForm').classList.add('hidden');
            document.getElementById('studentsSection').classList.add('hidden');
            console.log('Toggled add course form, hidden:', addCourseForm.classList.contains('hidden'));
        }

        // Toggle add new course form visibility
        function toggleNewCourseForm() {
            const newCourseForm = document.getElementById('newCourseForm');
            if (!newCourseForm) {
                console.error('newCourseForm element not found');
                return;
            }
            newCourseForm.classList.toggle('hidden');
            // Hide other sections
            document.getElementById('coursesSection').classList.add('hidden');
            document.getElementById('addCourseForm').classList.add('hidden');
            document.getElementById('dropCourseForm').classList.add('hidden');
            document.getElementById('studentsSection').classList.add('hidden');
            console.log('Toggled new course form, hidden:', newCourseForm.classList.contains('hidden'));
        }

        // Toggle drop course form visibility
        function toggleDropCourseForm() {
            const dropCourseForm = document.getElementById('dropCourseForm');
            if (!dropCourseForm) {
                console.error('dropCourseForm element not found');
                return;
            }
            dropCourseForm.classList.toggle('hidden');
            // Hide other forms
            document.getElementById('newCourseForm').classList.add('hidden');
            document.getElementById('addCourseForm').classList.add('hidden');
            document.getElementById('studentsSection').classList.add('hidden');
            console.log('Toggled drop course form, hidden:', dropCourseForm.classList.contains('hidden'));
        }

        // Toggle students section visibility
        function toggleStudents() {
            const studentsSection = document.getElementById('studentsSection');
            if (!studentsSection) {
                console.error('studentsSection element not found');
                return;
            }
            studentsSection.classList.toggle('hidden');
            // Hide other sections
            document.getElementById('coursesSection').classList.add('hidden');
            document.getElementById('newCourseForm').classList.add('hidden');
            document.getElementById('addCourseForm').classList.add('hidden');
            document.getElementById('dropCourseForm').classList.add('hidden');
            console.log('Toggled students section, hidden:', studentsSection.classList.contains('hidden'));
        }

        // Password toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '◆';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '■';
            }
            console.log('Toggled password visibility');
        }
    </script>
</body>
</html>