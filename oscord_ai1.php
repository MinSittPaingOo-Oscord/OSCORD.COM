<?php
    include "connectdb.php";

    #selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    if( isset($_POST['courseID'])){
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
        <div><h3>How to be an AI engineer? What is AI?</h3></div>
        <div class="content-section">
            AI(Artificial Intelligence) ဆိုတာကတော့အားလုံးသိတဲ့အတိုင်း စက်ကိုလူသားရဲ့အကူအညီမပါဘဲနဲ့ ကိုယ်တိုင် ဆုံးဖြတ်နိုင်စွမ်းရှိတဲ့ လူလုပ်အသိဉာဏ်တစ်ခုလိုပြောလိုရပါတယ်
            ဘယ်ကနေစပြီးလေ့လာရမလဲ
            - Mathematics(Linear Algebra, Probability, Calculus)
            - Statistics (စာရင်းအင်းပညာ)
            - Programming (Mostly Python)
            - Machine Learning
            ဒါတွေကနေစပြီးလေ့လာဖိုလိုအပ်ပါတယ်
            အဲဒီထဲမှာမှ Mathematics & Statistics ဟာဆိုရင် Data Science ဘက်မှာအဓိကအသုံးချပါတယ်
            Programming ကတော့ Physically AI Traning လုပ်တဲ့နေရာမှာ အများအားဖြင့် Python ကိုအသုံးပြုတာဖြစ်တဲ့အတွက် လေ့လာဖိုလိုတာဖြစ်ပါတယ်
            AI engineer တစ်ဦးဖြစ်လာဖိုဆိုရင် Data Scientist + Software Engineer = AI Enginner ဆိုတာကိုလဲနားလည်ဖိုလိုပါတယ်
        </div>
        <hr>
        <div><h4>So What Is Data Science?</h4></div>
        <div class="content-section">
            Data Science နဲ့ပတ်သက်ပြီးအရင်ရှင်းပြပါမယ်
            အားလုံးမြင်တွေ့လှုပ်ရှားသွားလာနေတဲ့ လူ့အဖွဲအစည်းထဲမှာ လူတစ်ဦးတစ်ယောက်ချင်းစီ အသက်မွေးလုပ်ကိုင်နေကြတဲ့ လုပ်ငန်းတစ်ခုချင်းစီရှိကြပါတယ်
            ဘယ်လုပ်ငန်းမှာမဆိုသည် လုပ်ငန်းကြီးရင်ကြီးသလောက် သူတိုလုပ်ငန်းစဉ်မှာရှိတဲ့ အချက်အလက် Data တွေကို ကောင်းကောင်းမွန်မွန် Handle လုပ်နိုင်ဖိုလိုအပ်ပါတယ်
            ဥပမာ ဈေးဆိုင်တစ်ခုမှာဆိုရင် ထားရှိတဲ့ကုန်ပစ္စည်းအချက်အလက်တွေ ဈေးနှုန်းတွေ Customer အချက်အလက်တွေ အရူံးအမြတ်စာရင်းတွေ စသဖြင့် Data တွေကို Systematically Store လုပ်ပြီး Handle နိုင်ဖိုလိုအပ်ပါတယ်
            ဒီလို Data Handle တဲ့နေရာမှာ လုပ်ငန်းသေးရင်တော့ စာအုပ်ပေါ်ချမှတ်တာဖြစ်ဖြစ် IT နဲ့အကျွမ်းတဝင်ရှိတဲ့လူဆိုရင် excel ကိုအသုံးပြုတာပဲဖြစ်ဖြစ် ဆိုရင်အဆင်ပြေပါတယ်
            လုပ်ငန်းအနည်းငယ်ပိုပြီး operation ကကြီးမားလာတဲ့အခါ database ကိုအသုံးပြုပြီး ရေးထားတဲ့ Software တွေကိုအသုံးပြုလာကြပါတယ်
            Business Operation ကအရမ်းအရမ်းကိုကြီးမားသွားပြီးဆိုရင်တော့ Data Science ပညာကိုတတ်မြောက်ထားတဲ့ Data Scientist တွေရဲ့အကူအညီကိုလိုအပ်လာပြီဖြစ်ပါတယ်
            Data Scientist တွေဟာ ဘာကိုအဆင့်ဆင့်လုပ်ဆောင်သွားရလဲဆိုတာရှင်းပြပါမယ်
            ပထမဦးဆုံးမှာ Operation မှာဖြစ်နေတဲ့ Business Problem ကိုသိအောင်လုပ်ရပါတယ် ပြီးရင် လုပ်ငန်မှာရှိနေတဲ့ Data တွေကို Collection လိုက်စုစည်းရပါတယ်
            စုစည်းထားတဲ့ Data တွေဟာအရမ်းကိုများပြားတဲ့တဲ့အတွက်ကြောင့် စနစ်တကျမရှိနေနိုင်ပါဖူး Duplicate ဖြစ်နေတာတွေ နေရာတလွဲဖြစ်နေတာတွေ စသဖြင့်ပွစကြဲနေတတ်ကြပါတဖယ်
            ပွစကြဲနေတဲ့ Data တွေကို Collect လုပ်တဲ့အပြီးမှာ Data Cleaning လုပ်ပေးရပါတယ်
            အဲဒါပြီးရင် Data Analysis လိုဆိုတဲ့ Data တွေကိုခွဲခြမ်းစိတ်ဖြာပေးရပါတယ် ဒီနေရာမှာ Data Analyst လိုခေါ်တဲ့ Job တစ်ခုကထပ်ပြီးတိုးလာပါတယ်
            Analysis ပိုင်းပြီးသွားရင်တော့ Data Science နည်းပညာတွေဖြစ်တဲ့ Statistics(စာရင်းအင်းပညာ), Mathematics စတာတွေကိုအသုံးပြုပြီး Data တွေကို ကိုယ်လိုချင်တဲ့ Format အတိုင်း ဖန်တီးထုတ်လုပ်ပါတော့တယ်
            ဒီအတွက် Data Scientist တွေသည် Business point of view မှာပိုပြီး အားသာကြပါတယ် Statistics, Mathematics ဒါတွေကိုပိုပြီး ကျွမ်းကျင်တတ်မြောက်ဖိုလိုပါတယ်
            ဒါဆိုရ AI Engineer နဲ့ရောဘာဆိုင်တာလဲ
            - AI Enginner တစ်ယောက်ဖြစ်လာဖိုဆိုရင်အပေါ်မှာပြောခဲ့တဲ့ Data Science ကို တစ်ဖက်ကမ်းထိတတ်မြောက်ထားဖိုတော့မလိုအပ်ပါဖူး
            - Data Science မှာလေ့လာဖိုလိုအပ်တာတွေကို အခြေအနေတစ်ခုအထိတတ်မြောက်ပြီးရင် Machine Learning, Programming ဘက်ကိုဦးစားပေးလေ့လာရမှာဖြစ်ပါတယ်
            ဘာလို့ Machine Learning, Data Science တွေက AI engineering နဲ့ဆက်စပ်နေတာလဲဆိုတာ နားလည်ဖို့ Deep Learning ဆိုတာဘာလဲ Machine Learning ဆိုတာဘာလဲဆိုတာတွေကိုဆက်လက်ဖတ်ရှုပေးပါ
        </div>
        <div class="content-section">
            <div class='row'>
                <div class='col'><a href='oscord_AI.php'>Back</a></div>
                <div class='col'><a href='oscord_ai2.php'>Next</a></div>
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