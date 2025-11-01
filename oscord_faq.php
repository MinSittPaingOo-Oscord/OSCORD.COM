<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* ------------------------------------------------------------------ */
        /* --- FAQ Section Custom Styles --- */
        /* ------------------------------------------------------------------ */

        .faq-section {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the section */
        }

        /* Title Styling */
        .faq-title {
            font-size: 3.5rem; /* Large, bold title */
            font-weight: 800;
            color: #000000;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        /* Chat Prompt Styling (Left Column) */
        .faq-chat-prompt {
            font-family: Arial, sans-serif;
            max-width: 300px;
        }

        .faq-chat-prompt h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000000;
        }

        .faq-chat-prompt .text-dark-subtle {
            color: #6c757d !important;
        }

        .chat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #1a73e8; /* Blue background matching the image */
            padding: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .arrow-indicator::before {
            content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='none' d='M0 0h24v24H0z'/%3E%3Cpath d='M12 2L10.59 3.41 15.17 8H4v2h11.17l-4.58 4.59L12 17l7-7-7-7z' fill='%23000000'/%3E%3C/svg%3E");
            display: inline-block;
            width: 50px;
            height: 50px;
            transform: rotate(145deg); /* Adjusted to look like the arrow in the image */
            position: relative;
            top: -15px;
            left: -10px;
        }


        /* Search Bar Styling */
        .faq-search-box {
            border-bottom: 1px solid #dee2e6; /* Light gray line */
        }

        .faq-search-input {
            border: none;
            padding-left: 40px;
            padding-right: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 1rem;
            color: #343a40;
            background-color: transparent;
            border-radius: 0;
        }

        .faq-search-input:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .faq-search-input::placeholder {
            color: #adb5bd;
            font-weight: 500;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.1rem;
        }

        /* Accordion Styling */
        .faq-accordion {
            --bs-accordion-border-width: 1px;
            --bs-accordion-border-color: #e9ecef; /* Very light line for separation */
            --bs-accordion-bg: transparent;
            --bs-accordion-color: #000000;
            font-family: Arial, sans-serif;
        }

        .faq-item {
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid #e9ecef; /* Ensure visual separation between items */
        }

        .faq-question {
            font-size: 1.1rem;
            font-weight: 600;
            padding: 15px 10px;
            color: #000000; /* Question text color */
        }

        /* FIX: Hide default Bootstrap chevron and implement custom one */
        .faq-question::after {
            background-image: none !important; /* HIDES THE DEFAULT BOOTSTRAP SVG */
            content: '\2304'; /* Unicode for chevron down/up */
            font-size: 1.5rem;
            font-weight: 900;
            transform: rotate(0deg);
            transition: transform 0.2s ease-in-out;
            color: #000000; /* Color for collapsed state (black) */
        }

        .faq-question:not(.collapsed)::after {
            transform: rotate(180deg);
            color: #1a73e8; /* Color for expanded state (blue) */
        }
        /* END FIX */

        .faq-question:not(.collapsed) {
            color: #000000;
            background-color: transparent;
            box-shadow: none;
        }

        .accordion-body.faq-answer {
            padding-top: 0;
            padding-bottom: 20px;
            color: #6c757d; /* Answer text color */
            font-size: 1rem;
            line-height: 1.6;
            padding-left: 15px;
        }

        .faq-answer p {
            margin-bottom: 8px; /* Spacing between Burmese paragraphs */
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .faq-title {
                font-size: 2.5rem;
            }
            .faq-chat-prompt {
                text-align: center;
                max-width: 100%;
            }
            .faq-chat-prompt .d-flex {
                justify-content: center;
            }
            .arrow-indicator {
                display: none; /* Hide complex arrow on small screen */
            }
        }
    </style>
</head>
<body>

<section class="faq-section container py-5 my-5">
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-5 mb-lg-0">
            <h1 class="faq-title">Frequently Asked Questions</h1>
            
            <div class="faq-chat-prompt mt-5">
                <p class="text-dark-subtle fw-bold">Can't find what you are looking for?</p>
                <h4 class="mb-3">We would like to chat with you.</h4>
                <div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3400/3400624.png" alt="Chat Icon" class="chat-icon">
                    <p class="arrow-indicator ms-3"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12">
            
            <div class="faq-search-box mb-4 position-relative">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="faqSearchInput" class="form-control faq-search-input" placeholder="What are you looking for?">
            </div>

            <div class="accordion accordion-flush faq-accordion" id="faqAccordion">

                <div class="accordion-item faq-item" data-search-term="Oscord မှာ Beginner တွေအတွက် ဘာသင်တန်းတွေရှိလဲ Java Python">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Oscord မှာ Beginner တွေအတွက် ဘာသင်တန်းတွေရှိလဲ
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body faq-answer">
                            <p>Oscord မှာ Programming စတင်လေ့လာမည့်သူများအတွက် Java Programming အတန်းနှင့် Python Programming (Basic to Advanced) အတန်းများရှိပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item" data-search-term="Web Development Course React Laravel Project Full Stack">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Web Development ကိုအခြေခံမှစ၍ Project Development Level အထိသင်ယူချင်ရင် ဘယ် Course တွေကိုတက်ရောက်သင့်ပါသလဲ
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body faq-answer">
                            <p>Oscord မှာ Web Development အတွက် Full Stack Developer Class လေးကနေစပြီးတက်ရောက်လိုရပါတယ်</p>
                            <p>Full Stack အတန်းလေးပြီးရင် React + Laravel အတန်းလေး ထပ်မံတက်ရောက်နိုင်ပါတယ်</p>
                            <p>ဒါတွေတက်ရောက်ပြီးပြီဆိုရင်တော့ Web Development အတွက် ခိုင်လုံတဲ့ Project Development Skill တွေကိုရရှိလာမှာဖြစ်ပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item faq-item" data-search-term="Certificate သင်တန်းပြီးရင် ပေးပါသလား Assignment Exam">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            သင်တန်းပြီးရင် Certificate ပေးပါသလား
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body faq-answer">
                            <p>မိမိတက်ရောက်သည့် အတန်းမှာ သတ်မှတ်ထားတဲ့ Assignment, Exam နှင့် Project တွေ Complete ဖြစ်ပြီး Instructor တွေဘက်မှလည်း သက်ဆိုင်ရာ Course ရဲ့အရည်အချင်းပြည့်မှီသည်ဟု ထောက်ခံချက်ပါပါက Digital Certificate လေး ပေးပါတယ်နော်</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item faq-item" data-search-term="By One အတန်း အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား Time Zone">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed faq-question" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            By One အတန်းအတွက်အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body faq-answer">
                            <p>By One အတန်းတိုင်းအတွက် အတန်းချိန်များညှိနှိင်းပေးပါတယ်</p>
                            <p>ဒါ့ကြောင့်လဲ Oscord မှာ မြန်မာ ထိုင်း ကိုရီးယား ဂျပန် စင်ကာပူစသည့် အရှေ့တိုင်းနိုင်ငံများမှ ကျောင်းသားများသာမက Finland, Sweland, USA စသည့် Time Zone မတူသည့်အနောက်တိုင်းနိုင်ငံများမှ ကျောင်းသားများကိုလည်း အဆင်ပြေအောင်သေချာလေးအချိန်ညှိပေးတဲ့အတွက် သင်တန်းများလာရောက် တက်ကြပါတယ်ခင်ဗျာ</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('faqSearchInput');
    const faqItems = document.querySelectorAll('.faq-item');

    searchInput.addEventListener('keyup', function (e) {
        const searchTerm = e.target.value.toLowerCase().trim();

        faqItems.forEach(item => {
            const questionText = item.querySelector('.faq-question').textContent.toLowerCase();
            // Use data-search-term for broader matching, including English keywords
            const searchData = item.getAttribute('data-search-term').toLowerCase();

            if (questionText.includes(searchTerm) || searchData.includes(searchTerm)) {
                item.style.display = 'flex'; 
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

</body>
</html>