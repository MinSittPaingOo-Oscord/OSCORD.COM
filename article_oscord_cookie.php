<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.what is Cookie.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Georgia, serif;
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

        .main {
            background: transparent;
            margin-top: 50px;
            padding: 10px;
            margin-left: 50px;
            margin-right: 50px;
            margin-bottom: 50px;
            max-width: 100%;
            animation: fadeIn 1s ease-out;
        }

        .main h3 {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 60px !important;
        }

        .main h4 {
            font-family: Georgia, serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 60px !important;
        }

        .main .content-section {
            font-size: 1rem;
            line-height: 40px;
            color: #d0d0d0;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .main a {
            color: #00f2ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .main a:hover {
            color: #ffffff;
            text-decoration: underline;
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
    
    <div class="main">
        <h3>🍪 Cookie ဆိုတာ ဘာလဲ?🍪</h3>
        <div class="content-section">
            🌐 ကျွန်တော်တို့က website တစ်ခုကို ဝင်လိုက်တဲ့အခါမှာ အဲ့ဒီ website ရဲ့ Server ကနေ HTTP Response နဲ့ Cookie လို့ခေါ်တဲ့ Data Packet လေးတစ်ခုကို ဖန်တီးပြီး ကျွန်တော်တို့ရဲ့ Web Browser ဆီကို ပို့ပေးလိုက်ပါတယ်<br><br>
            💻 အဲမှာ ကျွန်တော်တို့ရဲ့ Browser က အဲ့ဒီ Cookie Data ကို ယူပြီး ကိုယ့်ကွန်ပျူတာရဲ့ Local Storage နေရာတစ်ခုမှာ သိမ်းပေးထားလိုက်ပါတယ်<br><br>
            📂 ဒီ Storage ကို Browser Data (သို့) Site Data လို့လည်း ခေါ်ကြပါတယ်<br><br>
            🔁 နောက်ထပ် အဲ့ဒီ site ကိုပဲ ပြန်ဝင်တဲ့အခါ Browser က သူသိမ်းထားတဲ့ Cookie လေးကို ပြန်ရှာပါတယ်<br><br>
            📡 ပြီးတော့ အဲ့ဒီ Cookie ကို website Server ဆီကို HTTP Request နဲ့ auto ပြန်ပို့ပေးလိုက်ပါတယ်<br><br>
            🧠 ဒါကြောင့်မို့လို့ Server ကနေ ကျွန်တော်တို့ ဘာတွေလုပ်ထားခဲ့လဲ ဘာတွေလုပ်ထားတာလဲဆိုတာကို တန်းသိတာပါ<br><br>
            🔐 ဥပမာ — Login ဝင်ထားတာ၊ Language setting၊ Cart ထဲက ပစ္စည်းတွေ စတာတွေကို မှတ်ထားနိုင်ပါတယ်
        </div>
        <hr>
        <div class="content-section">
            ⚠️ ဒါပေမဲ့ ဒီနေရာမှာ သတိထားရမှာက Tracking Cookie တွေပါပဲ<br><br>
            🕵️‍♂️ တချို့ Cookie တွေက ကိုယ်ဘယ်ဝက်ဘ်ဆိုဒ်တွေ ကြည့်ခဲ့လဲ ဆိုတာကို မှတ်တမ်းတင်ဖို့ ကြိုးစားတတ်ပါတယ်<br><br>
            📊 ဒီလို Data တွေကို Ads Company တွေက အသုံးပြုပြီး Targeted Ads ပြဖို့ သုံးနိုင်ပါတယ်<br><br>
            😟 အဲ့ဒါကြောင့် Privacy အတွက်တော့ စိတ်ပူရပါတယ်<br><br>
            📝 ကဲ... ဒါဆိုရင်တော့ Cookie ဆိုတာ website နဲ့ Browser ကြားမှာ ကိုယ် data တွေကို မှတ်မိနေအောင် သုံးတဲ့ note လေးတစ်ခုပါပဲ
        </div>
        <hr>
        <h4>🔗 ရှေ့ရက်က API နဲ့ကော ဘယ်လိုကွာမယ်ထင်လဲ?</h4>
        <div class="content-section">
            စဉ်းစားကြည့်ရအောင်ပါ<br><br>
            💬 နှစ်ခုက သိသာပါတယ် API ဆိုတာက စကားဘယ်လိုပြောမလဲဆိုတဲ့ protocol ဆိုတာမျိုးဖြစ်ပြီး<br><br>
            📦 Cookie ကျတော့ သူခနက ဘာအကြောင်းပြောနေတာလဲဆိုတာကို မှတ်မိသလိုမျိုး data packet လေးတစ်ခုဖြစ်ပါတယ်<br><br>
            ✅ အတိုချုံးပြောရရင် Cookie = Website က User ကို မှတ်ထားဖို့ သုံးတဲ့ data လေးတွေပါ
        </div>
        <hr>
        <div class="content-section">
            <strong>Author Name</strong> - Instructor Min Thu Khaing<br>
            <strong>Content Series</strong> - Journey with Moriarty
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
            }, { threshold: 0 });

            document.querySelectorAll('.main').forEach(el => {
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>