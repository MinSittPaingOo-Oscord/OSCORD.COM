<?php
session_start();
require_once 'connectdb.php';

// Check if instructor is logged in
if (!isset($_SESSION['instructor_id'])) {
    header("Location: oscord_instructorControlLogin.php?error=Please login first");
    exit();
}

// Validate query parameters
if (!isset($_GET['instructorID']) || !isset($_GET['studentID'])) {
    header("Location: admin_dashboard.php?message=" . urlencode("Invalid request. Missing instructor or student ID."));
    exit();
}

$instructorID = intval($_GET['instructorID']);
$studentID = intval($_GET['studentID']);
$message = '';
$course_message = ''; // Separate message for course actions

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
$query = "SELECT instructorName, instructorPin FROM oscord_instructor WHERE instructorID = ?";
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

// Fetch student details
$query = "SELECT * FROM oscord_student WHERE studentID = ?";
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
    $enrolledCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare enrolled courses query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching enrolled courses.";
}

// Fetch available courses for the instructor (not enrolled by the student)
$query = "SELECT c.courseID, c.courseName 
          FROM oscord_course c 
          JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
          WHERE ic.instructorID = ? 
          AND c.courseID NOT IN (
              SELECT courseID 
              FROM oscord_studentxcourse 
              WHERE studentID = ?
          )";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("ii", $instructorID, $studentID);
    $stmt->execute();
    $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $error = "Failed to prepare available courses query: " . $conn->error;
    logDebug($error);
    $course_message = "Error fetching available courses.";
}

// Handle PIN verification via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'verify_pin') {
    $enteredPin = $_POST['pin'];
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result && $result['instructorPin'] == $enteredPin) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
    exit();
}

// Handle student approval update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_approval']) && isset($_POST['pin_verified']) && $_POST['pin_verified'] == 'true') {
    $studentApprove = isset($_POST['student_approve']) ? 1 : 0;
    $query = "UPDATE oscord_student SET studentApprove = ? WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ii", $studentApprove, $studentID);
        if ($stmt->execute()) {
            $message = "Student approval status updated successfully.";
            logDebug("Student ID $studentID approval status updated to $studentApprove by instructor ID $instructorID");
            // Refresh student details
            $query = "SELECT * FROM oscord_student WHERE studentID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("i", $studentID);
                $stmt->execute();
                $student = $stmt->get_result()->fetch_assoc();
                $stmt->close();
            }
        } else {
            $error = "Failed to update student approval: " . $stmt->error;
            logDebug($error);
            $message = "Error updating student approval status.";
        }
    } else {
        $error = "Failed to prepare update query: " . $conn->error;
        logDebug($error);
        $message = "Error preparing update.";
    }
}

// Handle course registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_course']) && isset($_POST['pin_verified']) && $_POST['pin_verified'] == 'true') {
    if (!empty($_POST['course_ids']) && is_array($_POST['course_ids'])) {
        $success_count = 0;
        $enrollDate = date('Y-m-d');
        foreach ($_POST['course_ids'] as $courseID) {
            $courseID = intval($courseID);
            // Check instructor authorization
            $query = "SELECT courseID FROM oscord_instructorxcourse WHERE courseID = ? AND instructorID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $courseID, $instructorID);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Register course
                    $query = "INSERT INTO oscord_studentxcourse (studentID, courseID, enrollDate) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    if ($stmt) {
                        $stmt->bind_param("iis", $studentID, $courseID, $enrollDate);
                        if ($stmt->execute()) {
                            $success_count++;
                            logDebug("Course ID $courseID registered for student ID $studentID by instructor ID $instructorID");
                        }
                        $stmt->close();
                    }
                }
            }
        }
        if ($success_count > 0) {
            $course_message = "$success_count course(s) successfully registered for the student.";
            // Refresh enrolled courses
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_studentxcourse sc ON c.courseID = sc.courseID 
                      WHERE sc.studentID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $studentID);
            $stmt->execute();
            $enrolledCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            // Refresh available courses
            $query = "SELECT c.courseID, c.courseName 
                      FROM oscord_course c 
                      JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
                      WHERE ic.instructorID = ? 
                      AND c.courseID NOT IN (
                          SELECT courseID 
                          FROM oscord_studentxcourse 
                          WHERE studentID = ?
                      )";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $instructorID, $studentID);
            $stmt->execute();
            $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $course_message = "No courses registered. Check authorization or try again.";
        }
    } else {
        $course_message = "Please select at least one course to register.";
    }
}

// Handle course dropping
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['drop_course']) && isset($_POST['pin_verified']) && $_POST['pin_verified'] == 'true') {
    $courseID = intval($_POST['course_id']);
    $query = "SELECT courseID FROM oscord_instructorxcourse WHERE courseID = ? AND instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ii", $courseID, $instructorID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $query = "DELETE FROM oscord_studentxcourse WHERE studentID = ? AND courseID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $studentID, $courseID);
                if ($stmt->execute()) {
                    $course_message = "Course successfully dropped for the student.";
                    logDebug("Course ID $courseID dropped for student ID $studentID by instructor ID $instructorID");
                    // Refresh enrolled courses
                    $query = "SELECT c.courseID, c.courseName 
                              FROM oscord_course c 
                              JOIN oscord_studentxcourse sc ON c.courseID = sc.courseID 
                              WHERE sc.studentID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $studentID);
                    $stmt->execute();
                    $enrolledCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    // Refresh available courses
                    $query = "SELECT c.courseID, c.courseName 
                              FROM oscord_course c 
                              JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
                              WHERE ic.instructorID = ? 
                              AND c.courseID NOT IN (
                                  SELECT courseID 
                                  FROM oscord_studentxcourse 
                                  WHERE studentID = ?
                              )";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ii", $instructorID, $studentID);
                    $stmt->execute();
                    $availableCourses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                } else {
                    $error = "Failed to drop course: " . $stmt->error;
                    logDebug($error);
                    $course_message = "Error dropping course.";
                }
            } else {
                $error = "Failed to prepare drop course query: " . $conn->error;
                logDebug($error);
                $course_message = "Error preparing course drop.";
            }
        } else {
            $course_message = "You are not authorized to drop this course.";
        }
    } else {
        $error = "Failed to prepare course authorization query: " . $conn->error;
        logDebug($error);
        $course_message = "Error checking course authorization.";
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
    <title>Manage Student - Oscord</title>
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
        .cyber-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .cyber-table th, .cyber-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 20, 147, 0.3);
        }
        .cyber-table th {
            background: rgba(255, 20, 147, 0.2);
            color: #00ffea;
            font-weight: 700;
        }
        .cyber-table tr:hover {
            background: rgba(0, 255, 234, 0.1);
        }
        .cyber-table .btn-cyber {
            padding: 0.5rem 1rem;
            width: auto;
        }
        .cyber-table .checkbox-field {
            accent-color: #00ffea;
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container mx-auto">
        <!-- PIN Verification Modal -->
        <div id="pinModal" class="modal">
            <div class="modal-content">
                <h3 class="text-xl font-bold text-white mb-4">Enter Your PIN</h3>
                <input type="number" id="pinInput" class="input-field" placeholder="Enter 6-digit PIN">
                <p id="pinError" class="text-red-400 hidden mb-4"></p>
                <div class="flex justify-center space-x-4">
                    <button class="btn-cyber" onclick="verifyPin()">Submit</button>
                    <button class="btn-cyber" onclick="closePinModal()">Cancel</button>
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
                    <p class="text-gray-400">Country: <?php echo htmlspecialchars($student['studentCountry']); ?></p>
                    <p class="text-gray-400">Birthday: <?php echo htmlspecialchars($student['studentBirthday']); ?></p>
                    <p class="text-gray-400">Phone: <?php echo htmlspecialchars($student['studentPhone']); ?></p>
                    <p class="text-gray-400">Telegram: <?php echo htmlspecialchars($student['studentTelegram']); ?></p>
                    <p class="text-gray-400">Registration Date: <?php echo htmlspecialchars($student['registrationDate']); ?></p>
                    <p class="text-gray-400">Question 1 (Prior Experience): <?php echo htmlspecialchars($student['question1']); ?></p>
                    <p class="text-gray-400">Question 2 (Goal): <?php echo htmlspecialchars($student['question2']); ?></p>
                    <p class="text-gray-400">Approval Status: <?php echo $student['studentApprove'] ? 'Approved ✔️' : 'Not Approved ❌'; ?></p>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="admin_dashboard.php" class="btn-cyber mt-4 inline-block text-center">Back to Dashboard</a>
                <button onclick="toggleEditForm()" class="btn-cyber mt-4 inline-block text-center">Edit Approval Status</button>
            </div>

            <!-- Edit Approval Form (Hidden by default) -->
            <div id="editForm" class="mt-6 hidden">
                <?php if (!empty($message)): ?>
                    <div class="alert-cyber">
                        <span><?php echo htmlspecialchars($message); ?></span>
                        <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                    </div>
                <?php endif; ?>
                <form id="approvalForm" method="POST" action="">
                    <input type="hidden" name="update_approval" value="true">
                    <input type="hidden" name="pin_verified" id="approvalPinVerified" value="false">
                    <div class="checkbox-group">
                        <input type="checkbox" name="student_approve" id="student_approve" class="checkbox-field" <?php echo $student['studentApprove'] ? 'checked' : ''; ?>>
                        <label for="student_approve" class="checkbox-label">Approve Student</label>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="btn-cyber" onclick="return showPinModal('approvalForm')">Save Changes</button>
                        <button type="button" onclick="toggleEditForm()" class="btn-cyber">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enrolled Courses -->
        <div class="cyber-card">
            <h3 class="text-2xl font-bold text-white mb-6">Enrolled Courses</h3>
            <?php if (empty($enrolledCourses)): ?>
                <p class="text-gray-400 mb-4">This student is not enrolled in any courses.</p>
            <?php else: ?>
                <table class="cyber-table mb-4">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enrolledCourses as $course): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($course['courseID']); ?></td>
                                <td><?php echo htmlspecialchars($course['courseName']); ?></td>
                                <td>
                                    <form id="dropForm_<?php echo $course['courseID']; ?>" method="POST" action="">
                                        <input type="hidden" name="drop_course" value="true">
                                        <input type="hidden" name="pin_verified" id="dropPinVerified_<?php echo $course['courseID']; ?>" value="false">
                                        <input type="hidden" name="course_id" value="<?php echo $course['courseID']; ?>">
                                        <button type="submit" class="btn-cyber" onclick="return showPinModal('dropForm_<?php echo $course['courseID']; ?>')">Drop</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Register New Course -->
        <div class="cyber-card">
            <h3 class="text-2xl font-bold text-white mb-6">Register New Course</h3>
            <?php if (!empty($course_message)): ?>
                <div class="alert-cyber">
                    <span><?php echo htmlspecialchars($course_message); ?></span>
                    <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                </div>
            <?php endif; ?>
            <?php if (empty($availableCourses)): ?>
                <p class="text-gray-400 mb-4">No available courses to register for this student.</p>
            <?php else: ?>
                <form id="registerForm" method="POST" action="">
                    <input type="hidden" name="register_course" value="true">
                    <input type="hidden" name="pin_verified" id="registerPinVerified" value="false">
                    <table class="cyber-table mb-4">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Course ID</th>
                                <th>Course Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($availableCourses as $course): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="course_ids[]" value="<?php echo $course['courseID']; ?>" class="checkbox-field">
                                    </td>
                                    <td><?php echo htmlspecialchars($course['courseID']); ?></td>
                                    <td><?php echo htmlspecialchars($course['courseName']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn-cyber" onclick="return showPinModal('registerForm')">Register Selected Courses</button>
                </form>
            <?php endif; ?>
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

        // PIN Modal Functions
        let currentFormId = null;

        function showPinModal(formId) {
            currentFormId = formId;
            const modal = document.getElementById('pinModal');
            const pinInput = document.getElementById('pinInput');
            const pinError = document.getElementById('pinError');
            pinInput.value = '';
            pinError.classList.add('hidden');
            modal.style.display = 'flex';
            pinInput.focus();
            return false; // Prevent form submission
        }

        function closePinModal() {
            const modal = document.getElementById('pinModal');
            modal.style.display = 'none';
            currentFormId = null;
        }

        function verifyPin() {
            const pinInput = document.getElementById('pinInput');
            const pinError = document.getElementById('pinError');
            const pin = pinInput.value;

            if (!pin || pin.length !== 6 || !/^\d+$/.test(pin)) {
                pinError.textContent = 'Please enter a valid 6-digit PIN.';
                pinError.classList.remove('hidden');
                return;
            }

            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=verify_pin&pin=${encodeURIComponent(pin)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const form = document.getElementById(currentFormId);
                    const pinVerifiedInput = form.querySelector('[name="pin_verified"]');
                    pinVerifiedInput.value = 'true';
                    form.submit();
                } else {
                    pinError.textContent = data.message || 'Incorrect PIN.';
                    pinError.classList.remove('hidden');
                }
            })
            .catch(error => {
                pinError.textContent = 'Error verifying PIN. Please try again.';
                pinError.classList.remove('hidden');
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>