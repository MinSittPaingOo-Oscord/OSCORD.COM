<?php
    include "connectdb.php";

    #selecting course name
    $query1 = "SELECT courseID,courseName FROM oscord_course";
    $result1 = $conn->query($query1);

    if (isset($_POST['courseID'])) {
         $courseID = $_POST['id'];
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
            text-shadow: 0 0 5px rgba(0, 242, 255, 0);
            line-height: 40px !important;
        }

        .main h4 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0);
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
        <div><h4>What Is Machine Learning? Artificial Intelligence နဲ့ဘယ်လိုဆက်စပ်နေသလဲ</h4></div>
        <div class="content-section">
            Machine Learning ဆိုတာ Artificial Intelligence ရဲ့အစိတ်အပိုင်းတစ်ခုဖြစ်ပါတယ်
            စက်တွေကိုလူတွေအတိုင်း စဉ်းစားနိုင်အောင် လုပ်ပေးတဲ့ Function တွေ နည်းပညာတွေကို ပြောတာဖြစ်ပါတယ်
            ဒါကိုနားလည်ဖို့ဆိုရင် Traditional Programming နဲ့ Machine Learning ကိုကွဲကွဲပြားပြားနားလည်ဖို့လဲလိုအပ်ပါတယ်
            ဥပမာ လူတစ်ယောက်က ထမင်းကြော်နည်းကိုသိတယ် သူ့လက်ထဲမှာလဲထမင်းဆိုတာကြီးကရှိနေတယ်ဆိုရင်
            သူသာထမင်းကြော်လိုက်တယ်ဆိုရင် ထမင်းကြော်တစ်ပွဲထွက်လာမှာဖြစ်ပါတယ်
            Traditional Programming မှာဆိုရင်လည်းဒီလိုပါပဲ Input တစ်ခုရှိမယ် Function တစ်ခုရှိမယ်ဆိုရင်
            Function ထဲက Action အပေါ်မှာမူတည်ပြီးတော့ Output တစ်ခုထွက်လာမှာဖြစ်ပါတယ်
            လူနားလည်အောင်ပြောရမယ်ဆိုရင်တော့ ထမင်းဆိုတာက Input
            ထမင်းကြော်နည်းက Function
            ထမင်းကြော်လိုက်တာက Function ထဲက Action
            ထွက်လာတဲ့ ထမင်းကြော်က Output ဖြစ်ပါတယ် ဒါကသာမာန်ရိုးကျ Programming ပါ
            Machine Learning မှာကတော့
            ဥပမာ လူလိုပြောရမယ်ဆိုရင် အဲဒီလူက ထမင်းကြော်နည်းမရှိသေးတဲ့
            ထမင်းမကြော်တတ်သေးတဲ့လူသားတစ်ယောက်ဖြစ်နေပါသေးတယ်
            ဒါပေမယ့် သူ့လက်ထဲကို ထမင်းရယ် ကြော်ထားပြီးသား ထမင်းကြော်ရယ်ကို ထည့်ပေးလိုက်မယ်ဆိုရင်
            ထမင်းနဲ့ထမင်းကြော်ကိုခွဲခြားနိုင်ပါတယ်
            ဒါဟာစက်တွေမှာဆိုရင်လဲ Deep Learning တုန်းက ဘယ်ဟာကိုဘာမှန်းသိအောင်လုပ်ထားလို့ သိသလိုပါပဲ
            ဒါဆိုဟုတ်ပြီ အဲဒီထမင်းမကြော်တတ်သေးတဲ့လူကို မတူညီတဲ့ထမင်းအမျိုးအစားတွေရယ်
            အဲဒီထမင်းတွေကိုကြော်ထားတဲ့ မတူညီတဲ့ထမင်းကြော်အများကြီးတွေကို အစုံအစုံလိုက် (ထမင်း + ထမင်းကြော်)
            တစ်နည်းအားဖြင့် (Input + Output) နှစ်ခုတွဲပြီး Data တွေအများကြီးပေးလိုက်မယ်ဆိုရင်
            အဲဒီလူက ထမင်းကြော်နည်းကို သူဘာသာသူအကြိမ်ပေါင်းများစွာကြော်ကြည့်ရင်းနဲ့
            နောက်ဆုံး ထမင်းကြော်နည်းအမှန်ကိုသိသွားမှာဖြစ်ပါတယ် ဒါဆိုရင်နောက်အကြိမ်တွေကြရင်
            ဘယ်လိုထမင်းအမျိုးအစားကိုပဲသူ့ကိုပေးလိုက်ပေးလိုက် သူဟာထမင်းကြော်တတ်သွားမှာဖြစ်တယ်
            Machine Learning အရပြန်ကြည့်မယ်ဆိုရင် စက်ကို Input + Output
            ဒီလို Pair လိုက်ပေးလိုက်တဲ့အခါမှာ Input ကနေ Output ထွက်စေတဲ့
            Function ကိုသူ့ဘာသာသူခန့်မှန်းနိုင်သွားတယ် ဒါပါပဲ
            ထမင်းက Input, ထမင်းကြော် က Output, ထမင်းကြော်နည်းက Function,
            ထမင်းကြော်နည်းမှန်အောင်စဉ်းစားပြီးတစ်ခါပြီးတစ်ခါလိုက်ကြော်ကြည့်နေတဲ့လုပ်ငန်းစဉ်က Machine Learning algorithms ပဲဖြစ်ပါတယ်
            ဒါကို Mathematics ရူထောင့်ကနေတစ်ချက်ရှင်းပြပါမယ်
            Linear Algebra လို့ခေါ်တဲ့ Mathematics Chapter မှာ x (Input), y(Output),
            ဥပမာ y=2x ဆိုရင် Function ဒါကို Mathematics ကိုသင်ဖူးသူတိုင်းနားလည်ကြပါလိမ့်မယ်
            y သည် x အပေါ်မှာမူတည်ပါတယ်
            Input သည် Output အပေါ်မှာမူတည်တယ်
            ဘာအပေါ်မှာလိုက်ပြီးမူတည်မှာလဲဆိုတော့ Function အပေါ်မှာလိုက်ပြီး တွက်ချက်အဖြေထုတ်သွားတာပါ
            ဒါက Traditional Programming ပါ
            Machine Learning မှာကတော့ စက်ကို<br>
            Input(x) ------> Output(y)<br>
            1 ------> 2<br>
            2 ------> 4<br>
            3 ------> 6<br>
            4 ------> 8<br>
            5 ------> 10<br>
            ဒီလိုမျိုး Trillion ချီတဲ့အစုံလိုက်အစုံလိုက် Input ရယ် Output ရယ်ကိုပေးလိုက်တဲ့အခါမှာ
            ဒီ Input တွေက ဒီ Output ထွက်ဖို့ကို တူညီတဲ့ Function တစ်ခုထွက်ဖို့ကို
            အကြိမ်ပေါင်းများစွာ တွက်ချက်စဉ်းစားပြီးတော့ နောက်ဆုံး Function တစ်ခုကိုထုတ်နိုင်သွားပါတယ်
            အဲလိုထုတ်နိုင်သွားအောင်လုပ်တာသည် Machine Learning ဖြစ်ပါတယ်
            ဒါဆိုနောက်လာမယ့် မသိတဲ့ Input တွေအတွက် စက်ကိုယ်တိုင်စဉ်းစားတွက်ချက်ထားတဲ့
            Function ကိုအသုံးချပြီးတော့ Output တွေအများကြီးကိုလဲတွက်ချက်နိုင်သွားမှာဖြစ်ပါတယ်
            ဒီကနေမှအခြေခံပြီးတော့ နောက်ဆုံး Artificial Intelligence ဆိုတာကို Train လုပ်နိုင်ခဲ့တာဖြစ်ပါတယ်
            ဒါကိုလက်တွေ့ဘဝမှာဘယ်လိုအသုံးချနေလဲ
            ဥပမာ ကင်ဆာဖြစ်ခဲ့တဲ့လူတွေအများကြီးရဲ့ ကင်ဆာ ဓာတ်မှန် Photo တွေကို
            Input သွင်းလိုက်တယ် ပြီးတော့ တစ်ခုချင်းစီရဲ့ ကင်ဆာအခြေအနေဘယ်လိုရှိလဲ
            Danger Zone လား Safe Zone လားစသဖြင့် ရှိနေပြီးသား Result(Output) တွေကို စက်ကိုပေးလိုက်မယ်
            စက်က Machine Learning Algorithm တွေကိုအသုံးပြုပြီးတော့ ဘယ်လို အခြေအနေဆို
            ဘာဖြစ်နိုင်လဲဆိုတာကို အရင်ကမရှိသေးတဲ့ နောက်လာမယ့် လူနာတွေအပေါ်မှာ
            အရင်ကရှိခဲ့ Data တွေနဲ့ အတွေ့အကြုံယူ တွက်ချက်စဉ်းစားပြီးတော့
            ဒီလူက ကင်ဆာဖြစ်နိုင်မဖြစ်နိုင်ဆိုတာအဖြေထုတ်ပေးသွားမှာဖြစ်ပါတယ်
            ဒါဆိုရင်သာမာန်လူသားတစ်ယောက်မလုပ်နိုင်တဲ့ကိစ္စကို စက်ကလုပ်နိုင်သွားတာဖြစ်ပါတယ်
            So ဒီနေရာမှာလဲ Input တွေ Result တွေဆိုတာလဲ ရှိနှင့်နေပြီးသား Data တွေဖြစ်ပါတယ်
            ဒါကြောင့်လဲ Machine Learning ဟာ Data Science အပေါ်မှာလဲ မှီခိုတယ်ဆိုတာနားလည်နိုင်ပါတယ်
            ရှိနေပြီးသား Data တွေအပေါ်မှာ မူတည်ပြီး တွက်ချက်တဲ့အပိုင်းမှာလဲ
            Probability, Linear Algebra, Calculus စတဲ့ Mathematics Concept တွေကလဲ
            Machine Learning Algorithm တွေထဲမှာ ထည့်သွင်းအသုံးချတတ်ဖို့လိုပါသေးတယ်
            ဒါဆိုရင် General အားဖြင့်တော့သဘောပေါက်လောက်ပြီလို့ထင်ပါတယ်
        </div>
        <div class="content-section">
            <div class='row'>
                <div class='col'><a href='oscord_ai2.php'>Back</a></div>
                <div class='col'><a href='oscord_ai4.php'>Next</a></div>
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