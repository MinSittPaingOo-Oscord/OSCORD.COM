<?php
    include "connectdb.php";
    $query_course_count = "SELECT COUNT(*) as course_count FROM oscord_course";
    $result_course_count = $conn->query($query_course_count);
    $course_count = $result_course_count->fetch_assoc()['course_count'];
    
    $query_student_count = "SELECT COUNT(DISTINCT studentID) as student_count FROM oscord_studentxcourse";
    $result_student_count = $conn->query($query_student_count);
    $student_count = $result_student_count->fetch_assoc()['student_count'];
    
    $query_content_count = "SELECT (SELECT COUNT(*) FROM oscord_vidlec) + (SELECT COUNT(*) FROM file) as content_count";
    $result_content_count = $conn->query($query_content_count);
    $content_count = $result_content_count->fetch_assoc()['content_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Impact</title>
    <style>
            .stats-section {
            /* background: rgba(0, 0, 0, 0.9); */
            background : transparent;
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
            /* background: #1c2526; */
            background : transparent;
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

        @media (max-width: 576px) {

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
                min-width: 80%;
            }

        }
    </style>
</head>
<body>
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
</body>
</html>