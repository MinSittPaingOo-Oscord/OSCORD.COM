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
            padding: 20px 0;
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

        @media (max-width: 768px) {
            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .dropdown-item {
                font-size: 0.8rem;
            }
        }

        .review-section {
            margin: 60px auto;
            padding: 40px 20px;
            background: transparent;
            border-radius: 15px;
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 1;
            width: 90%;
            max-width: 1200px;
            height: auto;
            overflow: hidden;
        }

        .review-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: #00f2ff;
            text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff;
            animation: neonPulse 2s infinite;
        }

        .review-container {
            display: flex;
            flex-wrap: nowrap;
            will-change: transform;
            padding: 20px 0;
        }

        .review-item {
            background: transparent;
            border: 2px solid #00f2ff;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            animation: fadeIn 1s ease-out;
            width: 800px;
            margin-right: 20px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            flex-shrink: 0;
            line-height: 40px;
            text-align: left;
        }

        .review-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.6);
        }

        .review-item::before {
            content: '';
            font-size: 2.5rem;
            color: #00f2ff;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .review-item::after {
            content: '';
            font-size: 2.5rem;
            color: #00f2ff;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .review-item h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #00f2ff;
        }

        .review-item p {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 10px;
            flex-grow: 1;
            overflow-x: auto;
            overflow-y: auto;
            padding-right: 10px;
        }

        .review-item p::-webkit-scrollbar {
            width: 8px;
        }

        .review-item p::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .review-item p::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f2ff, #ff00ff);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        .review-item p::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #ff00ff, #00f2ff);
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
        }

        .review-item p {
            scrollbar-width: thin;
            scrollbar-color: #00f2ff rgba(0, 0, 0, 0.5);
        }

        .form-container {
            background: transparent;
            padding: 0px;
            border-radius: 15px;
            margin: 30px auto;
            width: 100%;
            max-width: 100%;
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
            .review-section {
                padding: 30px 15px;
                margin: 40px 0;
                height: auto;
            }

            .review-section h2 {
                font-size: 2.2rem;
            }

            .review-item {
                width: 350px;
            }

            .review-item h3 {
                font-size: 1.1rem;
            }

            .review-item p {
                font-size: 0.95rem;
            }

            .form-container h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .review-section {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 22px;
            }

            .review-section h2 {
                font-size: 1.8rem;
            }

            .review-item {
                width: 280px;
                padding: 15px;
            }

            .review-item h3 {
                font-size: 1rem;
            }

            .review-item p {
                font-size: 0.9rem;
            }

            .form-container {
                padding: 20px;
                max-width: 100%;
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
        }

        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
    <?php 

            include "nav.php";
    ?>
    
    <div class="review-section">
        <h2>Student Reviews</h2>
        <?php 
        // Diagnostic: Check number of reviews fetched
        $num_reviews = $result ? $result->num_rows : 0;
        if (!$result) { ?>
            <p class="error-message">Error: <?php echo htmlspecialchars($conn->error); ?></p>
        <?php } elseif ($num_reviews > 0) { ?>
         
            <div class="review-container">
                <?php
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
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

            // Student Reviews dynamic infinite scrolling
            const reviewContainer = document.querySelector('.review-container');
            if (reviewContainer && reviewContainer.querySelectorAll('.review-item').length > 0) {
                const reviewItems = reviewContainer.querySelectorAll('.review-item');
                const originalWidth = Array.from(reviewItems).reduce((sum, item) => sum + item.offsetWidth + 20, 0);
                console.log(`Original reviews: ${reviewItems.length}, Total width: ${originalWidth}px`);

                // Clone items dynamically to fill at least 3x viewport width for seamless looping
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

                // Animation variables
                let scrollPosition = 0;
                const scrollSpeed = 1; // Pixels per frame (adjust for speed)
                let isPaused = false;
                let animationFrameId;

                // Animation loop
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
    </script>
</body>
</html>