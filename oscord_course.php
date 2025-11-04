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
    <title>Home</title>
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

        #homeDiv {
            background-image: url('./image/blur.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
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

        /* LAYOUT & TITLE */
        #main-course-container {
            padding-bottom: 50px;
            max-width: 1200px;
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

        /* CARD STYLING */
        /* Use flex on the row to ensure cards stay aligned vertically */
        #course-grid-row {
            display: flex;
            flex-wrap: wrap;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .course-col {
            /* Ensures each column has padding and space */
            padding: 10px;
            display: flex;
            /* Makes sure the card inside stretches */
        }

        .neon-course-card {
            background: transparent;
            border: 1px;
            border-radius: 15px;
            transition: all 0.4s ease;
            color: #e6e6e6;
            width: 100%;
            box-shadow: 0 5px 5px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            min-height: 550px;
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
            height: 200px;
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

        @media (max-width: 820px) {
            .neon-course-card {
                min-height: 500px;
            }
        }

        @media (max-width: 576px) {
            .neon-course-card {
                min-height: 450px;
            }

            .neon-card-title {
                font-size: 1.2rem;
                line-height: 1.2;
                margin-bottom: 15px;
            }

            .neon-card-details .detail-item {
                font-size: 0.82rem;
                line-height: 1.4;
            }

            .btn-start-learning {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>


    <?php
    include "nav.php";
    echo "<div id='homeDiv'>";
    ?>
    <div class="container" id="main-course-container">
        <h1 id="titleCourse">Our Courses</h1>

        <!-- STANDARD BOOTSTRAP GRID -->
        <div class="row" id="course-grid-row">
            <?php
            if ($result_course_details && $result_course_details->num_rows > 0) {
                while ($row2 = $result_course_details->fetch_assoc()) {
                    // Responsive column classes: 1 per row on extra small, 2 per row on small (tablet), 3 per row on large (desktop)
                    echo "<div class='col-12 col-sm-6 col-lg-4 course-col'>";
                    echo "<form method='post' action='oscord_specificCoursePage.php' class='h-100'>";
                    echo "<div class='neon-course-card animate-on-scroll h-100'>";
                    echo "<div class='neon-card-body'>";

                    echo "<img src='image/" . htmlspecialchars($row2['coursePhoto']) . "' alt='" . htmlspecialchars($row2['courseName']) . "' class='card-img-top'>";
                    echo "<h6 class='neon-card-title'>" . htmlspecialchars($row2['courseName']) . "</h6>";

                    echo "<div class='neon-card-details'>";
                    echo "<div class='detail-item'><b>Course Fee</b> : " . htmlspecialchars($row2['courseFee']) . "</div>";
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

                    if ($stmt3) {
                        $stmt3->bind_param("i", $courseID);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();

                        while ($row3 = $result3->fetch_assoc()) {
                            echo "<div class='course-detail-item'>" . htmlspecialchars($row3['coursedetailName']) . "</div>";
                        }
                        $stmt3->close();
                    } else {
                        error_log("Failed to prepare statement for course details: " . $conn->error);
                    }
                    echo "</div>";

                    echo "<button class='btn-start-learning' type='submit' name='courseID' value='" . htmlspecialchars($row2['courseID']) . "'>Start Learning</button>";
                    echo "</div>"; // .neon-card-body
                    echo "</div>"; // .neon-course-card
                    echo "</form>";
                    echo "</div>"; // .col-*-*
                }
            } else {
                echo "<p class='text-center w-100 pt-5'>No courses found.</p>";
            }

            if (isset($conn)) {
                $conn->close();
            }
            ?>
        </div>
        <!-- END STANDARD BOOTSTRAP GRID -->
    </div>
    <?php
    include "footer.php";
    echo "</div>";

    ?>
    <?php $conn->close(); ?>
</body>

</html>
