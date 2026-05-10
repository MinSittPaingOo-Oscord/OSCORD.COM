<DOCUMENT filename="article_oscord_proxyServer.php">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.what is ProxyServer.com</title>
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
        <h3>🐳⚜️ Proxy Server ဆိုတာ ဘာလဲ?</h3>
        <div class="content-section">
            ပြီးခဲ့တဲ့ရက်က ကျွန်တော်တို့ REST API တွေအကြောင်း ပြောဖြစ်ခဲ့ကြပါတယ်။ API ဆိုတာ Server ရဲ့ Data logic တွေ ဘယ်လိုအလုပ်လုပ်မလဲဆိုတာ သတ်မှတ်ပေးတဲ့ Blueprint တစ်ခုဆိုရင်၊ Proxy Server ဆိုတာကတော့ အပြင်ကလာတဲ့ Request တွေနဲ့ ကိုယ့်ရဲ့ API Server ကြားမှာ ရပ်တည်ပေးနေတဲ့ “Traffic Controller” တစ်ယောက်ပဲ ဖြစ်ပါတယ်။<br><br>
            ရိုးရိုးရှင်းရှင်း ပြောရရင် Proxy ဆိုတာ Client (အသုံးပြုသူ) နဲ့ Target Server (သွားချင်တဲ့ Website) ကြားထဲမှာ ဝင်ရောက်ကြားခံပေးတဲ့ Intermediate Server တစ်ခုပါ။
        </div>
        <hr>
        <h4>⚜️ Proxy ဘယ်လို အလုပ်လုပ်သလဲ?</h4>
        <div class="content-section">
            ပုံမှန် Connection မျိုးမှာ Client က Server ဆီ တိုက်ရိုက်ချိတ်ဆက်ပေမဲ့ Proxy သုံးထားရင်တော့ အဆင့် (၂) ဆင့် ပြောင်းသွားပါတယ်။
            <ol>
                <li><strong>Request ပေးပို့ခြင်း</strong> – Client က Request ကို Proxy Server ဆီ အရင်ပို့ပါတယ်။</li>
                <li><strong>ထပ်ဆင့်ပေးပို့ခြင်း</strong> – Proxy ကမှတစ်ဆင့် ၎င်းရဲ့ ကိုယ်ပိုင် IP Address ကို အသုံးပြုပြီး Target Server ဆီကို Request ကို Forward လုပ်ပေးပါတယ်။</li>
                <li><strong>Response ပြန်ပို့ခြင်း</strong> – Server က ပြန်လာတဲ့ Data (Response) ကိုလည်း Proxy က အရင်လက်ခံပြီးမှ Client ဆီ ပြန်လည်ပေးပို့တာ ဖြစ်ပါတယ်။</li>
            </ol>
        </div>
        <hr>
        <h4>⚜️ Proxy သုံးခြင်းရဲ့အဓိကအကျိုးကျေးဇူးများ</h4>
        <div class="content-section">
            <ul>
                <li><strong>Privacy (ကိုယ်ရေးအချက်အလက်လုံခြုံမှု)</strong> – Client ရဲ့ တကယ့် IP Address ကို Target Server က မသိနိုင်တော့ဘဲ Proxy IP ကိုသာ မြင်ရတဲ့အတွက် အသုံးပြုသူရဲ့ တည်နေရာနဲ့ Identity ကို ဖုံးကွယ်ပေးနိုင်ပါတယ်။</li>
                <li><strong>Security (လုံခြုံရေး)</strong> – မလုံခြုံတဲ့ Website တွေကို ပိတ်ပင်ထားတာမျိုး ဒါမှမဟုတ် အန္တရာယ်ရှိတဲ့ Traffic တွေ Server ထဲမဝင်လာအောင် ရှေ့တန်းကနေ Filter လုပ်ပြီး တားဆီးပေးနိုင်ပါတယ်။</li>
                <li><strong>Caching (မြန်နှုန်းမြှင့်တင်ခြင်း)</strong> – ခဏခဏ တောင်းဆိုလေ့ရှိတဲ့ Data တွေကို Proxy က သိမ်းဆည်း (Cache) ထားပေးပါတယ်။ နောက်တစ်ကြိမ် Request လာတဲ့အခါ Server ဆီအထိ သွားစရာမလိုဘဲ Proxy ကနေ တိုက်ရိုက်ပေးလိုက်တဲ့အတွက် ပိုမိုမြန်ဆန်လာပါတယ်။</li>
            </ul>
        </div>
        <hr>
        <h3>⚜️🔰 Backend Development မှာ သိထားရမယ့် Proxy အမျိုးအစားများ</h3>
        <div class="content-section">
            Developer တစ်ယောက်အနေနဲ့ Forward Proxy နဲ့ Reverse Proxy ရဲ့ ကွာခြားချက်ကို သေချာနားလည်ထားဖို့ လိုအပ်ပါတယ်။
            <ol>
                <li><strong>Forward Proxy (Client-Side Proxy)</strong><br>
                ဒါက Client (အသုံးပြုသူ) ဘက်ကနေ ရပ်တည်ပေးတာပါ။ ဥပမာ - ရုံးလုပ်ငန်းသုံး Network တွေမှာ ဝန်ထမ်းတွေရဲ့ Internet အသုံးပြုမှုကို ထိန်းချုပ်ဖို့နဲ့ Security အတွက် သုံးပါတယ်။ Client က ဘယ်သူမှန်း Server က မသိအောင် လုပ်ပေးတာ ဖြစ်ပါတယ်။</li>
                <li><strong>Reverse Proxy (Server-Side Proxy)</strong><br>
                ဒါကတော့ Backend Developer တွေအတွက် အရေးအကြီးဆုံးအပိုင်းပါ။ <a href="https://nodejs.org" target="_blank">Node.js</a> ဒါမှမဟုတ် အခြား Web Server တွေရဲ့ ရှေ့ဆုံးမှာ <a href="https://nginx.org" target="_blank">Nginx</a> သို့မဟုတ် <a href="https://httpd.apache.org" target="_blank">Apache</a> တို့ကို Reverse Proxy အဖြစ် ထားလေ့ရှိပါတယ်။ သူက အောက်ပါအတိုင်း အကူအညီပေးပါတယ် -
                    <ul>
                        <li><strong>Load Balancing</strong> – Request တွေ အများကြီးဝင်လာရင် Server အများအပြားဆီကို ဝန်ခွဲဝေပေးပြီး Server မကျအောင် ထိန်းပေးပါတယ်။</li>
                        <li><strong>SSL Termination</strong> – HTTPS အတွက် Certificate တွေကို Reverse Proxy မှာပဲ သတ်မှတ်ပေးထားလို့ နောက်ကွယ်က Main Server က ပိုမိုပေါ့ပါးစွာ အလုပ်လုပ်နိုင်ပါတယ်။</li>
                        <li><strong>Security</strong> – API Server ရဲ့ တကယ့် IP နဲ့ Structure ကို အပြင်လူတွေ တိုက်ရိုက်မမြင်ရအောင် ကာကွယ်ပေးထားပါတယ်။</li>
                    </ul>
                Forward Proxy က Client ကို ကာကွယ်ပေးပြီး၊ Reverse Proxy ကတော့ Server (Backend) ကို ကာကွယ်ပေးတာ ဖြစ်ပါတယ်။ ခေတ်မီတဲ့ Backend Architecture တိုင်းမှာ Reverse Proxy ဆိုတာ မရှိမဖြစ် လိုအပ်တဲ့ Component တစ်ခုပဲ ဖြစ်ပါတယ်။
            </ol>
        </div>
        <hr>
        <div class="content-section">
            ဒါဆိုရင် Proxy Server အကြောင်းကို နားလည်သင့်သလောက်နားလည်သွားပြီလို့ ယူဆပါတယ်ခင်ဗျာ။<br><br>
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
</DOCUMENT>
