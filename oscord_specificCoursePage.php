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
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a, #1c2526);
            color: #e6e6e6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes neonGlow {
            0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
            50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 25px;
            box-shadow: 0 4px 12px rgba(0, 242, 255, 0.15);
            animation: slideIn 0.5s ease-out;
        }

        .nav-link {
            color: #e6e6e6 !important;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 10px 20px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: #00f2ff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #00f2ff !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            background: #1c2526;
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 242, 255, 0.2);
            animation: fadeIn 0.3s ease-out;
        }

        .dropdown-item {
            color: #e6e6e6;
            font-size: 0.95rem;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: translateX(5px);
        }

        /* Welcome Section */
        .welcome-container {
            background: linear-gradient(145deg, rgba(0, 242, 255, 0.12), rgba(200, 0, 255, 0.12));
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 50px 5%;
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://via.placeholder.com/1920x1080') no-repeat center/cover;
            opacity: 0.1;
            z-index: 0;
            animation: pulse 10s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.15; }
        }

        .main {
            position: relative;
            z-index: 1;
        }

        #titleCourseTitle {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.2rem;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        #courseDesc {
            font-size: 1.2rem;
            color: #d0d0d0;
            line-height: 1.9;
            max-width: 750px;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .course-info {
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .course-info b {
            color: #00f2ff;
            font-weight: 600;
        }

        .course-image {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            border: 2px solid #00f2ff;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.4);
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .course-image:hover {
            transform: scale(1.08) rotate(2deg);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.6);
        }

        .fb-link {
            color: #ff00ff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .fb-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .btn-course-detail {
            background: transparent;
            border: 2px solid #00f2ff;
            color: #00f2ff;
            padding: 12px 30px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .btn-course-detail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .coursedetail {
            font-size: 0.95rem;
            color: #ffffff;
            background: #2a2a2a;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .coursedetail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: translateX(5px);
        }

        /* Tabs Section */
        .intro2 {
            background: #2a2a2a;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
            animation: fadeIn 0.8s ease-out;
        }

        .intro3 .nav-tabs {
            border-bottom: 2px solid #444;
            margin-bottom: 25px;
        }

        .intro3 .nav-link {
            color: #d0d0d0;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: 500;
            padding: 12px 25px;
            border: none;
            position: relative;
            transition: all 0.3s ease;
        }

        .intro3 .nav-link.active {
            color: #00f2ff;
            border-bottom: 3px solid #00f2ff;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        .intro3 .nav-link:hover {
            color: #00f2ff;
            transform: translateY(-2px);
        }

        .under {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
        }

        /* Video Cards */
        .video-card {
            background: #2a2a2a;
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.4s ease;
            animation: fadeIn 1s ease-out;
            height : 360px;
        }

        .video-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-error {
            color: #ff4d4d;
            font-size: 0.95rem;
            padding: 15px;
            text-align: center;
        }

        .video-card .card-body {
            padding: 20px;
        }

        .video-card .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height : 30px;
        }

        .video-details {
            font-size: 0.95rem;
            color: #d0d0d0;
        }

        .video-details a {
            color: #ff00ff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .video-details a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .details-btn {
            color: #ff00ff;
            background: transparent;
            border: 1px solid #ff00ff;
            padding: 8px 15px;
            font-size: 0.95rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .details-btn:hover {
            background: #ff00ff;
            color: #ffffff;
            transform: scale(1.05);
        }

        /* Lecture Files */
        .fileBox {
            background: #2a2a2a;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }

        .fileBox h2 {
            color: #ffffff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .fileBox .list-group-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid #444;
            color: #e6e6e6;
            padding: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .fileBox .list-group-item:hover {
            background: rgba(0, 242, 255, 0.1);
        }

        .fileBox .list-group-item a {
            color: #00f2ff;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .fileBox .list-group-item a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff;
        }

        .fileBox .badge {
            background: #ff00ff;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.95rem;
            animation: neonGlow 2s infinite;
        }

        /* Login Modal */
        .modal-content {
            background: #1c2526;
            border-radius: 15px;
            color: #e6e6e6;
            border: none;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
            animation: fadeIn 0.5s ease-out;
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-title {
            color: #00f2ff;
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
        }

        .modal .btn-close {
            filter: invert(1);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .modal .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }

        .modal .form-label {
            color: #d0d0d0;
            font-weight: 500;
        }

        .modal .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .modal .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        .modal .btn-dark {
            background: #ff00ff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .modal .btn-dark:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 767px) {
            #titleCourseTitle {
                font-size: 2.5rem;
            }
            #courseDesc {
                font-size: 1.1rem;
            }
            .welcome-container {
                padding: 30px 5%;
                min-height: 70vh;
            }
            .course-image {
                margin-top: 25px;
            }
            .video-card .card-title {
                font-size: 1.3rem;
            }
            .fileBox {
                padding: 20px;
            }
            .fileBox .list-group-item a {
                font-size: 0.95rem;
            }
            .btn-course-detail {
                padding: 10px 25px;
                font-size: 1rem;
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
                            <div class='container'>
                                <div class='row align-items-center'>
                                    <div class='col-lg-6 main'>
                                        <h1 id='titleCourseTitle'>".htmlspecialchars($row2['courseName'])."</h1>
                                        <p id='courseDesc'>".htmlspecialchars($row2['courseDescription'])."</p>
                                        <div class='course-info'>
                                            <b>Course Fee</b>: ".htmlspecialchars($row2['courseFee'])."<br>
                                            <b>Course Period</b>: ".htmlspecialchars($row2['coursePeriod'])."<br>";
                    if (!empty($row2['courseFbLink'])) {
                        echo "<br><a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a><br>";
                    }
                    echo "        </div>
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
                            </div>
                        </div>";
                }
            } else {
                echo "<p class='text-center'>Course not found.</p>";
            }
        ?>
    </div>
        
    <div class='intro2'>Start Learning</div>
        
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
                            $query4 = "SELECT * FROM oscord_vidlec  WHERE videoFree = 1 AND courseID = ".$id." ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED)";
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
                                $query9 = "SELECT * FROM oscord_vidlec WHERE courseID = ".$id." ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED)";
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

                        // Scroll-triggered animations
                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    entry.target.classList.add('animate');
                                }
                            });
                        }, { threshold: 0.1 });

                        document.querySelectorAll('.video-card, .fileBox').forEach(el => {
                            el.style.opacity = '0';
                            el.style.transform = 'translateY(20px)';
                            el.classList.add('animate-on-scroll');
                            observer.observe(el);
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

                    // Animation for scroll-triggered elements
                    const style = document.createElement('style');
                    style.innerHTML = `
                        .animate-on-scroll.animate {
                            animation: fadeIn 0.8s ease-out forwards;
                        }
                    `;
                    document.head.appendChild(style);
                </script>
            </div>
        </div>
    </div>      
</body>
</html>