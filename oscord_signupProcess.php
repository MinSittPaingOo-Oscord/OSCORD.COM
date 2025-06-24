<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connectdb.php";

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// Note: Ensure oscord_instructor.instructorPassword and oscord_student.studentPassword are VARCHAR(500) to store hashed passwords correctly.

function isValidPasscode($passcode) {
    /*if (strlen($passcode) < 8) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $passcode)) {
        return false;
    }
    if (!preg_match('/[a-z]/', $passcode)) {
        return false;
    }
    if (!preg_match('/[0-9]/', $passcode)) {
        return false;
    }
    if (!preg_match('/[@$!%*_?&]/', $passcode)) {
        return false;
    }*/
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';
    $today = date("Y-m-d");

    // Log received POST data for debugging
    error_log("POST data: " . print_r($_POST, true));

    if ($role == "instructor") {
        if (
            isset($_POST['instructor_name']) && 
            isset($_POST['instructor_birthday']) && 
            isset($_POST['instructor_phone']) && 
            isset($_POST['instructor_email']) && 
            isset($_POST['instructor_passcode']) && 
            isset($_POST['instructor_pin']) && 
            isset($_POST['instructorCourse']) && 
            !empty(trim($_POST['instructor_name'])) && 
            !empty(trim($_POST['instructor_birthday'])) && 
            !empty(trim($_POST['instructor_phone'])) && 
            !empty(trim($_POST['instructor_email'])) && 
            !empty(trim($_POST['instructor_passcode'])) && 
            isset($_POST['instructor_pin']) && $_POST['instructor_pin'] !== '' && 
            !empty($_POST['instructorCourse'])
        ) {
            if (isValidPasscode($_POST['instructor_passcode'])) {
                $name = trim($_POST['instructor_name']);
                $birthday = trim($_POST['instructor_birthday']);
                $phone = trim($_POST['instructor_phone']);
                $email = trim($_POST['instructor_email']);
                $passcode = password_hash(trim($_POST['instructor_passcode']), PASSWORD_DEFAULT);
                $pin = (int) trim($_POST['instructor_pin']);
                $approve = 0; // Default value for instructorApprove
                $courses = $_POST['instructorCourse'];

                // Validate birthday format
                if (!DateTime::createFromFormat('Y-m-d', $birthday)) {
                    error_log("Invalid birthday format for instructor: $birthday");
                    echo "<script>alert('Invalid birthday format. Please use YYYY-MM-DD.'); window.location.replace('oscord_signUpPage.php');</script>";
                    exit;
                }

                // Validate PIN
                if ($pin < 100000 || $pin > 999999) {
                    error_log("Invalid PIN for instructor: $pin");
                    echo "<script>alert('Invalid PIN: Must be exactly 6 digits (100000–999999).'); window.location.replace('oscord_signUpPage.php');</script>";
                    exit;
                }

                $query1 = "INSERT INTO oscord_instructor (instructorName, instructorEmail, instructorPassword, instructorBirthday, instructorPhone, instructorApprove, instructorPin) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query1);
                if (!$stmt) {
                    error_log("Prepare failed: " . $conn->error);
                    echo "<script>alert('Database error: Unable to prepare statement.'); window.location.replace('oscord_signUpPage.php');</script>";
                    exit;
                }
                $stmt->bind_param("sssssii", $name, $email, $passcode, $birthday, $phone, $approve, $pin);
                if (!$stmt->execute()) {
                    error_log("Execute failed: " . $stmt->error);
                    echo "<script>alert('Error registering instructor: " . addslashes($stmt->error) . "'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt->close();
                    exit;
                }

                if ($stmt->affected_rows > 0) {
                    $instructorID = $conn->insert_id;

                    foreach ($courses as $courseID) {
                        $query2 = "INSERT INTO oscord_instructorxcourse (instructorID, courseID) VALUES (?, ?)";
                        $stmt2 = $conn->prepare($query2);
                        if (!$stmt2) {
                            error_log("Prepare failed for instructorxcourse: " . $conn->error);
                            continue;
                        }
                        $stmt2->bind_param("ii", $instructorID, $courseID);
                        $stmt2->execute();
                        $stmt2->close();
                    }

                    echo "<script>alert('Instructor Registered Successfully!'); window.location.replace('oscord_home.php');</script>";
                    $stmt->close();
                    exit;
                } else {
                    error_log("No rows affected for instructor insert");
                    echo "<script>alert('Error registering instructor: No data inserted.'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt->close();
                    exit;
                }
            } else {
                error_log("Invalid passcode for instructor");
                echo "<script>alert('Invalid Passcode Format: Must be at least 8 characters with uppercase, lowercase, number, and special character.'); window.location.replace('oscord_signUpPage.php');</script>";
                exit;
            }
        } else {
            error_log("Missing required fields for instructor");
            echo "<script>alert('Please fill all required fields for instructor registration, including a 6-digit PIN.'); window.location.replace('oscord_signUpPage.php');</script>";
            exit;
        }
    } elseif ($role == "student") {
        if (
            isset($_POST['student_name']) && 
            isset($_POST['student_country']) && 
            isset($_POST['student_email']) && 
            isset($_POST['student_passcode']) && 
            isset($_POST['student_birthday']) && 
            isset($_POST['student_telegram']) && 
            isset($_POST['student_phone']) && 
            isset($_POST['student_question1']) && 
            isset($_POST['student_question2']) && 
            isset($_POST['studentCourse']) && 
            !empty(trim($_POST['student_name'])) && 
            !empty(trim($_POST['student_country'])) && 
            !empty(trim($_POST['student_email'])) && 
            !empty(trim($_POST['student_passcode'])) && 
            !empty(trim($_POST['student_birthday'])) && 
            !empty(trim($_POST['student_telegram'])) && 
            !empty(trim($_POST['student_phone'])) && 
            !empty(trim($_POST['student_question1'])) && 
            !empty(trim($_POST['student_question2'])) && 
            !empty($_POST['studentCourse'])
        ) {
            if (isValidPasscode($_POST['student_passcode'])) {
                $name = trim($_POST['student_name']);
                $country = trim($_POST['student_country']);
                $email = trim($_POST['student_email']);
                $passcode = password_hash(trim($_POST['student_passcode']), PASSWORD_DEFAULT);
                $birthday = trim($_POST['student_birthday']);
                $telegram = trim($_POST['student_telegram']);
                $phone = trim($_POST['student_phone']);
                $question1 = trim($_POST['student_question1']);
                $question2 = trim($_POST['student_question2']);
                $approve = 0; // Default value for studentApprove
                $courses = $_POST['studentCourse'];

                // Validate birthday format
                if (!DateTime::createFromFormat('Y-m-d', $birthday)) {
                    error_log("Invalid birthday format for student: $birthday");
                    echo "<script>alert('Invalid birthday format. Please use YYYY-MM-DD.'); window.location.replace('oscord_signUpPage.php');</script>";
                    exit;
                }

                $query3 = "INSERT INTO oscord_student (studentName, studentEmail, studentPassword, studentBirthday, studentPhone, studentCountry, studentTelegram, question1, question2, studentApprove, registrationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt3 = $conn->prepare($query3);
                if (!$stmt3) {
                    error_log("Prepare failed: " . $conn->error);
                    echo "<script>alert('Database error: Unable to prepare statement.'); window.location.replace('oscord_signUpPage.php');</script>";
                    exit;
                }
                $stmt3->bind_param("sssssssssis", $name, $email, $passcode, $birthday, $phone, $country, $telegram, $question1, $question2, $approve, $today);
                if (!$stmt3->execute()) {
                    error_log("Execute failed: " . $stmt3->error);
                    echo "<script>alert('Error registering student: " . addslashes($stmt3->error) . "'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt3->close();
                    exit;
                }

                if ($stmt3->affected_rows > 0) {
                    $studentID = $conn->insert_id;

                    foreach ($courses as $courseID) {
                        $query4 = "INSERT INTO oscord_studentxcourse (studentID, courseID, enrollDate) VALUES (?, ?, ?)";
                        $stmt4 = $conn->prepare($query4);
                        if (!$stmt4) {
                            error_log("Prepare failed for studentxcourse: " . $conn->error);
                            continue;
                        }
                        $stmt4->bind_param("iis", $studentID, $courseID, $today);
                        $stmt4->execute();
                        $stmt4->close();
                    }

                    echo "<script>alert('Student Registered Successfully!'); window.location.replace('oscord_home.php');</script>";
                    $stmt3->close();
                    exit;
                } else {
                    error_log("No rows affected for student insert");
                    echo "<script>alert('Error registering student: No data inserted.'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt3->close();
                    exit;
                }
            } else {
                error_log("Invalid passcode for student");
                echo "<script>alert('Invalid Passcode Format: Must be at least 8 characters with uppercase, lowercase, number, and special character.'); window.location.replace('oscord_signUpPage.php');</script>";
                exit;
            }
        } else {
            error_log("Missing required fields for student");
            echo "<script>alert('Please fill all required fields for student registration.'); window.location.replace('oscord_signUpPage.php');</script>";
            exit;
        }
    } else {
        error_log("Invalid role selected: $role");
        echo "<script>alert('Invalid role selected.'); window.location.replace('oscord_signUpPage.php');</script>";
        exit;
    }
} else {
    error_log("Invalid request method: " . $_SERVER["REQUEST_METHOD"]);
    echo "<script>alert('Invalid request method.'); window.location.replace('oscord_signUpPage.php');</script>";
    exit;
}

$conn->close();
?>