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