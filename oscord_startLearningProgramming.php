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
    <title>oscord.When you start learning programming.com</title>
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

        /* Animations */
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

        /* Main Content */
        .main {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 15px;
            padding: 40px;
            margin: 30px auto;
            max-width: 900px;
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }

        .main #hh3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height : 60px !important;
        }

     

        .main div {
            font-size: 1rem;
            line-height: 1.9;
            color: #d0d0d0;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-out 0.2s both;
            line-height : 40px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .main {
                padding: 20px;
                margin: 20px;
            }

            .main h3 {
                font-size: 1.8rem;
            }

            .main div {
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

            .main div {
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
    
    <div class='container main animate-on-scroll'>
        <h3 id='hh3'>Programming ကိုစတင်လေ့လာတော့မယ်ဆိုရင်ဘာတွေသိထားဖို့လိုအပ်လဲ</h3>
        <div>အရင်ဆုံးကတော့ ကိုယ်ကဘယ် Developing Field ထဲကိုသွားချင်သလဲဆိုတာစဉ်းစားဖို့လိုပါတယ်</div>
        <div>Developing Field တွေကတော့အများအပြားရှိတဲ့ထဲမှ စတင်လေ့လာမယ့်သူတွေအတွက် လောလောဆယ်ခေါင်းရူပ်မနေစေချင်တော့</div>
        <div>General ဖြစ်တဲ့ Field သုံးခုကိုပဲဖော်ပြလိုက်ပါမယ်</div>
        <div>1. Desktop Application Development </div>
        <div>2. Web Application Development </div>
        <div>3. Android Application Development </div>
        <div>အိုကေပါ အထက်မှာဖော်ပြထားတဲ့ Developing Field သုံးခုကိုသိသွားပြီဆိုရင် ဘာကိုဆက်စဉ်းစားရမလဲဆိုတာကတော့</div>
        <div>ဘယ် Field ကိုသွားဖို့အတွက်ဆိုရင် ဘာတွေလေ့လာသင်ယူဖို့လိုအပ်သလဲဆိုတာပါ</div>
        <div>ဘာတွေလေ့လာဖို့လိုအပ်သလဲဆိုရင် Developfield တစ်ခုချင်းစီမှာ သေချာပေါက်သိထားရမယ့် အရာကတော့</div>
        <div>Programming Fundamental Concepts တွေနဲ့ Database Management System ပါ</div>
        <div>Fundamental Concepts တွေဆိုတာကတော့ Programming စလေ့လာတော့မယ်ဟေ့ဆိုတာနဲ့ သိကိုသိထားရမယ့်</div>
        <div>Programming Language တိုင်းမှာပါဝင်တဲ့ Concepts တွေပါ</div>
        <div>(Fundamental အပိုင်းကတော့ ဘယ် Developing Field ကိုပဲသွားသွား လိုကိုလိုအပ်ပါတယ်)</div>
        <div>သို့ပေမယ့် Language တစ်ခုရဲ့ Fundamental Concepts တွေကိုပိုင်နိုင်သွားပြီဆိုရင် Others Langauge တွေအတွက်</div>
        <div>အလွယ်အကူအဆင်ပြေပြေနဲ့ လေ့လာနိုင်မှာဖြစ်ပါတယ်</div>
        <div>(Syntax ပဲကွဲပြီး Theory တူတူပဲမို့လို့ပါ)</div>
        <div><a href="oscord_database.php">Database Management System ဆိုတာဘာလဲ & ဘာလို့ Programmer တစ်ယောက်က Database ကိုလေ့လာဖို့လိုအပ်တာလဲ</a></div>
        <div>ကျန်တာတွေကတော့ Field အပေါ်မှာမူတည်ပြီး တစ်ခုချင်းစီမှာ လေ့လာရတဲ့ Language & Framework တွေအများအပြားရှိပါတယ်</div>
        <div>ဥပမာ Desktop Application တစ်ခုတည်ဆောက်မယ်ဆို C# သို့မဟုတ် Java ကိုအသုံးပြုကြပါတယ်</div>
        <div>& Web Application Development အတွက်ဆိုရင်တော့ PHP , Python, Java , C# စတာတွေကိုအသုံးပြုပါတယ်</div>
        <div>(အဲဒီနေရာမှာ မရောသွားစေချင်တာက ကျနော်တို့က အကုန်လုံးကိုလေ့လာထားစရာမလိုပါဘူး ဥပမာ Web အတွက်ဆို</div>
        <div>အပေါ်မှာဖော်ပြခဲ့တဲ့ Python , Java , C#, PHP စတာတွေထဲမှာမှ Java ကိုပဲသုံးပြီး Develop လုပ်သွားမှာလား</div>
        <div>ဒါမှမဟုတ် PHP ကိုပဲသုံးသွားမလားဆိုတာတော့ ကာယကံရှင်ကပဲ ကိုယ်တိုင်ရွေးချယ်ရမှာဖြစ်ပါတယ်)</div>
        <div>ဒီနေရာမှာထပ်ပြီးမရောစေချင်စေတာကတော့ ရွေးချယ်ရမယ့်အပိုင်းမလာခင်</div>
        <div>ကိုယ်က Fundamental Concepts တွေကိုသိထားမှအဆင်ပြေပါမှာ Fundamental Concept အပိုင်းတစ်ခုထဲကလည်း</div>
        <div>Application Development Level အထိပေးစွမ်းနိုင်မှာမဟုတ်ပါဘူး (Application Development Level ထိသွားဖို့အတွက်</div>
        <div>ကိုယ်ရွေးချယ်ထားတဲ့ Developing Field & ကိုယ်ရွေးချယ်ထားတဲ့ Langauge ရဲ့သက်ဆိုင်ရာဆက်လေ့လာရမယ့် နည်းပညာတွေရှိပါတယ်</div>
        <div>ဥပမာ ကိုယ်က Web Development ကို Java နဲ့သွားချင်တာလား ဒါဆို Java Fundamental ကိုအရင်သင်ယူပြီးရင်</div>
        <div>J2EE , Java Spring စတဲ့ Java ရဲ့ Advanced Technique တစ်ခုကိုအသုံးပြုလို့ရပါတယ်)</div>
        ဒီလောက်ဆိုသဘောပေါက်လောက်ပြီလို့ထင်ပါတယ်
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