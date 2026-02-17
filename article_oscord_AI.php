<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.ai.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        }

      

        /* Main Content */
        .main {
            background : transparent;
            /* border-radius: 15px; */
            margin-top : 50px;
            padding: 10px;
            margin-left : 50px;
            margin-right : 50px;
            margin-bottom : 50px;
            max-width: 1000px;
            /* box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2); */
            animation: fadeIn 1s ease-out;
        }

        .main h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 40px !important;
        }

        .main h4 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 40px !important;
        }

        .main .content-section {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .main a {
            color: #ff00ff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .main a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .main hr {
            border-color: #555;
            margin: 20px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main {
                padding: 20px;
                margin: 20px;
            }

            .main h3 {
                font-size: 1.8rem;
            }

            .main h4 {
                font-size: 1.3rem;
            }

            .main .content-section {
                font-size: 0.95rem;
            }

            .navbar-custom .nav-link {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            .dropdown-item {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .main h3 {
                font-size: 1.5rem;
            }

            .main h4 {
                font-size: 1.2rem;
            }

            .main .content-section {
                font-size: 0.9rem;
            }
        }

        /* Scroll-triggered animations */
        .animate-on-scroll.animate {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>
<body>


    <?php
        include "nav.php";
    ?>
    
    <div class="container main animate-on-scroll">
        <div><h3>AI engineer တစ်ယောက်ဖြစ်လာဖို့ဘယ်ကနေစလေ့လာရမလဲ</h3></div>
        <div class="content-section">
            Data Science ဆိုတာရောဘာလဲ
            Deep Learning, Machine Learning, Artificial Intelligence ဒါတွေကဘာကွာတာလဲ
            AI ကဘယ်ကစတာလဲ, အနာဂတ်မှာ AI က Human Jobs တွေမှာအစားထိုးသွားမှာလား
            တကယ်ပဲဘာတွေဖြစ်နေပီလဲ, တကယ်ပဲဘာတွေဖြစ်လာနိုင်လဲ
            ဒီမေးခွန်းတွေကို အသေးစိတ်ရှင်းပြပေးသွားပါမယ်
        </div>
        <br><br>
        <div class="content-section">
            <a href="article_oscord_ai1.php">How to be AI engineer? What is AI and DataScience ?</a><br>
            <a href="article_oscord_ai2.php">What is Deep Learning?</a><br>
            <a href="article_oscord_ai3.php">What is Machine Learning?</a><br>
            <a href="article_oscord_ai4.php">AI Revolution</a>
        </div>
    </div>
    
    <script>
        // Scroll-triggered animations
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.main').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>