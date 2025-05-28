<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connectdb.php";

function isValidPasscode($passcode) {
    if (strlen($passcode) < 8) {
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
    if (!preg_match('/[@$!%*?&]/', $passcode)) {
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $today = date("Y-m-d"); // Consistent date variable

    if ($role == "instructor") {
        if (
            isset($_POST['instructor_name']) && 
            isset($_POST['instructor_age']) && 
            isset($_POST['instructor_phone']) && 
            isset($_POST['instructor_email']) && 
            isset($_POST['instructor_passcode']) && 
            isset($_POST['instructorCourse']) && 
            !empty($_POST['instructor_name']) && 
            !empty($_POST['instructor_age']) && 
            !empty($_POST['instructor_phone']) && 
            !empty($_POST['instructor_email']) && 
            !empty($_POST['instructor_passcode']) && 
            !empty($_POST['instructorCourse']) // Fixed parenthesis
        ) {
            if (isValidPasscode($_POST['instructor_passcode'])) {
                $name = $_POST['instructor_name'];
                $age = $_POST['instructor_age'];
                $phone = $_POST['instructor_phone'];
                $email = $_POST['instructor_email'];
                $passcode = password_hash($_POST['instructor_passcode'], PASSWORD_DEFAULT); // Hash passcode
                $courses = $_POST['instructorCourse'];

                $query1 = "INSERT INTO oscord_instructor (instructorName, instructorEmail, instructorPassword, instructorAge, instructorPhone, registrationDate) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query1);
                $stmt->bind_param("sssiss", $name, $email, $passcode, $age, $phone, $today); // Added registrationDate
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $instructorID = $conn->insert_id;

                    foreach ($courses as $courseID) {
                        $query2 = "INSERT INTO oscord_instructorxcourse (instructorID, courseID) VALUES (?, ?)";
                        $stmt2 = $conn->prepare($query2);
                        $stmt2->bind_param("ii", $instructorID, $courseID);
                        $stmt2->execute();
                        $stmt2->close();
                    }

                    echo "<script>alert('Instructor Registered Successfully!'); window.location.replace('oscord_home.php');</script>";
                    $stmt->close();
                    exit;
                } else {
                    echo "<script>alert('Error registering instructor: " . $stmt->error . "'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt->close();
                    exit;
                }
            } else {
                echo "<script>alert('Invalid Passcode Format: Must be at least 8 characters with uppercase, lowercase, number, and special character.'); window.location.replace('oscord_signUpPage.php');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Please fill all required fields for instructor registration.'); window.location.replace('oscord_signUpPage.php');</script>";
            exit;
        }
    } elseif ($role == "student") {
        if (
            isset($_POST['student_name']) && 
            isset($_POST['student_country']) && 
            isset($_POST['student_email']) && 
            isset($_POST['student_passcode']) && 
            isset($_POST['student_age']) && 
            isset($_POST['student_telegram']) && 
            isset($_POST['student_phone']) && 
            isset($_POST['student_question1']) && // Fixed field names
            isset($_POST['student_question2']) && 
            isset($_POST['studentCourse']) && 
            !empty($_POST['student_name']) && 
            !empty($_POST['student_country']) && 
            !empty($_POST['student_email']) && 
            !empty($_POST['student_passcode']) && 
            !empty($_POST['student_age']) && 
            !empty($_POST['student_telegram']) && 
            !empty($_POST['student_phone']) && 
            !empty($_POST['student_question1']) && 
            !empty($_POST['student_question2']) && 
            !empty($_POST['studentCourse'])
        ) {
            if (isValidPasscode($_POST['student_passcode'])) {
                $name = $_POST['student_name'];
                $country = $_POST['student_country'];
                $email = $_POST['student_email'];
                $passcode = password_hash($_POST['student_passcode'], PASSWORD_DEFAULT); // Hash passcode
                $age = $_POST['student_age'];
                $telegram = $_POST['student_telegram'];
                $phone = $_POST['student_phone'];
                $question1 = $_POST['student_question1'];
                $question2 = $_POST['student_question2'];
                $courses = $_POST['studentCourse'];

                $query3 = "INSERT INTO oscord_student (studentName, studentEmail, studentPassword, studentAge, studentPhone, studentCountry, studentTelegram, question1, question2, registrationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt3 = $conn->prepare($query3);
                $stmt3->bind_param("sssississs", $name, $email, $passcode, $age, $phone, $country, $telegram, $question1, $question2, $today); // Fixed bind_param
                $stmt3->execute();

                if ($stmt3->affected_rows > 0) {
                    $studentID = $conn->insert_id;

                    foreach ($courses as $courseID) {
                        $query4 = "INSERT INTO oscord_studentxcourse (studentID, courseID, enrollDate) VALUES (?, ?, ?)";
                        $stmt4 = $conn->prepare($query4);
                        $stmt4->bind_param("iis", $studentID, $courseID, $today); // Fixed bind_param for enrollDate
                        $stmt4->execute();
                        $stmt4->close();
                    }

                    echo "<script>alert('Student Registered Successfully!'); window.location.replace('oscord_home.php');</script>";
                    $stmt3->close();
                    exit;
                } else {
                    echo "<script>alert('Error registering student: " . $stmt3->error . "'); window.location.replace('oscord_signUpPage.php');</script>";
                    $stmt3->close();
                    exit;
                }
            } else {
                echo "<script>alert('Invalid Passcode Format: Must be at least 8 characters with uppercase, lowercase, number, and special character.'); window.location.replace('oscord_signUpPage.php');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Please fill all required fields for student registration.'); window.location.replace('oscord_signUpPage.php');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Invalid role selected.'); window.location.replace('oscord_signUpPage.php');</script>";
        exit;
    }
}

$conn->close();
?>