<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>oscord.what is SSH.com</title>
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
        <h3>🐳⚜️ SSH ဆိုတာဘာလဲ?</h3>
        <div class="content-section">
            SSH (Secure Shell) ဆိုတာကတော့ Secure Shell Protocol လို့ ခေါ်ဆိုပါတယ်။<br>
            နာမည်မှာ ပါတဲ့အတိုင်းပဲ၊ Network ပေါ်မှာ လုံခြုံစိတ်ချရတဲ့ Secure ဖြစ်တဲ့ Remote Connection တွေ ပြုလုပ်နိုင်ဖို့အတွက် သတ်မှတ်ထားတဲ့ Protocol တစ်ခု ဖြစ်ပါတယ်။
        </div>
        <hr>
        <h4>⚜️ SSH ရဲ့ တန်ဖိုး (Value)</h4>
        <div class="content-section">
            SSH ရဲ့ တန်ဖိုး (Value) ကတော့ Client နဲ့ Server ကြားမှာ ဖြစ်ပေါ်တဲ့ Communication တွေ အားလုံးကို Cryptographic Methods တွေ သုံးပြီး Encrypt လုပ်ပေးလိုက်တာပဲ ဖြစ်ပါတယ်။<br>
            ကျွန်တော်တို့ Terminal ကနေ Command တစ်ခုခု ပေးပို့တာပဲဖြစ်ဖြစ်၊ Server ကနေ ပြန်ပို့တာပဲဖြစ်ဖြစ် ကြားဖြတ်ဖမ်းယူတာမျိုး မဖြစ်နိုင်အောင် ကာကွယ်ပေးထားတာ ဖြစ်ပါတယ်။
        </div>
        <hr>
        <h4>⚜️ Backend Development မှာ SSH ရဲ့ အသုံးပြုမှု</h4>
        <div class="content-section">
            ပြီးတော့လည်း ကျွန်တော်တို့ Node.js Backend Application တွေ၊ API တွေကို Production Server တွေမှာ Deploy လုပ်ပြီး Manage လုပ်ရတဲ့အခါမှာ မရှိမဖြစ် အသုံးပြုရပါတယ်။<br>
            ကျွန်တော်တို့ Local Development ကနေ Remote Server ပေါ်မှာရှိတဲ့ Backend Application ကို ချိတ်ဆက်ဖို့အတွက် SSH ကို အသုံးပြုရပါတယ်။
        </div>
        <hr>
        <h3>⚜️🔰 File Transfer နဲ့ System Administration အတွက် SSH</h3>
        <div class="content-section">
            Code တွေ၊ Node modules တွေကို Server ပေါ်ကို လုံလုံခြုံခြုံ ကူးပြောင်းဖို့အတွက် SCP (Secure Copy) ဒါမှမဟုတ် SFTP (SSH File Transfer Protocol) လိုမျိုး SSH နဲ့ တွဲဖက်အသုံးပြုတဲ့ Tools တွေကို သုံးစွဲရပါတယ်။<br>
            Server မှာ Application ကို Start, Stop, Restart တွေ လုပ်ဆောင်ဖို့၊ Package အသစ်တွေ Install လုပ်ဖို့နဲ့ Dependency တွေ Update လုပ်ဖို့ စတဲ့ System Administration အလုပ်တွေ အများကြီးကို SSH Terminal ကနေပဲ Remote အနေနဲ့ လုပ်ဆောင်လို့ ရပါတယ်။
        </div>
        <hr>
        <h4>⚜️ Server Security နဲ့ SSH</h4>
        <div class="content-section">
            ကျွန်တော်တို့ရဲ့ Backend Application တွေဟာ Sensitive Data တွေနဲ့ Interaction လုပ်ရတဲ့အတွက် Server Security က တော်တော်လေး အရေးကြီးပါတယ်။<br>
            Key-Based Authentication အနေနဲ့ Node.js Backend တွေ ထားရှိတဲ့ Server တွေမှာ Password ထက် SSH Keypair ဖြစ်တဲ့ Public Key နဲ့ Private Key တွေကို အသုံးပြုပြီး ဝင်ရောက်တာက Standard Security Practice တစ်ခု ဖြစ်လာပါတယ်။<br>
            အဲ့ဒါမှသာ Brute-force attack တွေကနေ ပိုမိုကာကွယ်နိုင်ပြီး Server Access ကို ပိုမိုကောင်းမွန် စိတ်ချရစေမှာ ဖြစ်ပါတယ်။
        </div>
        <hr>
        <div class="content-section">
            အဆုံးသတ်ရရင်တော့ SSH ဟာ Application ရဲ့ Code တွေမှာ တိုက်ရိုက်ကြီး ပါဝင်ပတ်သက်နေတာမျိုး မဟုတ်ပေမဲ့ ကျွန်တော်တို့ Backend Infrastructure ရဲ့ အမြဲတမ်း ယုံကြည်စိတ်ချရတဲ့ Gateway (Trusted Gateway) တစ်ခု ဖြစ်နေပါတယ်။<br>
            ဒါဆိုရင် SSH အကြောင်းကို နားလည်သင့်သလောက်နားလည်သွားပြီလို့ယူဆပါတယ်ခင်ဗျာ
        </div>
        <hr>
        <div class="content-section">
            Author Name - Instructor Min Thu Khaing<br>
            Content Series - Journey with Moriarty
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
            }, { threshold: 0 }); // Removed threshold to trigger on any visibility

            document.querySelectorAll('.main').forEach(el => {
                // Remove initial hide, let CSS animation handle fade-in
                el.classList.add('animate-on-scroll');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>