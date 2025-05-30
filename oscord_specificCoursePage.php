<?php
    include "connectdb.php";

    #selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    $id = 1; // Default to courseID=1 if not set
    if (isset($_POST['courseID'])) {
        $id = $_POST['courseID'];
    }
    $query2 = "SELECT * FROM oscord_course WHERE courseID = ".$id;
    $result2 = $conn->query($query2);

    # Function to convert YouTube URLs to embed format
    function convertToEmbed($url) {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?]+)/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?]+)/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        }
        return $url; // Return original if not a YouTube URL
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(145deg, #000, #1a1a1a);
            color: #fff;
            min-height: 100vh;
        }

        /* Navigation */
        .upper .navbar-custom {
            background: rgba(0, 0, 0, 0.8);
            position: sticky;
            top: 0;
            z-index: 10;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0, 212, 212, 0.2);
        }

        .upper .nav-link {
            color: #fff !important;
            font-size: 16px;
            padding: 8px 12px;
            transition: color 0.3s ease;
        }

        .upper .nav-link:hover {
            color: #00d4d4 !important;
        }

        .dropdown-menu {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            z-index: 1000;
        }

        .dropdown-item {
            color: #fff;
            font-size: 14px;
            padding: 6px 12px;
        }

        .dropdown-item:hover {
            background: #00d4d4;
            color: #000;
        }

        /* Welcome Section */
        .intro {
            margin-bottom: 20px;
        }

        .welcome-container {
            background: linear-gradient(135deg, rgba(0, 212, 212, 0.15), rgba(185, 0, 255, 0.15));
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding: 20px 5%;
            position: relative;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://via.placeholder.com/1920x1080') no-repeat center/cover;
            opacity: 0.2;
            z-index: 0;
        }

        .main {
            position: relative;
            z-index: 1;
            padding-left: 15px;
        }

        #titleCourseTitle {
            font-size: 2.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 15px;
        }

        #courseDesc {
            font-size: 1rem;
            color: #ccc;
            line-height: 1.6;
            max-width: 600px;
        }

        .main div {
            margin-bottom: 15px;
        }

        .main div b {
            color: #00d4d4;
        }

        .fb-link {
            color: #b900ff;
            text-decoration: none;
        }

        .fb-link:hover {
            color: #fff;
        }

        .btn-course-detail {
            background: transparent;
            border: 2px solid #00d4d4;
            color: #00d4d4;
            padding: 8px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-course-detail:hover {
            background: #00d4d4;
            color: #000;
        }

        .coursedetail {
            font-size: 14px;
            color: #fff;
            background: #1a1a1a;
            padding: 6px;
            border-radius: 4px;
        }

        /* Tabs Section */
        .intro2 {
            background: #1a1a1a;
            color: #fff;
            text-align: center;
            padding: 12px;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .intro3 {
            padding: 15px 0;
        }

        .intro3 .nav-tabs {
            border-bottom: 1px solid #333;
        }

        .intro3 .nav-link {
            color: #ccc;
            font-size: 1rem;
            padding: 8px 15px;
            border: none;
        }

        .intro3 .nav-link.active {
            color: #00d4d4;
            border-bottom: 2px solid #00d4d4;
        }

        .intro3 .nav-link:hover {
            color: #00d4d4;
        }

        .under {
            background: rgba(26, 26, 26, 0.85);
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        /* Video Cards */
        .video-card {
            background: rgba(26, 26, 26, 0.9);
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            z-index: 1;
        }

        .video-error {
            color: #ff5555;
            font-size: 0.9rem;
            padding: 10px;
            text-align: center;
        }

        .video-card .card-body {
            padding: 12px;
        }

        .video-card .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .video-details {
            font-size: 0.9rem;
            color: #ccc;
        }

        .video-details a {
            color: #b900ff;
        }

        .video-details a:hover {
            text-decoration: underline;
        }

        .details-btn {
            color: #b900ff;
            background: transparent;
            border: 1px solid #b900ff;
            padding: 4px 8px;
            font-size: 0.9rem;
            border-radius: 4px;
        }

        .details-btn:hover {
            background: #b900ff;
            color: #fff;
        }

        /* Lecture Files */
        .fileBox {
            background: rgba(26, 26, 26, 0.9);
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
        }

        .fileBox h2 {
            color: #fff;
            font-size: 1.4rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .fileBox .list-group-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid #333;
            color: #fff;
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fileBox .list-group-item a {
            color: #00f0f0;
            font-size: 1rem;
            text-decoration: none;
        }

        .fileBox .list-group-item a:hover {
            color: #fff;
        }

        .fileBox .badge {
            background: #b900ff;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* Login Modal */
        .modal-content {
            background: #1a1a1a;
            border-radius: 8px;
            color: #fff;
        }

        .modal-header {
            border-bottom: 1px solid #333;
        }

        .modal-title {
            color: #00d4d4;
        }

        .modal .btn-close {
            filter: invert(1);
        }

        .modal .form-label {
            color: #ccc;
        }

        .modal .form-control {
            background: #333;
            border: 1px solid #555;
            color: #fff;
        }

        .modal .form-control:focus {
            border-color: #b900ff;
            box-shadow: none;
        }

        .modal .btn-dark {
            background: #b900ff;
            border: none;
            border-radius: 4px;
            padding: 8px;
        }

        .modal .btn-dark:hover {
            background: #00d4d4;
        }

        /* Responsive */
        @media (max-width: 767px) {
            #titleCourseTitle {
                font-size: 2rem;
            }
            #courseDesc {
                font-size: 0.9rem;
            }
            .welcome-container {
                padding: 15px 3%;
                min-height: 60vh;
            }
            .main {
                padding-left: 10px;
            }
            .video-card .card-title {
                font-size: 1.1rem;
            }
            .fileBox {
                padding: 10px;
            }
            .fileBox .list-group-item a {
                font-size: 0.9rem;
            }
            .btn-course-detail {
                padding: 6px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class='upper'>
        <ul class="nav nav-pills navbar-custom">
            <li class="nav-item">
                <a class="nav-link" href="oscord_home.php">OSCORD - Programming & Computer Science</a>
            </li>
            <form method='post' action='oscord_specificCoursePage.php'>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Courses</a>
                    <ul class="dropdown-menu">
                        <?php
                            if ($result1 && $result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo "<li><button class='dropdown-item' type='submit' name='courseID' value='".htmlspecialchars($row['courseID'])."'>".htmlspecialchars($row['courseName'])."</button></li>";
                                }
                            }
                        ?>
                    </ul>
                </li>
            </form>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Knowledge Sharing</a>
                <ul class="dropdown-menu">
                    <li><a class='dropdown-item' href="oscord_startLearningProgramming.php">Start Learning Programming</a></li>
                    <li><a class='dropdown-item' href="oscord_webDevelopment.php">Web Development</a></li>
                    <li><a class='dropdown-item' href="oscord_database.php">What is Database?</a></li>
                    <li><a class='dropdown-item' href="oscord_AI.php">Data Science & AI</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Control</a>
                <ul class="dropdown-menu">
                    <li><a class='dropdown-item' href="oscord_instructorControlLogin.php">Instructor</a></li>
                    <li><a class='dropdown-item' href="oscord_studentControlLogin.php">Student</a></li>
                </ul>
            </li>
            <li class='nav-item ms-auto'>
                <a class='nav-link' href='oscord_signUpPage.php'>Sign Up</a>
            </li>
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
                                        <div><h1 id='titleCourseTitle'>".htmlspecialchars($row2['courseName'])."</h1></div>
                                        <div id='courseDesc'>".htmlspecialchars($row2['courseDescription'])."</div>
                                        <div>
                                            <b>Course Fee</b>: ".htmlspecialchars($row2['courseFee'])."<br>
                                            <b>Course Period</b>: ".htmlspecialchars($row2['coursePeriod'])."<br>";
                    if (!empty($row2['courseFbLink'])) {
                        echo "<br><a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a><br>";
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
                                <div class='col'></div>
                            </div>
                        </div>";
                }
            } else {
                echo "<p class='text-center'>Course not found.</p>";
            }
        ?>
    </div>
        
    <div class='intro2'>Start</div>
        
    <div class='intro3 container'>
        <div class='tab'>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="simpleLectureVideo" data-bs-toggle="tab" data-bs-target="#simple_lecture_video" type="button" role="tab" aria-controls="simple_lecture_video">Free Lecture Videos</button>
                </li>  
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="unlock" data-bs-toggle="tab" data-bs-target="#unlock_" type="button" role="tab" aria-controls="unlock_">Unlock</button>
                </li>
            </ul>

            <div class="tab-content under" id="myTabContent">
                <div class="tab-pane fade show active" id="simple_lecture_video" role="tabpanel" aria-labelledby="simpleLectureVideo">
                    <div class="row">
                        <?php 
                            $query4 = "SELECT * FROM oscord_vidlec WHERE videoFree = 1 AND courseID = ".$id;
                            $result4 = $conn->query($query4);

                            if ($result4 && $result4->num_rows > 0) {
                                while ($row4 = $result4->fetch_assoc()) {
                                    $videoLink = convertToEmbed(htmlspecialchars($row4['videoLink']));
                                    $videoId = md5($videoLink); // Unique ID for collapse
                                    if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                        echo "
                                            <div class='col-12 col-md-6 col-lg-4'>
                                                <div class='video-card'>
                                                    <div class='video-wrapper'>
                                                        <iframe src='$videoLink' title='".htmlspecialchars($row4['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen loading='lazy'></iframe>
                                                    </div>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>".htmlspecialchars($row4['videoName'])."</h5>
                                                        <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId' aria-expanded='false' aria-controls='details-$videoId'>
                                                            Show Details
                                                        </button>
                                                        <div class='collapse video-details mt-2' id='details-$videoId'>
                                                            <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                    } else {
                                        echo "<p class='video-error'>Invalid video link for: ".htmlspecialchars($row4['videoName'])."</p>";
                                    }
                                }
                            } else {
                                echo "<p class='text-center text-white mt-3'>No free lecture videos available.</p>";
                            }
                        ?>  
                    </div>
                </div>

                <div class="tab-pane fade" id="unlock_" role="tabpanel" aria-labelledby="unlock">
                    <div id='unlockedcontent' style='display: none;'>
                        <div class="mt-4">
                            <?php
                                $sql = "SELECT * FROM file WHERE courseID = ".$id;
                                $result = $conn->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    echo "<div class='fileBox'>";
                                    echo "<h2>Lecture Files</h2>";
                                    echo "<ul class='list-group mt-3'>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li class='list-group-item'>";
                                        echo "<a href='download.php?id=".htmlspecialchars($row['fileID'])."'>".htmlspecialchars($row['fileName'])."</a>";
                                        echo "<span class='badge'>Download</span>";
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-info mt-3 text-center'>No lecture files uploaded yet.</div>";
                                }
                            ?>
                        </div>
                        
                        <h2 class="text-white mt-4 mb-3">Video Lectures</h2>
                        <div class="row">
                            <?php 
                                $query9 = "SELECT * FROM oscord_vidlec WHERE courseID = ".$id;
                                $result9 = $conn->query($query9);

                                if ($result9 && $result9->num_rows > 0) {
                                    while ($row9 = $result9->fetch_assoc()) {
                                        $videoLink = convertToEmbed(htmlspecialchars($row9['videoLink']));
                                        $videoId = md5($videoLink);
                                        if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                            echo "
                                                <div class='col-12 col-md-6 col-lg-4'>
                                                    <div class='video-card'>
                                                        <div class='video-wrapper'>
                                                            <iframe src='$videoLink' title='".htmlspecialchars($row9['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen loading='lazy'></iframe>
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title'>".htmlspecialchars($row9['videoName'])."</h5>
                                                            <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId' aria-expanded='false' aria-controls='details-$videoId'>
                                                                Show Details
                                                            </button> 
                                                            <div class='collapse video-details mt-2' id='details-$videoId'>
                                                                <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                        } else {
                                            echo "<p class='video-error'>Invalid video link for: ".htmlspecialchars($row9['videoName'])."</p>";
                                        }
                                    }
                                } else {
                                    echo "<p class='text-center text-white mt-3'>No video lectures available.</p>";
                                }
                            ?>  
                        </div>
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
                                        <input type="hidden" id="courseID" name="courseID" value="<?php echo htmlspecialchars($id); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Debug iframe sources
                    document.addEventListener('DOMContentLoaded', () => {
                        document.querySelectorAll('.video-wrapper iframe').forEach(iframe => {
                            console.log('Iframe src:', iframe.src);
                        });
                    });

                    // Unlock tab login check
                    document.getElementById("unlock").addEventListener("click", function(event) {
                        const isLoggedIn = false; // Replace with actual login check if available
                        if (!isLoggedIn) {
                            event.preventDefault();
                            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                            loginModal.show();
                        }
                    });

                    // Login form submission
                    document.getElementById("loginForm").addEventListener("submit", function(event) {
                        event.preventDefault();
                        const email = document.getElementById("email").value;
                        const password = document.getElementById("password").value;
                        const courseID = document.getElementById("courseID").value;

                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "oscord_login.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                const loginApprove = xhr.responseText;
                                if (loginApprove === "true") {
                                    alert("Login successful!");
                                    const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                                    loginModal.hide();
                                    document.getElementById("unlockedcontent").style.display = "block";
                                    // Trigger tab content refresh
                                    const unlockTab = new bootstrap.Tab(document.getElementById('unlock'));
                                    unlockTab.show();
                                } else if (loginApprove === "false") {
                                    alert("Invalid email or passcode.");
                                } else {
                                    alert("Server error: " + loginApprove);
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