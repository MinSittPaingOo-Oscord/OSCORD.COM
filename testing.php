<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        /* ==============================
           STRONG GLASS-NEON NAVBAR
        ============================== */
        .navbar-custom {
            background: rgba(10, 10, 10, 0.6);
            backdrop-filter: blur(25px) saturate(200%);
            -webkit-backdrop-filter: blur(25px) saturate(200%);
            border: 2px solid rgba(0, 242, 255, 0.35);
            border-radius: 18px;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.3),
                        inset 0 0 15px rgba(0, 242, 255, 0.1);
            animation: slideIn 0.5s ease-out;
        }

        .nav-link {
            color: #e8ffff !important;
            font-family: 'Calibri', sans-serif;
            font-weight: 400;
            font-size: 1.05rem;
            position: relative;
            letter-spacing: 0.5px;
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
            text-shadow: 0 0 10px #00f2ff, 0 0 25px #00f2ff;
        }

        .nav-link.active {
            color: #00f2ff !important;
            text-shadow: 0 0 12px #00f2ff, 0 0 25px #00f2ff;
        }

        /* Removed animated title style (previously targeted first nav-item) */

        /* Dropdown Glass Style */
        .dropdown-menu {
            background: rgba(20, 25, 25, 0.85);
            backdrop-filter: blur(15px) saturate(180%);
            -webkit-backdrop-filter: blur(15px) saturate(180%);
            border: 1px solid rgba(0, 242, 255, 0.25);
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 242, 255, 0.35);
            animation: fadeIn 0.3s ease-out;
        }

        .dropdown-item {
            color: #e6e6e6;
            font-size: 1rem;
            font-family : "Times New Roman", sans-serif;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(0, 242, 255, 0.95);
            color: #0a0a0a;
            transform: translateX(6px);
            border-radius: 6px;
            text-shadow: none;
        }

        @media (max-width: 576px) {
            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }
            .dropdown-item {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
</body>
</html>

<?php
    include "connectdb.php";
    $query1 = "SELECT courseID, courseName FROM oscord_course LIMIT 100";
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $stmt1->close();
?>
<div class='upper'>
    <ul class="nav nav-pills navbar-custom">
        <li class="nav-item">
            <a class="nav-link" href="oscord_home.php">OSCORD Code Academy</a>
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
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Blogs</a>
            <ul class="dropdown-menu">
                <li><a class='dropdown-item' href="oscord_startLearningProgramming.php">How to start learning programming ?</a></li>
                <li><a class='dropdown-item' href="oscord_webDevelopment.php">How to study to become a full stack web developer ?</a></li>
                <li><a class='dropdown-item' href="oscord_database.php">What is Database & What should we study in DataBase?</a></li>
                <li><a class='dropdown-item' href="oscord_AI.php">How to be AI Engineer & What are Data Science, Machine Learning and Deep Learning</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Setting</a>
            <ul class="dropdown-menu">
                <li><a class='dropdown-item' href="oscord_instructorControlLogin.php">Instructor</a></li>
                <li><a class='dropdown-item' href="oscord_studentControlLogin.php">Student</a></li>
            </ul>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='oscord_signUpPage.php'>Sign Up</a>
        </li>
    </ul>
</div>
