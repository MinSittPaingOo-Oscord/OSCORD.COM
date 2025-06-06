<?php
include "connectdb.php";

$query1 = "SELECT courseID,courseName FROM oscord_course";
$result1 = $conn->query($query1);

$query2 = "SELECT * FROM oscord_course";
$result2 = $conn->query($query2);

$query_reviews = "SELECT sr.*, s.studentName FROM oscord_studentreview sr JOIN oscord_student s ON sr.studentID = s.studentID WHERE sr.isShown=1";
$result_reviews = $conn->query($query_reviews);

$query_students = "SELECT studentID, studentName FROM oscord_student";
$result_students = $conn->query($query_students);

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);

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
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
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

        /* Particle Background */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background: transparent;
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

        @keyframes neonPulse {
            0%, 100% { text-shadow: 0 0 5px #00f2ff, 0 0 10px #00f2ff, 0 0 15px #00f2ff; }
            50% { text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff; }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        @keyframes logoSpin {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.05); }
            100% { transform: rotate(360deg) scale(1); }
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

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.5);
            animation: logoSpin 8s infinite linear;
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
            z-index: 1;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('./back2.jpg') no-repeat center/cover;
            opacity: 0.1;
            z-index: 0;
            animation: pulse 10s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.15; }
        }

        .middle {
            position: relative;
            z-index: 1;
        }

        .welcome-container h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0px;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        .welcome-container p {
            font-size: 1.2rem;
            color: #d0d0d0;
            line-height: 1.9;
            max-width: 600px;
            margin: 0 auto 30px;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .circularImage {
            max-width: 100%;
            height: auto;
            border-radius: 240px;
            border: 2px solid #00f2ff;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.4);
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .circularImage:hover {
            transform: scale(1.08) rotate(2deg);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.6);
        }

        /* Stats Section */
        .stats-section {
            background: rgba(20, 20, 20, 0.9);
            padding: 40px 0;
            margin-top: 0px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
            text-align: center;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .stats-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;
            animation: neonPulse 2s infinite;
        }

        .stats-content {
            max-width: 1200px;
            width: 100%;
            padding: 0 15px;
        }

        .stats-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
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
            min-width: 250px;
            max-width: 350px;
        }

        .stats-item:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.6);
        }

        .stats-item h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
            animation: neonPulse 2s infinite;
        }

        .stats-item p {
            font-size: 1.1rem;
            color: #d0d0d0;
            margin: 0;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .stats-item i {
            font-size: 1.5rem;
            color: #00f2ff;
            margin-right: 8px;
            vertical-align: middle;
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
            border: 1px;
            border-radius: 15px;
            padding: 20px;
            margin: 15px auto;
            transition: all 0.4s ease;
            color: #e6e6e6;
            max-width: 400px;
            box-shadow: 0 5px 5px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            height: 1200px;
            position: relative;
            z-index: 1;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 40px;
        }

        #courseDescription {
            font-size: 1rem;
            line-height: 1.9;
            color: #d0d0d0;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .card-text .detail-item {
            margin-bottom: 10px;
            color: #d0d0d0;
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
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
            display: block;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .btn-course-detail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .course-details-content {
            background: transparent;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 30px;
            max-height: 200px;
            overflow-y: auto;
            animation: fadeIn 1s ease-out;
        }

        .course-details-content .course-detail-item {
            color: #e6e6e6;
            font-weight: 400;
            padding: 5px 10px;
            font-size: 0.95rem;
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

        .review-section {
            margin: 60px 0;
            padding: 40px;
            background: transparent;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        .review-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 40px;
        }

        .review-item h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .review-item p {
            font-size: 1rem;
            line-height: 40px;
            margin-bottom: 20px;
            color: #d0d0d0;
        }

        .review-item i {
            font-size: 1.2rem;
            color: #00f2ff;
            margin-right: 8px;
            vertical-align: middle;
        }

        .form-container {
            background: transparent;
            padding: 30px;
            border-radius: 15px;
            margin: 30px auto;
            width: 100%;
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        .form-container h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .form-select, .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-select:focus, .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        .form-container .btn {
            background: #ff00ff;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .form-container .btn:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .contact-form {
            background: #2a2a2a;
            padding: 50px;
            margin: 30px auto;
            max-width: 700px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        .contact-form h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .contact-form label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #d0d0d0;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #555;
            background: #333;
            color: #e6e6e6;
            margin-bottom: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .contact-form input:focus, .contact-form textarea:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        .contact-form .btn {
            background: #ff00ff;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            color: #ffffff;
            width: 100%;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .contact-form .btn:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /* Footer */
        #homeConclusion {
            background: rgba(10, 10, 10, 0.95);
            padding: 40px 0;
            color: #e6e6e6;
            animation: fadeIn 1s ease-out;
            padding-top: 30px;
            position: relative;
            z-index: 1;
        }

        #homeConclusion h4 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        #homeConclusion h4 i {
            font-size: 1.2rem;
            color: #00f2ff;
            margin-right: 8px;
            vertical-align: middle;
        }

        #homeConclusion a {
            color: #00f2ff;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        #homeConclusion a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff;
        }

        #last {
            background: #111;
            padding: 20px 0;
            font-size: 0.9rem;
            color: #d0d0d0;
            position: relative;
            z-index: 1;
        }

        /* Responsive Design */
        @media (max-width: 820px) {
            .welcome-container {
                min-height: 70vh;
                padding: 30px 5%;
            }

            .welcome-container h2 {
                font-size: 2.5rem;
            }

            .welcome-container p {
                font-size: 1.1rem;
            }

            .circularImage {
                margin-top: 25px;
                border-radius: 330px;
            }

            .middle {
                flex-direction: column;
                text-align: center;
            }

            .middle .col {
                margin-bottom: 20px;
            }

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
                line-height: 1.7;
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

            .review-section {
                padding: 30px 20px;
            }

            .review-section h2 {
                font-size: 1.8rem;
                line-height: 1.4;
            }

            .contact-form {
                padding: 30px 20px;
                max-width: 100%;
            }

            .stats-section h2 {
                font-size: 2rem;
            }

            .stats-item h3 {
                font-size: 1.8rem;
            }

            .stats-item p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .dropdown-item {
                font-size: 0.8rem;
            }

            .card {
                max-width: 85%;
                height: auto;
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 30px;
            }

            .card-title {
                font-size: 1.4rem;
                line-height: 1.3;
                margin-bottom: 15px;
            }

            #courseDescription {
                font-size: 0.9rem;
                line-height: 1.6;
                margin-bottom: 15px;
            }

            .card-text .detail-item {
                font-size: 0.85rem;
                margin-bottom: 6px;
            }

            .btn-course-detail {
                padding: 8px 15px;
                font-size: 0.9rem;
                margin-top: 10px;
                margin-bottom: 15px;
            }

            .course-details-content {
                max-height: 120px;
                padding: 6px 10px;
                margin-bottom: 15px;
            }

            .course-details-content .course-detail-item {
                font-size: 0.8rem;
                padding: 3px 6px;
            }

            .form-container h2 {
                font-size: 1.5rem;
            }

            .stats-section h2 {
                font-size: 1.8rem;
            }

            .stats-item h3 {
                font-size: 1.5rem;
            }

            .stats-item p {
                font-size: 0.9rem;
            }

            .stats-item {
                min-width: 200px;
            }

            .review-section {
                max-width: 90%;
                padding: 20px;
                margin-left: 20px;
            }

            .logo-img {
                width: 40px;
                height: 40px;
            }
        }

        /* Scroll-triggered animations */
        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <ul class="nav nav-pills navbar-custom">
        <li class="nav-item logo-container">
            <a class="nav-link" aria-current="page" href="oscord_home.php">OSCORD - Programming & Computer Science</a>
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
        
        <li class="nav-item ms-auto">
            <a class="nav-link" href="oscord_signUpPage.php">Sign Up</a>
        </li>
    </ul>

    <div class="welcome-container">
        <div class='container middle row'>
            <div class='col' id="wel">
                <h2>Welcome to Oscord</h2>
                <br>
                <p>Study programming & Computer Science subjects from basic to software development level at OSCORD. 
                Online students can join both <b>by one VIP class</b> and group class (if available).
                For all by one classes, students <b>can negotiate</b> the class schedule.
                The video records and lecture files are usually sent in the private Telegram channel daily right after the class.</p>
            </div>
            <div class='col'>
                <img src='./OSCORD.jpg' class='circularImage'>
            </div>
        </div>
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
                    <h3><i class="fas fa-users"></i> <?php echo htmlspecialchars($student_count); ?></h3>
                    <p>Students Enrolled</p>
                </div>
                <div class="stats-item animate-on-scroll">
                    <h3><i class="fas fa-video"></i> <?php echo htmlspecialchars($content_count); ?></h3>
                    <p>Video Lectures & Files</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 id="titleCourse">Courses from OSCORD</h1>
        <div class="row">
            <?php
            while ($row2 = $result2->fetch_assoc()) {
                echo "<div class='col-md-6 col-lg-4'>";
                echo "<form method='post' action='oscord_specificCoursePage.php'>";
                echo "<div class='card animate-on-scroll'>";
                echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>".htmlspecialchars($row2['courseName'])."</h5>";
                    echo "<div id='courseDescription'>".htmlspecialchars($row2['courseDescription'])."</div>";
                    echo "<div class='card-text'>";
                        echo "<div class='detail-item'><b>Course Fee</b>: ".htmlspecialchars($row2['courseFee'])."</div>";
                        echo "<div class='detail-item'><b>Course Period</b>: ".htmlspecialchars($row2['coursePeriod'])."</div>";
                        if (!empty($row2['courseFbLink'])) {
                            echo "<div class='detail-item'><a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a></div>";
                        }
                    echo "</div>";
                    echo "<button class='btn btn-course-detail' type='button' data-bs-toggle='collapse' data-bs-target='#courseDetails".htmlspecialchars($row2['courseID'])."' aria-expanded='false' aria-controls='courseDetails".htmlspecialchars($row2['courseID'])."'>Course Details</button>";
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
            ?>
        </div>

        <!-- Student Review Section -->
        <div class="review-section">
            <h2>Student Reviews</h2>
            <?php
            if ($result_reviews && $result_reviews->num_rows > 0) {
                while ($row_review = $result_reviews->fetch_assoc()) {
                    echo "<div class='review-item animate-on-scroll'>";
                    echo "<h3 id='studentName'><i class='fas fa-user-graduate'></i> ".htmlspecialchars($row_review['studentName'])."</h3>";
                    echo "<p id='review'>".htmlspecialchars($row_review['studentreview'])."</p>";
                    echo "<hr>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available yet.</p>";
            }
            ?>

            <div class="form-container animate-on-scroll">
                <h2 class="text-center mb-4 w-100" id='titlereviewform'>Review a Course</h2>
                <form class='form' action='oscord_savereview.php' method='post'>
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Select Your Name</label>
                        <select class="form-select" id="student_name" name="student_name" required>
                            <option value="">Select</option>
                            <?php
                            if ($result_students && $result_students->num_rows > 0) {
                                while ($row_student = $result_students->fetch_assoc()) {
                                    echo "<option value='".htmlspecialchars($row_student['studentID'])."'>".htmlspecialchars($row_student['studentName'])."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseID" class="form-label">Select Course</label>
                        <select class="form-select" id="courseID" name="courseID" required>
                            <option value="">Select</option>
                            <?php
                            if ($result_courses && $result_courses->num_rows > 0) {
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
                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <footer id="homeConclusion" class='w-100'>
        <div class="container">
            <div class="row undermiddle">
                <div class="col-9">
                    <section class="contact-form animate-on-scroll">
                        <h2>Contact Us</h2>
                        <form id="contactForm" method="POST" action="contact.php">
                            <label for="contact_name">Your Name:</label>
                            <input type="text" id="contact_name" name="name" required>

                            <label for="contact_email">Your Email:</label>
                            <input type="email" id="contact_email" name="email" required>

                            <label for="message">Your Message:</label>
                            <textarea id="message" name="content" required></textarea>

                            <button type="submit" class="btn">Send Message</button>
                        </form>
                    </section>
                </div>

                <div class="col">
                    <h4><i class="fas fa-link"></i> Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://www.facebook.com/share/19u16vW5KQ/">Facebook Page</a></li><br>
                        <li><a href="https://t.me/oscord_cs">Telegram</a></li><br>
                        <li><a href="https://t.me/oscord_ProgrammingClass">Telegram Channel</a></li><br>
                        <li><a href="https://drive.google.com/file/d/1obR7QrzHTh7cldw-QFf_P82ijd_VkTDI/view?usp=sharing">Viber</a></li><br>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center bg-dark w-100">
            <p class='text-light' id="last">© Oscord Programming Class All Rights Reserved 2022-2025</p>
        </div>
    </footer>

    <script>
        // Particle.js configuration
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": ["#00f2ff", "#ff00ff", "#ffffff"]
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "size_min": 0.5,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#00f2ff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 100,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });

        // Scroll-triggered animations
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.card, .review-item, .form-container, .contact-form, .stats-item').forEach(el => {
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