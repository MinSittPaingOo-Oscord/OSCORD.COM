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
    <title>oscord.what is database.com</title>
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
            background : transparent;
            /* border-radius: 15px; */
            margin-top : 50px;
            padding: 10px;
            margin-left : 50px;
            margin-right : 50px;
            margin-bottom : 50px;
            max-width: auto;
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
            line-height: 60px !important;
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

        .main .video-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            /* animation: neonGlow 2s ease-in-out infinite; */
        }

        .main .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 10px;
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
    
    <div class='container main animate-on-scroll'>
        <div><h3>Database ဆိုတာဘာလဲ။<br>Programmer တစ်ယောက်ကဘာလို့ Database ကိုလေ့လာဖို့လိုအပ်တာလဲ။</h3></div>
      
        
        <div class="content-section">
            Database ဆိုတာ အလွယ်ပြောရရင်တော့ စာရင်းစာအုပ်ကြီး တစ်အုပ်လိုပါပဲ။
            အချက်အလက်တွေအများကြီးကို စနစ်တကျ စီမံပြီး သိမ်းဆည်းလို့ရတဲ့ နေရာကြီးတစ်ခုပေါ့။
            ကုန်ဆုံဆိုင်၊စတိုးဆိုင်၊စားသောက်ဆိုင်၊ဟိုတယ် အစရှိတဲ့ စီးပွားရေးလုပ်ငန်းအများစုဟာ ...
            သူတို့ရဲ့ လုပ်ငန်းနဲ့ဆိုင်တဲ့ အချက်အလက်တွေကို Database ထဲမှာ သိမ်းဆည်းထားခြင်းအားဖြင့် Data ပျောက်ဆုံးခြင်းမရှိတော့ဘဲ
            ထို Data တွေကို ပြင်ဆင်ခြင်း၊ထပ်တိုးခြင်း၊ဖျက်ခြင်း စသည်တို့ကို Program ကနေတဆင့် လုပ်ကိုင်လို့ရပါတယ်။
            <br>
            Program ကနေတစ်ဆင့် လို့ပြောတဲ့နေရာမှာ Programmer သမားများဟာ အသုံးပြုမယ့် Database ကို Code နဲ့ချိတ်ဆက်ပြီး Program ရေးပေးရပါတယ်။
            Computer မှာ အဓိကအားဖြင့် Memory နှစ်မျိုးနှစ်စားရှိပါတယ်။
            - Primary Memory(Main Memory)
            - Secondary Memory(External Memory)
            တို့ဖြစ်ပါတယ်။
            Primary Memory လို့ခေါ်တဲ့ Main Memory ဟာ Computer တစ်လုံးကို အသုံးပြုလည်ပတ်နေတဲ့ အချိန်မှာပဲ Data တွေကို Store လုပ်ပါတယ်။
            အသုံးပြုနေတဲ့ Computer ကို Shut Down ချလိုက်တဲ့အခါ တစ်နည်းအားဖြင့် လျှပ်စစ်ပြတ်တောက်သွားတဲ့အခါ Primary Memory ပေါ်မှာ ရှိတဲ့ Data တွေဟာ ရုတ်ချည်းပျောက်ကွယ် သွားမှာဖြစ်တယ်။
            Secondary Memory ကတော့ Long Term အတွက်ရည်ရွယ်အသုံးပြုပါတယ်။ Second Memory ထဲမှာ ရှိတဲ့ Data & Instructions တွေဟာ လက်ရှိအသုံးပြနေတဲ့ Computer က Power Off သွားလည်း ပျောက်ဆုံးခြင်းရှိမှာ မဟုတ်ပါဘူး။
            ဆိုကြပါစို့ Program တစ်ခုရှိမယ်။ Variables တွေ Declare လုပ်ထားမယ်။ User Input တောင်းတယ်။ ရလာတဲ့ User Input တွေကို Variables ထဲမှာ သွားပြီး Store လုပ်တယ်။
            ဒီမှာဆိုရင် User ဆီကနေ ရရှိလာတဲ့ Data တွေဟာ Variables တွေမှာ Assign ၀င်သွားပါတယ်။ ထို Variable တွေဟာ Computer ရဲ့ Primary Memory မှာသာ တည်ရှိပါတယ်။
            စက်ပိတ်လိုက်ရင် (သို့မဟုတ်) Program ကို နောက်တစ်�ကြိမ် ပြန် Run မယ်ဆိုရင် အရှေ့က Assign ၀င်ထားတဲ့ တန်ဖိုးတွေဟာ ပျောက်ဆုံးသွားမှာဖြစ်တယ်။ တန်ဖိုးအသစ်ကို ပြန်လည် Input ပေးရမှာဖြစ်တယ်။
            အမှန်တကယ် စီးပွားရေးလုပ်ငန်းတွေအတွက် Program ရေးပေးတော့မယ်ဟေ့ ဆိုရင် ဒီလိုမျိုး User Input ကရလာမယ့် အချက်အလက်တွေဟာ ပျက်စီးသွားလို့မဖြစ်ပါဘူး။
            စီးပွားရေးလုပ်ငန်းတွေဟာ သူတို့ဆီမှာ ရှိတဲ့ အချက်အလက်တွေကို နှစ်ရှည်ကြာအောင် သိမ်းဆည်းချင်တာဖြစ်ပါတယ်။
            ဒါကြောင့်မလို့ အချက်အလက်တွေကိုသိမ်းဆည်းပေးရတဲ့အခါမှာ Computer ရဲ့ Secondary Memory မှာ File (သို့မဟုတ်) Database တစ်ခုအနေနဲ့ သွားပြီးသိမ်းဆည်းရပါတယ်။
            Programmer တွေဟာ သူတို့ဆီလာတဲ့ Customer ရဲ့ စီးပွားရေးလုပ်ငန်းတွေအတွက် Application တစ်ခုရေးပေးတော့မယ်ဆိုရင် လုပ်ငန်းအကြောင်းနားလည်အောင်လုပ်ပြီး Database design တည်ဆောက်ပေးရပါတယ်။
            Data တွေကို ဘယ်လိုသိမ်းချင်တာလဲ၊ ဘယ်လို Operations တွေကို လုပ်ကိုင်ချင်တာလဲ၊ အစရှိသဖြင့် Customer လုပ်ငန်းကို မေးမြန်းရပါတယ်။
            မေးမြန်းပြီးမှသာ Database တစ်ခုကိုတည်ဆောက်ပြီး Code နှင့် ချိတ်ဆက်ကာ Application တစ်ခု ဖန်တီးပေးရတာ ဖြစ်ပါတယ်။
            ဒီလိုမျိုး Application မှာ Database ကို အသုံးပြုခြင်းအားဖြင့် Application ကို အသုံးပြုမယ့် User က
            Data တွေကို သိမ်းဆည်းနိုင်သွားမယ်။
            သိမ်းဆည်းထားတဲ့ Data တွေကို ပြင်မှာလား
            ပြန်ဖျက်မှာလား
            Data အသစ်ထပ်တိုးမှာလား
            Database ထဲကနေ ကိုယ်လိုချင်တဲ့ Data ကိုပဲ ရှာမှာလား
            Data တွေကို ကိုယ်လိုချင်သလို စီစဉ်မယ်၊ ထိန်းချုပ်မယ်
            စသဖြင့် Data Management ကို လုပ်ကိုင်နိုင်သွားမယ်။
            ဒါကြောင့်မလို့ Programmer တစ်ဦးဟာ Database ကို အသုံးပြုတတ်သူဖြစ်ရပါမယ်။
        </div>
        <hr>
        <div><h4>Database server အမျိုးအစားများ</h4></div>
        <div class="content-section">
            - SQL Server(Microsoft SQL)
            - Oracle
            - My SQL Server
            - Aurora
            SQL Server သို့မဟုတ် Microsoft SQL Server ဟာ Business နှင့် Organization တွေမှာ အသုံးပြုတဲ့ Database Management System တစ်ခုဖြစ်ပါတယ်။
            တစ်နည်းအားဖြင့် Desktop Application တွေမှာသုံးပါတယ်။
            စီးပွားရေးလုပ်ငန်းတွေဟာ Desktop Application ကိုပိုမိုတွင်ကျယ်စွာ အသုံးပြုပါတယ်။
            Data warehousing, Business intelligence and Analytics စတဲ့ နေရာတွေမှာ အသုံးပြုကြပါတယ်။
            My SQL ကတော့ Web Application & Website တွေရေးတဲ့နေရာမှာ အသုံးပြုတဲ့ Database Management System တစ်ခုဖြစ်ပါတယ်။
            အသုံးပြရလွယ်ကူတယ်၊ မြန်ဆန်တယ်၊ ဖတ်လို့ရူလို့လွယ်တယ် ဒါတွေကြောင့် လူသိများကြပါတယ်။
            ကျန်တဲ့ Database server အမျိုးအစားတွေကလည်း သူနေရာနဲ့သူ အသုံးပြုကြတဲ့ အသုံး၀င်ကြတဲ့ Database Management System တွေဖြစ်ပါတယ်။
        </div>
        <hr>
        <div><h4>Programmer တွေအတွက် Database ကို လေ့လာသင့်တဲ့ အခြားသော အကြောင်းအရင်း</h4></div>
        <div class="content-section">
            Job Opportunities & Valuable Asset of Industries
            Career Advancement in Data Science & Business Intelligence
            ယနေ့ခေတ်ဟာ Data-driven world ဖြစ်ပါတယ်။
            အပေါ်မှာရှင်းပြသွားသလိုပဲ။ Data တွေကို သိမ်းဆည်းပြီး အလုပ်လုပ်ကိုင်ကြတာပါ။
            Database ကို လေ့လာထားတယ်၊ Database knowledge ရှိတယ်ဆိုရင် သင်ဟာ အလုပ်အကိုင်အခွင့်အလမ်းပေါများမှာဖြစ်ပါတယ်။
            ဒါဆိုရင် Database ကိုဘာကြောင့်သုံးတယ်၊ ဘယ်နေရာတွေမှာသုံးတယ်၊ Database ကိုဘာကြောင့်လိုအပ်တယ် ဒါတွေကိုသိသွားပြီလို့ထင်ပါတယ်။
        </div>
          <br>
        <br>
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/Z4QG6skyk9Y?list=PLunggmB-HckVY_eH5OdEatnCtJs0PnpDp" allowfullscreen></iframe>
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