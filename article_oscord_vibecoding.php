<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.vibe-coding-juniors.com</title>
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
    
    <div class="main">
        <h3>🐳⚜️ Junior တွေ Vibe Coding သုံးသင့်လား?</h3>
        <div class="content-section">
            ကျွန်တော်တို့ Developer လောကမှာ "Vibe Coding" ဆိုတာ ကြားဖူးမှာပါ။ တစ်ခါတလေ အရမ်းလိုအပ်ပေမယ့် Junior တွေအတွက်တော့ ဘယ်လောက်အထိ အသုံးချသင့်လဲ၊ ဘယ်လို အချိန်မှာ သုံးသင့်လဲဆိုတာကို Share ပေးချင်ပါတယ်။
        </div>
        <hr>
        <h4>⚜️ Vibe Coding ဆိုတာ ဘာလဲ?</h4>
        <div class="content-section">
            Vibe Coding ဆိုတာ နာမည်အတိုင်းပါပဲ။ ကိုယ့်ရဲ့စိတ်ထဲမှာ ရေးချင်တဲ့ Code ရဲ့ Feeling ဒါမှမဟုတ် Intuition ကိုလိုက်ပြီး၊ Documentation တွေ၊ Boilerplate တွေ၊ Library Function တွေရဲ့ Syntax အသေးစိတ်ကို ခဏမေ့ထားပြီး application /platform မြန်မြန်ရေးတာမျိုးပါ။ အလွယ်ဆုံးပြောရရင် Flow အတိုင်း Code ကို ပစ်ချလိုက်တာမျိုးဖြစ်ပါတယ်။
        </div>
        <hr>
        <h4>⚜️ Junior တွေ Vibe Coding ကို သုံးသင့်ပါသလား?</h4>
        <div class="content-section">
            Vibe Coding ကို Junior တွေ သုံးသင့်ပါတယ်။ ဒါပေမယ့် အရာအားလုံးအတွက်တော့ မဟုတ်ပါဘူး။ အဓိက အချက်ကတော့ ကျွန်တော်တို့မှာ Foundation ခိုင်မာမှု ရှိနေဖို့ပါပဲ။ Junior Developer တစ်ယောက်အနေနဲ့ အခြေခံကို မခိုင်ဘဲ Vibe Coding ကို စောစောစီးစီး သုံးမိရင် ကိုယ့်ရဲ့ Skill ကို ရေရှည်မှာ ထိခိုက်စေနိုင်ပါတယ်။ ဒါကြောင့် အောက်ပါအချက်တွေကို အရင်ဆုံး သေချာနားလည်ထားဖို့လိုပါတယ်။
        </div>
        <hr>
        <h4>⚜️ Foundation ခိုင်မာမှု ရှိဖို့ အရေးကြီးအချက်များ</h4>
        <div class="content-section">
            <ul>
                <li><strong>Software Development ရဲ့ Fundamental Principles</strong> – SOLID, DRY, KISS လိုမျိုး Design Principles တွေရဲ့ သဘောတရားကို အရင်ဆုံး နားလည်ထားရပါမယ်။ Code က ဘာကြောင့် Clean ဖြစ်ရမယ်၊ ဘယ်လို ရေရှည် Maintainance ကောင်းမလဲဆိုတဲ့ အခြေခံကိုသိမှ Vibe နဲ့ ရေးတဲ့ Code ကအဆင်ပြေမှာပါ။</li>
                <li><strong>Feature နဲ့ User Requirement</strong> – ကိုယ်တည်ဆောက်နေတဲ့ Feature တစ်ခုက User ရဲ့ Requirement ကို တကယ်ပြည့်မီရဲ့လား၊ ဒီ Feature ရဲ့ တကယ့်ရည်ရွယ်ချက်က ဘာလဲဆိုတာကို သေချာသိထားရမယ်။</li>
                <li><strong>System Design</strong> – System ရဲ့ Architecture ကို ဘယ်လိုချထားတယ်၊ Data Flow က ဘယ်လိုသွားတယ်၊ Database ကို ဘယ်လိုချိတ်တယ် စတဲ့ System ရဲ့ အလုံးစုံ ပုံစံကို ရေရေလည်လည် နားလည်ထားဖို့ လိုပါတယ်။ ဒီအခြေခံတွေ ရပြီဆိုမှ Vibe Coding ကို အသင့်တော်ဆုံး နေရာမှာ သုံးလို့ရပါပြီ။</li>
            </ul>
        </div>
        <hr>
        <h4>⚜️ Vibe Coding ရဲ့ အဓိက အားသာချက်များ</h4>
        <div class="content-section">
            Vibe Coding ရဲ့ အဓိက အားသာချက်ကတော့ အချိန်ကုန်သက်သာစေခြင်း ပါပဲ။<br>
            "အချိန်ကုန်စေတဲ့၊ ဒါပေမယ့် Priority သိပ်မမြင့်တဲ့ အစိတ်အပိုင်းတွေကို ကျော်ဖြတ်ပြီး၊ တကယ့်ပြဿနာ (Real Problems) တွေ၊ User ရဲ့ Core Requirements တွေနဲ့ System Design ပိုင်းကိုသာ အာရုံစိုက်ဖို့ပါပဲ။"
            <ul>
                <li><strong>CRUD Function တွေ</strong> – Create, Read, Update, Delete ရေးရတဲ့အခါ Boilerplate Code တွေကို အမြန်ဆုံး ဖြတ်ရေးလိုက်တာ။</li>
                <li><strong>Temporary Test Code နဲ့ Mock Data</strong> – Syntax/API အသေးစိတ်ကို လိုက်မကြည့်တော့ဘဲ ကိုယ်သိတဲ့အတိုင်း အရင်ဆုံး ပြီးအောင် ရေးချလိုက်တာ။</li>
                <li><strong>UI Component တွေ</strong> – Basic Style လေးတွေ အမြန်ဆုံး သတ်မှတ်ပြီး၊ Functionality အပေါ် အရင်ဆုံး အာရုံစိုက်လိုက်တာမျိုး။</li>
            </ul>
        </div>
        <hr>
        <div class="content-section">
            ဒီလို Vibe Coding ကိုလုပ်မယ်ဆိုရင် ကျွန်တော်တို့ ဦးနှောက်ရဲ့ will powerနဲ့ attentionကို Application ရဲ့ Logic ပိုင်း၊ Security ပိုင်း၊ Scalability ပိုင်း စတဲ့ တကယ့်ကိုယ်သေချာစဉ်းစားရေးပေး ရှိတဲ့ အလုပ်တွေမှာ အကောင်းဆုံး သုံးနိုင်မှာပါ။<br><br>
            Vibe Coding ဟာ Junior တွေအတွက် အလုပ်တွေကို ကျော်လွှားပြီး၊ ရလဒ်မြန်မြန်ရအောင် ကူညီပေးနိုင်တဲ့ Tool တစ်ခုပါ။ ဒါပေမယ့် ဒီ Tool ကို မသုံးခင်မှာ ကိုင်တွယ်ပုံနဲ့ အခြေခံသဘောတရား တွေကို အရင်ဆုံး လေ့လာထားပြီးမှသုံးသင့်ပါတယ်။ Foundation ကို သေချာဆောက်ပြီးမှ Vibe Coding ကို အသုံးပြုမယ်ဆိုရင် တကယ်မြန်ဆန်၊ ပိုပြီး efficient ဖြစ်တဲ့ System တွေကို တည်ဆောက်နိုင်မှာပါ။
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