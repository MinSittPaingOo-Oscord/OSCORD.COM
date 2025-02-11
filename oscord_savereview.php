<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    #echo "Student ID: " . $_POST['student_name'] . "<br>";
    #echo "Review Text: " . $_POST['review_text'] . "<br>";
    #echo "Course ID: " . $_POST['courseID'] . "<br>";

    $studentID = $_POST['student_name'];
    $reviewText = $_POST['review_text'];
    $courseID = $_POST['courseID']; 

    if (!empty($studentID) && !empty($reviewText) && !empty($courseID)) {
        $query1 = "INSERT INTO oscord_studentreview (studentreview, courseID, studentID) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("sii", $reviewText, $courseID, $studentID);  
        
  if ($stmt->execute()) {
    echo "<script type='text/javascript'>
            alert('Review submitted successfully!');
          window.location.href = 'oscord_home.php";
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('Error occurred');
            window.location.href = 'oscord_home.php";

          </script>";
}


    } else {
        echo "All fields are required!";
    }
}

$conn->close();
?>