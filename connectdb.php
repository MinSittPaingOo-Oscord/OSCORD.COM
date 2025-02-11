<?php
$servername		= "fdb1030.awardspace.net";
$username 		= "4586032_oscord";
$password 		= "Thanoswasright@1989";
$databasename 	= "4586032_oscord";
$port = 3306 ;
$conn = new mysqli($servername,$username,$password,$databasename,$port);
if ($conn->connect_error)
   die("Connection failed: " . $conn->connect_error);
else 
   #echo "Connected successfully";
?>
