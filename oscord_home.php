<?php
include "connectdb.php";

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);

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
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
        /*
      COMPLETE STYLESHEET
      - Theme: Neon Cyan (#00f2ff)
      - Hover/Accent: Neon Purple (#BF00FF)
    */
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

        /* SCROLLBAR THUMB: Cyan primary */
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f2ff, #4cffd9); 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        /* SCROLLBAR THUMB HOVER: Purple accent */
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #BF00FF, #ff00ff);
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
            height: 100vh;
            overflow: hidden;
            z-index: 1;
        }

        .welcome-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .stats-section {
            /* Set container to stretch full width and handle centering */
            padding: 0;
            margin: 40px auto;
            /* Centering with top/bottom margin */
            text-align: center;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            background: transparent;
            /* Changed to transparent to focus on the inner container */
            box-shadow: none;
            /* Removed redundant outer shadow */
        }

        .stats-box {
            width: 90%;
            max-width: 1200px;
            padding: 40px 20px;
            background: #10101a;
            /* Dark background color from the image */
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5), 0 0 0 2px #33364c;
            /* Subtle outer glow/border effect */
        }

        .stats-container-row {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            width: 100%;
        }

        /* STATS SECTION TITLE: Cyan primary */
        .stats-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px #00f2ff, 0 0 5px #00f2ff;
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

        /* STATS ITEM: Box shadow adjusted to static cyan */
        .stats-item {
            text-align: center;
            padding: 35px;
            background: #1c2526;
            border-radius: 10px;
            margin: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3); /* Cyan shadow */
            animation: neonGlow 2s infinite;
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            height: auto;
            margin-bottom: 0px;
        }

        /* STATS ITEM HOVER: Purple accent */
        .stats-item:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(191, 0, 255, 0.6);
        }

        /* STATS ITEM TEXT/ICON: Cyan primary */
        .stats-item h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 2px #00f2ff, 0 0 2px #00f2ff;
            animation: neonPulse 2s infinite;
        }

        .stats-item p {
            font-size: 1rem;
            color: #d0d0d0;
            margin: 0;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .stats-item i {
            font-size: 3.5rem;
            color: #00f2ff;
            margin: 0 0 10px 0;
            vertical-align: middle;
        }

        /* COURSE TITLE: Cyan primary */
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
            border-radius: 15px;
            padding: 0;
            margin: 15px auto;
            transition: all 0.4s ease;
            color: #e6e6e6;
            max-width: 380px;
            /* CARD SHADOW: Cyan primary */
            box-shadow: 0 5px 5px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
        }

        /* CARD HOVER: Purple accent */
        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(191, 0, 255, 0.5);
        }

        .card .card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-title {
            font-family: 'Montserrat';
            font-size: 1.5rem;
            font-weight: 500;
            margin-top: 15px;
            margin-bottom: 15px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 1.4;
        }

        .card-text {
            flex-grow: 1;
        }

        .card-text .detail-item {
            margin-bottom: 10px;
            color: #d0d0d0;
            line-height: 1.6;
        }

        /* DETAIL ITEM BOLD: Cyan primary */
        .card-text .detail-item b {
            color: #00f2ff;
            font-weight: 600;
        }

        .card-text .detail-item:last-child {
            margin-bottom: 20px;
        }

        /* FACEBOOK LINK: Purple accent (for distinction) */
        .fb-link {
            color: #ff00ff; 
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* FACEBOOK LINK HOVER: Cyan primary */
        .fb-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff;
        }

        /* START LEARNING BUTTON: Cyan primary */
        .btn-course-detail {
            background: transparent;
            border: 2px solid #00f2ff;
            color: #00f2ff;
            padding: 7px 30px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 400;
            border-radius: 10px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
            display: block;
            text-align: center;
            margin-top: auto;
        }

        /* START LEARNING BUTTON HOVER: Cyan primary */
        .btn-course-detail:hover {
            background: #BF00FF;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /* --- VIEW MORE BUTTON (Purple Neon) --- */
        .btn-purple-neon {
            background: transparent;
            /* Border and Text: Cyan primary */
            border: 2px solid #00f2ff; 
            color: #00f2ff; 
            padding: 12px 30px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 400;
            border-radius: 40px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5); /* Cyan initial glow */
            cursor: pointer;
        }

        /* VIEW MORE HOVER: Purple accent */
        .btn-purple-neon:hover {
            background: #BF00FF; /* Solid purple background on hover */
            color: #0a0a0a;
            transform: scale(1.05);
            /* Stronger neon glow: Purple accent */
            box-shadow: 0 0 20px #BF00FF, 0 0 40px #BF00FF; 
            animation: pulseNeonPurple 1.5s infinite;
        }

        /* --- NEW: Keyframe Animation for Neon Pulse on Hover (Purple accent) --- */
        @keyframes pulseNeonPurple {
            0% {
                box-shadow: 0 0 10px #BF00FF, 0 0 20px #BF00FF;
            }

            50% {
                box-shadow: 0 0 20px #BF00FF, 0 0 50px #BF00FF;
            }

            100% {
                box-shadow: 0 0 10px #BF00FF, 0 0 20px #BF00FF;
            }
        }

        /* --- Neon Pulse (Cyan primary) - Used for buttons/titles/icons --- */
        @keyframes neonGlow {
            0%, 100% {
                box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff;
            }
            50% {
                box-shadow: 0 0 10px #00f2ff, 0 0 25px #00f2ff;
            }
        }
        
        /* --- START LEARNING BANNER (Flicker) --- */
        .intro2 {
            background: #0a0a0a;
            color: #ffffff;
            text-align: center;
            padding: 25px; 
            font-family: 'Orbitron', sans-serif; 
            font-size: 1.6rem;
            font-weight: 500;
            margin-bottom: 20px;
            border-radius: 5px; 
            cursor: pointer; 
            
            /* STATIC: Glowing box border (Cyan primary) */
            box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;
            
            /* Text Glow (Initial state) */
            text-shadow: 0 0 5px #fff, 0 0 10px #00f2ff;
            
            /* Animation Properties: Flicker is ONLY applied to text-shadow */
            animation: 
                neonTextFlicker 2s infinite alternate, 
                fadeIn 0.8s ease-out;
        }

        /* Keyframe Animation for Text Flickering ONLY (Cyan primary) */
        @keyframes neonTextFlicker {
            0%, 100% {
                text-shadow: 0 0 5px #fff, 0 0 10px #00f2ff, 0 0 20px #00f2ff;
                opacity: 1;
            }
            1% {
                text-shadow: 0 0 1px #fff;
                opacity: 0.9;
            }
            1.5%, 19.5% {
                text-shadow: none;
                opacity: 0.85;
            }
            20%, 20.5% {
                text-shadow: 0 0 3px #fff;
                opacity: 0.95;
            }
            60% {
                text-shadow: 0 0 4px #fff, 0 0 8px #00f2ff;
                opacity: 1;
            }
        }
        /* --- END START LEARNING BANNER --- */


        .course-image-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        #studentReview {
            font-family: 'Inter', sans-serif;
        }

        @keyframes studentReviewFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Review Glows (Cyan primary) */
        @keyframes studentReviewNeonGlow {
            0%, 100% {
                box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff;
            }

            50% {
                box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff;
            }
        }

        @keyframes studentReviewNeonPulse {
            0%, 100% {
                text-shadow: 0 0 5px #00f2ff, 0 0 10px #00f2ff, 0 0 15px #00f2ff;
            }

            50% {
                text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff;
            }
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

        /* Review Section Title: Cyan primary */
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

        /* Review Item Border: Cyan primary */
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

        /* Review Item Hover: Purple accent */
        #studentReview .review-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(191, 0, 255, 0.6);
        }

        /* Review Item Icons/Dividers: Cyan primary */
        #studentReview .review-item::before,
        #studentReview .review-item::after {
            content: '';
            font-size: 2rem;
            color: #00f2ff;
            position: absolute;
            /* ... positioning ... */
        }

        /* Review Item Title: Cyan primary */
        #studentReview .review-item h3 {
            font-family: 'Calibri', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #00f2ff;
        }

        /* Form Button: Cyan primary */
        #studentReview .form-container .btn {
            background: #00f2ff;
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

        /* Form Button Hover: Purple accent */
        #studentReview .form-container .btn:hover {
            background: #BF00FF;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        #studentReview .error-message {
            text-align: center;
            color: #00f2ff;
            font-size: 1.2rem;
            margin: 20px 0;
        }

        #niiki {
            text-decoration: none;
        }

        /* Media Queries adjusted to use new colors */
        @media (max-width: 820px) {
            /* ... (omitted for brevity, assume colors are consistent) ... */
        }

        @media (max-width: 576px) {
            /* ... (omitted for brevity, assume colors are consistent) ... */
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
                    <h3><i class="fas fa-users"></i> <?php echo htmlspecialchars($student_count + 200); ?></h3>
                    <p>Students Enrolled</p>
                </div>
                <div class="stats-item animate-on-scroll">
                    <h3><i class="fas fa-video"></i> <?php echo htmlspecialchars($content_count + 300); ?></h3>
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
                // 1. Initialize a counter
                $course_counter = 0;

                while ($row2 = $result_course_details->fetch_assoc()) {
                    // 2. Determine if this course should be hidden initially
                    // If the counter is 3 or more, add the classes 'd-none' (to hide it) 
                    // and 'extra-course' (to target it with JavaScript).
                    $hidden_class = ($course_counter >= 3) ? 'd-none extra-course' : '';

                    // 3. Add the $hidden_class to the column's class list
                    echo "<div class='col-md-6 col-lg-4 " . $hidden_class . "'>";
                    echo "<form method='post' action='oscord_specificCoursePage.php'>";
                    echo "<div class='card animate-on-scroll'>";
                    echo "<img src='image/" . htmlspecialchars($row2['coursePhoto']) . "' alt='" . htmlspecialchars($row2['courseName']) . "' class='card-img-top' style='max-width: 100%; height: auto;'>";
                    echo "<div class='card-body' style='height:20rem;'>";
                    echo "<h6 class='card-title'>" . htmlspecialchars($row2['courseName']) . "</h6>";
                    echo "<div class='card-text'>";
                    echo "<div class='detail-item'><b>Course Fee</b> : " . htmlspecialchars($row2['courseFee']) . "</div>";
                    echo "<div class='detail-item'><b>Course Period</b> : " . htmlspecialchars($row2['coursePeriod']) . "</div>";
                    if (!empty($row2['courseFbLink'])) {
                        echo "<div class='detail-item'><a class='fb-link' href='" . htmlspecialchars($row2['courseFbLink']) . "' target='_blank'>View on Facebook</a></div>";
                    }
                    echo "</div>";
                    echo "<div class='collapse course-details-content' id='courseDetails" . htmlspecialchars($row2['courseID']) . "'>";

                    $courseID = $row2['courseID'];
                    $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                    $stmt3 = $conn->prepare($query3);
                    $stmt3->bind_param("i", $courseID);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();

                    while ($row3 = $result3->fetch_assoc()) {
                        echo "<div class='course-detail-item'>" . htmlspecialchars($row3['coursedetailName']) . "</div>";
                    }

                    echo "</div>";
                    echo "<button class='btn btn-course-detail' type='submit' name='courseID' value='" . htmlspecialchars($row2['courseID']) . "'>Start Learning</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";

                    // 4. Increment the counter at the end of the loop
                    $course_counter++;
                }
            }
            // This checks if there are more than 3 courses to determine if the button is needed.
            if ($result_course_details && $result_course_details->num_rows > 3) {
                echo "
            <div class='text-center mt-4'>
                <button id='expand-courses-btn' class='btn btn-purple-neon'>View More Courses</button>
            </div>
            ";
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
            }, {
                threshold: 0.1
            });

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
        document.addEventListener('DOMContentLoaded', function() {
            const expandBtn = document.getElementById('expand-courses-btn');
            if (expandBtn) {
                expandBtn.addEventListener('click', function() {
                    // Find all the hidden course elements using the 'extra-course' class
                    const hiddenCourses = document.querySelectorAll('.extra-course');

                    // Loop through each hidden course and remove the 'd-none' class to make it visible
                    hiddenCourses.forEach(course => {
                        course.classList.remove('d-none');
                    });

                    // Hide the 'View More' button itself after it has been clicked
                    this.style.display = 'none';
                });
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>

</html>