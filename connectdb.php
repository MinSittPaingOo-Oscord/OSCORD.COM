<?php
// $servername		= "ps04.zwhosting.com";
// $username 		= "zuhpszwh_mspo";
// $password 		= "Thanoswasright@1989";
// $databasename 	= "zuhpszwh_oscord";

$servername		= "localhost";
$username 		= "root";
$password 		= "Thanoswasright@1989";
$databasename 	= "oscord";
$port = 3306 ;
$conn = new mysqli($servername,$username,$password,$databasename,$port);
if ($conn->connect_error)
   die("Connection failed: " . $conn->connect_error);
else 
   #echo "Connected successfully";
?>
