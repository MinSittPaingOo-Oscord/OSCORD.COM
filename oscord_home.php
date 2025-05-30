<?php
include "connectdb.php";

$query1 = "SELECT courseID,courseName FROM oscord_course";
$result1 = $conn->query($query1);

$query2 = "SELECT * FROM oscord_course";
$result2 = $conn->query($query2);

$query_reviews = "SELECT sr.*, s.studentName FROM oscord_studentreview sr JOIN oscord_student s ON sr.studentID = s.studentID";
$result_reviews = $conn->query($query_reviews);

$query_students = "SELECT studentID, studentName FROM oscord_student";
$result_students = $conn->query($query_students);

$query_courses = "SELECT courseID, courseName FROM oscord_course";
$result_courses = $conn->query($query_courses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            color: #333;
            scroll-behavior: smooth;
        }

        .navbar-custom {
            background: rgba(0, 0, 0, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease;
        }

        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 10px 20px;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #00ddeb !important;
        }

        .dropdown-menu {
            background: rgba(0, 0, 0, 0.95);
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item {
            color: #fff;
            font-weight: 400;
            padding: 10px 20px;
            transition: background 0.3s ease, color 0.3s ease;
            font-size: 0.9rem;
        }

        .dropdown-item:hover {
            background: #00ddeb;
            color: #000 !important;
        }

        /* Welcome Section */
        .welcome-container {
            background: url('./back2.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .welcome-container .middle {
            position: relative;
            z-index: 2;
        }

        .welcome-container h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .welcome-container p {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto 30px;
            color: #fff;
        }

        .circularImage {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .circularImage:hover {
            transform: scale(1.05);
        }

        #titleCourse {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin: 50px 0 30px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin: 15px auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #333;
            height: 1000px;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            /* Removed flexbox */
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
        }

        #courseDescription {
            font-size: 1rem;
            line-height: 1.4;
            margin-bottom: 30px;
        }

        .card-text {
            margin-bottom: 0;
            line-height: 1.4;
        }

        .card-text .detail-item {
            margin-bottom: 10px;
        }

        .card-text .detail-item:last-child {
            margin-bottom: 20px;
        }

        .btn-course-detail {
            background: transparent;
            border: 2px solid #00ddeb;
            color: #00ddeb;
            padding: 5px 15px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            display: block;
            text-align: left;
        }

        .btn-course-detail:hover {
            background: #00ddeb;
            color: #000;
            border-color: #00ddeb;
        }

        .fb-link {
            color: #00ddeb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .fb-link:hover {
            color: #008b97;
        }

        /* Collapsible Course Details */
        .course-details-content {
            background: #fff;
            border-radius: 8px;
            padding: 5px;
            margin-bottom: 30px;
            max-height: 200px;
            overflow-y: auto;
        }

        .course-details-content .course-detail-item {
            color: #000;
            font-weight: 400;
            padding: 2px 5px;
            font-size: 0.9rem;
            line-height: 1.2;
            background: #fff;
            border-radius: 4px;
            margin-bottom: 2px;
        }

        .course-details-content .course-detail-item:hover {
            background: #00ddeb;
            color: #000;
        }

        .review-section {
            margin: 60px 0;
            padding: 40px 0;
        }

        .review-section h2 {
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .review-item h1 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .review-item p {
            font-size: 1rem;
            line-height: 40px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin: 30px auto;
            /* max-width: 600px;
             */
             width : 100%;
        }

        .form-container h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .form-select, .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
        }

        .form-container .btn {
            background: #00ddeb;
            border: none;
            padding: 12px;
            border-radius: 25px;
            font-weight: 500;
            color: #000;
            transition: background 0.3s ease;
        }

        .form-container .btn:hover {
            background: #008b97;
        }

        .contact-form {
            max-width: 900px;
            padding: 50px;
            margin-right : 150px;
            margin-bottom : 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .contact-form h2 {
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .contact-form label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 1rem;
            background: #fff;
        }

        .contact-form .btn {
            background: #00ddeb;
            border: none;
            padding: 12px;
            border-radius: 25px;
            font-weight: 500;
            color: #000;
            width: 100%;
            transition: background 0.3s ease;
        }

        .contact-form .btn:hover {
            background: #008b97;
        }

        /* Footer */
        #homeConclusion {
            background: #000;
            padding: 40px 0;
            color: #fff;
        }

        #homeConclusion h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        #homeConclusion p, #homeConclusion a {
            font-size: 1rem;
            color: #ccc;
            transition: color 0.3s ease;
        }

        #homeConclusion a:hover {
            color: #00ddeb;
        }

        #last {
            background: #111;
            padding: 20px 0;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .welcome-container {
                min-height: 80vh;
                padding: 30px 15px;
            }

            .welcome-container h2 {
                font-size: 2rem;
            }

            .welcome-container p {
                font-size: 1rem;
            }

            .circularImage {
                width: 200px;
                height: 200px;
            }

            .middle {
                flex-direction: column;
                text-align: center;
            }

            .middle .col {
                margin-bottom: 20px;
            }

            .card {
                max-width: 100%;
                height: auto;
            }

            .btn-course-detail {
                width: 100%;
            }

            #titleCourse {
                font-size: 2rem;
            }

            .review-section h2 {
                font-size: 1.8rem;
            }

            .contact-form {
                padding: 20px;
                width : 270px;
                margin-left : 20px;
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

            .card-title {
                font-size: 1.5rem;
            }

            .form-container h2 {
                font-size: 1.5rem;
            }

            .card {
                height: auto;
            }

            .course-detail-item {
                font-size: 0.8rem;
            }
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
                            echo "<li><button class='dropdown-item' type='submit' name='courseID' value='".$row['courseID']."'>".$row['courseName']."</button></li>";
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
        
        <?php
            echo "<li class='nav-item ms-auto'>
                    <a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
                </li>";
        ?>
    </ul>
        
    <div class="welcome-container">
        <div class='container middle row'>
            <div class='col' id="wel">
                <h2>Welcome to Oscord</h2>
                <br>
                <p>Study programming basic to software development level at OSCORD. 
                Online students can join both by one VIP class and group class(if available).
                For all by one classes, students can negotiate the class schedule.
                The video records and lecture files are usually sent in the private telegram channel daily right after the class.</p> 
            </div>
            <div class='col'>
                <img src='./OSCORD.jpg' class='circularImage'>
            </div>
        </div>
    </div>   
        
    <div class="container">
        <h1 id="titleCourse">Courses from OSCORD</h1>
        <div class="row">
            <?php
            while ($row2 = $result2->fetch_assoc()) {
                echo "<div class='col-md-6 col-lg-4'>";
                echo "<form method='post' action='oscord_specificCoursePage.php'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . htmlspecialchars($row2['courseName']) . "</h5>
                            <div id='courseDescription'>" . htmlspecialchars($row2['courseDescription']) . "</div>
                            <div class='card-text'>
                                <div class='detail-item'><b>Course Fee</b>: " . htmlspecialchars($row2['courseFee']) . "</div>
                                <div class='detail-item'><b>Course Period</b>: " . htmlspecialchars($row2['coursePeriod']) . "</div>";
                if (!empty($row2['courseFbLink'])) {
                    echo "<div class='detail-item'><a class='fb-link' href='" . htmlspecialchars($row2['courseFbLink']) . "' target='_blank'>View on Facebook</a></div>";
                }
                echo "            </div>
                            <button class='btn btn-course-detail' type='button' data-bs-toggle='collapse' data-bs-target='#courseDetails" . $row2['courseID'] . "' aria-expanded='false' aria-controls='courseDetails" . $row2['courseID'] . "'>
                                Course Details
                            </button>
                            <div class='collapse course-details-content' id='courseDetails" . $row2['courseID'] . "'>";
                                
                                $courseID = $row2['courseID'];
                                $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ?";
                                $stmt3 = $conn->prepare($query3);
                                $stmt3->bind_param("i", $courseID);
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();

                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "<div class='course-detail-item'>" . htmlspecialchars($row3['coursedetailName']) . "</div>";
                                }

                echo "        </div>
                            <button class='btn btn-course-detail' type='submit' name='courseID' value='".$row2['courseID']."'>Start Learning</button>
                        </div>
                    </div>
                </form>";
                echo "</div>"; 
            }
            ?>
        </div>

        <!-- Student Review Session -->
        <div class="review-section">
            <h2>Student Reviews</h2>
            <?php
            if ($result_reviews && $result_reviews->num_rows > 0) {
                while ($row_review = $result_reviews->fetch_assoc()) {
                    echo "<div class='review-item'>";
                    echo "<h1 id='student_name'>Student Name - " . htmlspecialchars($row_review['studentName']) . "</h1>";
                    echo "<p id='review'>" . htmlspecialchars($row_review['studentreview']) . "</p>";
                    echo "<hr>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available yet.</p>";
            }
            ?>

            <div class="form-container">
                <h2 class="text-center mb-4 w-100" id='titlereviewform'>Review a Course</h2>
                <form class='form' action='oscord_savereview.php' method='post'>
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Select Your Name</label>
                        <select class="form-select" id="student_name" name="student_name" required>
                            <option value="">Select</option>
                            <?php
                            if ($result_students && $result_students->num_rows > 0) {
                                while ($row_student = $result_students->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row_student['studentID']) . "'>" . htmlspecialchars($row_student['studentName']) . "</option>";
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
                                    echo "<option value='" . htmlspecialchars($row_course['courseID']) . "'>" . htmlspecialchars($row_course['courseName']) . "</option>";
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
                    <section class="contact-form">
                        <h2>Contact Us</h2>
                        <form id="contactForm" method="POST" action="contact.php">
                            <label for="contact_name">Your Name:</label>
                            <input type="text" id="contact_name" name="name" required>

                            <label for="contact_email">Your Email:</label>
                            <input type="email" id="contact_email" name="email" required>

                            <label for="message">Your Message:</label>
                            <textarea id="message" name="message" required></textarea>

                            <button type="submit" class="btn">Send Message</button>
                        </form>
                    </section>
                </div>

                <div class="col">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://www.facebook.com/share/19u16vW5KQ/">Facebook Page</a></li><br>
                        <li><a href="https://t.me/oscord_cs">Telegram Acc</a></li><br>
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

    <?php $conn->close(); ?>
</body>
</html>