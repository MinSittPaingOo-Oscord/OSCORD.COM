<?php
session_start();
require_once 'connectdb.php'; // Database connection file
require 'vendor/autoload.php'; // PHPMailer via Composer (adjust path if manual)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize step
if (!isset($_SESSION['reset_email']) || !isset($_SESSION['verification_code'])) {
    $_SESSION['reset_step'] = 0;
}
$step = isset($_SESSION['reset_step']) ? $_SESSION['reset_step'] : 0;
$email = '';
$errors = [];
$success = '';
$redirect = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && $step == 0) {
        // Step 0: Email submission
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $query = "SELECT * FROM oscord_instructor WHERE instructorEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Generate 6-digit code and advance step immediately
            $verification_code = sprintf("%06d", mt_rand(100000, 999999));
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['reset_email'] = $email;
            $_SESSION['last_code_sent'] = time();
            $_SESSION['reset_step'] = 1; // Advance step immediately

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
                $mail->Subject = 'Oscord Password & Pin Reset Verification Code';
                $mail->Body = "<h2>Oscord Password & Pin Reset</h2><p>Your verification code is: <strong>$verification_code</strong></p><p>This code is valid for 5 minutes. Do not share it.</p>";
                $mail->AltBody = "Your verification code: $verification_code\nValid for 5 minutes.";

                $mail->send();
                $success = "Verification code sent to your email.";
            } catch (Exception $e) {
                $errors[] = "Failed to send email: {$mail->ErrorInfo}. Please use the resend option.";
            }
        } else {
            $errors[] = "Email not found in our records.";
            $_SESSION['reset_step'] = 0;
        }
        $stmt->close();
        $step = $_SESSION['reset_step']; // Update step for rendering
    } elseif ($step == 1 && isset($_POST['code'])) {
        // Step 1: Verify code
        $code = trim($_POST['code']);
        if ($code === $_SESSION['verification_code']) {
            $_SESSION['reset_step'] = 2;
            $step = 2; // Update step for rendering
        } else {
            $errors[] = "Invalid verification code.";
        }
    } elseif ($step == 1 && isset($_POST['resend'])) {
        // Resend code
        $email = $_SESSION['reset_email'];
        $query = "SELECT * FROM oscord_instructor WHERE instructorEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Generate new 6-digit code
            $verification_code = sprintf("%06d", mt_rand(100000, 999999));
            $_SESSION['verification_code'] = $verification_code;
            $_SESSION['last_code_sent'] = time();

            // Send email with PHPMailer
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
                $mail->Subject = 'Oscord Password & Pin Reset Verification Code';
                $mail->Body = "<h2>Oscord Password & Pin Reset</h2><p>Your new verification code is: <strong>$verification_code</strong></p><p>This code is valid for 5 minutes. Do not share it.</p>";
                $mail->AltBody = "Your new verification code: $verification_code\nValid for 5 minutes.";

                $mail->send();
                $success = "New verification code sent to your email.";
            } catch (Exception $e) {
                $errors[] = "Failed to resend email: {$mail->ErrorInfo}. Please try again later.";
            }
        } else {
            $errors[] = "Email no longer valid.";
            $_SESSION['reset_step'] = 0;
            unset($_SESSION['verification_code']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['last_code_sent']);
            $step = 0;
        }
        $stmt->close();
    } elseif ($step == 2) {
        // Step 2: Reset password and PIN
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $pin = $_POST['pin'];
        $email = $_SESSION['reset_email'];

        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        } elseif (!is_numeric($pin) || strlen($pin) < 6) {
            $errors[] = "Pin must be a number with at least 6 digits.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE oscord_instructor SET instructorPassword = ?, instructorPin = ? WHERE instructorEmail = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sis", $hashed_password, $pin, $email);
            if ($stmt->execute()) {
                $success = "Password and pin reset successfully.";
                $redirect = "oscord_instructorControlLogin.php";
                // Clear session
                unset($_SESSION['reset_step']);
                unset($_SESSION['reset_email']);
                unset($_SESSION['verification_code']);
                unset($_SESSION['last_code_sent']);
            } else {
                $errors[] = "Failed to reset password and pin.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password & Pin - Oscord</title>
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
        <h2 class="text-4xl font-bold text-white mb-8 text-center tracking-wider">
            <?php echo $step == 0 ? 'Forgot Password & Pin' : ($step == 1 ? 'Verify Code' : 'Reset Password & Pin'); ?>
        </h2>

        <!-- Error messages -->
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert-cyber">
                    <span><?php echo htmlspecialchars($error); ?></span>
                    <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Success message -->
        <?php if (!empty($success)): ?>
            <div class="alert-cyber" style="border-color: #00ffea; background: rgba(0, 255, 234, 0.2); color: #ccffff;">
                <span><?php echo htmlspecialchars($success); ?></span>
                <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
            </div>
        <?php endif; ?>

        <!-- Form based on step -->
        <form method="POST" action="" id="resetForm">
            <?php if ($step == 0): ?>
                <!-- Step 0: Email Input -->
                <div class="input-group">
                    <input type="email" name="email" id="email" required placeholder=" "
                           class="input-field" value="<?php echo htmlspecialchars($email); ?>">
                    <label for="email" class="input-label">Email</label>
                </div>
                <button type="submit" class="btn-cyber" id="submitBtn">
                    <span id="btnText">Send Verification Code</span>
                    <span class="spinner" id="spinner"></span>
                </button>
            <?php elseif ($step == 1): ?>
                <!-- Step 1: Verification Code Input -->
                <div class="input-group">
                    <input type="text" name="code" id="code" required placeholder=" "
                           class="input-field">
                    <label for="code" class="input-label">Verification Code</label>
                </div>
                <button type="submit" class="btn-cyber" id="submitBtn">
                    <span id="btnText">Verify Code</span>
                    <span class="spinner" id="spinner"></span>
                </button>
                <button type="submit" name="resend" class="resend-btn" id="resendBtn" disabled>
                    <span id="resendText">Resend Code (<span id="countdown">12</span>s)</span>
                    <span class="spinner" id="resendSpinner"></span>
                </button>
            <?php elseif ($step == 2): ?>
                <!-- Step 2: New Password and Pin Input -->
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
                <div class="input-group">
                    <input type="number" name="pin" id="pin" required placeholder=" "
                           class="input-field">
                    <label for="pin" class="input-label">New Pin</label>
                </div>
                <button type="submit" class="btn-cyber" id="submitBtn">
                    <span id="btnText">Reset Password & Pin</span>
                    <span class="spinner" id="spinner"></span>
                </button>
            <?php endif; ?>
        </form>
        <div class="mt-6 text-center text-sm text-gray-400 tracking-wide">
            <p>Remembered your credentials? <a href="oscord_instructorControlLogin.php" class="text-cyan-400 hover:text-cyan-300">Login</a></p>
            <p class="mt-2"><a href="oscord_home.php" class="text-cyan-400 hover:text-cyan-300">Back to Home</a></p>
        </div>
    </div>

    <script>
        // Password toggle functionality
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

        // Show loading spinner on form submission
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('spinner');
            const resendBtn = document.getElementById('resendBtn');
            const resendText = document.getElementById('resendText');
            const resendSpinner = document.getElementById('resendSpinner');

            if (e.submitter === resendBtn) {
                resendBtn.disabled = true;
                resendText.style.display = 'none';
                resendSpinner.style.display = 'block';
            } else {
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                spinner.style.display = 'block';
            }
        });

        // Resend code countdown
        if (document.getElementById('resendBtn')) {
            let countdown = 12;
            const countdownElement = document.getElementById('countdown');
            const resendBtn = document.getElementById('resendBtn');
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

        // Display alert and redirect
        <?php if (!empty($success) && !empty($redirect)): ?>
            alert('<?php echo addslashes($success); ?>');
            setTimeout(function() {
                window.location.href = '<?php echo htmlspecialchars($redirect); ?>';
            }, 1000);
        <?php elseif (!empty($success)): ?>
            alert('<?php echo addslashes($success); ?>');
        <?php elseif (!empty($errors)): ?>
            alert('<?php echo addslashes(implode(", ", $errors)); ?>');
        <?php endif; ?>
    </script>
</body>
</html>