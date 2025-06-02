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
        <div><h4>Deep Learning ဆိုတာဘာလဲ? AI နဲ့ဘယ်လိုဆက်စပ်နေတာလဲ?</h4></div>
        <div class="content-section">
            တကယ်တော့ AI ရဲ့အစဟာ Deep Learning ကနေစခဲ့တာဖြစ်ပါတယ်
            သမိုင်းကိုပြန်ကြည့်ရမယ်ဆိုရင် World War II ဖြစ်ပေါ်နေတုန်းကပေါ့
            Computer Scientist လည်းဖြစ် Psychologist လည်းဖြစ်တဲ့လူတစ်ဦးက Deep Learning ကိုရှာတွေ့ခဲ့တာဖြစ်တယ်
            ဒါကိုနားလည်ဖို့ဆိုရင် Psychology ဗဟုသုတတစ်ချို့ကိုသိထားဖို့လိုအပ်ပါတယ်
            လူသားတွေဟာ မွေးလာကတည်းက အရွယ်ရောက်ပြီးသား လူသားတစ်ယောက်ရဲ့ အသိဉာဏ် စဉ်းစားတွေးခေါ်နိုင်စွမ်းမရှိသေးပါဘူး
            အဲဒီအတွက် သူရဲ့ကြီးပြင်းလာစဉ်ကာလအတွင်းမှာ အသိဉာဏ်ရှိလူသားတစ်ယောက်ဖြစ်ဖို့ အရင်ဆုံးလုပ်ရတာက သူ့ပတ်ဝန်းကျင်မှာ ရှိနေတဲ့ Data တွေကို Absorb လုပ်ရတာပါပဲ
            Absorb လုပ်နိုင်ဖို့ မိဘတွေ ဆရာတွေက ကလေးတစ်ယောက်ကို Train (လေ့ကျင့်) ပေးရပါတယ်. အဖေဆိုတဲ့လူကြီးကိုပြပြီးတော့ ဒါကအဖေ, အမေဆိုတဲ့လူကြီးကိုပြပြီးတော့ဒါကအမေ, နေထိုင်နေတဲ့အဆောက်အဦးကြီးကိုပြပြီးတော့ ဒါကတော့အိမ်, စသဖြင့် ကလေးကို များပြားလှတဲ့ Data တွေ Absorb လုပ်နိုင်အောင် ရိုက်သွင်းပေးရပါတယ်
            Data တွေကိုသိပြီးသွားတဲ့ကလေးတစ်ယောက်ဟာ ဥပမာ အမေကိုအမေလိုသိသွားတယ် အဖေကိုအဖေလိုသိသွားတယ် အိမ်ကိုအိမ်လို့သိသွားတယ်
            ဘာလို့အဲဒီလိုသိတာလဲဆိုတော့ အမေကိုမြင်တယ်ပဲထားပါတော့ အမေရဲ့ပုံရိပ်ကိုမြင်ရင် အရင်ဆုံး မျက်လုံးကမြင်ပါတယ်
            မြင်လာတဲ့ပုံရိပ်ကို ဦးနှောက်ကဖတ်တယ် ဦးနှောက်ထဲမှာရှိတဲ့ Signal တွေကတစ်ခုနဲ့တစ်ခုချိတ်ဆက်ပြီး ကိုယ် absorb လုပ်ထားတဲ့ Data တွေနဲ့တိုက်စစ်တယ်
            ပြီးရင် သေချာတယ်ဆိုရင် ဒါဟာ အမေဆိုတာကို သိသွားပါတယ်
            (ဒါကတော့ မြင် ကြား အနံ့ အရသာ အထိအတွေ့ အာရုံငါးပါးထဲက အမြင်အာရံုအရ Data Absord လုပ်တာကိုပဲဥပမာပေးတာဖြစ်ပါတယ်
            လူသားတစ်ယောက်အတွက်ဆိုရင် အာရုံငါးပါးလုံးကနေ Sense ဖြစ်တာတွေအကုန်လုံးသည် Data တွေဖြစ်ပါတယ်)
            နောက်ပိုင်းကြရရှိတဲ့ Data တွေများလာတဲ့အခါမှာ လူလိုပြောရင်တော့ ပညာစုံလာတဲ့အခါမှာ
            ကိုယ်ပိုင်စဉ်းစားဆုံးဖြတ်နိုင်တဲ့ အသိဉာဏ်တွေရလာတယ်
            Deep Learning ဆိုတာလဲဒီသဘောတရားပါပဲ
            စက်တစ်ခုကို အသိဉာဏ်တစ်ခုပေးဖို့ဆိုရင်အရင်ဆုံးသူ့ကို Data တွေအများကြီး Absord လုပ်ခိုင်းရပါတယ်
            (ဒီနေရာမှာ Data Science ကအရေးပါလာတာဖြစ်ပါတယ်
            Handle လုပ်ပြီး Clean လုပ်ပြီး Analysis လုပ်ပြီးတဲ့ Data တွေကိုယူပြီးစက်ကိုပြန်လည် Train ပေးရမှာဖြစ်ပါတယ်)
            ဥပမာ စက်က ခွေးကိုခွေးလိုသိစေချင်တယ်ဆိုရင် အရင်ဆုံး သူ့ကိုခွေးပုံတွေအများကြီးကို ပြရပါတယ်
            ဒီနေရာမှာ ပုံ Image ဆိုတာသည် Pixel အစုလိုက်လေးတွေနဲ့အလုပ်လုပ်တာဖြစ်တဲ့အတွက်
            ဒီ Pixel အစုလိုက်လေးတွေဆို ခွေး အခြားမတူတဲ့ ခွေးပုံက Pixel အစုလေးတွေကိုလဲခွေး
            ဒီလိုနဲ့ Trillion နဲ့ချီတဲ့ ခွေးပုံတွေကို စက်ကို Absord လုပ်ခိုင်းလိုအပြီးမှာ သူသည် ခွေးကိုခွေးမှန်းသိသွားတယ်
            Trillion ထဲမှာမပါတဲ့ အခြားခွေးပုံတစ်ခုကိုပြသတဲ့အခါမှာလဲ သူ့ဘာသူ Probability တွက်ချက်ပြီးတော့
            ခွေးကိုခွေးမှန်းဆုံးဖြတ်နိုင်သွားမှာဖြစ်ပါတယ်
            ဒီလိုဆုံးဖြတ်တဲ့နေရာမှာလဲ Deep Learning မှာ လူဦးနှောက်ထဲကလို Signal
            ဒီမှာတော့ Neuron Link တွေချိတ်ဆက်ပြီးတော့အလုပ်လုပ်ကြပါတယ်
            Neuron Link တွေမှာဆိုရင် Layer1 LayerN အထိပုံမှာပြထားတဲ့အတိုင်းလေးတွေ အလုပ်လုပ်ကြပါတယ်
            ဒါရဲ့အသေးစိတ်အလုပ်လုပ်ပုံကိုတော့ သေသေချာချာ Course တစ်ခုအနေနဲ့လေ့လာမှနားလည်နိုင်မှာဖြစ်ပါတယ်
            ဒါဆိုရင် Deep Learning နဲ့ပတ်သက်ပြီးကတော့ ဒီနေရာမှာ လုံလောက်ပြီလိုထင်ပါတယ်
            Machine Learning နဲ့ရောဘာကွာလဲ Machine Learning ကရော ဘာကြီးလဲဆိုတာ ဆက်လက်ဖတ်ရှုပေးပါအုန်း ...
        </div>
        <div class="content-section">
            <div class='row'>
                <div class='col'><a href='oscord_ai1.php'>Back</a></div>
                <div class='col'><a href='oscord_ai3.php'>Next</a></div>
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