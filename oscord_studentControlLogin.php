<?php
session_start();
require_once 'connectdb.php'; // Use the provided database connection file

$redirect = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query to check student credentials
    $query = "SELECT * FROM oscord_student WHERE studentEmail = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $student['studentPassword'])) {
            // Check if student is approved
            if ($student['studentApprove'] == 1) {
                // Set session variables
                $_SESSION['student_id'] = $student['studentID'];
                $_SESSION['student_name'] = $student['studentName'];
                
                // Set success message and redirect
                $message = 'Login Successful';
                $redirect = "student_dashboard.php?studentID=" . urlencode($student['studentID']);
            } else {
                // Set error message and redirect
                $message = 'Student not approved';
                $redirect = "oscord_home.php?error=Student not approved";
            }
        } else {
            // Set error message and redirect
            $message = 'Invalid credentials';
            $redirect = "oscord_home.php?error=Invalid credentials";
        }
    } else {
        // Set error message and redirect
        $message = 'Invalid credentials';
        $redirect = "oscord_home.php?error=Invalid credentials";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - Oscord</title>
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
            body{
                background : black;
            }
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="cyber-card">
        <h2 class="text-4xl font-bold text-white mb-8 text-center tracking-wider">Student Login</h2>
        
        <!-- Error message -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert-cyber">
                <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                <button onclick="this.parentElement.style.display='none'" class="hover:text-white">×</button>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" id="loginForm">
            <div class="input-group">
                <input type="email" name="email" id="email" required placeholder=" "
                       class="input-field">
                <label for="email" class="input-label">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required placeholder=" "
                       class="input-field">
                <label for="password" class="input-label">Password</label>
                <span class="password-toggle" onclick="togglePassword()">⚡️</span>
            </div>
            <button type="submit" class="btn-cyber" id="submitBtn">
                <span id="btnText">Login</span>
                <span class="spinner" id="spinner"></span>
            </button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-400 tracking-wide">
            <p>Forgot credentials? <a href="student_forgotPasscode.php" class="text-cyan-400 hover:text-cyan-300"><u>Reset Password</u></a></p>
            <p class="mt-2"><a href="oscord_home.php" class="text-cyan-400 hover:text-cyan-300"><u>Back to Home</u></a></p>
        </div>
    </div>

    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🔒';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '⚡️';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('spinner');
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            spinner.style.display = 'block';
        });

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
        <?php if (!empty($message) && !empty($redirect)): ?>
            alert('<?php echo addslashes($message); ?>');
            setTimeout(() => {
                window.location.href = '<?php echo $redirect; ?>';
            }, 1000); // Delay redirect to show alert
        <?php endif; ?>
    </script>
</body>
</html>