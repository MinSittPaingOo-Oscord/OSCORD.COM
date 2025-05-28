<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connectdb.php";

$query1 = "SELECT * FROM oscord_course";
$result1 = $conn->query($query1);

$query2 = "SELECT * FROM oscord_course";
$result2 = $conn->query($query2); // Fixed to use $query2
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: black;
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            min-height: 100vh;
        }

        .left-content {
            flex: 1;
            color: white;
            padding: 20px;
        }

        .left-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .left-content p {
            margin-top: 10px;
            font-size: 1.2rem;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            margin: 20px;
        }

        .form-container h2 {
            color: #333;
        }

        .hidden {
            display: none;
        }

        .main div {
            line-height: 40px;
        }

        .main div a {
            color: #00ff15;
        }

        .main div a:hover {
            font-weight: bold;
            color: #8000ff;
        }

        .courseDropDown {
            width: 100%; /* Adjusted for responsiveness */
            padding-left: 10px;
        }

        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                justify-content: center;
            }

            .left-content {
                text-align: left;
            }

            .form-container {
                margin: 20px auto;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .form-container {
                max-width: 100%;
                margin: 20px auto;
            }

            .left-content {
                text-align: left;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-content main">
        <h1>Register Now</h1><br>
        <div>
            Oscord မှ Instructor များသည် admin control များ ပြုလုပ်ရန်အတွက် Instructor Account ဖွင့်ရပါမည်
            Student များသည် Enrollment ပြုလုပ်ဖိုအတွက် ပေးထားသော Form တွင် ပြည့်စုံစွာဖြည့်စွက်ပါ
            သက်ဆိုင်ရာ Course Fee ကို Kpay - 09685417411 Min Sitt Paing Oo Account သိုသင်တန်းကြေးသွင်းပါ
            Thailand Currency ဖြင့်ပေးသွင်းလိုပါက <a href='https://drive.google.com/file/d/10Q2B1Hh8E2_IOglTjorYLAgOP1YXgcud/view?usp=sharing'>QR</a> မှတစ်ဆင့်ပေးသွင်းနိုင်သည်
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
            <form action="oscord_signupProcess.php" method="POST">
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">Select</option>
                        <option value="instructor">Instructor</option>
                        <option value="student">Student</option>
                    </select>
                </div>

                <div id="instructorFields" class="hidden">
                    <div class="mb-3">
                        <label class="form-label">Instructor Name</label>
                        <input type="text" class="form-control" name="instructor_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="instructor_age" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="instructor_phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="instructor_email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passcode</label>
                        <input type="password" class="form-control" name="instructor_passcode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Responsible Courses</label>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="instructorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Courses
                            </button>
                            <ul class="dropdown-menu courseDropDown" aria-labelledby="instructorDropdown">
                                <?php
                                if ($result1 && $result1->num_rows > 0) {
                                    while ($row = $result1->fetch_assoc()) {
                                        echo "<li>
                                                <div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='instructorCourse[]' value='".$row['courseID']."' id='instructor_course_".$row['courseID']."'>
                                                    <label class='form-check-label' for='instructor_course_".$row['courseID']."'>".$row['courseName']."</label>
                                                </div>
                                              </li>";
                                    }
                                } else {
                                    echo "<li>No courses available</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="studentFields" class="hidden">
                    <div class="mb-3">
                        <label class="form-label">Student Name</label>
                        <input type="text" class="form-control" name="student_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="student_country" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="student_email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passcode</label>
                        <input type="password" class="form-control" name="student_passcode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="student_age" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telegram Account User Name</label>
                        <input type="text" class="form-control" name="student_telegram" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="student_phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Have you ever studied Programming? If so, which course have you studied?</label>
                        <textarea class="form-control" rows="3" placeholder="Type your answer here..." name="student_question1" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Why do you want to join this class?</label>
                        <textarea class="form-control" rows="3" placeholder="Type your answer here..." name="student_question2" required></textarea>
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
                                        echo "<li>
                                                <div class='form-check'>
                                                    <input class='form-check-input' type='checkbox' name='studentCourse[]' value='".$row2['courseID']."' id='student_course_".$row2['courseID']."'>
                                                    <label class='form-check-label' for='student_course_".$row2['courseID']."'>".$row2['courseName']."</label>
                                                </div>
                                              </li>";
                                    }
                                } else {
                                    echo "<li>No courses available</li>";
                                }
                                ?>
                            </ul>
                        </div>
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

        if (role === "instructor") {
            document.getElementById("instructorFields").classList.remove("hidden");
        } else if (role === "student") {
            document.getElementById("studentFields").classList.remove("hidden");
        }
    });
</script>
</body>
</html>