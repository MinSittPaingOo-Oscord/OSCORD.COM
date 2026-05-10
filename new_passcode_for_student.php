<?php

require_once "connectdb.php";

$studentID = 71;           
$newPassword = "Leonkennendy9090";  

$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

$sql = "UPDATE oscord_student 
        SET studentPassword = ? 
        WHERE studentID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $hashedPassword, $studentID);


if ($stmt->execute()) {
    echo "Password reset successful.";
} else {
    echo "Error resetting password.";
}

$stmt->close();
$conn->close();

?>