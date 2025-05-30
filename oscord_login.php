<?php
include "connectdb.php";

$loginStudent    = false;
$loginInstructor = false;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "false";
    $conn->close();
    exit;
}

$email    = trim($_POST['email']    ?? '');
$password =             $_POST['password'] ?? '';
$courseID = isset($_POST['courseID']) ? (int)$_POST['courseID'] : 0;

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password) || $courseID <= 0) {
    echo "false";
    $conn->close();
    exit;
}

$query8 = "SELECT studentID FROM oscord_studentxcourse WHERE courseID = ?";
if ($stmt8 = $conn->prepare($query8)) {
    $stmt8->bind_param("i", $courseID);
    $stmt8->execute();
    $result8 = $stmt8->get_result();

    while ($row8 = $result8->fetch_assoc()) {
        $query9 = "
            SELECT studentEmail, studentPassword, studentApprove
            FROM oscord_student
            WHERE studentID = ?
        ";
        if ($stmt9 = $conn->prepare($query9)) {
            $stmt9->bind_param("i", $row8['studentID']);
            $stmt9->execute();
            $result9 = $stmt9->get_result();

            while ($row9 = $result9->fetch_assoc()) {
                $pwdOk = password_verify($password, $row9['studentPassword'])
                       || ($password === $row9['studentPassword']);

                if (strcasecmp($row9['studentEmail'], $email) === 0
                    && $pwdOk
                    && $row9['studentApprove'] == 1) {
                    $loginStudent = true;
                    break 2;  // exit both loops
                }
            }
            $stmt9->close();
        }
    }
    $stmt8->close();
}

$query10 = "SELECT instructorID FROM oscord_instructorxcourse WHERE courseID = ?";
if ($stmt10 = $conn->prepare($query10)) {
    $stmt10->bind_param("i", $courseID);
    $stmt10->execute();
    $result10 = $stmt10->get_result();

    while ($row10 = $result10->fetch_assoc()) {
        $query11 = "
            SELECT instructorEmail, instructorPassword, instructorApprove
            FROM oscord_instructor
            WHERE instructorID = ?
        ";
        if ($stmt11 = $conn->prepare($query11)) {
            $stmt11->bind_param("i", $row10['instructorID']);
            $stmt11->execute();
            $result11 = $stmt11->get_result();

            while ($row11 = $result11->fetch_assoc()) {
                $pwdOk = password_verify($password, $row11['instructorPassword'])
                       || ($password === $row11['instructorPassword']);

                if (strcasecmp($row11['instructorEmail'], $email) === 0
                    && $pwdOk
                    && $row11['instructorApprove'] == 1) {
                    $loginInstructor = true;
                    break 2;
                }
            }
            $stmt11->close();
        }
    }
    $stmt10->close();
}

$login = $loginStudent || $loginInstructor;
echo $login ? "true" : "false";

$conn->close();
exit;
?>
