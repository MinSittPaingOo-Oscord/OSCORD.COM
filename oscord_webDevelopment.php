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
    <title>oscord.what is webDevelopment.com</title>
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
        <div><h3>How to start learning Web Development</h3></div>
        <div class="content-section">
            Web Development ကိုလေ့လာတဲ့အခါမှာ Frontend & Backend ဆိုပြီးနှစ်ပိုင်းလေ့လာရပါတယ်
            Frontend ပိုင်းကတော့ Website တစ်ခုမှာ User Interface ဘက်ကနေမြင်နေရသမျှ Content အားလုံးကို Develop လုပ်ရတာဖြစ်ပါတယ်
            Web Development ကိုစတင်လေ့လာတော့မယ်ဆိုရင် Frontend ပိုင်းဖြစ်တဲ့ HTML ကနေစတင်ပြီး CSS, JavaScript, Bootstrap စတဲ့နည်းပညာတွေကိုလေ့လာဖို့လိုအပ်ပါတယ်
            Html( Hyper Text Markup Language) သည် Website ရဲ့ကျောရိုးကြီးတစ်ခုလုံးကိုထောက်ပံ့ပေးထားတာဖြစ်ပါတယ်
            Web တစ်ခုမှာမြင်ရသမျှ Content အားလုံးဟာ HTMl ကိုအသုံးပြုပြီးဖန်တီးထားတာဖြစ်ပါတယ်
            CSS(Cascading Style Sheet) ဆိုတာကတော့ Html နဲ့ရေးသားထားတဲ့ Content တွေကို ပိုပြီးလှပအောင် Design ပိုင်းကိုထောက်ပံ့ပေးတာဖြစ်ပါတယ်
            Webpage တစ်ခုကို Responsive ဖြစ်အောင်လဲထောက်ပံ့ပေးပါတယ်
            JavaScript ကတော့ Function Control Flow တွေဖန်တီးဖို့အသုံးပြုပါတယ်
            ဥပမာအားဖြင့်ဆိုရရင် ဘယ် Button ကိုနှိပ်လိုက်လို့ ဘယ်အလုပ်တွေကိုအလုပ်လုပ်မလဲ ဆိုတာတွေကိုထိန်းချုပ်တာဖြစ်ပါတယ်
            Boostrap(Framework for CSS & JS) - Framework ရဲ့သဘောတရားသည် ရေးထားပီးသားဖန်တီးထားပီးသား Code တွေကိုအဆင်သင့်ယူသုံးလို့ရအောင် ဖန်တီးထားတာဖြစ်ပါတယ်
            Bootstrap Framework ကိုကြတော့ CSS & JS ရေးသားမယ့်နေရာမှာ ထောက်ပံ့နိုင်အောင်ဖန်တီးထားတာဖြစ်ပါတယ်
            Jquery(Framework for JavaScript) - JavaScript ရဲ့ Framework တစ်ခုဖြစ်တဲ့အတွက် အချို့သော JavaScript control flow တွေကို ကိုယ်တိုင်ရေးစရာမလိုဘဲ အသင့်ယူသုံးနိုင်မှာဖြစ်ပါတယ်
            အပေါ်မှာပြောသွားတဲ့ Technique တွေသည် Frontend Development အတွက်မရှိမဖြစ်လိုအပ်တဲ့နည်းပညာတွေဖြစ်ပါတယ်
            ဒါ့အပြင် ReactJS စတဲ့နည်းပညာတွေကိုလဲ Frontend အတွက်ဆက်ပြီးလေ့လာသွားချင်ရင်လဲ ရပါတယ်
        </div>
        <hr>
        <div><h3>Backend Development</h3></div>
        <div class="content-section">
            အပိုင်းကတော့ Server Page တစ်ခုကနေ Database နဲ့ Connect လုပ်တဲ့အပိုင်းဖြစ်ပါတယ်
            ဒီအပိုင်းမှာ Database နဲ့ပတ်သက်ပြီး အသေးစိတ်ပြောရန်လိုအပ်ပါတယ်
            Database ဆိုတာ အလွယ်တကူပြောရမယ်ဆိုရင် Data တွေကို Table တွေအလိုက်သိုလှောင်ထားတဲ့ Server တစ်ခုဖြစ်ပါတယ်
            Backend Developing အပိုင်းသည် လက်ရှိရေးနေတဲ့ Program ဘက်ကနေ Database တစ်ခုနဲ့ချိတ်ဆက်ပြီးတော့ Database ထဲမှာရှိနေတဲ့ Data တွေကို INSERTION, DELETION, UPDATING & SELECTION ဒီလေးခုကိုအဓိကလုပ်ဆောင်သွားမှာဖြစ်တယ်
            မြင်သာအောင်ပြောရမယ်ဆိုရင် Web page တစ်ခုမှာ Form ဖြည့်ရတဲ့အပိုင်းကိုမြင်ဖူးကြမှာပါ
            အဲဒီမှာ ကိုယ်ဖြည့်လိုက်တဲ့ Form ထဲက Data တွေသည် Database တစ်ခုထဲကိုရောက်မှသာလျှင် Permanent ဖြစ်မှာဖြစ်ပါတယ်
            လက်ရှိရေးနေတဲ့ Program ဘက်�ကနေ Database Connection လုပ်တယ်လို့ပြောတဲ့နေရာမှာ အဲဒီ Program သည် Backend Language Program တစ်ခုခုနဲ့ရေးထားတာပါ
            ဘာတွေရှိမလဲဆိုတော့
            - PHP + Laravel Framework
            - Python + DJango Framework
            - J2EE + Spring Framework
            - C# + Asp.net framework
            စတဲ့ Technique တွေနဲ့ Backend Develop လုပ်လို့ရပါတယ်
            အဲတော့ Web Developer တစ်ဦးက Frontend ပိုင်းကိုလေ့လာ့ပြီးပြီဆိုရင် Backend ပိုင်းအတွက် Language တစ်ခုခုကိုရွေးချယ်ရပါတယ်
            တစ်ခုကိုတတ်ရင်လဲကျန်တဲ့ Technique တွေကိုတတ်မြောက်ဖို့လွယ်ကူနိုင်ပါတယ်
            အဲဒီမှာ Framework ဆိုပြီးတွဲဖော်ပြထားတာတွေသည် Backend အတွက်သုံးရမယ့် Languages တွေကိုအကူအနေနဲ့ ထောက်ပံံ့ပေးတာတွေဖြစ်ပါတယ်
            ဒီလောက်ဆိုရင် နည်းလည်လောက်ပီလို့ထင်ပါတယ်
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