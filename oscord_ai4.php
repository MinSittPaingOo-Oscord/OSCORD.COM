<?php
    include "connectdb.php";

    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    if (isset($_POST['courseID'])) {
        $id = $_POST['courseID'];
    }
?>
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes neonGlow {
            0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
            50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        .navbar-custom {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 25px;
            box-shadow: 0 4px 12px rgba(0, 242, 255, 0.15);
            animation: slideIn 0.5s ease-out;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-custom .nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
        }

        .nav-item {
            flex: 1;
            text-align: center;
        }

        .nav-item.ms-auto {
            flex: 0 1 auto;
        }

        .nav-link {
            color: #e6e6e6 !important;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 10px 20px;
            position: relative;
            transition: all 0.3s ease;
            display: block;
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

        .main {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 15px;
            padding: 40px;
            margin: 30px auto;
            max-width: 900px;
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
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

            .navbar-custom .nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-item {
                text-align: left;
                width: 100%;
            }

            .nav-item.ms-auto {
                text-align: left;
                width: 100%;
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
        
        <?php
            echo "<li class='nav-item ms-auto'>
                    <a class='nav-link' aria-current='page' href='oscord_signUpPage.php'>Sign Up</a>
                </li>";
        ?>
    </ul>
    
    <div class="container main animate-on-scroll">
        <div><h4>AI Revolution</h4></div>
        <div class="content-section">
            AI ကအနာဂတ်မှာ Developer တွေကိုအစားထိုးသွားမှာလား
            အခြားလုပ်ငန်းတွေကိုမှာရော Worker တွေအပေါ်မှာအစားထိုးသွားမှာလား
            အခုဆိုရင် AI ရဲ့လုပ်နိုင်စွမ်းနဲ့ တိုးတက်လာမှုတွေကို အားလုံးမျက်မြင်ကိုယ်တွေ့တွေ့ခဲ့ပြီးဖြစ်တယ်
            ဒီအတွက်လဲ စိုးရိမ်စရာတွေဖြစ်နေကြတယ်ပေါ့
            AI ကတကယ်ပဲ လူတွေကိုလွှမ်းမိုးသွားမှာလား
            လူတွေရဲ့အကူအညီတွေလုံးဝမလိုအပ်ဘဲနဲ့ ရှင်သန်ကြတော့မှာလားဆိုတော့
            မဟုတ်သေးပါဘူးလို့ပဲပြောရမှာဖြစ်ပါတယ်
            AI ကဘယ်လောက်ပဲလုပ်နိုင်လုပ်နိုင် လူလိုချင်တာကိုမသိတာဖြစ်တဲ့အတွက်
            နောက်ပြီးလူ့ခံစားချက်အတိုင်းလိုက်မခံစားနိုင်တဲ့အတွက် အဓိကက AI ကအခုထိ
            လူကသာ Train ပေးနေရတာဖြစ်တဲ့အတွက် AI ကသူ့ဘာသူ Train ပြီး
            လူတွေနေရာမှာအစားထိုးဖို့ကိုတော့ Century တစ်ခုလောက်ထိ စိတ်ချလို့ရတယ်ဆိုတာကိုပြောနိုင်ပါတယ်
            AI ကအခုချိန်မှာတော့လူသားတွေလုပ်ဆောင်နေတဲ့ Task တွေကို ပိုပြီးလွယ်ကူမြန်ဆန်ကောင်းမွန်အောင်
            ကူညီပေးတဲ့နေရာမှာအများကြီးအထောက်အကူဖြစ်လာပြီပဲဖြစ်ပါတယ်
            သို့ပေမယ့် AI ကလုပ်ပေးနိုင်တဲ့အလုပ်တွေကို ကိုယ်က General ထက်ပိုပြီးတတ်ကျွမ်းထားနိုင်ဖို့လိုအပ်ပါတယ်
            ဥပမာ Developer တွေဆိုရင် အရင်ကထက် အနည်းငယ်တော့ Challenging ဖြစ်လာပါတယ်
            ဘာလို့လဲဆိုတော့ Level တစ်ခုထိလုပ်နိုင်စွမ်းရှိနေတာဖြစ်တဲ့အတွက်ကိုယ်က
            General Level ထက်ပိုပြီးသာလွန်နေဖို့တော့လိုအပ်ပါလိမ့်မယ်
            ဒါဆိုရင်တော့ Artificial Intelligence, Data Science, Machine Learning, Deep Learning
            ဒါတွေကိုနားလည်သဘောပေါက်လောက်ပြီလို့ထင်ပါတယ်
        </div>
        <div class="content-section">
            <div class='row'>
                <div class='col'><a href='oscord_ai3.php'>Back</a></div>
            </div>
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