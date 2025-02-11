<?php
include "connectdb.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $role = $_POST['role'];

    if ($role == "instructor") {
       
        $name = $_POST['instructor_name'];
            
        $age = $_POST['instructor_age'];
            
        $phone = $_POST['instructor_phone'];
            
        $email = $_POST['instructor_email'];
            
        $passcode = $_POST['instructor_passcode'];
            
        $courses = isset($_POST['instructorCourse']) ? $_POST['instructorCourse'] : [];

  
        $query1 = "INSERT INTO oscord_instructor (instructorName, instructorEmail, instructorPassword, instructorAge, instructorPhone) VALUES (?, ?, ?, ?, ?)";
            
        $stmt = $conn->prepare($query1);
            
        $stmt->bind_param("sssis", $name, $email, $passcode , $age, $phone);
            
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
   
            $instructorID = $conn->insert_id;

            foreach ($courses as $courseID) {
                
                  $query2 = "INSERT INTO oscord_instructorxcourse (instructorID, courseID) VALUES (?, ?)";
            
       			 $stmt2 = $conn->prepare($query2);
            
        		$stmt2->bind_param("ii", $instructorID, $courseID);
            
        		$stmt2->execute();
            }

           echo "<script>alert('Instructor Registered Successfully!');</script>";
                ?><script> window.location.replace("oscord_home.php"); </script><?php exit;
        } else {
            echo "<script>alert('Error registering instructor!');</script>";
                ?><script> window.location.replace("oscord_home.php"); </script><?php exit;
        }


        $stmt->close();
        $stmt2->close();
            
    } elseif ($role == "student") {
        
        $name = $_POST['student_name'];
            
        $country = $_POST['student_country'];
            
        $email = $_POST['student_email'];
            
        $passcode = $_POST['student_passcode'];
            
        $age = $_POST['student_age'];
            
        $telegram = $_POST['student_telegram'];
            
        $phone = $_POST['student_phone'];
            
        $courses = isset($_POST['studentCourse']) ? $_POST['studentCourse'] : [];
            
       
        $query3 = "INSERT INTO oscord_student (studentName, studentEmail, studentPassword, studentAge, studentPhone, studentCountry, studentTelegram) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
        $stmt3 = $conn->prepare($query3);
            
        $stmt3->bind_param("sssisss", $name, $email, $passcode , $age, $phone,$country,$telegram);
            
        $stmt3->execute();

        if ($stmt3->affected_rows > 0) {
   
            $studentID = $conn->insert_id;

            foreach ($courses as $courseID) {
                
                  $query4 = "INSERT INTO oscord_studentxcourse (studentID, courseID) VALUES (?, ?)";
            
       			 $stmt4 = $conn->prepare($query4);
            
        		$stmt4->bind_param("ii", $studentID, $courseID);
            
        		$stmt4->execute();
            }

            echo "<script>alert('Student Registered Successfully!');</script>";
                ?><script> window.location.replace("oscord_home.php"); </script><?php exit;
        } else {
            echo "<script>alert('Error registering student');</script>";
                ?><script> window.location.replace("oscord_home.php"); </script><?php exit;
        }


        $stmt3->close();
        $stmt4->close();
            
    }
}
?>
