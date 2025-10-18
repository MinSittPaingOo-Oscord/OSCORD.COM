<?php
// Include database connection if needed for dynamic data
include "connectdb.php";
?>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>

   
    #footer-wrapper {
        margin-top : 90px;
        font-family: 'Inter', sans-serif;
    }

    #footer-wrapper #homeConclusion {
        background: rgba(10, 10, 10, 0.95);
        padding: 40px 0;
        color: #e6e6e6;
        position: relative;
        z-index: 1;
    }

    @keyframes footerFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes footerNeonGlow {
        0%, 100% { box-shadow: 0 0 5px #00f2ff, 0 0 15px #00f2ff, 0 0 30px #00f2ff; }
        50% { box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 40px #00f2ff; }
    }

    #footer-wrapper #footer-contact-form {
        background: #2a2a2a;
        padding: 30px;
        margin: 30px auto;
        max-width: 400px;
        height : auto;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
        position: relative;
        z-index: 1;
        opacity: 1; /* Ensure form is visible by default */
    }

    #footer-wrapper #footer-contact-form.footer-animate.animate {
        animation: footerFadeIn 0.8s ease-out forwards;
    }

    #footer-wrapper #footer-contact-form h2 {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.4rem;
        font-weight: 400;
        text-align: center;
        margin-bottom: 20px;
        color: #ffffff;
        text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
    }

    #footer-wrapper #footer-contact-form label {
        font-size: 1rem;
        font-weight: 300;
        margin-bottom: 5px;
        display: block;
        color: #d0d0d0;
    }

    #footer-wrapper #footer-contact-form input,
    #footer-wrapper #footer-contact-form textarea {
        width: 90%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #555;
        background: #333;
        color: #e6e6e6;
        margin-bottom: 15px;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    #footer-wrapper #footer-contact-form input:focus,
    #footer-wrapper #footer-contact-form textarea:focus {
        border-color: #ff00ff;
        box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        outline: none;
    }

    #footer-wrapper #footer-contact-form #footer-submit-btn {
        background: #ff00ff;
        border: none;
        padding: 12px;
        border-radius: 50px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 300;
        color: #ffffff;
        width: 90%;
        transition: background 0.3s ease, transform 0.3s ease;
        animation: footerNeonGlow 2s infinite;
    }

    #footer-wrapper #footer-contact-form #footer-submit-btn:hover {
        background: #00f2ff;
        color: #0a0a0a;
        transform: scale(1.05);
    }

    #footer-wrapper #footer-quick-links {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 20px;
        color: #ffffff;
        text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
    }

    #footer-wrapper #footer-quick-links i {
        font-size: 1rem;
        color: #00f2ff;
        margin-right: 8px;
        vertical-align: middle;
    }

    #footer-wrapper #footer-links a {
        color: #00f2ff;
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    #footer-wrapper #footer-links a:hover {
        color: #ffffff;
        text-shadow: 0 0 10px #00f2ff;
    }

    #footer-wrapper #footer-last {
        background: #111;
        padding: 20px 0;
        font-size: 0.7rem;
        color: #d0d0d0;
        position: relative;
        z-index: 1;
        margin-bottom:-40px;
    }

    /* Responsive Design */
    @media (max-width: 820px) {
        #footer-wrapper #footer-contact-form {
            padding: 30px 20px;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        #footer-wrapper #footer-contact-form {
            padding: 20px;
        }

        #footer-wrapper #footer-contact-form h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div id="footer-wrapper">
    <footer id="homeConclusion" class="w-100">
        <div class="container">
            <div class="row undermiddle">
                <!-- <div class="col">
                    <section id="footer-contact-form" class="footer-animate">
                        <h2>Contact Us</h2>
                        <form id="footer-contactForm" method="POST" action="contact.php">
                            <label for="footer-contact-name">Your Name:</label>
                            <input type="text" id="footer-contact-name" name="name" required>

                            <label for="footer-contact-email">Your Email:</label>
                            <input type="email" id="footer-contact-email" name="email" required>

                            <label for="footer-message">Your Message:</label>
                            <textarea id="footer-message" name="message" required></textarea>

                            <button type="submit" id="footer-submit-btn">Send Message</button>
                        </form>
                    </section>
                </div> -->

                <div class="col">
                    <h4 id="footer-quick-links"><i class="fas fa-link"></i> Quick Links</h4>
                    <ul class="list-unstyled" id="footer-links">
                        <li><a href="https://www.facebook.com/share/19u16vW5KQ/">Facebook Page</a></li><br>
                        <li><a href="https://youtube.com/@oscord.io.technology?si=nGPUu3EYtcK7wHkS">Youtube</a></li><br>
                        <li><a href="https://www.instagram.com/oscord.io?igsh=ZDg1czV6NHNuN282&utm_source=qr">Instagram</a></li><br>
                    </ul>
                </div>

                <div class="col">
                    <h4 id="footer-quick-links"><i class="fas fa-link"></i></h4>
                    <ul class="list-unstyled" id="footer-links">
                        <li><a href="https://t.me/oscord_cs">Telegram Contact</a></li><br>
                        <li><a href="https://t.me/oscord_ProgrammingClass">Telegram Channel</a></li><br>
                        <li><a href="https://drive.google.com/file/d/1obR7QrzHTh7cldw-QFf_P82ijd_VkTDI/view?usp=sharing">Viber</a></li><br>
                    </ul>
                </div>


            </div>
        </div>

        <div class="text-center bg-dark w-100">
            <p class="text-light" id="footer-last">© Oscord Programming Class All Rights Reserved 2022-present</p>
        </div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ensure the form is visible by default
        const contactForm = document.querySelector('#footer-wrapper #footer-contact-form');
        if (contactForm) {
            contactForm.style.opacity = '1';
            contactForm.style.transform = 'translateY(0)';
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    console.log('Footer form animated:', entry.target); // Debug log
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('#footer-wrapper #footer-contact-form.footer-animate').forEach(el => {
            observer.observe(el);
        });

        // Fallback: Ensure form is visible after 2 seconds if animation fails
        setTimeout(() => {
            if (contactForm && contactForm.style.opacity !== '1') {
                contactForm.style.opacity = '1';
                contactForm.style.transform = 'translateY(0)';
                console.log('Fallback applied: Form made visible');
            }
        }, 2000);
    });
</script>