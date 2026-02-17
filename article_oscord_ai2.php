
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
                <div class='col'><a href='article_oscord_ai1.php'>Back</a></div>
                <div class='col'><a href='article_oscord_ai3.php'>Next</a></div>
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