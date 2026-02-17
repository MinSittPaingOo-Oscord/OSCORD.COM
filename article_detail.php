<DOCUMENT filename="oscord_faq.php">
<style>
    a {
        color: #e8ffff;
        text-decoration: none;
        transition: all 0.35s ease;
        position: relative;
        font-weight: 400;
    }

    a:hover {
        color: #00f2ff;
        text-shadow: 
            0 0 8px #00f2ff,
            0 0 20px #00f2ff,
            0 0 35px #8000ff,
            0 0 50px #ff00f7;
        transform: translateY(-2px) scale(1.02);
    }

    a::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #00f2ff, #8000ff, #ff00f7);
        box-shadow: 0 0 10px #00f2ff;
        transition: width 0.4s ease;
    }

    a:hover::after {
        width: 100%;
    }

    #oscord-faq-section {
        max-width: 85%;
        margin: 50px auto;
        padding: 20px;
        background-color: transparent;
        padding-top : 50px !important;
        margin-top : 0px !important;
        margin-bottom : 0px !important;
        padding-bottom : 100px !important;
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

    .oscord-faq-question::after,
    .accordion-button::after {
        content: none !important;
        display: none !important;
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
        <div class="col-lg-4 col-md-12 mb-5 mb-lg-0">
            <h1 id="oscord-faq-title">Read Articles</h1>

            <div id="oscord-faq-chat-prompt" class="mt-5">
                <p class="text-dark-subtle fw-bold">We hope you get valuable knowledge for your career by reading these articles.</p>
                <h4 class="mb-3">We’d be happy to chat with you if you have any more questions.</h4>
                <div class="d-flex align-items-center">
                   <a href='https://t.me/oscord_cs' target="_blank"> <img src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png"
                         alt="telegram Icon"
                         id="oscord-faq-chat-icon">
                    </a>
                    <p id="oscord-faq-arrow-indicator" class="ms-3"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12">
            <div id="oscord-faq-search-box">
                <i class="fas fa-search" id="oscord-faq-search-icon"></i>
                <input type="text" id="oscord-faq-search-input" placeholder="What are you looking for?">
            </div>

            <!-- ==================== SINGLE ACCORDION CONTAINER ==================== -->
            <div id="oscord-faq-accordion" class="accordion accordion-flush">

                <!-- Article 1 -->
                <div class="accordion-item oscord-faq-item"
                    data-search-term="Full Stack Web Developer ဖြစ်ဖိုဘာတွေသင်ယူရမလဲ, Web Development, HTML,CSS,JavaScript,PHP,React, Laravel">
                    <h2 class="accordion-header">
                        <a href="article_oscord_webDevelopment.php" 
                        class="oscord-faq-question d-block"
                        style="text-decoration:none; color:inherit; padding:15px 10px; display:block;">
                            Full Stack Web Developer ဖြစ်ဖိုဘာတွေသင်ယူရမလဲ
                        </a>
                    </h2>
                </div>

                <!-- Article 2 -->
                <div class="accordion-item oscord-faq-item"
                    data-search-term="Programming ကိုစတင်လေ့လာတော့မယ်ဆိုရင်ဘာတွေသိထားဖို့လိုအပ်လဲ">
                    <h2 class="accordion-header">
                        <a href="article_oscord_startLearningProgramming.php" 
                        class="oscord-faq-question d-block"
                        style="text-decoration:none; color:inherit; padding:15px 10px; display:block;">
                            Programming ကိုစတင်လေ့လာတော့မယ်ဆိုရင်ဘာတွေသိထားဖို့လိုအပ်လဲ
                        </a>
                    </h2>
                </div>

                <!-- Article 3 -->
                <div class="accordion-item oscord-faq-item"
                    data-search-term="Programmer database">
                    <h2 class="accordion-header">
                        <a href="article_oscord_database.php" 
                        class="oscord-faq-question d-block"
                        style="text-decoration:none; color:inherit; padding:15px 10px; display:block;">
                            Programmer တစ်ယောက်ကဘာလို database ကိုလေ့လာသင်ယူဖိုလိုအပ်တာလဲ
                        </a>
                    </h2>
                </div>

                <!-- Article 4 -->
                <div class="accordion-item oscord-faq-item"
                    data-search-term="Data Science, Machine Learning, AI Engineering, Artificial Engineering">
                    <h2 class="accordion-header">
                        <a href="article_oscord_AI.php" 
                        class="oscord-faq-question d-block"
                        style="text-decoration:none; color:inherit; padding:15px 10px; display:block;">
                            Data Science , Machine Learning နှင့် AI Engineering ဘာသာရပ်များကိုလေ့လာလိုသူများအတွက်
                        </a>
                    </h2>
                </div>

              
                <div class="accordion-item oscord-faq-item"
                    data-search-term="Rest API">
                    <h2 class="accordion-header">
                        <a href="article_oscord_restapi.php" 
                        class="oscord-faq-question d-block"
                        style="text-decoration:none; color:inherit; padding:15px 10px; display:block;">
                        REST API ဆိုတာ ဘာလဲ?
                        </a>
                    </h2>
                </div>


            </div>
            <!-- ==================== END SINGLE ACCORDION ==================== -->
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