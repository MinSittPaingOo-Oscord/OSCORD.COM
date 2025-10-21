<?php
include "connectdb.php";

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);

$query_course_details = "SELECT * FROM oscord_course ORDER BY sort IS NULL, sort ASC";
$result_course_details = $conn->query($query_course_details);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Display</title>
    <style>
        
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

        }

        @media (max-width: 576px) {
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

        }
    </style>
</head>
<body>
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
</body>
</html>