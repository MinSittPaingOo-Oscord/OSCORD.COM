<?php
session_start();
require_once 'connectdb.php'; // Database connection file
require 'vendor/autoload.php'; // PHPMailer via Composer (adjust path if manual)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => '', 'step' => 0];

    if (!isset($_SESSION['reset_email']) || !isset($_SESSION['verification_code'])) {
        $_SESSION['reset_step'] = 0;
    }

    if ($_POST['action'] === 'submit_email') {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $query = "SELECT * FROM oscord_student WHERE studentEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Generate 6-digit code
            $verification_code = sprintf("%06d", mt_rand(100000, 999999));
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['reset_email'] = $email;
            $_SESSION['last_code_sent'] = time();
            $_SESSION['reset_step'] = 1;

            // Attempt to send email with PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'minsittmandalay137@gmail.com';
                $mail->Password = 'dpvtkoiyrjgjnrql';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('no-reply@oscord.com', 'Oscord');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Oscord Password Reset Verification Code';
                $mail->Body = "<h2>Oscord Password Reset</h2><p>Your verification code is: <strong>$verification_code</strong></p><p>This code is valid for 5 minutes. Do not share it.</p>";
                $mail->AltBody = "Your verification code: $verification_code\nValid for 5 minutes.";

                $mail->send();
                $response['success'] = true;
                $response['message'] = "Verification code sent to your email.";
                $response['step'] = 1;
            } catch (Exception $e) {
                $response['message'] = "Failed to send email: {$mail->ErrorInfo}. Please use the resend option.";
                $response['step'] = 1; // Still proceed to step 1
            }
        } else {
            $response['message'] = "Email not found in our records.";
            $response['step'] = 0;
        }
        $stmt->close();
    } elseif ($_POST['action'] === 'verify_code') {
        $code = trim($_POST['code']);
        if ($code === $_SESSION['verification_code']) {
            $_SESSION['reset_step'] = 2;
            $response['success'] = true;
            $response['message'] = "Code verified successfully.";
            $response['step'] = 2;
        } else {
            $response['message'] = "Invalid verification code.";
            $response['step'] = 1;
        }
    } elseif ($_POST['action'] === 'resend_code') {
        $email = $_SESSION['reset_email'];
        $query = "SELECT * FROM oscord_student WHERE studentEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $verification_code = sprintf("%06d", mt_rand(100000, 999999));
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['last_code_sent'] = time();

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'minsittmandalay137@gmail.com';
                $mail->Password = 'dpvtkoiyrjgjnrql';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('no-reply@oscord.com', 'Oscord');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Oscord Password Reset Verification Code';
                $mail->Body = "<h2>Oscord Password Reset</h2><p>Your new verification code is: <strong>$verification_code</strong></p><p>This code is valid for 5 minutes. Do not share it.</p>";
                $mail->AltBody = "Your new verification code: $verification_code\nValid for 5 minutes.";

                $mail->send();
                $response['success'] = true;
                $response['message'] = "New verification code sent to your email.";
                $response['step'] = 1;
            } catch (Exception $e) {
                $response['message'] = "Failed to resend email: {$mail->ErrorInfo}. Please try again later.";
                $response['step'] = 1;
            }
        } else {
            $response['message'] = "Email no longer valid.";
            $_SESSION['reset_step'] = 0;
            unset($_SESSION['verification_code']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['last_code_sent']);
            $response['step'] = 0;
        }
        $stmt->close();
    } elseif ($_POST['action'] === 'reset_password') {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_SESSION['reset_email'];

        if ($password !== $confirm_password) {
            $response['message'] = "Passwords do not match.";
            $response['step'] = 2;
        } elseif (strlen($password) < 8) {
            $response['message'] = "Password must be at least 8 characters long.";
            $response['step'] = 2;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE oscord_student SET studentPassword = ? WHERE studentEmail = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $hashed_password, $email);
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Password reset successfully.";
                $response['step'] = 3; // Redirect step
                $response['redirect'] = "oscord_studentControlLogin.php";
                // Clear session
                unset($_SESSION['reset_step']);
                unset($_SESSION['reset_email']);
                unset($_SESSION['verification_code']);
                unset($_SESSION['last_code_sent']);
            } else {
                $response['message'] = "Failed to reset password.";
                $response['step'] = 2;
            }
            $stmt->close();
        }
    }

    $conn->close();
    echo json_encode($response);
    exit;
}

// Initial step for page load
$step = isset($_SESSION['reset_step']) ? $_SESSION['reset_step'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #0d0d2b 0%, #2a0a4e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        canvas#particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .cyber-card {
            background: rgba(20, 20, 40, 0.3);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            border: 2px solid rgba(255, 20, 147, 0.5);
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            padding: 2rem;
            width: 100%;
            max-width: 450px;
        }
        .cyber-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.5);
        }
        .input-group {
            position: relative;
            margin-bottom: 1.75rem;
        }
        .input-field {
            background: rgba(255, 255, 255, 0.05);
            color: #e0e0ff;
            border: 2px solid rgba(255, 20, 147, 0.4);
            border-radius: 0.5rem;
            padding: 0.8rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            outline: none;
            border-color: #00ffea;
            box-shadow: 0 0 15px rgba(0, 255, 234, 0.5);
        }
        .input-label {
            position: absolute;
            top: 0.8rem;
            left: 1rem;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .input-field:focus + .input-label,
        .input-field:not(:placeholder-shown) + .input-label {
            top: -1rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: #00ffea;
            background: rgba(20, 20, 40, 0.8);
            padding: 0 0.3rem;
        }
        .btn-cyber {
            background: linear-gradient(45deg, #ff1493, #00ffea);
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: 700;
            width: 100%;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .btn-cyber:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 234, 0.7);
        }
        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            border-radius: 50%;
        }
        .btn-cyber:hover::before {
            width: 300%;
            height: 300%;
        }
        .btn-cyber:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .alert-cyber {
            animation: glitch 0.3s ease;
            background: rgba(255, 20, 147, 0.2);
            border: 2px solid #ff1493;
            color: #ffccff;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, 0); }
            80% { transform: translate(2px, 2px); }
            100% { transform: translate(0); }
        }
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #00ffea;
            transition: color 0.3s ease;
        }
        .password-toggle:hover {
            color: #ff1493;
        }
        .spinner {
            display: none;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid #00ffea;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            animation: spin 0.8s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .resend-btn {
            background: linear-gradient(45deg, #ff1493, #00ffea);
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .resend-btn:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 255, 234, 0.7);
        }
        .resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        @media (max-width: 640px) {
            body{
                background:black;
            }
            .cyber-card {
                padding: 1.5rem;
                max-width: 90%;
            }
            .text-4xl {
                font-size: 1.5rem;
            }
            .input-field {
                padding: 0.6rem;
            }
            .input-label {
                top: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="cyber-card">
        <h2 class="text-4xl font-bold text-white mb-8 text-center tracking-wider" id="form-title">
            <?php echo $step == 0 ? 'Forgot Password' : ($step == 1 ? 'Verify Code' : 'Reset Password'); ?>
        </h2>

        <div id="alert-container"></div>

        <form id="resetForm">
            <div id="step-0" class="<?php echo $step == 0 ? '' : 'hidden'; ?>">
                <div class="input-group">
                    <input type="email" name="email" id="email" required placeholder=" "
                           class="input-field">
                    <label for="email" class="input-label">Email</label>
                </div>
                <button type="button" class="btn-cyber" id="submit-email-btn">
                    <span id="btnText-email">Send Verification Code</span>
                    <span class="spinner" id="spinner-email"></span>
                </button>
            </div>

            <div id="step-1" class="<?php echo $step == 1 ? '' : 'hidden'; ?>">
                <div class="input-group">
                    <input type="text" name="code" id="code" required placeholder=" "
                           class="input-field">
                    <label for="code" class="input-label">Verification Code</label>
                </div>
                <button type="button" class="btn-cyber" id="submit-code-btn">
                    <span id="btnText-code">Verify Code</span>
                    <span class="spinner" id="spinner-code"></span>
                </button>
                <button type="button" class="resend-btn" id="resend-btn" disabled>
                    <span id="resendText">Resend Code (<span id="countdown">12</span>s)</span>
                    <span class="spinner" id="resendSpinner"></span>
                </button>
            </div>

            <div id="step-2" class="<?php echo $step == 2 ? '' : 'hidden'; ?>">
                <div class="input-group">
                    <input type="password" name="password" id="password" required placeholder=" "
                           class="input-field">
                    <label for="password" class="input-label">New Password</label>
                    <span class="password-toggle" onclick="togglePassword('password')">⚡️</span>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" id="confirm_password" required placeholder=" "
                           class="input-field">
                    <label for="confirm_password" class="input-label">Confirm Password</label>
                    <span class="password-toggle" onclick="togglePassword('confirm_password')">⚡️</span>
                </div>
                <button type="button" class="btn-cyber" id="submit-reset-btn">
                    <span id="btnText-reset">Reset Password</span>
                    <span class="spinner" id="spinner-reset"></span>
                </button>
            </div>
        </form>
        <div class="mt-6 text-center text-sm text-gray-400 tracking-wide">
            <p>Remembered your credentials? <a href="oscord_studentControlLogin.php" class="text-cyan-400 hover:text-cyan-300"><u>Login</u></a></p>
            <p class="mt-2"><a href="oscord_home.php" class="text-cyan-400 hover:text-cyan-300"><u>Back to Home</u></a></p>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const toggleIcon = input.nextElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                toggleIcon.textContent = '🔒';
            } else {
                input.type = 'password';
                toggleIcon.textContent = '⚡️';
            }
        }

        function showAlert(message, isSuccess = false) {
            const alertContainer = document.getElementById('alert-container');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert-cyber';
            alertDiv.style.borderColor = isSuccess ? '#00ffea' : '#ff1493';
            alertDiv.style.background = isSuccess ? 'rgba(0, 255, 234, 0.2)' : 'rgba(255, 20, 147, 0.2)';
            alertDiv.style.color = isSuccess ? '#ccffff' : '#ffccff';
            alertDiv.innerHTML = `
                <span>${message}</span>
                <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
            `;
            alertContainer.innerHTML = '';
            alertContainer.appendChild(alertDiv);
        }

        function updateFormStep(step) {
            document.getElementById('step-0').classList.add('hidden');
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.add('hidden');

            const title = document.getElementById('form-title');
            if (step === 0) {
                document.getElementById('step-0').classList.remove('hidden');
                title.textContent = 'Forgot Password';
            } else if (step === 1) {
                document.getElementById('step-1').classList.remove('hidden');
                title.textContent = 'Verify Code';
                startCountdown();
            } else if (step === 2) {
                document.getElementById('step-2').classList.remove('hidden');
                title.textContent = 'Reset Password';
            }
        }

        function startCountdown() {
            let countdown = 12;
            const countdownElement = document.getElementById('countdown');
            const resendBtn = document.getElementById('resend-btn');
            const resendText = document.getElementById('resendText');

            const timer = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(timer);
                    resendBtn.disabled = false;
                    resendText.textContent = 'Resend Code';
                }
            }, 1000);
        }

        document.getElementById('submit-email-btn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const btn = this;
            const btnText = document.getElementById('btnText-email');
            const spinner = document.getElementById('spinner-email');

            btn.disabled = true;
            btnText.style.display = 'none';
            spinner.style.display = 'block';

            const formData = new FormData();
            formData.append('action', 'submit_email');
            formData.append('email', email);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';

                showAlert(data.message, data.success);
                updateFormStep(data.step);
            })
            .catch(error => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';
                showAlert('An error occurred. Please try again.');
            });
        });

        document.getElementById('submit-code-btn').addEventListener('click', function() {
            const code = document.getElementById('code').value;
            const btn = this;
            const btnText = document.getElementById('btnText-code');
            const spinner = document.getElementById('spinner-code');

            btn.disabled = true;
            btnText.style.display = 'none';
            spinner.style.display = 'block';

            const formData = new FormData();
            formData.append('action', 'verify_code');
            formData.append('code', code);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';

                showAlert(data.message, data.success);
                updateFormStep(data.step);
            })
            .catch(error => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';
                showAlert('An error occurred. Please try again.');
            });
        });

        document.getElementById('resend-btn').addEventListener('click', function() {
            const btn = this;
            const btnText = document.getElementById('resendText');
            const spinner = document.getElementById('resendSpinner');

            btn.disabled = true;
            btnText.style.display = 'none';
            spinner.style.display = 'block';

            const formData = new FormData();
            formData.append('action', 'resend_code');

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btnText.style.display = 'block';
                spinner.style.display = 'none';

                showAlert(data.message, data.success);
                updateFormStep(data.step);
            })
            .catch(error => {
                btnText.style.display = 'block';
                spinner.style.display = 'none';
                showAlert('An error occurred. Please try again.');
            });
        });

        document.getElementById('submit-reset-btn').addEventListener('click', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const btn = this;
            const btnText = document.getElementById('btnText-reset');
            const spinner = document.getElementById('spinner-reset');

            btn.disabled = true;
            btnText.style.display = 'none';
            spinner.style.display = 'block';

            const formData = new FormData();
            formData.append('action', 'reset_password');
            formData.append('password', password);
            formData.append('confirm_password', confirmPassword);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';

                showAlert(data.message, data.success);
                if (data.step === 3 && data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    updateFormStep(data.step);
                }
            })
            .catch(error => {
                btn.disabled = false;
                btnText.style.display = 'block';
                spinner.style.display = 'none';
                showAlert('An error occurred. Please try again.');
            });
        });

        // Particle background animation
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        const particleCount = 50;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.size > 0.2) this.size -= 0.05;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = 'rgba(0, 255, 234, 0.5)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach((particle, index) => {
                particle.update();
                particle.draw();
                if (particle.size <= 0.2) {
                    particles.splice(index, 1);
                    particles.push(new Particle());
                }
            });
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        // Initial countdown if on step 1
        if (<?php echo $step; ?> === 1) {
            startCountdown();
        }
    </script>
</body>
</html>