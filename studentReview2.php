<?php
include 'connectdb.php';

$sql = "SELECT sr.studentreviewID, sr.studentreview, sr.courseID, sr.studentID, sr.isShown, 
               s.studentName, c.courseName
        FROM oscord_studentreview sr
        JOIN oscord_student s ON sr.studentID = s.studentID
        JOIN oscord_course c ON sr.courseID = c.courseID
        WHERE sr.isShown = 1
        ORDER BY sr.studentreviewID DESC";
$result = $conn->query($sql);

$query_students = "SELECT studentID, studentName FROM oscord_student";
$result_students = $conn->query($query_students);

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);

// Query for course dropdown in navigation bar
$query1 = "SELECT courseID, courseName FROM oscord_course";
$result1 = $conn->query($query1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reviews</title>
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
            padding:  0;
        }

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
            margin-bottom : 0px;
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

        .review-section {
        
           
            /* background: transparent; */
            background: linear-gradient(145deg, rgba(0, 242, 255, 0.1), rgba(255, 0, 255, 0.1));
           
            /* box-shadow: 0 0 25px rgba(0, 242, 255, 0.5); */
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
            width: 100%;
            margin-top : 0px;
            padding-top : 0px;
        
        }
        

        .review-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            padding-top : 40px;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            animation: neonPulse 2s infinite;
        }

        .carousel-inner {
            padding: 20px 0;
            transition: transform 0.5s ease-in-out; /* Smoother slide transitions */
        }

        .carousel-item {
            text-align: center;
        }

        .review-item {
            /* background: linear-gradient(145deg, rgba(0, 242, 255, 0.1), rgba(255, 0, 255, 0.1)); */
            /* border: 2px solid #00f2ff; */
            background : transparent;
            border-radius: 15px;
            padding: 25px;
            margin: 0 auto;
            transition: all 0.3s ease;
            /* box-shadow: 0 0 15px rgba(0, 242, 255, 0.3); */
            animation: fadeIn 1s ease-out;
            max-width: 800px;
         
            height : 500px;
        }

        .review-item:hover {
            transform: translateY(-5px);
            /* box-shadow: 0 0 25px rgba(0, 242, 255, 0.6); */
            border-color: #ff00ff;
        }

        .review-item h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: #ffffff;
    
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .review-item p {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 10px;
            text-align: left;
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;

        }

        .review-item p::-webkit-scrollbar {
            width: 6px;
        }

        .review-item p::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .review-item p::-webkit-scrollbar-thumb {
            background: #00f2ff;
            border-radius: 10px;
        }

        .review-item p::-webkit-scrollbar-thumb:hover {
            background: #ff00ff;
        }

        .review-item i {
            font-size: 1.2rem;
            color: #00f2ff;
            margin-right: 8px;
            vertical-align: middle;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            background: transparent;
            transition: opacity 0.3s ease;
            opacity: 0.7;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #00f2ff;
            border-radius: 50%;
            padding: 15px;
            width: 40px;
            height: 40px;
            background-size: 60%;
        }

        .carousel-indicators {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .carousel-indicators button {
            background-color: #00f2ff !important;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 6px;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .carousel-indicators button:hover {
            opacity: 0.8;
            transform: scale(1.2);
        }

        .carousel-indicators .active {
            opacity: 1;
            transform: scale(1.4);
        }

        .form-container {
            background: transparent;
            padding: 30px;
            border-radius: 15px;
            margin: 30px auto;
            width: 100%;
            max-width: 800px;
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
            text-align: center;
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
            width: 100%;
            margin-top: 30px;
        }

        .form-container .btn:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .error-message {
            text-align: center;
            color: #ff00ff;
            font-size: 1.2rem;
            margin: 20px 0;
        }

        @media (max-width: 820px) {
            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .dropdown-item {
                font-size: 0.8rem;
            }

            .review-section {
                padding: 30px 15px;
                margin: 40px auto;
            }

            .review-section h2 {
                font-size: 2.2rem;
            }

            .review-item {
                max-width: 90%;
            }

            .review-item h3 {
                font-size: 1.4rem;
            }

            .review-item p {
                font-size: 0.95rem;
            }

            .form-container h2 {
                font-size: 1.6rem;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                padding: 12px;
                width: 35px;
                height: 35px;
            }

            .carousel-indicators button {
                width: 10px;
                height: 10px;
                margin: 0 5px;
            }
        }

        @media (max-width: 576px) {
            .navbar-custom .nav-link {
                font-size: 0.8rem;
                padding: 6px 10px;
            }

            .dropdown-item {
                font-size: 0.7rem;
            }

            .review-section {
                padding: 20px 10px;
                margin: 30px auto;
            }

            .review-section h2 {
                font-size: 1.8rem;
            }

            .review-item {
                padding: 15px;
                max-width: 95%;
            }

            .review-item h3 {
                font-size: 1.2rem;
            }

            .review-item p {
                font-size: 0.9rem;
            }

            .form-container {
                padding: 20px;
                max-width: 95%;
            }

            .form-container h2 {
                font-size: 1.4rem;
            }

            .form-select, .form-control {
                font-size: 0.9rem;
            }

            .form-container .btn {
                padding: 10px;
                font-size: 0.9rem;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                padding: 10px;
                width: 30px;
                height: 30px;
            }

            .carousel-indicators button {
                width: 8px;
                height: 8px;
                margin: 0 4px;
            }
        }

        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
    <ul class="nav nav-pills navbar-custom">
        <li class="nav-item">
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
        
        <li class='nav-item ms-auto'>
            <a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
        </li>
    </ul>
    
    <div class="review-section">
        <h2>Student Reviews</h2>
        <?php 
        // Diagnostic: Check number of reviews fetched
        $num_reviews = $result ? $result->num_rows : 0;
        if (!$result) { ?>
            <p class="error-message">Error: <?php echo htmlspecialchars($conn->error); ?></p>
        <?php } elseif ($num_reviews > 0) { ?>
            <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    $result->data_seek(0);
                    for ($i = 0; $i < $num_reviews; $i++) {
                        echo '<button type="button" data-bs-target="#reviewCarousel" data-bs-slide-to="' . $i . '"';
                        if ($i === 0) echo ' class="active" aria-current="true"';
                        echo ' aria-label="Slide ' . ($i + 1) . '"></button>';
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    $result->data_seek(0);
                    $is_first = true;
                    while ($row = $result->fetch_assoc()) {
                        $student_name = htmlspecialchars($row['studentName']);
                        $course_name = htmlspecialchars($row['courseName']);
                        $review_text = htmlspecialchars($row['studentreview']);
                        ?>
                        <div class="carousel-item <?php if ($is_first) { echo 'active'; $is_first = false; } ?>">
                            <div class="review-item animate-on-scroll">
                                <h3><i class="fas fa-user-graduate"></i> <?php echo $student_name; ?></h3>
                                <p><?php echo nl2br($review_text); ?></p>
                           
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php } else { ?>
            <p class="error-message">No reviews available yet. (Found <?php echo $num_reviews; ?> reviews.)</p>
        <?php } ?>

        <div class="form-container animate-on-scroll">
            <h2>Review a Course</h2>
            <form class="form" action="oscord_savereview.php" method="post">
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
                <button type="submit" class="btn">Submit</button>
            </form>
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

            document.querySelectorAll('.review-item, .form-container').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });

            // Initialize Bootstrap carousel
            const carousel = document.querySelector('#reviewCarousel');
            if (carousel) {
                new bootstrap.Carousel(carousel, {
                    interval: 5000, // 5 seconds per slide
                    wrap: true, // Loop back to first slide
                    pause: 'hover' // Pause on hover
                });
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>