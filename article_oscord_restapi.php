<?php include "nav.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API | Journey with Moriarty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --dark-bg: #0a0a0a;
            --glass-bg: rgba(28, 37, 38, 0.7);
        }

        body {
            background: linear-gradient(135deg, #0a0a0a, #161d1e);
            color: #e6e6e6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-container {
            margin: 60px 50px;
            max-width: 100%;
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Hero Header Section */
        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.8rem;
            color: #fff;
            text-shadow: 0 0 20px rgba(0, 242, 255, 0.6);
            margin-bottom: 60px;
            letter-spacing: 3px;
            text-align: left;
        }

        /* Content Blocks with High Vertical Spacing */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 242, 255, 0.15);
            border-radius: 15px;
            padding: 50px;
            margin-bottom: 70px; /* High vertical separation */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        h4 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            font-size: 1.6rem;
            margin-bottom: 45px;
            text-transform: uppercase;
        }

        .text-content {
            font-size: 1.2rem;
            line-height: 2.6; /* Extra far vertical line height */
            color: #d0d0d0;
            font-family: 'Inter', sans-serif;
        }

        /* REST Method Highlighting */
        .method-row {
            display: flex;
            align-items: center;
            margin-bottom: 35px; /* Vertical gap between items */
            padding: 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            transition: all 0.3s ease;
        }

        .method-row:hover {
            background: rgba(0, 242, 255, 0.08);
            transform: translateX(10px);
        }

        .badge-cyan {
            background: var(--neon-cyan);
            color: #000;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            padding: 8px 20px;
            min-width: 110px;
            text-align: center;
            border-radius: 5px;
            margin-right: 25px;
            box-shadow: 0 0 15px var(--neon-cyan);
        }

        /* Footer Aesthetics */
        .author-box {
            border-left: 3px solid var(--neon-cyan);
            padding-left: 25px;
            margin-top: 100px;
            font-family: 'Orbitron', sans-serif;
            opacity: 0.8;
            line-height: 2.2;
        }

        .author-label { color: var(--neon-cyan); font-size: 0.9rem; }
        .author-name { font-size: 1.2rem; display: block; }

        @media (max-width: 768px) {
            .main-container { margin: 30px 20px; }
            .hero-title { font-size: 1.8rem; }
            .glass-card { padding: 30px; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        
        <h3 class="hero-title">🐳⚜️ REST API ဆိုတာဘာလဲ?</h3>

        <div class="glass-card">
            <div class="text-content">
                REST API ဆိုတာက ရိုးရိုးလေးပြောရရင် Mobile App ဒါမှမဟုတ် Website နဲ့ Data တွေသိမ်းထားတဲ့ Server ကြားမှာ 
                <strong>စကားပြန်သဖွယ် ချိတ်ဆက်ပေးတဲ့ လမ်းကြောင်းတစ်ခု</strong> ဖြစ်ပါတယ်...
                <br><br>
                ဥပမာပြောရရင် Facebook App ကနေ Post တစ်ခု တင်လိုက်တဲ့အခါ အဲ့ဒီ Post ထဲကစာတွေ၊ ပုံတွေကို Server ဆီရောက်သွားအောင် 
                ဒီ API ကပဲ လမ်းကြောင်းဖွင့်ပြီး ပို့ပေးလိုက်တာမျိုးပါ။
            </div>
        </div>

        

        <div class="glass-card">
            <h4>⚜️ သူက ဘယ်လိုအလုပ်လုပ်တာလဲ?</h4>
            <div class="text-content">
                REST API က Web လောကမှာ အသုံးအများဆုံးဖြစ်တဲ့ <strong>HTTP စနစ်</strong>ပေါ်မှာ အခြေခံထားတာ ဖြစ်ပါတယ်။ 
                အောက်ပါ အချက် ၂ ချက်ကိုပဲ သိထားရင် တော်တော်လေး ပြည့်စုံသွားပါပြီ။
                
                <div style="margin-top: 50px;">
                    <p style="color: var(--neon-cyan); font-weight: bold;">No 1 - URL နဲ့ လှမ်းတောင်းတာ</p>
                    ကိုယ်လိုချင်တဲ့ Data တစ်ခုချင်းစီကို Resource လို့ ခေါ်ပြီး သူတို့မှာ သီးသန့် URL လိပ်စာလေးတွေ ရှိပါတယ်။ 
                    <em>ဥပမာ- yourserver.com/api/users လို့ ပြောလိုက်ရင် User စာရင်းကို လှမ်းညွှန်းလိုက်တာပါပဲ။</em>
                </div>

                <div style="margin-top: 50px;">
                    <p style="color: var(--neon-cyan); font-weight: bold; margin-bottom: 30px;">No 2 - Method တွေနဲ့ ခိုင်းတာ</p>
                    
                    <div class="method-row">
                        <span class="badge-cyan">GET</span>
                        <span>Server ဆီက Data တွေ ဖတ်ကြည့်ဖို့ သုံးပါတယ်</span>
                    </div>
                    
                    <div class="method-row">
                        <span class="badge-cyan">POST</span>
                        <span>Data အသစ်တွေ ထည့်ဖို့ သုံးပါတယ်</span>
                    </div>
                    
                    <div class="method-row">
                        <span class="badge-cyan">PUT</span>
                        <span>ရှိပြီးသား Data ကို ပြန်ပြင်ဖို့ သုံးပါတယ်</span>
                    </div>
                    
                    <div class="method-row">
                        <span class="badge-cyan">DELETE</span>
                        <span>မလိုတော့တဲ့ Data ကို ဖျက်ပစ်ဖို့ သုံးပါတယ်</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <h4>⚜️ ဘာလို့ ဒါကို သုံးကြတာလဲ?</h4>
            <div class="text-content">
                <p>🚀 <strong>သုံးရတာ အင်မတန် ရိုးရှင်းတယ်</strong> - စနစ်တွေ အများကြီးကြားမှာ ချိတ်ဆက်ရတာ လွယ်ကူစေပါတယ်။</p>
                <p>🛠️ <strong>စနစ်တကျ ရှိစေတယ်</strong> - Code ရေးတဲ့အခါ Standard တစ်ခုရှိနေတော့ တခြားသူတွေ ဖတ်ရင်လည်း နားလည်ရလွယ်တဲ့ Clean Code တွေ ဖြစ်လာတာပါ။</p>
                <p>📱 <strong>ကိုယ်ပိုင် App တစ်ခု အတွက် မရှိမဖြစ်ပါပဲ</strong> - ကိုယ့် App ထဲမှာ Data တွေ လိုချင်တာပဲဖြစ်ဖြစ်၊ App ကနေ Data ပို့ချင်တာပဲဖြစ်ဖြစ် ဒီ API လမ်းကြောင်းကို ဖန်တီးရမှာဖြစ်ပါတယ်။</p>
                
                <p style="text-align: center; color: var(--neon-cyan); margin-top: 60px; font-weight: 600;">
                    ဒါဆိုရင် RestAPI အကြောင်းကို နားလည်သင့်သလောက် နားလည်သွားပြီလို့ ယူဆပါတယ်ခင်ဗျာ။
                </p>
            </div>
        </div>

        <div class="author-box">
            <span class="author-label">AUTHOR</span>
            <span class="author-name">Instructor Min Thu Khaing</span>
            <span class="author-label" style="margin-top: 15px; display: block;">SERIES</span>
            <span class="author-name" style="font-size: 1rem;">Journey with Moriarty</span>
        </div>
    </div>

</body>
</html>