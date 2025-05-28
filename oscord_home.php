<?php
    include "connectdb.php";

    #selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    #selecting all courses information
    $query2 = "SELECT * FROM oscord_course";
	$result2 = $conn ->query($query2);

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
         
            body, html {
    			height: 100%; 
   	 			margin: 0;    
			}

			body {
    			background: linear-gradient(-45deg, #ee7752, rgb(253, 7, 179), #23a6d5, #23d5ab);
                 
               /* background-color : black;*/
    			background-attachment: fixed; 
    			background-size: 400% 400%;  
    			animation: gradient 4s ease infinite;
    			height: 100%;  
			}

			@keyframes gradient {
    			0% { background-position: 0% 50%; }
    			50% { background-position: 100% 50%; }
    			100% { background-position: 0% 50%; }
			}

           .navbar-custom {
              	background-color: black;
            	font-size: 18px; 
            }

        	.navbar-custom .nav-link {
            	color: white !important;
        	}

        	.navbar-custom .nav-link:hover {
            	color: #ccc !important;
        	}
        	
            .dropdown-menu{
            	background-color : black;
        	}
            
        	.dropdown-item{
            	background-color : black;
            	font-size : 18px;
            	color : white;
        	}
            
            .dropdown-item .coursedetail{
            	font-size : 14px;
        	}
        	
            .dropdown-item : hover{
            	color : #ccc !important
        	}
   		
            .card {
    			background-color: black;
                color : white;
    			border: 0px solid black; 
    			border-radius: 10px; 
    			width: 25em;
                height : 850px;
    			margin: 8px auto;             
    			box-shadow: none;  
    			text-align: left;
    			transition: transform 0.3s ease, background-color 0.3s ease;
            	display :block;
                box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
			}

			.card:hover {
    			transform: scale(1.009); 
    			background-color: white; 
    			color: black;
   	 			z-index: 10; 
    			box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
			}

			.card-title {
    			font-size: 50px; 
			}

			.card:hover .btn-course-detail {
   		 		font-size: 1.2em; 
                color : black;
			}
            
			.card-body {
    			padding: 20px;               
			}
            

        	.btn-course-detail{
            	width : 200px;
                    color : white;
            	background-color : transparent;
             	border : 1px solid white;
                margin-bottom: 20px;
        	}
            
        	.welcome-container {
    			background: url('./back2.jpg') no-repeat center center;
      
    			background-size: cover;
    			text-align: center;
    			border-radius: 0;
    			padding-bottom: 100px; 
                margin-bottom : 100px;
    			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    			width: 100%;
    			height: 100vh;
                  
                /*background-size : auto;*/
    			background-attachment: scroll;
    			display: flex;
    			flex-direction: column; 
    			justify-content: center; 
    			align-items: center; 
			}
            
          .circularImage {
            	width: 300px; 
            	height: 300px; 
            	border-radius: 50%; 
            	object-fit: cover; 
            	border: 1px solid #000;
        	}
            
        	.btnSignUp{
         		font-size : 2em;           
        	}
                
            .card-container {
            	margin-top: 50px;
        	}
            
            .middle{
    			justify-content: center;
    			align-items: center;
            }
            
            .middle .col h2,p{
            	display : flex;   
                color : white;
                 text-align : left;
           	}
            #titleCourse{
                    text-align : center;
                    padding-bottom : 70px;
                    font-weight : bold;
                    color : white;
                    font-family: Georgia, "Times New Roman", serif;
                    }
            
            
            
            @media (max-width: 768px) {
   			 .welcome-container {
        			height: auto;
        			padding: 50px 20px;
    			}
    	
    		.middle {
        		flex-direction: column;
        		text-align: center;
    		}

    		.middle .col {
       		 width: 100%;
        		padding-bottom: 20px;
   			 }

    		.card {
        		width: 100%;
        		margin-bottom: 20px;
    		}
    
    		.btn-course-detail {
       		 width: 100%;
    		}
               
}
               
				#homeConclusion {
    				width: 100%;
    				background-color: white;
    				color: black;
    				margin-top : 50px;
    				text-align: left;
				}

			#homeConclusion h4 {
    				font-size: 22px;
    				font-weight: bold;
    				margin-bottom: 20px;
    				color: black;
			}
	#homeConclusion .container .undermiddle .col * {
    				color: black;
			}
			#homeConclusion .container .undermiddle .col a {
    				color: #e100ff;
    				text-decoration: none;
    				
   					 transition: color 0.3s ease;
			}
            
            

			#homeConclusion .container .undermiddle .col a:hover {
    		
    			font-size : 1.5em;
			}

#homeConclusion p {
    color: white;
}
            
            .undermiddle div{
                    
                    margin-top : 30px;
                    }
            
            #last{
                                        justify-content : center;
                    }
            #wel *{
                    color : white;
                    }

               
    </style>
</head>
<body>
    <ul class="nav nav-pills navbar-custom">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="oscord_home.php">OSCORD - Programming & Computer Science</a>
        </li>
        <form method='post' action='oscord_specificCoursePage.php'>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Courses</a>
            <ul class="dropdown-menu">
                <?php
                    if ($result1 && $result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            echo " <li><button class='dropdown-item' type='submit' name='courseID' value='".$row['courseID']."'>".$row['courseName']."</button></li>";
                        }
                    }
                   
                ?>
            </ul>
        </li>
        </form>
            
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Knowledge Sharing</a>
            <ul class="dropdown-menu">
                  <li><a class='dropdown-item' href="oscord_startLearningProgramming.php">When you start learning Programming</a></li>
                  <li><a class='dropdown-item' href="oscord_webDevelopment.php">Web Development</a></li>
                  <li><a class='dropdown-item' href="oscord_database.php">What is Database?</a></li>
                  <li><a class='dropdown-item' href="oscord_AI.php">What are Data Science, Machine Learning, Artificial Intelligence, Deep Learning?</a></li>
            </ul>
        </li>
            
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Control</a>
            <ul class="dropdown-menu">
                  <li><a class='dropdown-item' href="oscord_instructorControlLogin.php">Instructor</a></li>
                  <li><a class='dropdown-item' href="oscord_studentControlLogin.php">Student</a></li>
            </ul>
        	</li>
        
       	<?php
            echo "<li class='nac-item ms-auto'>
            		<a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
            </li>";  
        ?>
    </ul>
        
        
        
        
        
     <div class="welcome-container">
            
        	<div class='container middle row'>
             
          
             <div class='col' id="wel">
                     <h2>Welcome to Oscord</h2>
                     <br>
                     <p>Study programming basic to software development level at OSCORD. 
                     Online students can join both by one VIP class and group class(if available).
                     For all by one classes, students can negeotitate the class schedule.
                     The video records and lecture files are usually sent in the private telegram channel daily right after the class.</p> 
             </div>
             <div class='col'>
             	<img src='./OSCORD.jpg' class='circularImage'>
        	 </div>
        	</div>
     </div>   
        
        
        
        
              
   <div class="container">
    <h1 id="titleCourse"> Courses from OSCORD </h1>
    <div class="row">
        <?php
        $counter = 0; // Track columns
        while ($row2 = $result2->fetch_assoc()) {
            if ($counter % 2 == 0) {
                echo "<div class='row'>"; 
            }
            echo "<div class='col-md-6'>"; 
            echo "<form method='post' action='oscord_specificCoursePage.php'>
                <div class='card btn' id='biigerCard'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $row2['courseName'] . "</h5>
                        <br>
                        <div>" . $row2['courseDescription'] . "</div>
                        <div class='card-text'><br>
                            <b>Course Fee</b> :  ". $row2['courseFee'] . "<br>Course Period</b> : " . $row2['coursePeriod'] ."
                        </div>
                        <br>
                        <div class='btn-group dropend'>
                            <button type='button' class='btn btn-course-detail dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                Course Details
                            </button>
                            <ul class='dropdown-menu'>";
                            
                            $courseID = $row2['courseID'];
                            $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                            $stmt3 = $conn->prepare($query3);
                            $stmt3->bind_param("i", $courseID);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();

                            while ($row3 = $result3->fetch_assoc()) {
                                echo "<li><a class='dropdown-item coursedetail' href='#'>" . htmlspecialchars($row3['coursedetailName']) . "</a></li>";
                            }

            echo "        </ul>
                        </div>
                        <button class='btn btn-light btn-course-detail mx-auto p-2' type='submit' name='courseID' value='".$row2['courseID']."'>Start Learning</button>
                    </div>
                </div>
            </form>";
            echo "</div>"; // Close col-md-

            $counter++;
            if ($counter % 2 == 0) {
                echo "</div>"; 
            }
        }
        ?>
    </div>
</div>
</div>
        
        
        
       <footer id="homeConclusion" class='w-100'>
    <div class="container ">
        <div class="row undermiddle">
  
            <div class="col">
                <h4>Contact Us</h4><br>
                <p>Email : &nbsp&nbsp<a href="mailto:minsittmandalay137@gmail.com">minsittmandalay137@gmail.com</a></p><br>
                <p>Phone Call in Thailand : &nbsp&nbsp<a href="tel:+66823059272">+66823059272</a></p>
            </div>

            <div class="col">
                <h4 >Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/share/19u16vW5KQ/">Facebook Page</a></li><br>
                    <li><a href="https://t.me/oscord_cs" >Telegram Acc</a></li><br>
                        <li><a href="https://t.me/oscord_ProgrammingClass" >Telegram Channel</a></li><br>
                    <li><a href="https://drive.google.com/file/d/1obR7QrzHTh7cldw-QFf_P82ijd_VkTDI/view?usp=sharing">Viber</a></li><br>
                    <li><a href="https://drive.google.com/file/d/11a07KQYdhyEyuzpxK1FhI4q1MFRVxqJC/view?usp=sharing">Line ID</a></li><br>
                </ul>
            </div>

           
        </div>
              </div>
            
            
      
                    
                     <div class="text-center bg-dark w-100">
                			<p class='text-light' id="last">&copy; Oscord Programming Class All Rights Reserved 2022-2025</p>
            			</div>
                  
  
</footer>

        
        <?php  $conn->close(); ?>
</body>
</html>
