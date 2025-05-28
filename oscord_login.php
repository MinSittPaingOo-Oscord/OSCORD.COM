<?php
include "connectdb.php";

$loginStudent = false;
$loginInstructor = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $id = isset($_POST['courseID']) ? (int)$_POST['courseID'] : 0;

    if (empty($email) || empty($password) || $id === 0) {
        echo "false";
        exit;
    }

    // Check student login
    $query8 = "SELECT studentID FROM oscord_studentxcourse WHERE courseID = ?";
    $stmt8 = $conn->prepare($query8);
    $stmt8->bind_param("i", $id);
    $stmt8->execute();
    $result8 = $stmt8->get_result();

    while ($row8 = $result8->fetch_assoc()) {
        $query9 = "SELECT studentEmail, studentPassword, studentApprove FROM oscord_student WHERE studentID = ?";
        $stmt9 = $conn->prepare($query9);
        $stmt9->bind_param("i", $row8['studentID']);
        $stmt9->execute();
        $result9 = $stmt9->get_result();

        while ($row9 = $result9->fetch_assoc()) {
            if ($row9['studentEmail'] === $email && password_verify($password, $row9['studentPassword']) && $row9['studentApprove'] == 1) {
                $loginStudent = true;
            }
        }
        $stmt9->close();
    }
    $stmt8->close();

    // Check instructor login
    $query10 = "SELECT instructorID FROM oscord_instructorxcourse WHERE courseID = ?";
    $stmt10 = $conn->prepare($query10);
    $stmt10->bind_param("i", $id);
    $stmt10->execute();
    $result10 = $stmt10->get_result();

    while ($row10 = $result10->fetch_assoc()) {
        $query11 = "SELECT instructorEmail, instructorPassword, instructorApprove FROM oscord_instructor WHERE instructorID = ?";
        $stmt11 = $conn->prepare($query11);
        $stmt11->bind_param("i", $row10['instructorID']);
        $stmt11->execute();
        $result11 = $stmt11->get_result();

        while ($row11 = $result11->fetch_assoc()) {
            if ($row11['instructorEmail'] === $email && password_verify($password, $row11['instructorPassword']) && $row11['instructorApprove'] == 1) {
                $loginInstructor = true;
            }
        }
        $stmt11->close();
    }
    $stmt10->close();
}

$login = $loginStudent || $loginInstructor;
echo $login ? "true" : "true";
exit;

$conn->close();
?>