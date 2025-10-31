<?php
// Include database connection if needed
include "connectdb.php";
?>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* ==============================
   OSCORD Footer (Glass Theme)
============================== */
#footer-wrapper {
  margin-top: 90px;
  font-family: 'Inter', sans-serif;
}

#footer-wrapper footer {
  background: rgba(10, 10, 10, 0.65);
  border-top: 2px solid rgba(0,242,255,0.35);
  backdrop-filter: blur(25px) saturate(200%);
  -webkit-backdrop-filter: blur(25px) saturate(200%);
  color: #e8ffff;
  padding-top: 50px;
  position: relative;
  box-shadow: 0 0 40px rgba(0,242,255,0.2), inset 0 0 20px rgba(0,242,255,0.1);
}

/* ===== Subscription Box ===== */
.footer-subscribe-box {
  background: rgba(10,10,10,0.55);
  border: 2px solid rgba(0,242,255,0.35);
  border-radius: 16px;
  max-width: 500px;
  margin: 0 auto 60px auto;
  text-align: center;
  padding: 25px 20px;
  box-shadow: 0 0 35px rgba(0,242,255,0.3), inset 0 0 20px rgba(0,242,255,0.1);
  backdrop-filter: blur(20px) saturate(180%);
}

.footer-subscribe-box h3 {
  font-family: 'Orbitron', sans-serif;
  font-size: 1.3rem;
  color: #00f2ff;
  margin-bottom: 10px;
  text-shadow: 0 0 15px rgba(0,242,255,0.6);
}

.footer-subscribe-box p {
  color: #bfefff;
  font-size: 0.9rem;
  margin-bottom: 15px;
}

.footer-subscribe-box input {
  width: 60%;
  padding: 10px;
  border: none;
  border-radius: 8px;
  background: rgba(255,255,255,0.05);
  color: #e8ffff;
  margin-right: 10px;
  outline: none;
  margin-bottom:10px;
}

.footer-subscribe-box button {
  padding: 10px 18px;
  border: none;
  border-radius: 8px;
  background: #00f2ff;
  color: #0a0a0a;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  width:58%;
  
}

.footer-subscribe-box button:hover {
  background: #ff00ff;
  color: #fff;
  transform: scale(1.05);
  box-shadow: 0 0 12px #ff00ff, 0 0 25px #ff00ff;
}

/* ===== Footer Columns ===== */
.footer-columns {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 0 8%;
  gap: 40px;
  text-align: left;
}

.footer-col {
  flex: 1 1 250px;
}

.footer-col h4 {
  font-family: 'Orbitron', sans-serif;
  font-size: 1.1rem;
  margin-bottom: 15px;
  color: #00f2ff;
  text-shadow: 0 0 10px rgba(0,242,255,0.6);
}

.footer-col p, 
.footer-col li, 
.footer-col a {
  font-size: 0.9rem;
  color: #c8faff;
  line-height: 1.7;
  text-decoration: none;
}

.footer-col a:hover {
  color: #ff00ff;
  text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
}

/* ===== Social Icons ===== */
.footer-socials i {
  font-size: 1.4rem;
  margin-right: 15px;
  color: #00f2ff;
  transition: all 0.3s ease;
  text-shadow: 0 0 12px rgba(0,242,255,0.7);
}

.footer-socials i:hover {
  transform: scale(1.2);
  text-shadow:0 0 10px #00f2ff,0 0 25px #00f2ff;
}

/* ===== Copyright ===== */
.footer-bottom {
  text-align: center;
   background: rgba(10, 10, 10, 0.65);
  border-top: 2px solid rgba(0,242,255,0.35);
  padding: 15px 0;
  color: #aeefff;
  font-size: 0.8rem;
  margin-top:20px;
  
}

/* ===== Tablet View ===== */
@media (max-width: 1024px) and (min-width: 768px) {
  .footer-columns {
    flex-direction: row;
    justify-content: space-around;
    text-align: left;
    gap: 30px;
  }
  .footer-col { flex: 1 1 40%; }
  .footer-subscribe-box input[type="email"] { width: 55%; }
}

/* ===== Mobile View ===== */
@media (max-width: 767px) {
  .footer-subscribe-box h3 {
    font-size: 1.2em;
  }

  .footer-subscribe-box {
    max-width: 80%;
    padding: 40px 20px;
  }

  .footer-subscribe-box input {
    width: 90%;
    margin-bottom: 10px;
  }
  .footer-subscribe-box button {
    width: 87%;
  }
  .footer-columns {
    flex-direction: column;
    text-align: center;
    align-items: center;
  }
  .footer-col { flex: 1 1 100%; }
  .footer-socials { justify-content: center; }

  .footer-bottom {
        font-size: 0.6rem;
    
  
    }
}
</style>

<div id="footer-wrapper">
  <footer>
    <div class="footer-subscribe-box">
      <h3>Get In Touch With Us 🤘</h3>
      <p>Send Email now🚀</p>
      <form action="contact.php" method="POST">
        <input type="email" placeholder="Enter Email Here" required name="email">
        <input type="text" id="footer-contact-name" name="name" placeholder="Enter Name here" required>
        <input type="text" id="footer-contact-name" name="message" placeholder="Enter Message here" required> <br>
        <button type="submit">Send Message</button>
      </form>
    </div>

    <!-- Footer Columns -->
    <div class="footer-columns">
      <!-- Left -->
      <div class="footer-col">
        <h4>OSCORD Code Academy</h4>
        <p>OSCORD Code Academy has been established for those who are studying Computer Science. Start Register Now and improve your skills by studying at OSCORD Code Academy.</p>
      </div>

      <!-- Middle -->
      <div class="footer-col">
        <h4>Navigation</h4>
        <ul style="list-style:none; padding:0;">
          <li><a href="oscord_home.php">Home</a></li>
          <li><a href="oscord_course.php">Courses</a></li>
          <li><a href="oscord_signUpPage.php">Sign Up</a></li>
        </ul>
      </div>

      <!-- Right -->
      <div class="footer-col">
        <h4>Explore Us</h4>
        <div class="footer-socials">
          <a href="https://www.facebook.com/share/19u16vW5KQ/" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="https://youtube.com/@oscord.io.technology?si=nGPUu3EYtcK7wHkS" target="_blank"><i class="fab fa-youtube"></i></a>
          <a href="https://t.me/oscord_cs" target="_blank"><i class="fab fa-telegram"></i></a>
          <a href="viber://chat?number=%2B959123456789" target="_blank"><i class="fab fa-viber"></i></a>
          <a href="https://www.instagram.com/oscord.io" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
      © OSCORD Programming Class — All Rights Reserved 2022–Present
    </div>
  </footer>
</div>