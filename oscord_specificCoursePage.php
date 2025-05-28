<?php
    include "connectdb.php";

    #selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    $id = 0;
    if (isset($_POST['courseID'])) {
        $id = $_POST['courseID'];
    }
    $query2 = "SELECT * FROM oscord_course WHERE courseID = ".$id;
    $result2 = $conn->query($query2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: black;
            background-attachment: fixed; 
            background-size: 400% 400%; 
            height: 100%;  
        }
        
        .upper .nav {
            padding-bottom: 20px;
        }
        
        .upper .navbar-custom {
            background-color: black;
            font-size: 18px; 
        }

        .upper .navbar-custom .nav-link {
            color: white !important;
        }

        .upper .navbar-custom .nav-link:hover {
            color: #ccc !important;
        }
        
        .dropdown-menu {
            background-color: black;
        }
        
        .dropdown-item {
            background-color: black;
            font-size: 18px;
            color: white;
        }
        
        .dropdown-item:hover {
            color: #ccc !important;
        }    
        
        /*_________________________________*/
        
        .intro {
            margin-bottom: 0px;
        }
        
        .welcome-container {
            background: url('./courseback2.png') no-repeat center center;
            background-size: cover;
            text-align: left;
            border-radius: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 100vh;
            background-attachment: scroll;
            display: flex;
            flex-direction: column; 
            justify-content: center;
        }
        
        .main {
            align-items: left;
            color: white;
            padding-left: 20px;
        }
        
        .main div h1 {
            padding-top: 30px;
    

        }
        
        .main div {
            padding-bottom: 20px;
        }
        
        .btn-course-detail {
            width: 100%;
            color: white;
            padding-left: 20px;
            background-color: transparent;
            border: 1px solid white;
            margin-bottom: 50px;
        }
        
        .coursedetail {
            font-size: 15px;
            color: black;
            background-color: white;
        } 
        
        .btn-group {
            margin-top : 150;
            padding-left: 20px;
        }
        
        @media (max-width: 790px) {
            .welcome-container {
                min-height: auto;
                padding-bottom: 50px;
            }
            .main {
                padding-left: 10px;
            }
            .row {
                flex-direction: column;
            }
            .col {
                width: 100%;
                text-align: left;
            }
        }
        
        /*_________________________________*/
        
        .intro2 {
            width: 100%;
            background-color: white;
            color: white;
            text-align: center;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0px;
        }
        
        /* _________________________________ */
        
        .intro3 {
            width: 100%;
            padding-left: 20px;
            height: auto;
            background: transparent;
        }
        
        .intro3 .tab .nav .nav-item .nav-link {
            background: transparent;
            color: white;
            border-radius: 0px;
        }
        
        .intro3 .tab .nav .nav-item .nav-link:hover {
            color: white; 
            border-bottom: 0px;
        }

        .intro3 .tab .nav .nav-item .nav-link:focus {
            color: white;
            border-bottom: 0px;
        }
        
        .under {
            color: white;
        }
        
        /*________________________*/
        
        #courseDescirptionArea {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        
        #courseDescriptionArea div {
            margin-bottom: 20px;
            line-height: 2;
        }
        
        #courseDescriptionArea div h3, h4 {
            margin-top: 40px;
            margin-bottom: 40px;
            line-height: 2;
        }
        
        #courseDescriptionArea div a {
            color: #00ff15;    
        }
        
        #courseDescriptionArea div a:hover {
            font-size: 1.5em;
        }
        
        /* __________________________*/
        
        .video-row {
            margin-top: 20px;
            background: transparent;
            color: white;
            border-radius: 0px;
            transition: transform 0.3s ease-in-out;
        }

        .video-row:hover {
            transform: scale(1.02);
        }

        .video-frame {
            border-radius: 0px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .video-title {
            margin-top: 20px;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            padding: 10px;
            line-height: 2;
        }
        
        .go_here p a {
            color: white;
        }
        
        /*_______________________________*/
        
        #review {
            line-height: 3.5;
        }
        
        #student_review {
            margin-top: 30px;        
        }
        
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
            color: black;
        }
        
        /*_______________________*/
        
        #loginModal {
            color: black;       
        }
        
        #unlockedcontent {
            display: none;
        }
        
        .fileBox {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 100%;
        }
        
        .fileUploadBox {
            margin-top: 20px;
            margin-bottom: 60px;
            width: 500px;
        }
        
        .fb-link {
            color: #00ff15;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .fb-link:hover {
           font-size : 1.5em;
        }

        #courseDescription{
            line-height : 40px;
        }

        #titleCourseName{
            line-height : 60px;

        }
    </style>
</head>
<body>
    <div class='upper'>
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
                                    echo "<li><button class='dropdown-item' type='submit' name='courseID' value='".$row['courseID']."'>".$row['courseName']."</button></li>";
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
                echo "<li class='nav-item ms-auto'>
                        <a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
                    </li>";  
            ?>
        </ul>    
    </div>
        
    <div class='intro'>
        <?php
            if ($result2 && $result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    echo "
                        <div class='welcome-container'>
                            <div class='row'>
                                <div class='col'>
                                    <div class='main'>
                                        <div><h1 id='titleCourseName'>".htmlspecialchars($row2['courseName'])."</h1></div>
                                        <div id='courseDescription'>".htmlspecialchars($row2['courseDescription'])."</div>
                                        <div>
                                            <b>Course Fee</b> : ".htmlspecialchars($row2['courseFee'])."<br>
                                            <b>Course Period</b> : ".htmlspecialchars($row2['coursePeriod'])."<br>";
                    if (!empty($row2['courseFbLink'])) {
                        echo "<br> <a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a><br>";
                    }
                    echo "            </div>
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
                                echo "<li><a class='dropdown-item coursedetail' href='#'>".htmlspecialchars($row3['coursedetailName'])."</a></li>";
                            }

                    echo "        </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class='col'>
                                </div>
                            </div>
                        </div>";
                }
            }
        ?>
    </div>
        
    <div class='intro2'>Start</div>
        
    <div class='intro3 container'>
        <div class='tab'>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="simpleLectureVideo" data-bs-toggle="tab" data-bs-target="#simple_lecture_video" type="button" role="tab" aria-controls="simple_lecture_video" aria-selected="false">Free Lecture Videos</button>
                </li>  
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="unlock" data-bs-toggle="tab" data-bs-target="#unlock_" type="button" role="tab" aria-controls="unlock_" aria-selected="false">Unlock</button>
                </li>
            </ul>

            <div class="tab-content under" id="myTabContent">
                <div class="tab-pane fade under show active" id="simple_lecture_video" role="tabpanel" aria-labelledby="simpleLectureVideo" tabindex="0">
                    <div>
                        <?php 
                            $query4 = "SELECT * FROM oscord_vidlec WHERE videoFree = 1 AND courseID = ".$id;
                            $result4 = $conn->query($query4);

                            if ($result4 && $result4->num_rows > 0) {
                                while ($row4 = $result4->fetch_assoc()) {
                                    echo "
                                        <div class='video-row row'>
                                            <div class='col-md-6'>
                                                <iframe width='100%' height='auto' src='".htmlspecialchars($row4['videoLink'])."' title='".htmlspecialchars($row4['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                            </div>
                                            <div class='col-md-6 go_here'>
                                                <h2>".htmlspecialchars($row4['videoName'])."</h2>
                                                <p>In case the video frame doesn't work correctly : <a href='".htmlspecialchars($row4['videoLink'])."'>go here</a></p>
                                            </div>
                                        </div>
                                        <hr>
                                    ";
                                }
                            }
                        ?>  
                    </div>
                </div>

               

                <div class="tab-pane fade under" id="unlock_" role="tabpanel" aria-labelledby="unlock" tabindex="0">
                    <div id='unlockedcontent'>
                        <div class="mt-5">
                            <?php
                                $sql = "SELECT * FROM file WHERE file.courseID=".$id;
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<div class='card shadow p-4 fileBox'>";
                                    echo "<h2 class='text-center text-dark'>Lectures Files</h2>";
                                    echo "<ul class='list-group mt-3'>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                        echo "<a href='download.php?id=".htmlspecialchars($row['fileID'])."' class='text-decoration-none text-dark'>".htmlspecialchars($row['fileName'])."</a>";
                                        echo "<span class='badge bg-light text-dark'>Download</span>";
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-info mt-4 text-center'>No Lecture files uploaded yet</div>";
                                }
                            ?>
                        </div>
<!-- 
                        <div class="card shadow p-4 fileUploadBox">
                            <h2 class="text-center text-dark">Upload a File</h2>
                            <form action="upload.php" method="POST" enctype="multipart/form-data" class="mt-4">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Choose a file:</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                    <input type="text" hidden value="<?php echo $id; ?>" name="courseID">
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Upload File</button>
                            </form>
                        </div> -->
                        
                        <?php 
                            $query9 = "SELECT * FROM oscord_vidlec WHERE courseID = ".$id;
                            $result9 = $conn->query($query9);

                            echo "<h2> Video Lectures </h2>";
                            if ($result9 && $result9->num_rows > 0) {
                                while ($row9 = $result9->fetch_assoc()) {
                                    echo "
                                        <div class='video-row row'>
                                            <div class='col-md-6'>
                                                <iframe width='100%' height='auto' src='".htmlspecialchars($row9['videoLink'])."' title='".htmlspecialchars($row9['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                                            </div>
                                            <div class='col-md-6 go_here'>
                                                <h2>".htmlspecialchars($row9['videoName'])."</h2>
                                                <p>In case the video frame doesn't work correctly : <a href='".htmlspecialchars($row9['videoLink'])."'>go here</a></p>
                                            </div>
                                        </div>
                                        <hr>
                                    ";
                                }
                            }
                        ?>  
                    </div>
                </div>
                    
                <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="loginForm">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Passcode</label>
                                        <input type="password" class="form-control" id="password" required>
                                        <input type="text" class="form-control" id="courseID" hidden name="courseID" value="<?php echo $id; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById("unlock").addEventListener("click", function(event) {
                        var isLoggedIn = false;

                        if (!isLoggedIn) {
                            event.preventDefault();
                            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                            loginModal.show(); 
                        }
                    });

                    document.getElementById("loginForm").addEventListener("submit", function(event) {
                        event.preventDefault();
                        var email = document.getElementById("email").value;
                        var password = document.getElementById("password").value;
                        var courseID = document.getElementById("courseID").value;

                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "oscord_login.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var loginApprove = xhr.responseText;
                                
                                if (loginApprove === "true") {
                                    alert("Login successful!");
                                    var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                                    loginModal.hide();
                                    document.getElementById("unlockedcontent").style.display = "block";
                                } else if (loginApprove === "false") {
                                    alert("Invalid email or passcode. Please try again.");
                                    document.getElementById("unlockedcontent").style.display = "none";
                                } else {
                                    alert("Anything");
                                }
                            }
                        };
                        xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password) + "&courseID=" + encodeURIComponent(courseID));
                    });
                </script>
            </div>
        </div>
    </div>      
</body>
</html>