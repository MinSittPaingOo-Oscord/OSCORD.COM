<?php
    include "connectdb.php";

    $id = 1;
    if (isset($_POST['courseID'])) {
        $id = (int)$_POST['courseID'];
    }

    function convertToEmbed($url) {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?]+)/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?]+)/i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        }
        return $url;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="public, max-age=86400">
    <meta http-equiv="Expires" content="Wed, 29 Jul 2025 00:00:00 GMT">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a, #1c2526);
            color: #e6e6e6;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .welcome-container {
            background: linear-gradient(145deg, rgba(0, 242, 255, 0.12), rgba(200, 0, 255, 0.12));
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 50px 5%;
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-out;
            z-index: 1;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://via.placeholder.com/1920x1080') no-repeat center/cover;
            opacity: 0.1;
            z-index: 0;
            animation: pulse 10s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.15; }
        }

        .main {
            position: relative;
            z-index: 1;
        }

        #titleCourseTitle {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.2rem;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: fadeIn 0.8s ease-out;
            line-height: 90px;
        }

        #courseDesc {
            font-size: 1.2rem;
            color: #d0d0d0;
            line-height: 50px;
            max-width: 750px;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out 0.2s both;
        }

        .course-info {
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .course-info b {
            color: #00f2ff;
            font-weight: 600;
        }

        .course-image {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            border: 2px solid #00f2ff;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.4);
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .course-image:hover {
            transform: scale(1.08) rotate(2deg);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.6);
        }

        .fb-link {
            color: #ff00ff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .fb-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .btn-course-detail {
            background: transparent;
            border: 2px solid #00f2ff;
            color: #00f2ff;
            padding: 12px 30px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .btn-course-detail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .coursedetail {
            font-size: 0.95rem;
            color: #ffffff;
            background: #2a2a2a;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .coursedetail:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: translateX(5px);
        }

        .intro2 {
            background: #2a2a2a;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
            animation: fadeIn 0.8s ease-out;
        }

        .intro3 .nav-tabs {
            border-bottom: 2px solid #444;
            margin-bottom: 25px;
        }

        .intro3 .nav-link {
            color: #d0d0d0;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: 500;
            padding: 12px 25px;
            border: none;
            position: relative;
            transition: all 0.3s ease;
        }

        .intro3 .nav-link.active {
            color: #00f2ff;
            border-bottom: 3px solid #00f2ff;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
        }

        .intro3 .nav-link:hover {
            color: #00f2ff;
            transform: translateY(-2px);
        }

        .under {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
        }

        .video-card {
            background: #2a2a2a;
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.4s ease;
            animation: fadeIn 1s ease-out;
            height: auto;
        }

        .video-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.5);
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000 url('https://via.placeholder.com/640x360?text=Click+to+Load+Video') no-repeat center;
            cursor: pointer;
        }

        .video-error {
            color: #ff4d4d;
            font-size: 0.95rem;
            padding: 15px;
            text-align: center;
        }

        .video-card .card-body {
            padding: 20px;
        }

        .video-card .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
            line-height: 30px;
        }

        .video-details {
            font-size: 0.95rem;
            color: #d0d0d0;
        }

        .video-details a {
            color: #ff00ff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .video-details a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #ff00ff;
        }

        .details-btn {
            color: #ff00ff;
            background: transparent;
            border: 1px solid #ff00ff;
            padding: 8px 15px;
            font-size: 0.95rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .details-btn:hover {
            background: #ff00ff;
            color: #ffffff;
            transform: scale(1.05);
        }

        .fileBox {
            background: #2a2a2a;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 10px 20px rgba(0, 242, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }

        .fileBox h2 {
            color: #ffffff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.3);
        }

        .fileBox .list-group-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid #444;
            color: #e6e6e6;
            padding: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .fileBox .list-group-item:hover {
            background: rgba(0, 242, 255, 0.1);
        }

        .fileBox .list-group-item a {
            color: #00f2ff;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .fileBox .list-group-item a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px #00f2ff;
        }

        .fileBox .badge {
            background: #ff00ff;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.95rem;
            animation: neonGlow 2s infinite;
        }

        .modal-content {
            background: #1c2526;
            border-radius: 15px;
            color: #e6e6e6;
            border: none;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
            animation: fadeIn 0.5s ease-out;
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-title {
            color: #00f2ff;
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
        }

        .modal .btn-close {
            filter: invert(1);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .modal .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }

        .modal .form-label {
            color: #d0d0d0;
            font-weight: 500;
        }

        .modal .form-control {
            background: #333;
            border: 1px solid #555;
            color: #e6e6e6;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .modal .form-control:focus {
            border-color: #ff00ff;
            box-shadow: 0 0 0 4px rgba(255, 0, 255, 0.3);
        }

        .modal .btn-dark {
            background: #ff00ff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            animation: neonGlow 2s infinite;
        }

        .modal .btn-dark:hover {
            background: #00f2ff;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 767px) {
            #titleCourseTitle {
                font-size: 2.5rem;
            }
            #courseDesc {
                font-size: 1.1rem;
            }
            .welcome-container {
                padding: 30px 5%;
                min-height: 70vh;
            }
            .course-image {
                margin-top: 25px;
            }
            .video-card {
                height: auto;
            }
            .video-card .card-title {
                font-size: 1.3rem;
            }
            .fileBox {
                padding: 20px;
            }
            .fileBox .list-group-item a {
                font-size: 0.95rem;
            }
            .btn-course-detail {
                padding: 10px 25px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "course_details.php"; ?>
    <div class='intro2'>Start Learning</div>
    <?php include "tabs_content.php"; ?>
    <?php include "login_modal.php"; ?>
</body>
</html>
<?php
    include "footer.php";
    $conn->close();
?>

