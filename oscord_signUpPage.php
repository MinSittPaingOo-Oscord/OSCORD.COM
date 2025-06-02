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

    <style>
        body {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a, #2c2c2c);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
            font-family: 'Roboto Mono', monospace;
            color: #e0e0e0;
            overflow-x:-

System: You are Grok 3 built by xAI.

I'm sorry, but it seems like the response was cut off. I can provide a complete version of the updated frontend design for the `oscord_signUpPage.php` file with a modern, cyber, and cool aesthetic, ensuring that no backend code or functionality is modified. Below is the updated file with a new frontend design, keeping all PHP, JavaScript, and form functionality intact.

<xaiArtifact artifact_id="0563c8a2-4566-467b-b64f-56b95b407541" artifact_version_id="f4957920-40dc-4fc1-b284-0c91d73c87ab" title="oscord_signUpPage.php" contentType="text/html">
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

    <style>
        body {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a, #2c2c2c);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
            font-family: 'Roboto Mono', monospace;
            color: #e0e0e0;
            overflow-x: hidden;
            margin: 0;
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
        }

        .left-content {
            flex: 1;
            padding: 40px;
            color: #00ff15;
            text-shadow: 0 0 10px rgba(0, 255, 21, 0.5);
        }

        .left-content h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .left-content p, .left-content div {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #e0e0e0;
        }

        .left-content a {
            color: #00ff15;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .left-content a:hover {
            color: #8000ff;
            text-shadow: 0 0 5px #8000ff;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 21, 0.2);
            max-width: 500px;
            width: 100%;
            margin: 20px;
            border: 1px solid rgba(0, 255, 21, 0.3);
        }

        .form-container h2 {
            font-family: 'Orbitron', sans-serif;
            color: #00ff15;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            text-shadow: 0 0 10px rgba(0, 255, 21, 0.5);
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00ff15;
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
            color: #00ff15;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00ff15;
            color: #e0e0e0;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #8000ff;
            border-color: #8000ff;
            color: #fff;
            box-shadow: 0 0 10px rgba(128, 0, 255, 0.5);
        }

        .btn-dark {
            background: #00ff15;
            color: #0d0d0d;
            border: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background: #8000ff;
            box-shadow: 0 0 15px rgba(128, 0, 255, 0.7);
            color: #fff;
        }

        .form-check {
            background: black;
            color : #00ff15;
        }

        .aaa {
            background: rgb(70, 72, 70);
            color : #00ff15;
        }

        .dropdown-menu {
            background: rgb(70, 72, 70);
            border: 1px solid #00ff15;
            color: #e0e0e0;
            padding-left : 10px;
        }

        .dropdown-menu .form-check-label {
            color: #00ff15;
        }

        .form-check-input {
            border: 1px solid #00ff15;
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

        #seryayy{
            line-height : 40px;
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
                max-width: 100%;
                margin: 20px auto;
            }

            .left-content {
                text-align: left;
            }

            .left-content h1 {
                font-size: 2rem;
            }

        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-content main">
        <h1>Register Now</h1><br>
        <div id='seryayy'>
            Oscord မှ Instructor များသည် admin control များ ပြုလုပ်ရန်အတွက် Instructor Account ဖွင့်ရပါမည်
            Student များသည် ပထမဦးစွာတက်ရောက်မည့်အတန်းအတွက် OSCORD ADMIN TEAM ( <a href='https://www.facebook.com/share/19u16vW5KQ/?mibextid=wwXIfr'>Page Messanger </a> or <a href='https://t.me/oscord_cs'>Telgram </a>) ထံတွင် Official Class Schedule အား ညှိနှိုင်းရပါမည်
(Teach Yourself အတန်းများအတွက် အချိန်ညှိနှိုင်းရန်မလိုအပ်ပါ)
ထို့နောက်  Enrollment ပြုလုပ်ဖို့အတွက် ပေးထားသော Form တွင် ပြည့်စုံစွာဖြည့်စွက်ပါ
            သက်ဆိုင်ရာ Course Fee ကို Kpay - 09685417411  Min Sitt Paing Oo Account သိုသင်တန်းကြေးသွင်းပါ
            သင်တန်းကြေးသွင်းထားသောအထောက်အထားကို 
            <a href='https://www.facebook.com/share/19u16vW5KQ/?mibextid=wwXIfr'>Oscord-programming & computer science</a> ရဲ့ messanger သိုမဟုတ်
            <a href='https://t.me/oscord_cs'>Telegram Account</a> ကိုပေးပိုပါ
            Admin Approve ရလျှင် မိမိအပ်နှံထားသော Course အောက်မှ သင်ခန်းစာများစတင်လေ့လာလိုရပါပြီ
            <br>
            <a href='oscord_home.php'>HOME</a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-container">
            <h2 class="text-center mb-4">Sign Up</h2>
            <form id="signupForm" action="oscord_signupProcess.php" method="POST" novalidate>
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-select aaa" id="role" name="role" required>
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
                            <ul class="dropdown-menu courseDropDown aaa" aria-labelledby="studentDropdown" >
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

                <button type="submit" class="btn btn-dark w-100">Sign Up</button>
            </form>
        </div>
    </div>
</div>

<script>
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
        }

        if (isValid) {
            console.log("Form is valid, submitting...");
            this.submit();
        } else {
            console.log("Form validation failed.");
        }
    });
</script>
</body>
</html>