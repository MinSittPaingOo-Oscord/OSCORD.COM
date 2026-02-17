<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connectdb.php";

$query1 = "SELECT * FROM oscord_course";
$result1 = $conn->query($query1);

$query2 = "SELECT * FROM oscord_course";
$result2 = $conn->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a, #2c2c2c);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
            font-family: 'Roboto Mono', monospace;
            color: #e0e0e0;
            overflow-x: hidden;
            margin: 0;
            position: relative;
        }

        html {
            scrollbar-width: thin;
            scrollbar-color: #00f2ff rgb(0, 0, 0);
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background: transparent;
            color :  #00f2ff;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 40px 20px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .left-content {
            flex: 1;
            padding: 40px;
            color:   #00f2ff;
            text-shadow: 0 0 10px   #00f2ff;
        }

        .left-content h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .left-content p, .left-content div {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #e0e0e0;
        }

        .left-content a {
            color:   #00f2ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .left-content a:hover {
            /* color:rgb(252, 116, 248); */
            /* text-shadow: 0 0 5px rgb(255, 254, 255); */
            color: rgb(255, 0, 247) !important;
            text-shadow: 0 0 15px rgba(255, 0, 247, 0.7);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05) !important;;
            backdrop-filter: blur(1px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 21, 0.2);
            /* max-width: 500px; */
            width: 100%;
            margin: 20px;
            border: 1px solid   #00f2ff;
        }

        .form-container h2 {
            font-family: 'Orbitron', sans-serif;
            color:   #00f2ff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            text-shadow: 0 0 10px   #00f2ff;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid   #00f2ff;
            color: #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #8000ff;
            box-shadow: 0 0 10px rgba(128, 0, 255, 0.5);
            color: #e0e0e0;
        }

        .form-label {
            color:   #00f2ff;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid  #00f2ff;
            color: #e0e0e0;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #8000ff;
            border-color: #8000ff;
            color: #fff;
            box-shadow: 0 0 10px rgba(128, 0, 255, 0.5);
        }

        .form-container .btn.btn-dark {
            background: #00f2ff !important;
            color: #0d0d0d !important;
            border: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .form-container .btn.btn-dark:hover {
            background: rgb(255, 0, 247) !important;
            box-shadow: 0 0 15px rgba(255, 0, 247, 0.7);
            color: #fff !important;
        }

        .form-check {
            background: black;
            color:   #00f2ff;
        }

        .aaa {
            background: rgb(70, 72, 70);
            color:  #00f2ff;
        }

        .dropdown-menu {
            background: rgb(70, 72, 70);
            border: 1px solid   #00f2ff;
            color: #e0e0e0;
            padding-left: 10px;
        }

        .dropdown-menu .form-check-label {
            color:   #00f2ff;
        }

        .form-check-input {
            border: 1px solid   #00f2ff;
        }

        .form-check-input:checked {
            background-color: #8000ff;
            border-color: #8000ff;
        }

        .error-message {
            color: #ff4d4d;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
            text-shadow: 0 0 5px rgba(255, 77, 77, 0.5);
        }

        .hidden {
            display: none;
        }

        #seryayy {
            line-height: 40px;
        }

        #tac div {
            line-height: 40px;
            margin-bottom: 15px;
        }

        #tac ul {
            line-height: 40px;
            margin-bottom: 15px;
            padding-left: 20px;
        }

      
        .modal-dialog .modal-content {
            background: rgba(255, 255, 255, 0.05) !important; /* Transparent background with higher specificity */
            backdrop-filter: blur(10px); /* Apply blur effect */
            border: 1px solid #00f2ff; /* Neon cyan border */
            color: #e0e0e0; /* Text color */
            border-radius: 15px; /* Rounded corners */
        }

        .modal-header {
            border-bottom: 1px solid   #00f2ff;
        }

        .modal-title {
            font-family: 'Orbitron', sans-serif;
            color:   #00f2ff;
            text-shadow: 0 0 10px   #00f2ff;
        }

        .modal-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .modal-footer {
            border-top: 1px solid   #00f2ff;
        }

        .btn-agree {
            background :  rgba(255, 255, 255, 0.05) !important;;
            color: #00f2ff ;
            border: 1px solid   #00f2ff;
            font-weight: bold;
        }

        .btn-agree:hover {
            background:rgb(249, 2, 200);
            color: #fff;
            box-shadow: 0 0 15px rgba(128, 0, 255, 0.7);
        }

        .btn-cancel {
            background:  rgba(255, 255, 255, 0.05) !important;;
            border: 1px solid   #00f2ff;
            color: #00f2ff;
        }

        .btn-agree {
            background: #00f2ff !important;
            color: #0d0d0d !important;
            border: 1px solid #00f2ff;
        }

        .btn-cancel {
            background: rgba(255,255,255,0.1) !important;
            color: #ff4d4d !important;
            border: 1px solid #ff4d4d;
        }

        
        .btn-cancel:hover {
            background: #ff4d4d;
            border-color: #ff4d4d;
            color: #fff;
        }

        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                justify-content: center;
            }

            .left-content {
                text-align: left;
                padding: 20px;
            }

            .form-container {
                margin: 20px auto;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 20px;
            }

            .form-container {
                width: 100%;
                margin: 20px auto;
            }

            .left-content {
                text-align: left;
       
            }

            .left-content h1 {
                font-size: 2rem;
            }

            .form-container h2 {
      
            font-size: 1.7rem;
   
            }

            .left-content h1 {
            font-size: 2.2rem;
        }

        .left-content p, .left-content div {
            font-size: 0.7rem;
        }
        #seryayy{
            font-size : 1em !important;
            line-height : 40px;
        }
        }
   
    </style>
</head>
<body>
    <?php 
        include "nav.php";    ?>
<div id="particles-js"></div>
<div class="container">
    <div class="left-content main">
        <h1>Register Now</h1><br>
        <div id="seryayy">
            Student များသည် ပထမဦးစွာတက်ရောက်မည့်အတန်းအတွက် OSCORD ADMIN TEAM ( <a href='https://www.facebook.com/share/19u16vW5KQ/?mibextid=wwXIfr'>Page Messanger </a> or <a href='https://t.me/oscord_cs'>Telegram </a>) ထံတွင် Official Class Schedule အား ညှိနှိုင်းရပါမည်
            (Teach Yourself အတန်းများအတွက် အချိန်ညှိနှိုင်းရန်မလိုအပ်ပါ)
                ထို့နောက်  Enrollment ပြုလုပ်ဖို့အတွက် ပေးထားသော Form တွင် ပြည့်စုံစွာဖြည့်စွက်ပါ
            သက်ဆိုင်ရာ Course Fee ကို Kpay - 09685417411  Min Sitt Paing Oo Account သိုသင်တန်းကြေးသွင်းပါ
            သင်တန်းကြေးသွင်းထားသောအထောက်အထားကို 
            <a href='https://www.facebook.com/share/19u16vW5KQ/?mibextid=wwXIfr'>Oscord Code Academy</a> ရဲ့ messanger သိုမဟုတ်
            <a href='https://t.me/oscord_cs'>Telegram Account</a> ကိုပေးပိုပါ
            Admin Approve ရလျှင် မိမိအပ်နှံထားသော Course အောက်မှ သင်ခန်းစာများစတင်လေ့လာလိုရပါပြီ
            
       
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-container">
            <h2 class="text-center mb-4">Register</h2>
            <form id="signupForm" action="oscord_signupProcess.php" method="POST" novalidate>
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="" class='aaa'>Select</option>
                        <option value="instructor" class='aaa'>Instructor</option>
                        <option value="student" class='aaa'>Student</option>
                    </select>
                    <div id="roleError" class="error-message">Please select a role.</div>
                </div>

                <div id="instructorFields" class="hidden">
                    <div class="mb-3">
                        <label class="form-label">Instructor Name</label>
                        <input type="text" class="form-control" name="instructor_name" required>
                        <div class="error-message">Please enter your name.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="instructor_birthday" required>
                        <div class="error-message">Please select your birthday.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="instructor_phone" required>
                        <div class="error-message">Please enter your phone number.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="instructor_email" required>
                        <div class="error-message">Please enter a valid email address.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passcode</label>
                        <input type="password" class="form-control" name="instructor_passcode" required>
                        <div class="error-message">Please enter a passcode.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instructor PIN (6 digits)</label>
                        <input type="number" class="form-control" name="instructor_pin" min="100000" max="999999" required>
                        <div class="error-message">Please enter a 6-digit PIN (100000–999999).</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Responsible Courses</label>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="instructorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Courses
                            </button>
                            <ul class="dropdown-menu courseDropDown aaa" aria-labelledby="instructorDropdown">
                                <?php
                                if ($result1 && $result1->num_rows > 0) {
                                    while ($row = $result1->fetch_assoc()) {
                                        echo "<li class='aaa'>
                                                <div class='form-check aaa'>
                                                    <input class='form-check-input' type='checkbox' name='instructorCourse[]' value='".htmlspecialchars($row['courseID'])."' id='instructor_course_".htmlspecialchars($row['courseID'])."'>
                                                    <label class='form-check-label aaa' for='instructor_course_".htmlspecialchars($row['courseID'])."'>".htmlspecialchars($row['courseName'])."</label>
                                                </div>
                                              </li>";
                                    }
                                } else {
                                    echo "<li>No courses available</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="instructorCourseError" class="error-message">Please select at least one course.</div>
                    </div>
                </div>

                <div id="studentFields" class="hidden">
                    <div class="mb-3">
                        <label class="form-label">Student Name</label>
                        <input type="text" class="form-control" name="student_name" required>
                        <div class="error-message">Please enter your name.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="student_country" required>
                        <div class="error-message">Please enter your country.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="student_email" required>
                        <div class="error-message">Please enter a valid email address.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passcode</label>
                        <input type="password" class="form-control" name="student_passcode" required>
                        <div class="error-message">Please enter a passcode.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="student_birthday" required>
                        <div class="error-message">Please select your birthday.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telegram Account User Name</label>
                        <input type="text" class="form-control" name="student_telegram" required>
                        <div class="error-message">Please enter your Telegram username.</div>
                    </div>
                    
                    <!-- <select name="type" required>
                            <option value='1'>Teach yourself with Video Lectures Only</option>
                            <option value='2'>VIP By One Class</option>
                            <option value='3'>Zoom Group Class</option>
                            <option value='4'>Video Lectures + Zoom - By One</option>
                            <option value='5'>Face to Face in Bangkok</option>
                    </select> -->

                    <div class="mb-3">
                            <label class="form-label">Select Learning Type</label>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Type
                                </button>
                                <ul class="dropdown-menu courseDropDown aaa" aria-labelledby="typeDropdown">
                                    <li class="aaa">
                                        <div class="form-check aaa">
                                            <input class="form-check-input aaa" type="radio" name="type" value="1" id="type_1">
                                            <label class="form-check-label aaa" for="type_1">Teach yourself with Video Lectures Only</label>
                                        </div>
                                    </li>
                                    <li class="aaa">
                                        <div class="form-check aaa">
                                            <input class="form-check-input aaa" type="radio" name="type" value="2" id="type_2">
                                            <label class="form-check-label aaa" for="type_2">VIP By One Class</label>
                                        </div>
                                    </li>
                                    <li class="aaa">
                                        <div class="form-check aaa">
                                            <input class="form-check-input aaa" type="radio" name="type" value="3" id="type_3">
                                            <label class="form-check-label aaa" for="type_3">Zoom Group Class</label>
                                        </div>
                                    </li>
                                    <li class="aaa">
                                        <div class="form-check aaa">
                                            <input class="form-check-input aaa" type="radio" name="type" value="4" id="type_4">
                                            <label class="form-check-label aaa" for="type_4">Video Lectures + Zoom - By One</label>
                                        </div>
                                    </li>
                                    <li class="aaa">
                                        <div class="form-check aaa">
                                            <input class="form-check-input aaa" type="radio" name="type" value="5" id="type_5">
                                            <label class="form-check-label aaa" for="type_5">Face to Face in Bangkok</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="typeError" class="error-message">Please select a type.</div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="student_phone" required>
                        <div class="error-message">Please enter your phone number.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Have you ever studied Programming? If so, which course have you studied?</label>
                        <textarea class="form-control" rows="3" placeholder="Type your answer here..." name="student_question1" required></textarea>
                        <div class="error-message">Please provide an answer.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Why do you want to join this class?</label>
                        <textarea class="form-control" rows="3" placeholder="Type your answer here..." name="student_question2" required></textarea>
                        <div class="error-message">Please provide an answer.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Register for Courses</label>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="studentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Courses
                            </button>
                            <ul class="dropdown-menu courseDropDown" aria-labelledby="studentDropdown">
                                <?php
                                if ($result2 && $result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo "<li class='aaa'>
                                                <div class='form-check aaa'>
                                                    <input class='form-check-input aaa' type='checkbox' name='studentCourse[]' value='".htmlspecialchars($row2['courseID'])."' id='student_course_".htmlspecialchars($row2['courseID'])."'>
                                                    <label class='form-check-label aaa' for='student_course_".htmlspecialchars($row2['courseID'])."'>".htmlspecialchars($row2['courseName'])."</label>
                                                </div>
                                              </li>";
                                    }
                                } else {
                                    echo "<li>No courses available</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="studentCourseError" class="error-message">Please select at least one course.</div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100">Register</button>
            </form>
        </div>
    </div>

</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tac">
                    <div>သင်တန်းကြေးပေးသွင်းပြီးပါက သင်တန်းမတတ်ဖြစ်တော့သည်ဖြစ်စေ 
                    မည်သည့်အကြောင်းကြောင့်မှ ပြန်လည် Refund ပေးအပ်မည်မဟုတ်ပါ</div>

                    <div>သင်တန်းစည်းကမ်းများ</div>
                    <ul>
                        <li>Zoom meeting ချိန်အတွင်း အသံ Mute ထားလိုမရပါဖူး</li>
                        <li>Telegram private channel နှင့် Website ပေါ်တွင်ပေးထားသော သင်ခန်းစာ, Video record  များ ကို မိမိတစ်ဦးတည်းသာဝင်ရောက်ပီး လေ့လာလိုရပါမယ်
                            မည်သူတစ်ဦးတစ်ယောက်ကိုမှ မျှဝေခြင်းကိုခွင့်မပြုပါ</li>
                        <li>အတန်းစမည့်အချိန်မှာ အမြဲတမ်း Zoom ID & passcode  သိုမဟုတ် Meeting Link ပိုပေးသွားမှာဖြစ်ပြီး 30 minutes အတွင်းဝင်ရောက်လာခြင်းမရှိပါက ပျက်ကွက်သည်ဟုယူဆပြီး Meeting အားရုတ်သိမ်းမှာဖြစ်ပါတယ်</li>
                    </ul>
                </div>
                <p>By clicking "Agree", you confirm that you have read, understood, and agree to be bound by these terms.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-agree" id="agreeTerms">Agree</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Particle.js configuration
    particlesJS('particles-js', {
        "particles": {
            "number": {
                "value": 80,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": ["#00ff15", "#8000ff", "#ffffff"]
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                }
            },
            "opacity": {
                "value": 0.5,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": true,
                    "speed": 2,
                    "size_min": 0.5,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#00f2ff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 2,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 100,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });

    document.getElementById("role").addEventListener("change", function() {
        const role = this.value;
        document.getElementById("instructorFields").classList.add("hidden");
        document.getElementById("studentFields").classList.add("hidden");
        document.getElementById("roleError").style.display = "none";

        if (role === "instructor") {
            document.getElementById("instructorFields").classList.remove("hidden");
        } else if (role === "student") {
            document.getElementById("studentFields").classList.remove("hidden");
        }
    });

    document.getElementById("signupForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let isValid = true;
        const role = document.getElementById("role").value;

        document.querySelectorAll(".error-message").forEach(function(error) {
            error.style.display = "none";
        });

        if (!role) {
            document.getElementById("roleError").style.display = "block";
            isValid = false;
        }

        if (role === "instructor") {
            const fields = [
                { id: "instructor_name", error: "Please enter your name." },
                { id: "instructor_birthday", error: "Please select your birthday." },
                { id: "instructor_phone", error: "Please enter your phone number." },
                { id: "instructor_email", error: "Please enter a valid email address." },
                { id: "instructor_passcode", error: "Please enter a passcode." },
                { id: "instructor_pin", error: "Please enter a 6-digit PIN (100000–999999)." }
            ];

            fields.forEach(function(field) {
                const input = document.querySelector(`[name="${field.id}"]`);
                if (!input.value.trim()) {
                    input.nextElementSibling.style.display = "block";
                    isValid = false;
                } else if (field.id === "instructor_pin") {
                    const pin = parseInt(input.value);
                    if (isNaN(pin) || pin < 100000 || pin > 999999) {
                        input.nextElementSibling.style.display = "block";
                        isValid = false;
                    }
                }
            });

            const courseCheckboxes = document.querySelectorAll("input[name='instructorCourse[]']:checked");
            if (courseCheckboxes.length === 0) {
                document.getElementById("instructorCourseError").style.display = "block";
                isValid = false;
            }

            if (isValid) {
                console.log("Form is valid, submitting for instructor...");
                this.submit();
            } else {
                console.log("Form validation failed.");
            }
        } else if (role === "student") {
            const fields = [
                { id: "student_name", error: "Please enter your name." },
                { id: "student_country", error: "Please enter your country." },
                { id: "student_email", error: "Please enter a valid email address." },
                { id: "student_passcode", error: "Please enter a passcode." },
                { id: "student_birthday", error: "Please select your birthday." },
                { id: "student_telegram", error: "Please enter your Telegram username." },
                { id: "student_phone", error: "Please enter your phone number." },
                { id: "student_question1", error: "Please provide an answer." },
                { id: "student_question2", error: "Please provide an answer." }
            ];

            fields.forEach(function(field) {
                const input = document.querySelector(`[name="${field.id}"]`);
                if (!input.value.trim()) {
                    input.nextElementSibling.style.display = "block";
                    isValid = false;
                }
            });

            const courseCheckboxes = document.querySelectorAll("input[name='studentCourse[]']:checked");
            if (courseCheckboxes.length === 0) {
                document.getElementById("studentCourseError").style.display = "block";
                isValid = false;
            }

            if (isValid) {
                console.log("Form is valid, showing terms modal for student...");
                const termsModal = new bootstrap.Modal(document.getElementById('termsModal'), {
                    keyboard: false
                });
                termsModal.show();
            } else {
                console.log("Form validation failed.");
            }
        }
    });

    document.getElementById("agreeTerms").addEventListener("click", function() {
        console.log("Terms agreed, submitting form...");
        document.getElementById("signupForm").submit();
    });
</script>

</body>
</html>
<?php
    include "footer.php";
?>