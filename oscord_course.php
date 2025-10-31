<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a, #2c2c2c);
            background-size: 200% 200%;
            animation: gradientShift 15s ease infinite;
            font-family: 'Roboto Mono', monospace;
            color: #e0e0e0;
            overflow: hidden;
            margin: 0;
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background: transparent;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 6rem;
            color: #00f2ff;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #e0e0e0;
            margin-bottom: 15px;
        }

        .message {
            font-size: 1rem;
            color: #d0d0d0;
            margin-bottom: 30px;
        }

        a {
            background: transparent;
            border: 2px solid #00f2ff;
            color: #00f2ff;
            padding: 8px 20px; /* Smaller button */
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem; /* Smaller font size */
            border-radius: 30px; /* Adjusted for smaller button */
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        a:hover {
            background: #00f2ff;
            color: #0d0d0d;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.7);
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <div class="content">
        <h1>404</h1>
        <p>Page Not Found</p>
        <p class="message">We apologize, but this page is currently under development to enhance your experience.</p>
        <a href="oscord_home.php">Return to Home</a>
    </div>
    <script>
        particlesJS('particles-js', {
            "particles": {
                "number": {"value": 80, "density": {"enable": true, "value_area": 800}},
                "color": {"value": ["#00f2ff", "#ff00ff", "#ffffff"]},
                "shape": {"type": "circle"},
                "opacity": {"value": 0.5, "random": false},
                "size": {"value": 3, "random": true},
                "line_linked": {"enable": true, "distance": 150, "color": "#00f2ff", "opacity": 0.4, "width": 1},
                "move": {"enable": true, "speed": 6, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false}
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {"onhover": {"enable": true, "mode": "repulse"}, "onclick": {"enable": true, "mode": "push"}, "resize": true},
                "modes": {"repulse": {"distance": 100, "duration": 0.4}, "push": {"particles_nb": 4}}
            },
            "retina_detect": true
        });
    </script>
</body>
</html>