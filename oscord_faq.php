<DOCUMENT filename="oscord_faq.php">
<style>
    #oscord-faq-section {
        max-width: 85%;
        margin: 50px auto;
        padding: 20px;
        background-color: transparent;
        margin-top : -50px !important;

    }

    #oscord-faq-title {
        font-size: 3.5rem;
        font-weight: 800;
        color:rgb(255, 255, 255);
        line-height: 1.4;
        margin-bottom: 20px;
    }

    #oscord-faq-chat-prompt {
        font-family: Arial, sans-serif;
        max-width: 300px;
    }

    #oscord-faq-chat-prompt h4 {
        font-size: 1.3rem;
        font-weight: 500;
        color:rgb(255, 255, 255);
    }

    #oscord-faq-chat-prompt .text-dark-subtle {
        color:rgb(253, 253, 253) !important;
    }

    #oscord-faq-chat-icon {
        width: 30%;
        height: 30%;
        border-radius: 50%;
        background-color:transparent;
        padding: 10px;
    }

    #oscord-faq-arrow-indicator::before {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M12 2L10.59 3.41 15.17 8H4v2h11.17l-4.58 4.59L12 17l7-7-7-7z' fill='%23000000'/%3E%3C/svg%3E");
        display: inline-block;
        width: 50px;
        height: 50px;
        transform: rotate(145deg);
        position: relative;
        top: -15px;
        left: -10px;
    }

    #oscord-faq-search-box {
        border-bottom: 1px solid #dee2e6;
        position: relative;
        margin-bottom: 1.5rem;
    }

    #oscord-faq-search-input {
        border: none;
        padding: 10px 15px 10px 40px;
        font-size: 1rem;
        color:rgb(255, 255, 255);
        background-color: transparent;
        border-radius: 0;
        width: 100%;
    }

    #oscord-faq-search-input:focus {
        outline: none;
        box-shadow: none;
    }

    #oscord-faq-search-input::placeholder {
        color:rgb(255, 255, 255);
        font-weight: 500;
    }

    #oscord-faq-search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color:rgb(255, 255, 255);
        font-size: 1.1rem;
    }

    #oscord-faq-accordion {
        --bs-accordion-border-width: 1px;
        --bs-accordion-border-color: transparent;
        --bs-accordion-bg: transparent;
        --bs-accordion-color:rgb(255, 255, 255);
        font-family: Arial, sans-serif;
    }

    .oscord-faq-item {
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid #e9ecef;
    }

    .oscord-faq-question {
        font-size: 1rem;
        font-weight: 500;
        padding: 15px 10px;
        line-height: 40px;
        color:rgb(255, 255, 255);
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        position: relative;
    }

    .oscord-faq-question::after {
        content: '\2304';
        font-size: 1rem;
        font-weight: 600;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%) rotate(0deg);
        transition: transform 0.2s ease-in-out;
        color:rgb(255, 255, 255);
        background-image: none;
    }

    .oscord-faq-question[aria-expanded="true"]::after {
        transform: translateY(-50%) rotate(180deg);
        color:rgb(255, 255, 255);
        background : transparent;
    }

    .oscord-faq-question[aria-expanded="true"] {
    background-color: transparent !important;
    color: rgb(255, 255, 255) !important;
}

.oscord-faq-question[aria-expanded="true"]::after {
    transform: translateY(-50%) rotate(180deg);
    color: rgb(255, 255, 255) !important;
}

    .oscord-faq-answer {
        padding: 0 15px 20px 15px;
        color:rgb(255, 255, 255);
        font-size: 0.9rem;
        line-height: 40px;
    }

    .oscord-faq-answer p {
        margin-bottom: 8px;
    }

    .oscord-faq-item .accordion-button:not(.collapsed) {
        background-color: transparent !important;
        box-shadow: none !important;
    }

    .oscord-faq-answer {
        background-color: transparent !important;
    }

    .oscord-faq-item {
        border-bottom: 1px solid #e9ecef;
        background-color: transparent;
    }

#oscord-faq-accordion .accordion-item,
#oscord-faq-accordion .accordion-body,
#oscord-faq-accordion .accordion-button {
    background-color: transparent !important;
}

    @media (max-width: 768px) {
        #oscord-faq-title {
            font-size: 2.5rem;
            justify-content: center;
        }
        #oscord-faq-chat-prompt {
            text-align: center;
            max-width: 100%;
        }
        #oscord-faq-chat-prompt .d-flex {
            justify-content: center;
        }
        #oscord-faq-arrow-indicator {
            display: none;
        }
    }
</style>

<section id="oscord-faq-section" class="container py-5 my-5">
    <div class="row">
        <!-- Left Column: Title + Chat Prompt -->
        <div class="col-lg-4 col-md-12 mb-5 mb-lg-0">
            <h1 id="oscord-faq-title">Frequently Asked Questions</h1>

            <div id="oscord-faq-chat-prompt" class="mt-5">
                <p class="text-dark-subtle fw-bold">Can't find what you are looking for?</p>
                <h4 class="mb-3">We would like to chat with you.</h4>
                <div class="d-flex align-items-center">
                   <a href='https://t.me/oscord_cs' target="_blank"> <img src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png"
                         alt="telegram Icon"
                         id="oscord-faq-chat-icon">
                    </a>
                    <p id="oscord-faq-arrow-indicator" class="ms-3"></p>
                </div>
            </div>
        </div>

        <!-- Right Column: Search + Accordion -->
        <div class="col-lg-8 col-md-12">
            <div id="oscord-faq-search-box">
                <i class="fas fa-search" id="oscord-faq-search-icon"></i>
                <input type="text" id="oscord-faq-search-input" placeholder="What are you looking for?">
            </div>

            <div id="oscord-faq-accordion" class="accordion accordion-flush">

                <div class="accordion-item oscord-faq-item"
                     data-search-term="Oscord မှာ Beginner တွေအတွက် ဘာသင်တန်းတွေရှိလဲ Java Python">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseOne"
                                aria-expanded="false"
                                aria-controls="oscordCollapseOne">
                            Oscord မှာ Beginner တွေအတွက် ဘာသင်တန်းတွေရှိလဲ
                        </button>
                    </h2>
                    <div id="oscordCollapseOne" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>Oscord မှာ Programming စတင်လေ့လာမည့်သူများအတွက် Java Programming အတန်းနှင့် Python Programming (Basic to Advanced) အတန်းများရှိပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item oscord-faq-item"
                     data-search-term="Web Development Course React Laravel Project Full Stack">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseTwo"
                                aria-expanded="false"
                                aria-controls="oscordCollapseTwo">
                            Web Development ကိုအခြေခံမှစ၍ Project Development Level အထိသင်ယူချင်ရင် ဘယ် Course တွေကိုတက်ရောက်သင့်ပါသလဲ
                        </button>
                    </h2>
                    <div id="oscordCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>Oscord မှာ Web Development အတွက် Full Stack Developer Class လေးကနေစပြီးတက်ရောက်လိုရပါတယ်
                            Full Stack အတန်းလေးပြီးရင် React + Laravel အတန်းလေး ထပ်မံတက်ရောက်နိုင်ပါတယ်
                            ဒါတွေတက်ရောက်ပြီးပြီဆိုရင်တော့ Web Development အတွက် ခိုင်လုံတဲ့ Project Development Skill တွေကိုရရှိလာမှာဖြစ်ပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item oscord-faq-item"
                     data-search-term="Certificate သင်တန်းပြီးရင် ပေးပါသလား Assignment Exam">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseThree"
                                aria-expanded="false"
                                aria-controls="oscordCollapseThree">
                            သင်တန်းပြီးရင် Certificate ပေးပါသလား
                        </button>
                    </h2>
                    <div id="oscordCollapseThree" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>မိမိတက်ရောက်သည့် အတန်းမှာ သတ်မှတ်ထားတဲ့ Assignment, Exam နှင့် Project တွေ Complete ဖြစ်ပြီး Instructor တွေဘက်မှလည်း သက်ဆိုင်ရာ Course ရဲ့အရည်အချင်းပြည့်မှီသည်ဟု ထောက်ခံချက်ပါပါက Digital Certificate လေး ပေးပါတယ်နော်</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item oscord-faq-item"
                     data-search-term="By One အတန်း အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား Time Zone">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseFour"
                                aria-expanded="false"
                                aria-controls="oscordCollapseFour">
                            By One အတန်းအတွက်အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား
                        </button>
                    </h2>
                    <div id="oscordCollapseFour" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>By One အတန်းတိုင်းအတွက် အတန်းချိန်များညှိနှိင်းပေးပါတယ်</p>
                            <p>ဒါ့ကြောင့်လဲ Oscord မှာ မြန်မာ ထိုင်း ကိုရီးယား ဂျပန် စင်ကာပူစသည့် အရှေ့တိုင်းနိုင်ငံများမှ ကျောင်းသားများသာမက Finland, Sweland, USA စသည့် Time Zone မတူသည့်အနောက်တိုင်းနိုင်ငံများမှ ကျောင်းသားများကိုလည်း အဆင်ပြေအောင်သေချာလေးအချိန်ညှိပေးတဲ့အတွက် သင်တန်းများလာရောက် တက်ကြပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                
                <div class="accordion-item oscord-faq-item"
                     data-search-term="By One အတန်း အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား Time Zone">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseFive"
                                aria-expanded="false"
                                aria-controls="oscordCollapseFive">
                                Data Science နှင့် Machine Learning Career အတွက် ဘယ် Course လေးတွေတတ်ရောက်သင့်ပါသလဲ
                        </button>
                    </h2>
                    <div id="oscordCollapseFive" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>Data Science, Machine Learning  နှင့် AI  modal engineering ပညာရပ်များအတွက် Oscord မှာ Python Programming (Basic to Advanced), Data Science Essential အတန်းများနှင့် Applied Mathematics အတန်းလေးများရှိပါတယ်
                            မကြာမှီမှာ Machine Learning (Basic to Advanced) အတန်း နှင့် Big Data Analytics အတန်းများလည်း အတန်းသစ်များဖွင့်လှစ်ဖိုရှိပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item oscord-faq-item"
                     data-search-term="By One အတန်း အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား Time Zone">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed oscord-faq-question"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#oscordCollapseSix"
                                aria-expanded="false"
                                aria-controls="oscordCollapseSix">
                                သင်တန်းကြေးက တစ်လချင်းသွင်းရတာလား
                        </button>
                    </h2>
                    <div id="oscordCollapseSix" class="accordion-collapse collapse" data-bs-parent="#oscord-faq-accordion">
                        <div class="accordion-body oscord-faq-answer">
                            <p>သင်တန်းကြေးက တစ်လချင်းသွင်းတာမျိုးမဟုတ်ပါခင်ဗျာ သက်ဆိုင်ရာ Course အတွက် သတ်မှတ်ထားသော သင်တန်းကြေးမှာ Course အစမှအဆုံးထိ အပြီးအစီးဖြစ်ပါတယ် Course ပြီးဆုံးဖိုအတွက်သတ်မှတ်ကာလမရှိပါ
                            Course ပြီးသည်အထိ Instructor များဘက်မှ အချိန်ကာလမည့်မျှကြာသည်ဖြစ်စေ သင်ကြားပေးမှာဖြစ်ပါတယ်နော်</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('oscord-faq-search-input');
        const faqItems = document.querySelectorAll('.oscord-faq-item');

        searchInput.addEventListener('keyup', function (e) {
            const searchTerm = e.target.value.toLowerCase().trim();

            faqItems.forEach(item => {
                const questionText = item.querySelector('.oscord-faq-question').textContent.toLowerCase();
                const searchData = item.getAttribute('data-search-term').toLowerCase();

                if (questionText.includes(searchTerm) || searchData.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script></DOCUMENT>