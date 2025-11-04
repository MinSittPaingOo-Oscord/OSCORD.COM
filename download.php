<?php
include "connectdb.php";

if (isset($_GET['id'])) {
        
    $fileId = $_GET['id'];
    $sql = "SELECT * FROM file WHERE fileID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fileId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fileData = $row['fileData'];
        $fileName = $row['fileName'];

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . strlen($fileData));
        echo $fileData;
    } else {
        echo "File not found!";
    }

    $stmt->close();
}

$conn->close();
?>
