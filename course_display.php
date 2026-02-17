<?php
include "connectdb.php";

$query_course_details = "SELECT * FROM oscord_course ORDER BY sort IS NULL, sort ASC";
$result_course_details = $conn->query($query_course_details);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Display Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
        /* BASE STYLES & SCROLLBAR */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Custom OS Scrollbar (for page scroll) */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f2ff, #4cffd9);
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #BF00FF, #ff00ff);
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
        }

        /* BODY & ANIMATIONS */
        body {
            background: linear-gradient(135deg, #0a0a0a, #1c2526);
            color: #e6e6e6;
            min-height: 100vh;
            /* Ensures no unwanted horizontal scrollbar on viewport edge */
            overflow-x: hidden;
            position: relative;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes floatAnimation {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-3px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* LAYOUT & TITLE */
        #main-course-container {
            padding-bottom: 50px;
            max-width: 1200px;
            /* CRUCIAL: Absolute positioning of buttons is relative to this element */
            position: relative;
        }

        #titleCourse {
            font-family: 'Helvetica', sans-serif;
            font-size: 2rem;
            font-weight: 500;
            text-align: center;
            margin: 10px 0 30px;
            color: #ffffff;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            padding-top: 50px;
        }

        /* SWIPER CONTAINER STYLING */
        .swiper {
            width: 86%;
            padding: 20px 0;
            padding-bottom: 40px;
        }

        /* SWIPER NAVIGATION BUTTON ENHANCEMENTS */
        .swiper-button-next,
        .swiper-button-prev {
            color: #00f2ff;
            opacity: 0.7;
            transition: all 0.3s ease-in-out;
            /* Kept floating animation */
            animation: floatAnimation 2s infinite ease-in-out;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 40px;
            height: 40px;

            /* Reset default Swiper CSS that may cause conflicts */
            margin-top: 0 !important;
        }

        /* 🌟 WIDE SCREEN (Desktop): Position buttons OUTSIDE the 1200px container 🌟 */
        .swiper-button-prev {
            /* Start from the left edge of #main-course-container */
            left: 0;
            /* Move button left by its width (40px) + desired offset (10px) = 50px */
            margin-left: -50px !important;
        }

        .swiper-button-next {
            /* Start from the right edge of #main-course-container */
            right: 0;
            /* Move button right by its width (40px) + desired offset (10px) = 50px */
            margin-right: -50px !important;
        }

        /* REMOVED: Swiper button hover effects */
        /*
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: #ffffff;
        opacity: 1;
        transform: translateY(-50%) scale(1.1);
        animation: none;
    }
    */

        /* Disabled State: Dim and remove animation */
        .swiper-button-disabled {
            color: #3f3f3f !important;
            opacity: 0.3 !important;
            cursor: default;
            pointer-events: none;
            animation: none !important;
        }

        /* CARD STYLING */
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: stretch;
            height: auto;
            padding: 10px;
        }

        .neon-course-card {
            background: transparent;
            border: 1px;
            border-radius: 15px;
            transition: all 0.4s ease;
            color: #e6e6e6;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 1px 1px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            height: 550px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(15px) saturate(100%);
            -webkit-backdrop-filter: blur(10px) saturate(100%);
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .neon-course-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .neon-card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .neon-card-title {
            font-family: 'Sancreek' !important;
            font-size: 1.5rem;
            font-weight: 500;
            margin-top: 15px;
            margin-bottom: 15px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 35px;
            padding: 0 1rem;
        }

        .neon-card-details {
            flex-grow: 1;
            margin-bottom: 20px;
            padding: 0 1rem;
        }


        .neon-card-details .detail-item {
            margin-bottom: 10px;
            color: #d0d0d0;
            line-height: 25px;
        }

        .neon-card-details .detail-item b {
            color: #00f2ff;
            font-weight: 600;
        }

        .fb-link {
            color: #ff00ff;
            text-decoration: none;
        }

        .fb-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .btn-start-learning {
            background: transparent;
            border: 2px solid #00f2ff;
            color: #00f2ff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 400;
            border-radius: 40px;
            transition: all 0.3s ease;
            display: block;
            padding: 1rem;
            text-align: center;
            width: 80%;
            margin: 0 auto 1.5rem auto;
        }

        .btn-start-learning:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /*
    ---
    ## 📱 MEDIA QUERIES
    ---
    */

        /* Reset button position for screens <= 1200px */
        @media (max-width: 1200px) {
            .swiper-button-prev {
                left: 0 !important;
                margin-left: 0 !important;
            }

            .swiper-button-next {
                right: 0 !important;
                margin-right: 0 !important;
            }
        }

        /* Tablet/Phablet adjustments <= 992px */
        @media (max-width: 992px) {
            .swiper {
                margin-left: 30px;
                margin-right: 0x;
                width: 95%;
            }

            .swiper-slide {
                /* border: 2px solid black; */
                padding: 0 !important;
            }

            .neon-course-card {
                min-height: 500px;
                /* border: 2px solid yellow; */
                width: 90%;
                text-align: center;
                margin: auto;
            }

            .swiper-button-prev {
                left: 0;
                margin-left: 50px !important;
            }

            .swiper-button-next {
                right: 0;
                margin-right: 50px !important;
            }
            .neon-course-card {
                text-align: left !important; /* Overrides center */
                width:340px !important;
                height : 200px !important;
                margin-left : 0px !important;
            }
            .neon-card-title,
            .neon-card-details {
                text-align: left; /* Specific to title and details */
                padding: 0 1.5rem; /* Slightly more padding for breathing room */
               
            }
            .swiper {
                margin: 0 auto;
                width: 95%;
            }

        }

        /* Mobile adjustments <= 576px */
        @media (max-width: 576px) {
            .swiper {
                /* border: 2px solid blue; */
            }

            .neon-course-card {
                min-height: 450px;
                min-width: 95%;
            }

            .neon-card-title {
                font-size: 1.2rem;
                margin-bottom: 15px;
                line-height : 30px !important;
            }

            .neon-card-details .detail-item {
                font-size: 0.82rem;
                line-height: 1.4;
            }

            .swiper-button-prev {
                left: 0;
                margin-left: 10px !important;
            }

            .swiper-button-next {
                right: 0;
                margin-right: 10px !important;
            }

            .btn-start-learning {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
            .neon-course-card {
                text-align: left !important; /* Overrides center */
                width:340px !important;
                height : 200px !important;
                margin-left : 0px !important;
            }
            .neon-card-title,
            .neon-card-details {
                text-align: left; /* Specific to title and details */
                padding: 0 1.5rem; /* Slightly more padding for breathing room */
            }
            .swiper {
                margin: 0 auto;
                width: 95%;
            }
        }
    </style>

<body>
    <div class="container" id="main-course-container">
        <h1 id="titleCourse">Our Courses</h1>

        <div class="swiper course-slider">
            <div class="swiper-wrapper">
                <?php
                if ($result_course_details && $result_course_details->num_rows > 0) {
                    while ($row2 = $result_course_details->fetch_assoc()) {
                        echo "<div class='swiper-slide'>";
                        echo "<form method='post' action='oscord_specificCoursePage.php' class='h-100'>";
                        echo "<div class='neon-course-card animate-on-scroll'>";
                        echo "<div class='neon-card-body'>";

                        echo "<img src='image/" . htmlspecialchars($row2['coursePhoto']) . "' alt='" . htmlspecialchars($row2['courseName']) . "' class='card-img-top'>";
                        echo "<h6 class='neon-card-title'>" . htmlspecialchars($row2['courseName']) . "</h6>";

                        echo "<div class='neon-card-details'>";

                        
                        $input = $row2['courseFee'];

                        $amount_str = trim(str_replace("MMK", "", $input));
                        
                        $amount_str = str_replace(",", "", $amount_str);
                        
                        $courseFee = (double) $amount_str;

                        echo "<div class='detail-item'><b>Course Fee</b> : " . number_format($courseFee * 0.15) . " MMK</div>";



                        echo "<div class='detail-item'><b>Course Period</b> : " . htmlspecialchars($row2['coursePeriod']) . "</div>";
                        if (!empty($row2['courseFbLink'])) {
                            echo "<div class='detail-item'><a class='fb-link' href='" . htmlspecialchars($row2['courseFbLink']) . "' target='_blank'>View on Facebook</a></div>";
                        }
                        echo "</div>";

                        // Course details collapse (kept for structure)
                        echo "<div class='collapse course-details-content' id='courseDetails" . htmlspecialchars($row2['courseID']) . "'>";
                        $courseID = $row2['courseID'];
                        // Use prepared statements for security (best practice)
                        $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                        $stmt3 = $conn->prepare($query3);

                        // Check if prepare succeeded before binding
                        if ($stmt3) {
                            $stmt3->bind_param("i", $courseID);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();

                            while ($row3 = $result3->fetch_assoc()) {
                                echo "<div class='course-detail-item'>" . htmlspecialchars($row3['coursedetailName']) . "</div>";
                            }
                            $stmt3->close();
                        } else {
                            // Handle statement preparation error
                            error_log("Failed to prepare statement for course details: " . $conn->error);
                        }
                        echo "</div>";

                        echo "<button class='btn-start-learning' type='submit' name='courseID' value='" . htmlspecialchars($row2['courseID']) . "'>Start Learning</button>";
                        echo "</div>"; // .neon-card-body
                        echo "</div>"; // .neon-course-card
                        echo "</form>";
                        echo "</div>"; // .swiper-slide
                    }
                } else {
                    echo "<div class='swiper-slide'><p class='text-center w-100 pt-5'>No courses found.</p></div>";
                }

                // Closing connection only if it was successfully opened
                if (isset($conn)) {
                    $conn->close();
                }
                ?>
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            const courseSwiper = new Swiper('.course-slider', {
                // Default settings for mobile (Phone)
                slidesPerView: 1,
                spaceBetween: 30,
                freeMode: true, // Enable free swipe/scroll mode for mobile
                watchOverflow: true, // Disables navigation/pagination if there are not enough slides

                // Navigation Arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                // Scrollbar
                scrollbar: {
                    el: '.swiper-scrollbar',
                    draggable: true,
                    hide: true,
                    enabled: false, // Default to disabled on mobile
                },

                // Responsive Breakpoints
                breakpoints: {
                    // 768px (iPad/Tablet)
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 0,
                        freeMode: false,
                        scrollbar: {
                            enabled: false,
                        }
                    },
                    // 992px (Laptop/Desktop)
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 0,
                        freeMode: false,
                        scrollbar: {
                            enabled: true, // Enable scrollbar for desktop
                            hide: false,
                        }
                    }
                },
            });
        });
    </script>
</body>

</html>