<?php
    include "connectdb.php";
    $query_students = "SELECT studentID, studentName FROM oscord_student";
    $result_students = $conn->query($query_students);
    
    $sql_reviews = "SELECT sr.studentreviewID, sr.studentreview, sr.courseID, sr.studentID, sr.isShown, 
                   s.studentName, c.courseName
            FROM oscord_studentreview sr
            JOIN oscord_student s ON sr.studentID = s.studentID
            JOIN oscord_course c ON sr.courseID = c.courseID
            WHERE sr.isShown = 1
            ORDER BY sr.studentreviewID DESC"; 
    $result_reviews_section = $conn->query($sql_reviews);
    
    $query_students_reviews = "SELECT studentID, studentName FROM oscord_student";
    $result_students_reviews = $conn->query($query_students_reviews);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <style>
            #studentReview {
            font-family: 'Inter', sans-serif;
        }

        @keyframes studentReviewFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes studentReviewNeonGlow {
            0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
            50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
        }

        @keyframes studentReviewNeonPulse {
            0%, 100% { text-shadow: 0 0 5px #00f2ff, 0 0 10px #00f2ff, 0 0 15px #00f2ff; }
            50% { text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff; }
        }

        #studentReview .review-section {
            margin: 50px auto;
            padding: 30px 10px;
            background: transparent;
            border-radius: 15px;
            animation: studentReviewFadeIn 1s ease-out;
            position: relative;
            z-index: 1;
            width: 70%;
            max-width: 800px;
            height: auto;
            overflow: hidden;
        }

        #studentReview .review-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 30px;
            color: #00f2ff;
            text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff;
            animation: studentReviewNeonPulse 2s infinite;
        }

        #studentReview .review-container {
            display: flex;
            flex-wrap: nowrap;
            will-change: transform;
            padding: 20px 0;
        }

        #studentReview .review-item {
            background: transparent;
            border: 2px solid #00f2ff;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            animation: studentReviewFadeIn 1s ease-out;
            width: 700px;
            margin-right: 20px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            flex-shrink: 0;
            line-height: 30px;
            text-align: left;
        }

        #studentReview .review-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.6);
        }

        #studentReview .review-item::before {
            content: '';
            font-size: 2rem;
            color: #00f2ff;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        #studentReview .review-item::after {
            content: '';
            font-size: 2rem;
            color: #00f2ff;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        #studentReview .review-item h3 {
            font-family: 'Calibri', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #00f2ff;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #00f2ff;
        }

        #studentReview .review-item p {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 10px;
            flex-grow: 1;
            overflow-x: auto;
            overflow-y: auto;
            padding-right: 10px;
        }

        #studentReview .review-item p::-webkit-scrollbar {
            width: 8px;
        }

        #studentReview .review-item p::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        #studentReview .review-item p::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f2ff, #ff00ff);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        #studentReview .review-item p::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #ff00ff, #00f2ff);
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
        }

        #studentReview .review-item p {
            scrollbar-width: thin;
            scrollbar-color: #00f2ff rgba(0, 0, 0, 0.5);
        }

        #studentReview .form-container {
            background: transparent;
            padding: 0px;
            border-radius: 15px;
            margin: 30px auto;
            width: 90%;
            max-width: 90%;
            animation: studentReviewFadeIn 1s ease-out;
            position: relative;
            z-index: 1;
        }

        #studentReview .form-container h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            text-align: center;
        }

        #studentReview .form-select,
        #studentReview .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        #studentReview .form-select:focus,
        #studentReview .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        #studentReview .form-container .btn {
            background: #ff00ff;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 400;
            color: #ffffff;
            transition: all 0.3s ease;
            animation: studentReviewNeonGlow 2s infinite;
            width: 100%;
            margin-top: 30px;
        }

        #studentReview .form-container .btn:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        #studentReview .error-message {
            text-align: center;
            color: #ff00ff;
            font-size: 1.2rem;
            margin: 20px 0;
        }

        #niiki{
              text-decoration : none;
        }

        @media (max-width: 820px) {
        
          

            #studentReview {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 55px;
            }

            #studentReview .review-section {
                padding: 30px 15px;
                margin: 40px 0;
                height: auto;
            }

            #studentReview .review-section h2 {
                font-size: 2.2rem;
            }

            #studentReview .review-item {
                width: 350px;
            }

            #studentReview .review-item h3 {
                font-size: 1.1rem;
            }

            #studentReview .review-item p {
                font-size: 0.95rem;
            }

            #studentReview .form-container h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            #studentReview {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 10px;
                margin-right: 20px;
            }
         
            .form-container h2 {
                font-size: 1.4rem;
            }

            #studentReview .review-section {
                padding: 20px 10px;
                margin: 30px 0;
                height: auto;
                margin-left: 22px;
            }

            #studentReview .review-section h2 {
                font-size: 1.8rem;
            }

            #studentReview .review-item {
                width: 280px;
                padding: 15px;
            }

            #studentReview .review-item h3 {
                font-size: 1rem;
            }

            #studentReview .review-item p {
                font-size: 0.9rem;
            }

            #studentReview .form-container {
                padding: 20px;
                max-width: 100%;
            }

            #studentReview .form-container h2 {
                font-size: 1.4rem;
            }

            #studentReview .form-select,
            #studentReview .form-control {
                font-size: 0.9rem;
            }

            #studentReview .form-container .btn {
                padding: 10px;
                font-size: 0.9rem;
            }
        }

        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }

        #studentReview .animate-on-scroll.animate {
            animation: studentReviewFadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
<div id="studentReview">
        <div class="review-section">
         <h2>Student Reviews</h2>
            <?php 
            // Diagnostic: Check number of reviews fetched
            $num_reviews = $result_reviews_section ? $result_reviews_section->num_rows : 0;
            if (!$result_reviews_section) { ?>
                <p class="error-message">Error: <?php echo htmlspecialchars($conn->error); ?></p>
            <?php } elseif ($num_reviews > 0) { ?>
          
                <div class="review-container">
                    <?php
                    $result_reviews_section->data_seek(0);
                    while ($row = $result_reviews_section->fetch_assoc()) {
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

            <!-- <div class="form-container animate-on-scroll">
                <h2>Review a Course</h2>
                <form class="form" action="oscord_savereview.php" method="post">
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Select Your Name</label>
                        <select class="form-select" id="student_name" name="student_name" required>
                            <option value="">Select</option>
                            //<?php
                           // if ($result_students_reviews && $result_students_reviews->num_rows > 0) {
                                // while ($row_student = $result_students_reviews->fetch_assoc()) {
                                   // echo "<option value='".htmlspecialchars($row_student['studentID'])."'>".htmlspecialchars($row_student['studentName'])."</option>";
                                //}
                            //}
                           // ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseID" class="form-label">Select Course</label>
                        <select class="form-select" id="courseID" name="courseID" required>
                            <option value="">Select</option>
                            <?php
                            if ($result_courses && $result_courses->num_rows > 0) {
                                $result_courses->data_seek(0);
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
            </div> -->
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

            document.querySelectorAll('.card, #studentReview .review-item, #studentReview .form-container, .contact-form, .stats-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });

            const reviewContainer = document.querySelector('#studentReview .review-container');
            if (reviewContainer && reviewContainer.querySelectorAll('.review-item').length > 0) {
                const reviewItems = reviewContainer.querySelectorAll('.review-item');
                const originalWidth = Array.from(reviewItems).reduce((sum, item) => sum + item.offsetWidth + 20, 0);
                console.log(`Original reviews: ${reviewItems.length}, Total width: ${originalWidth}px`);

           
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

                let scrollPosition = 0;
                const scrollSpeed = 1.5; // Pixels per frame (adjust for speed)
                let isPaused = false;
                let animationFrameId;

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