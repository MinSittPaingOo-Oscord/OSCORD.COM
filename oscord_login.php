<?php
include "connectdb.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "false";
    $conn->close();
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$courseID = isset($_POST['courseID']) ? (int)$_POST['courseID'] : 0;

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password) || $courseID <= 0) {
    echo "false";
    $conn->close();
    exit;
}

// Check student login
$query_student = "
    SELECT s.studentPassword, s.studentApprove
    FROM oscord_student s
    JOIN oscord_studentxcourse sx ON s.studentID = sx.studentID
    WHERE sx.courseID = ? AND s.studentEmail = ? AND s.studentApprove = 1
    LIMIT 1
";
$stmt_student = $conn->prepare($query_student);
$stmt_student->bind_param("is", $courseID, $email);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$loginStudent = false;

if ($row_student = $result_student->fetch_assoc()) {
    if (password_verify($password, $row_student['studentPassword'])) {
        $loginStudent = true;
    }
}
$stmt_student->close();

$loginInstructor = false;
if (!$loginStudent) {
    // Check instructor login only if student login fails
    $query_instructor = "
        SELECT i.instructorPassword, i.instructorApprove
        FROM oscord_instructor i
        JOIN oscord_instructorxcourse ix ON i.instructorID = ix.instructorID
        WHERE ix.courseID = ? AND i.instructorEmail = ? AND i.instructorApprove = 1
        LIMIT 1
    ";
    $stmt_instructor = $conn->prepare($query_instructor);
    $stmt_instructor->bind_param("is", $courseID, $email);
    $stmt_instructor->execute();
    $result_instructor = $stmt_instructor->get_result();

    if ($row_instructor = $result_instructor->fetch_assoc()) {
        if (password_verify($password, $row_instructor['instructorPassword'])) {
            $loginInstructor = true;
        }
    }
    $stmt_instructor->close();
}

echo ($loginStudent || $loginInstructor) ? "true" : "false";
$conn->close();
exit;
?>

<!-- Database Index Recommendations -->
<!--
CREATE INDEX idx_studentxcourse_course_id ON oscord_studentxcourse(courseID);
CREATE INDEX idx_instructorxcourse_course_id ON oscord_instructorxcourse(courseID);
CREATE INDEX idx_student_email_approve ON oscord_student(studentEmail, studentApprove);
CREATE INDEX idx_instructor_email_approve ON oscord_instructor(instructorEmail, instructorApprove);
-->