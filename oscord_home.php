<?php
include "connectdb.php";

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);

#IMPORTANT !!
$query_course_details = "SELECT * FROM oscord_course ORDER BY sort IS NULL, sort ASC";
$result_course_details = $conn->query($query_course_details);

$query_students = "SELECT studentID, studentName FROM oscord_student";
$result_students = $conn->query($query_students);

$query_course_count = "SELECT COUNT(*) as course_count FROM oscord_course";
$result_course_count = $conn->query($query_course_count);
$course_count = $result_course_count->fetch_assoc()['course_count'];

$query_student_count = "SELECT COUNT(DISTINCT studentID) as student_count FROM oscord_studentxcourse";
$result_student_count = $conn->query($query_student_count);
$student_count = $result_student_count->fetch_assoc()['student_count'];

$query_content_count = "SELECT (SELECT COUNT(*) FROM oscord_vidlec) + (SELECT COUNT(*) FROM file) as content_count";
$result_content_count = $conn->query($query_content_count);
$content_count = $result_content_count->fetch_assoc()['content_count'];

$sql_reviews = "SELECT sr.studentreviewID, sr.studentreview, sr.courseID, sr.studentID, sr.isShown, 
               s.studentName, c.courseName
        FROM oscord_studentreview sr
        JOIN oscord_student s ON sr.studentID = s.studentID
        JOIN oscord_course c ON sr.courseID = c.courseID
        WHERE sr.isShown = 1
        ORDER BY sr.studentreviewID DESC"; 
$result_reviews_section = $conn->query($sql_reviews);

$query_students_reviews = "SELECT studentID, studentName FROM oscord_student";
$result_students_reviews = $conn->query($query_students_reviews);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home  </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
     
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #00f2ff, #ff00ff);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #ff00ff, #00f2ff);
    box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
}

html {
    scrollbar-width: thin;
    scrollbar-color: #00f2ff rgb(0, 0, 0);
}

        body {
            background: linear-gradient(135deg, #0a0a0a, #1c2526);
            color: #e6e6e6;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .welcome-container {
    position: relative;
    width: 100%;
    height: 100vh; /* Full viewport height */
    overflow: hidden;
    z-index: 1;
}

.welcome-video {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the video covers the entire container without distortion */
    position: absolute;
    top: 0;
    left: 0;
    z-index: 0;
}

        .stats-section {
            background: rgba(20, 20, 20, 0.9);
            padding: 40px 0;
            margin-top: 0px;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
            text-align: center;
            width: 100%;
            height : auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .stats-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.7rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;
            animation: neonPulse 2s infinite;
        }

        .stats-content {
            max-width: 1000px;
            width: 100%;
            padding: 0 10px;
        }

        .stats-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .stats-item {
            text-align: center;
            padding: 20px;
            background: #1c2526;
            border-radius: 10px;
            margin: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
            animation: neonGlow 2s infinite;
            flex: 1;
            min-width: 100px;
            max-width: 200px;
            height : auto;
            margin-bottom : 0px;
        }

        .stats-item:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.6);
        }

        .stats-item h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
            animation: neonPulse 2s infinite;
        }

        .stats-item p {
            font-size: 0.7rem;
            color: #d0d0d0;
            margin: 0;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .stats-item i {
            font-size: 1.2rem;
            color: #00f2ff;
            margin-right: 8px;
            vertical-align: middle;
        }

        #titleCourse {
            font-family: 'Helvetica', sans-serif;
            font-size: 2rem;
            font-weight: 500;
            text-align: center;
            margin: 30px 0 30px;
            color: #ffffff;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: fadeIn 0.8s ease-out;
            position: relative;
            z-index: 1;
        }

        .card {
            background: transparent;
            border: 1px;
            border-radius: 15px;
            padding: 20px;
            margin: 15px auto;
            transition: all 0.4s ease;
            color: #e6e6e6;
            max-width: 300px;
            box-shadow: 0 5px 5px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            height: 650px;
            position: relative;
            z-index: 1;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .card-title {
            font-family: 'Montserrat';
            font-size: 1.5rem;
            font-weight: 500;
            margin-top : 15px;
            margin-bottom: 15px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 35px;
        }

        .card-text .detail-item {
            margin-bottom: 10px;
            color: #d0d0d0;
            line-height: 25px;
        }

        .card-text .detail-item b {
            color: #00f2ff;
            font-weight: 600;
        }

        .card-text .detail-item:last-child {
            margin-bottom: 20px;
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
            font-size: 1rem;
            font-weight: 400;
            border-radius: 40px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
            display: block;
            text-align: center;
            margin-bottom: 0px;
        }

        .btn-course-detail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        #studentReview {
            font-family: 'Inter', sans-serif;
        }

        @keyframes studentReviewFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes studentReviewNeonGlow {
            0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
            50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
        }

        @keyframes studentReviewNeonPulse {
            0%, 100% { text-shadow: 0 0 5px #00f2ff, 0 0 10px #00f2ff, 0 0 15px #00f2ff; }
            50% { text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff; }
        }

        #studentReview .review-section {
            margin: 50px auto;
            padding: 30px 10px;
            background: transparent;
            border-radius: 15px;
            animation: studentReviewFadeIn 1s ease-out;
            position: relative;
            z-index: 1;
            width: 70%;
            max-width: 800px;
            height: auto;
            overflow: hidden;
        }

        #studentReview .review-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 30px;
            color: #00f2ff;
            text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff;
            animation: studentReviewNeonPulse 2s infinite;
        }

        #studentReview .review-container {
            display: flex;
            flex-wrap: nowrap;
            will-change: transform;
            padding: 20px 0;
        }

        #studentReview .review-item {
            background: transparent;
            border: 2px solid #00f2ff;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            animation: studentReviewFadeIn 1s ease-out;
            width: 700px;
            margin-right: 20px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            flex-shrink: 0;
            line-height: 30px;
            text-align: left;
        }

        #studentReview .review-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.6);
        }

        #studentReview .review-item::before {
            content: '';
            font-size: 2rem;
            color: #00f2ff;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        #studentReview .review-item::after {
            content: '';
            font-size: 2rem;
            color: #00f2ff;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        #studentReview .review-item h3 {
            font-family: 'Calibri', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #00f2ff;
        }

        #studentReview .review-item p {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 10px;
            flex-grow: 1;
            overflow-x: auto;
            overflow-y: auto;
            padding-right: 10px;
        }

        #studentReview .review-item p::-webkit-scrollbar {
            width: 8px;
        }

        #studentReview .review-item p::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        #studentReview .review-item p::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f2ff, #ff00ff);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        #studentReview .review-item p::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #ff00ff, #00f2ff);
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
        }

        #studentReview .review-item p {
            scrollbar-width: thin;
            scrollbar-color: #00f2ff rgba(0, 0, 0, 0.5);
        }

        #studentReview .form-container {
            background: transparent;
            padding: 0px;
            border-radius: 15px;
            margin: 30px auto;
            width: 90%;
            max-width: 90%;
            animation: studentReviewFadeIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        #studentReview .form-container h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            text-align: center;
        }

        #studentReview .form-select,
        #studentReview .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        #studentReview .form-select:focus,
        #studentReview .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        #studentReview .form-container .btn {
            background: #ff00ff;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 400;
            color: #ffffff;
            transition: all 0.3s ease;
            animation: studentReviewNeonGlow 2s infinite;
            width: 100%;
            margin-top: 30px;
        }

        #studentReview .form-container .btn:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        #studentReview .error-message {
            text-align: center;
            color: #ff00ff;
            font-size: 1.2rem;
            margin: 20px 0;
        }

        #niiki{
              text-decoration : none;
            }

        @media (max-width: 820px) {
            

            .card {
                max-width: 300px;
                height: 1000px;
                padding: 15px;
                margin: 10px auto;
                border-radius: 12px;
            }

            .card-title {
                font-size: 1.6rem;
                line-height: 1.4;
                margin-bottom: 20px;
            }

            #courseDescription {
                font-size: 0.95rem;
                line-height: 40px;
                margin-bottom: 20px;
            }

            .card-text .detail-item {
                font-size: 0.9rem;
                margin-bottom: 8px;
            }

            .btn-course-detail {
                padding: 10px 20px;
                font-size: 0.95rem;
                margin-top: 15px;
                margin-bottom: 20px;
            }

            .course-details-content {
                max-height: 150px;
                padding: 8px 12px;
                margin-bottom: 20px;
            }

            .course-details-content .course-detail-item {
                font-size: 0.85rem;
                padding: 4px 8px;
            }

            #titleCourse {
                font-size: 2.2rem;
                margin: 40px 0 20px;
            }

            #studentReview {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 55px;
            }

            #studentReview .review-section {
                padding: 30px 15px;
                margin: 40px 0;
                height: auto;
            }

            #studentReview .review-section h2 {
                font-size: 2.2rem;
            }

            #studentReview .review-item {
                width: 350px;
            }

            #studentReview .review-item h3 {
                font-size: 1.1rem;
            }

            #studentReview .review-item p {
                font-size: 0.95rem;
            }

            #studentReview .form-container h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            #studentReview {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 10px;
                margin-right: 20px;
            }

            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .dropdown-item {
                font-size: 0.6rem;
            }

            .card {
                max-width: 85%;
                height: auto;
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 30px;
            }

            .card-title {
                font-size: 1.2rem;
                line-height: 1.2;
                margin-bottom: 15px;
            }

            .card-text .detail-item {
                font-size: 0.82rem;
                margin-bottom: 6px;
            }

            .btn-course-detail {
                padding: 8px 15px;
                font-size: 0.8rem;
                margin-top: 10px;
                margin-bottom: 15px;
            }

            .course-details-content {
                max-height: 110px;
                padding: 6px 10px;
                margin-bottom: 15px;
            }

            .course-details-content .course-detail-item {
                font-size: 0.7rem;
                padding: 3px 6px;
            }

            .form-container h2 {
                font-size: 1.4rem;
            }

            .stats-section h2 {
                font-size: 1.5rem;
            }

            .stats-item h3 {
                font-size: 1.3rem;
            }

            .stats-item p {
                font-size: 0.7rem;
            }

            .stats-item {
                min-width: 180px;
            }

            #studentReview .review-section {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 22px;
            }

            #studentReview .review-section h2 {
                font-size: 1.8rem;
            }

            #studentReview .review-item {
                width: 280px;
                padding: 15px;
            }

            #studentReview .review-item h3 {
                font-size: 1rem;
            }

            #studentReview .review-item p {
                font-size: 0.9rem;
            }

            #studentReview .form-container {
                padding: 20px;
                max-width: 100%;
            }

            #studentReview .form-container h2 {
                font-size: 1.4rem;
            }

            #studentReview .form-select,
            #studentReview .form-control {
                font-size: 0.9rem;
            }

            #studentReview .form-container .btn {
                padding: 10px;
                font-size: 0.9rem;
            }
        }

        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }

        #studentReview .animate-on-scroll.animate {
            animation: studentReviewFadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
   
    <?php
        include "nav.php";
    ?>

<div class="welcome-container">
    <video class="welcome-video" autoplay loop muted playsinline>
        <source src="video/wel.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
        
    <div class="stats-section">
        <h2>Our Impact</h2>
        <div class="stats-content">
            <div class="stats-row">
                <div class="stats-item animate-on-scroll">
                    <h3><i class="fas fa-book"></i> <?php echo htmlspecialchars($course_count); ?></h3>
                    <p>Courses Offered</p>
                </div>
                <div class="stats-item animate-on-scroll">
                    <h3><i class="fas fa-users"></i> <?php echo htmlspecialchars($student_count+200); ?></h3>
                    <p>Students Enrolled</p>
                </div>
                <div class="stats-item animate-on-scroll">
                    <h3><i class="fas fa-video"></i> <?php echo htmlspecialchars($content_count+300); ?></h3>
                    <p>Video Lectures & Files</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 id="titleCourse">Our Courses</h1>
        <div class="row">
            <?php
            if ($result_course_details && $result_course_details->num_rows > 0) {
                while ($row2 = $result_course_details->fetch_assoc()) {
                    echo "<div class='col-md-6 col-lg-4'>";
                    echo "<form method='post' action='oscord_specificCoursePage.php'>";
                    echo "<div class='card animate-on-scroll'>";
                    echo "<div class='card-body'>";
                    echo "<img src='image/".htmlspecialchars($row2['coursePhoto'])."' alt='".htmlspecialchars($row2['courseName'])."' class='card-img-top' style='max-width: 100%; height: auto;'>";
                        echo "<h6 class='card-title'>".htmlspecialchars($row2['courseName'])."</h6>";
                        // echo "<div id='courseDescription'>".htmlspecialchars($row2['courseDescription'])."</div>";
                        echo "<div class='card-text'>";
                            echo "<div class='detail-item'><b>Course Fee</b> : ".htmlspecialchars($row2['courseFee'])."</div>";
                            echo "<div class='detail-item'><b>Course Period</b> : ".htmlspecialchars($row2['coursePeriod'])."</div>";
                            if (!empty($row2['courseFbLink'])) {
                                echo "<div class='detail-item'><a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a></div>";
                            }
                        echo "</div>";
                        // echo "<button class='btn btn-course-detail' type='button' data-bs-toggle='collapse' data-bs-target='#courseDetails".htmlspecialchars($row2['courseID'])."' aria-expanded='false' aria-controls='courseDetails".htmlspecialchars($row2['courseID'])."'>Course Details</button>";
                        echo "<div class='collapse course-details-content' id='courseDetails".htmlspecialchars($row2['courseID'])."'>";
                        
                        $courseID = $row2['courseID'];
                        $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                        $stmt3 = $conn->prepare($query3);
                        $stmt3->bind_param("i", $courseID);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();

                        while ($row3 = $result3->fetch_assoc()) {
                            echo "<div class='course-detail-item'>".htmlspecialchars($row3['coursedetailName'])."</div>";
                        }

                        echo "</div>";
                        echo "<button class='btn btn-course-detail' type='submit' name='courseID' value='".htmlspecialchars($row2['courseID'])."'>Start Learning</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                }
            }
            ?>
        </div>     
    </div>

    <!-- Student Reviews Section -->
    <div id="studentReview">
        <div class="review-section">
         <h2>Student Reviews</h2>
            <?php 
            // Diagnostic: Check number of reviews fetched
            $num_reviews = $result_reviews_section ? $result_reviews_section->num_rows : 0;
            if (!$result_reviews_section) { ?>
                <p class="error-message">Error: <?php echo htmlspecialchars($conn->error); ?></p>
            <?php } elseif ($num_reviews > 0) { ?>
          
                <div class="review-container">
                    <?php
                    $result_reviews_section->data_seek(0);
                    while ($row = $result_reviews_section->fetch_assoc()) {
                        $student_name = htmlspecialchars($row['studentName']);
                        $course_name = htmlspecialchars($row['courseName']);
                        $review_text = htmlspecialchars($row['studentreview']);
                        ?>
                        <div class="review-item animate-on-scroll">
                            <h3><i class="fas fa-user-graduate"></i> <?php echo $student_name; ?></h3>
                            <p><?php echo nl2br($review_text); ?></p>
                          
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } else { ?>
                <p class="error-message">No reviews available yet. (Found <?php echo $num_reviews; ?> reviews.)</p>
            <?php } ?>

            <!-- <div class="form-container animate-on-scroll">
                <h2>Review a Course</h2>
                <form class="form" action="oscord_savereview.php" method="post">
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Select Your Name</label>
                        <select class="form-select" id="student_name" name="student_name" required>
                            <option value="">Select</option>
                            //<?php
                           // if ($result_students_reviews && $result_students_reviews->num_rows > 0) {
                                // while ($row_student = $result_students_reviews->fetch_assoc()) {
                                   // echo "<option value='".htmlspecialchars($row_student['studentID'])."'>".htmlspecialchars($row_student['studentName'])."</option>";
                                //}
                            //}
                           // ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseID" class="form-label">Select Course</label>
                        <select class="form-select" id="courseID" name="courseID" required>
                            <option value="">Select</option>
                            <?php
                            if ($result_courses && $result_courses->num_rows > 0) {
                                $result_courses->data_seek(0);
                                while ($row_course = $result_courses->fetch_assoc()) {
                                    echo "<option value='".htmlspecialchars($row_course['courseID'])."'>".htmlspecialchars($row_course['courseName'])."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="textarea_review" class="form-label">Your Review Here</label>
                        <textarea class="form-control" id="textarea_review" rows="5" placeholder="Type your review here" name="review_text" required></textarea>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div> -->
        </div>
    </div>

   <?php
    include "footer.php";
   ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.card, #studentReview .review-item, #studentReview .form-container, .contact-form, .stats-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });

            const reviewContainer = document.querySelector('#studentReview .review-container');
            if (reviewContainer && reviewContainer.querySelectorAll('.review-item').length > 0) {
                const reviewItems = reviewContainer.querySelectorAll('.review-item');
                const originalWidth = Array.from(reviewItems).reduce((sum, item) => sum + item.offsetWidth + 20, 0);
                console.log(`Original reviews: ${reviewItems.length}, Total width: ${originalWidth}px`);

           
                const viewportWidth = window.innerWidth;
                const clonesNeeded = Math.ceil((viewportWidth * 3) / originalWidth);
                console.log(`Clones needed: ${clonesNeeded}`);
                for (let i = 0; i < clonesNeeded; i++) {
                    reviewItems.forEach(item => {
                        const clone = item.cloneNode(true);
                        reviewContainer.appendChild(clone);
                    });
                }
                console.log(`Total items after cloning: ${reviewContainer.querySelectorAll('.review-item').length}`);

                let scrollPosition = 0;
                const scrollSpeed = 1.5; // Pixels per frame (adjust for speed)
                let isPaused = false;
                let animationFrameId;

                function animateScroll() {
                    if (!isPaused) {
                        scrollPosition -= scrollSpeed;
                        if (-scrollPosition >= originalWidth) {
                            scrollPosition += originalWidth; // Reset to start of original reviews
                        }
                        reviewContainer.style.transform = `translateX(${scrollPosition}px)`;
                    }
                    animationFrameId = requestAnimationFrame(animateScroll);
                }

                // Start animation
                animateScroll();

                // Pause/resume on hover
                reviewContainer.addEventListener('mouseenter', () => {
                    isPaused = true;
                });
                reviewContainer.addEventListener('mouseleave', () => {
                    isPaused = false;
                });

                // Cleanup on page unload
                window.addEventListener('unload', () => {
                    cancelAnimationFrame(animationFrameId);
                });
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>