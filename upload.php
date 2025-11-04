<?php

include "connectdb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {

    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
    $fileError = $file['error'];
        $courseID = $_POST['courseID'];

    $fileData = file_get_contents($fileTmpName);


    if ($fileError === 0) {

        $stmt = $conn->prepare("INSERT INTO file (fileName,courseID,fileData) VALUES (?, ?,?)");
        $stmt->bind_param("sib", $fileName,$courseID, $null);

        $stmt->send_long_data(2, $fileData);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>
            alert('File upload successful !');
          window.location.href = 'admin_dashboard.php'</script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error saving file information to the database!');
          window.location.href = 'admin_dashboard.php'</script>";
        }
        $stmt->close();
    } else {
        echo "Error with the file upload!";
    }
}

$conn->close();
?>
