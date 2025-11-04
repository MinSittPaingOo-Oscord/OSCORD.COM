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
   
    <?php
        include "nav.php";
    ?>
    
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
            Data Science နဲ့ပတ်သက်ပြီးအရင်ရှင်းပြပါမယ် <br>
            Data Science မှာအဓိက အရေးကြီးဆုံးကတော့ data preprocessing (Data တွေကိုပြန်လည်ပြင်ဆင်ခြင်း) ဖြစ်ပါတယ်
<br>
ဥပမာ - ကျောင်းတစ်ကျောင်းမှာရှိတဲ့ ကျောင်းသား dataset တွေကို ကျောင်းမှာရှိတဲ့ office အစုံ နေရာအစုံ လူအစုံကနေ မေးမြန်း data ကောက်လာပြီးရလာတယ်ထားပါတော့
<br>
Data တွေသည် တခါတရံမှာ noisy လို့ခေါ်တဲ့ ရူပ်ပွနေတာမျိုးတွေ, Data မှားနေတာမျိုးတွေ, Null Value အပေါက်တွေဖြစ်နေတာမျိုးတွေ, Data Duplicate(data ထပ်နေတာမျိုးတွေ), Format မကျတာမျိုးတွေ, ကိုယ်အသုံးပြုမယ့်ရည်ရွယ်ချက်ကနေသွေဖယ်နေတဲ့မလိုအပ်တဲ့ data တွေ, တွက်လို့ချက်လို့မရတဲ့စာအရှည်ကြီးတွေ စသဖြင့်ဒါမျိုးတွေပါလာနိုင်ပါတယ်
<br>
ဒီလိုမျိုး ဖြစ်ချင်တိုင်း ပရန်းပတာဖြစ်နေတဲ့ data တွေကိုသုံးပြီးတော့ ဘာမှလုပ်လို့မရပါဖူး
<br>
ဒီအတွက် data science နည်းပညာဟာအရေးပါလာတာဖြစ်ပါတယ်
<br>
Data science မှာဆိုရင် အပေါ်မှာပြောခဲ့တဲ့
ပွစတက်နေတဲ့ raw data တွေကို
<br>
No 1 - selection (ကိုယ်အသုံးလိုမယ့် Target Data ကိုပဲရွေးထုတ်) မယ်<br>
No 2 - Preprocess ( Null အပေါက်ဖြစ်နေတဲ့ data တွေကို Data science နည်းပညာတစ်ခုခုကိုသုံးပြီး ခန့်မှန်းပြီးဖြည့်တာမျိုးတွေ ခန့်မှန်းလို့မရတော့ရင် ဖယ်ပစ်တာမျိုး Duplicate ဖြစ်နေတာမျိုးတွေဖယ်ပစ်တာမျိုးတွေ) လုပ်မယ်<br>
No 3 - Data တွေကို တွက်လို့ချက်လို့ရအောင် Transform Data တွေကိုပုံစံပြောင်းပစ်တာမျိုးတွေ<br>
No 4 - မညီတဲ့ Data တွေကို clustering လို့ခေါ်တဲ့ အုပ်စုတစ်စုဆီ တစ်စုဆီ Cluster ခွဲတာမျိုးတွေ<br>
No 5 - နောက်ဆုံးရလာတဲ့ data တွေကို ပြန်ပြီး စစ်ဆေးတာမျိုးတွေ<br>
ဒါတွေကိုအဆင့်ဆင့်တွက်ချက်ပြီးလုပ်ကိုင်ရပါတယ်<br>
ဒါ့အပြင် data science မှာ<br>
- association rule mining ဆိုတဲ့ ဥပမာ - online shop တစ်ခုမှာ ဘယ်သူကဘာဝယ်ရင် ဘာတွေနဲ့တွဲပြီးဝယ်လို့ရှိလဲဆိုတာမျိုးတွေကိုတွက်ချက်တာ<br>
- Supervised Machine Learning - ရှိနှင့်နေပြီးသား Data တွေကိုသုံးပြီး နောက်ကြရင် ဘာဖြစ်ရင် ဘာထွက်လာမလဲဆိုတဲ့ Rule တွေ ကိုခန့်မှန်းတွက်ချက်တာ<br>
စသဖြင့် နည်းပညာတွေ theory တွေအများကြီးရှိပါတယ်
<br>  ဘာလို့ Machine Learning, Data Science တွေက AI engineering နဲ့ဆက်စပ်နေတာလဲဆိုတာ နားလည်ဖို့ Deep Learning ဆိုတာဘာလဲ Machine Learning ဆိုတာဘာလဲဆိုတာတွေကိုဆက်လက်ဖတ်ရှုပေးပါ
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