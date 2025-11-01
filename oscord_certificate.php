<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a0a;
            /* Dark background for the whole page */
            color: #e6e6e6;
            margin: 0;
            padding: 0;
        }

        /* Certificate Section Styles */
        .certificate-section {
            background-color: #0a0a0a;
            padding: 80px 0;
            color: #ffffff;
        }

        .certificate-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 30px;
            line-height: 1.1;
            color: #ffffff;
        }

        .certificate-content p {
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 40px;
            max-width: 600px;
            color: #e6e6e6;
        }

        /* --- Padding Fix: Increased image size constraints --- */
        .certificate-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 0 !important;
        }

        .certificate-placeholder {
            width: 100%;
            max-width: 650px;
            /* INCREASED MAX-WIDTH to allow the image to fill more of the column */
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 0 2px rgba(191, 0, 255, 0.2);
            background-color: #1c2526;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #BF00FF;
            font-size: 1.5rem;
            text-align: center;
            padding: 0;
            min-height: 400px;
            object-fit: contain;
        }

        /* --- End Padding Fix --- */

        .btn-start-learning {
            background-color: #1a73e8;
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-start-learning:hover {
            background-color: #0d6efd;
            transform: translateY(-3px);
            color: #ffffff;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .certificate-content {
                text-align: center;
                margin-bottom: 50px;
            }

            .certificate-content h1 {
                font-size: 2.8rem;
            }

            .certificate-content p {
                font-size: 1rem;
                max-width: 100%;
                margin-left: auto;
                margin-right: auto;
            }

            .certificate-image-container {
                height: auto;
            }

            .certificate-placeholder {
                min-height: 300px;
                max-width: 80%;
            }
        }

        @media (max-width: 576px) {
            .certificate-content h1 {
                font-size: 2.2rem;
            }

            .certificate-content p {
                font-size: 0.9rem;
            }

            .btn-start-learning {
                padding: 12px 25px;
                font-size: 1rem;
            }

            .certificate-placeholder {
                min-height: 250px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>


    <section class="certificate-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="certificate-content">
                        <h1>Certificate Of Completion</h1>
                        <p>At Oscord Code Academy, we award digital certificates to students who successfully complete all assignments, projects, and exams for each of our courses. Our training focuses on building your programming and software development skills through hands-on assignments, exams, and practical projects, with expert instructors guiding you throughout the entire course.</p>
                        <a href="#" class="btn-start-learning" id="startLearningBtn">Start Learning</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="certificate-image-container">
                        <img src="image/oscord certificate.png" alt="Oscord Code Academy Certificate" class="certificate-placeholder img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startLearningBtn = document.getElementById('startLearningBtn');

            if (startLearningBtn) {
                startLearningBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent default anchor tag behavior

                    // Scroll to the top of the page smoothly
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</body>

</html>