<?php
include "connectdb.php";

$id = 1;
if (isset($_POST['courseID'])) {
    $id = (int)$_POST['courseID'];
}

function convertToEmbed($url)
{
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
            font-family: 'Times New Roman', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a, #1c2526);
            color: #e6e6e6;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        html {
            scrollbar-width: thin;
            scrollbar-color: #00f2ff rgb(0, 0, 0);
        }

        /* --- START CORRECTED NEON SIGN EFFECT --- */
        .intro2 {
            /* Base Container Styling */
            background: #0a0a0a;
            /* Dark background */
            color: #ffffff;
            text-align: center;
            padding: 25px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            font-weight: 500;
            margin-bottom: 20px;
            border-radius: 5px;
            cursor: pointer;

            /* STATIC: Glowing box border (runs constantly) */
            box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;

            /* Text Glow (Initial state) */
            text-shadow: 0 0 5px #fff, 0 0 10px #00f2ff;

            /* Animation Properties: Flicker is ONLY applied to text-shadow */
            animation:
                neonTextFlicker 2s infinite alternate,
                fadeIn 0.8s ease-out;
        }

        /* Keyframe Animation for Text Flickering ONLY */
        @keyframes neonTextFlicker {

            0%,
            100% {
                /* Full brightness for the text */
                text-shadow: 0 0 5px #fff, 0 0 10px #00f2ff, 0 0 20px #00f2ff;
                opacity: 1;
            }

            1% {
                /* Quick dim spot */
                text-shadow: 0 0 1px #fff;
                opacity: 0.9;
            }

            1.5%,
            19.5% {
                /* Quick off state */
                text-shadow: none;
                opacity: 0.85;
            }

            20%,
            20.5% {
                /* Quick flash back on */
                text-shadow: 0 0 3px #fff;
                opacity: 0.95;
            }

            60% {
                /* Subtle dim for breathing */
                text-shadow: 0 0 4px #fff, 0 0 8px #00f2ff;
                opacity: 1;
            }
        }

        /* --- END CORRECTED NEON SIGN EFFECT --- */

    

    

        /* Responsive */
       

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
    <!-- <div class='intro2'>Start Learning</div> -->
    <?php include "tabs_content.php"; ?>
    <?php include "login_modal.php"; ?>
</body>

</html>
<?php
include "footer.php";
$conn->close();
?>