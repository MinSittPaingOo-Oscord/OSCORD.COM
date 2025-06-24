<?php
include "connectdb.php";

$query_courses = "SELECT * FROM oscord_course";
$result_courses = $conn->query($query_courses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            position: relative;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes neonGlow {
            0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
            50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
        }

        #titleCourse {
            font-family: 'Orbitron', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin: 50px 0 30px;
            color: #ffffff;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: fadeIn 0.8s ease-out;
            position: relative;
            z-index: 1;
        }

        .card {
            background: transparent;
            border: 1px solid rgba(0, 242, 255, 0.3);
            border-radius: 15px;
            padding: 15px;
            margin: 10px auto;
            transition: all 0.4s ease;
            color: #e6e6e6;
            /* max-width: 350px;
             */
            width : 500px;
            box-shadow: 0 5px 15px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            height: 780px;
            position: relative;
            z-index: 1;
           
        }

        .card *{
            line-height : 40px;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 40px;
        }

        #courseDescription {
            font-size: 0.95rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .card-text .detail-item {
            margin-bottom: 6px;
            color: #d0d0d0;
            font-size: 0.9rem;
        }

        .card-text .detail-item b {
            color: #00f2ff;
            font-weight: 600;
        }

        .card-text .detail-item:last-child {
            margin-bottom: 10px;
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
            padding: 8px 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
            display: block;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .btn-course-detail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .course-details-content {
            background: transparent;
            border-radius: 8px;
            padding: 6px 10px;
            margin-bottom: 15px;
            max-height: 100px;
            overflow-y: auto;
            animation: fadeIn 1s ease-out;
        }

        .course-details-content .course-detail-item {
            color: #e6e6e6;
            font-weight: 400;
            padding: 3px 6px;
            font-size: 0.85rem;
            line-height: 1.2;
            background: transparent;
            border-radius: 4px;
            margin-bottom: 2px;
            transition: all 0.3s ease;
        }

        .course-details-content .course-detail-item:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: translateX(5px);
        }

        .carousel-section {
            margin: 60px 0;
            padding: 0 15px;
            background: transparent;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .carousel-inner {
            width: 100%;
            overflow: hidden;
        }

        .carousel-item {
            width: 100%;
        }

        .carousel-item .row {
            margin: 0 -15px;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 60px;
            height: 60px;
            background: rgba(0, 242, 255, 0.2);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            background: rgba(0, 242, 255, 0.4);
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #00f2ff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            background-size: 50% 50%;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        /* Desktop view (3 courses) */
        @media (min-width: 992px) {
            .carousel-item .col-lg-4 {
                flex: 0 0 33.3333%;
                max-width: 33.3333%;
            }
        }

        /* iPad view (2 courses, assuming 768px to 991px) */
        @media (min-width: 720px) and (max-width: 920px) {
            .carousel-item .col-lg-4 {
                flex: 0 0 50%;
                max-width: 33%;
            }
            .carousel-item .col-lg-4:nth-child(n+3) {
                display: none;
            }
            .card {
                max-width: 28%;
                height: 550px;
                padding: 12px;
            }
            .card-title { font-size: 1.4rem; margin-bottom: 12px; }
            #courseDescription { font-size: 0.9rem; line-height: 1.6; }
            .card-text .detail-item { font-size: 0.85rem; }
            .btn-course-detail { padding: 7px 15px; font-size: 0.9rem; }
            .course-details-content { max-height: 80px; padding: 5px 8px; }
            .course-details-content .course-detail-item { font-size: 0.8rem; }
        }

        /* Mobile view (1 course) */
        @media (max-width: 767px) {
            .carousel-item .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .carousel-item .col-lg-4:nth-child(n+2) {
                display: none;
            }
            .card {
                max-width: 85%;
                height: 500px;
                padding: 10px;
            }
            .card-title { font-size: 1.3rem; margin-bottom: 10px; }
            #courseDescription { font-size: 0.85rem; line-height: 1.5; }
            .card-text .detail-item { font-size: 0.8rem; margin-bottom: 5px; }
            .btn-course-detail { padding: 6px 12px; font-size: 0.85rem; margin-top: 8px; margin-bottom: 10px; }
            .course-details-content { max-height: 70px; padding: 4px 6px; }
            .course-details-content .course-detail-item { font-size: 0.75rem; padding: 2px 4px; }
            #titleCourse { font-size: 1.8rem; margin: 30px 0 15px; }
            .carousel-control-prev, .carousel-control-next { width: 40px; height: 40px; }
            .carousel-control-prev-icon, .carousel-control-next-icon { width: 25px; height: 25px; }
        }

        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="carousel-section">
        <h1 id="titleCourse">Explore Our Courses</h1>
        <div id="courseCarousel" class="carousel slide" data-bs-interval="false">
            <div class="carousel-inner">
                <?php
                if ($result_courses && $result_courses->num_rows > 0) {
                    $courses = [];
                    while ($row = $result_courses->fetch_assoc()) {
                        $courses[] = $row;
                    }

                    $chunk_size = 3;
                    $chunks = array_chunk($courses, $chunk_size);
                    $is_first = true;

                    foreach ($chunks as $chunk) {
                        $active_class = $is_first ? 'active' : '';
                        echo "<div class='carousel-item $active_class'>";
                        echo "<div class='row'>";
                        foreach ($chunk as $row) {
                            echo "<div class='col-lg-4 d-flex justify-content-center'>";
                            echo "<form method='post' action='oscord_specificCoursePage.php'>";
                            echo "<div class='card animate-on-scroll'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($row['courseName']) . "</h5>";
                            echo "<div id='courseDescription'>" . htmlspecialchars($row['courseDescription']) . "</div>";
                            echo "<div class='card-text'>";
                            echo "<div class='detail-item'><b>Course Fee</b>: " . htmlspecialchars($row['courseFee']) . "</div>";
                            echo "<div class='detail-item'><b>Course Period</b>: " . htmlspecialchars($row['coursePeriod']) . "</div>";
                            if (!empty($row['courseFbLink'])) {
                                echo "<div class='detail-item'><a class='fb-link' href='" . htmlspecialchars($row['courseFbLink']) . "' target='_blank'>View on Facebook</a></div>";
                            }
                            echo "</div>";
                            echo "<button class='btn btn-course-detail' type='button' data-bs-toggle='collapse' data-bs-target='#courseDetails" . htmlspecialchars($row['courseID']) . "' aria-expanded='false' aria-controls='courseDetails" . htmlspecialchars($row['courseID']) . "'>Course Details</button>";
                            echo "<div class='collapse course-details-content' id='courseDetails" . htmlspecialchars($row['courseID']) . "'>";
                            $courseID = $row['courseID'];
                            $query_details = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                            $stmt_details = $conn->prepare($query_details);
                            $stmt_details->bind_param("i", $courseID);
                            $stmt_details->execute();
                            $result_details = $stmt_details->get_result();
                            while ($row_detail = $result_details->fetch_assoc()) {
                                echo "<div class='course-detail-item'>" . htmlspecialchars($row_detail['coursedetailName']) . "</div>";
                            }
                            $stmt_details->close();
                            echo "</div>";
                            echo "<button class='btn btn-course-detail' type='submit' name='courseID' value='" . htmlspecialchars($row['courseID']) . "'>Start Learning</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</form>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";
                        $is_first = false;
                    }
                } else {
                    echo "<div class='carousel-item active'>";
                    echo "<div class='row justify-content-center'>";
                    echo "<div class='col-lg-4'>";
                    echo "<div class='card animate-on-scroll'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>No Courses Available</h5>";
                    echo "<div id='courseDescription'>Sorry, no courses are available at the moment. Please check back later!</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#courseCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#courseCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>