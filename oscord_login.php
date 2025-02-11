<?php
	
	include "connectdb.php";  
	$loginStudent = false;
	$loginInstructor = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    	$email = $_POST['email'];
    	$password = $_POST['password'];
            $id = $_POST['courseID'];
  
	}
           
 	
	$query8 = "SELECT * FROM oscord_studentxcourse WHERE oscord_studentxcourse.courseID =".$id;
	$result8 = $conn->query($query8);
                    
	while($row8 = $result8->fetch_assoc()){
                                               		 
           $query9 = "SELECT * FROM oscord_student WHERE oscord_student.studentID=".$row8['studentID'];
           $result9 = $conn ->query($query9);
                                
           while($row9 = $result9->fetch_assoc()){
                                       
                     if($row9['studentEmail'] == $email && $row9['studentPassword'] == $password && $row9['studentApprove'] == 1){
                     	        $loginStudent = true;
                     }
                               		       
           }
	}

	$query10 = "SELECT * FROM oscord_instructorxcourse WHERE oscord_instructorxcourse.courseID =".$id;
	$result10 = $conn->query($query10);
                    
	while($row10 = $result10->fetch_assoc()){
                                               		 
           $query11 = "SELECT * FROM oscord_instructor WHERE oscord_instructor.instructorID=".$row10['instructorID'];
           $result11 = $conn ->query($query11);
                                
           while($row11 = $result11->fetch_assoc()){
                                       
                     if($row11['instructorEmail'] == $email && $row11['instructorPassword'] == $password && $row11['instructorApprove'] == 1){
                     	        $loginInstructor = true;
                     }
                               		       
           }
	}
$login = $loginStudent || $loginInstructor;
echo $login ? "true" : "false";
                    
?>