<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Welcome container</title>
    <style>
        .welcome-container {
            position: relative;
            width: 100%;
            height: 100vh; 
            overflow: hidden;
            z-index: 1;
        }

        .welcome-video {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <video class="welcome-video" autoplay loop muted playsinline>
        <source id="video-source" src="video/wel.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<script>
    function setVideoSource() {
        const videoSource = document.getElementById('video-source');
        const video = document.querySelector('.welcome-video');
        const width = window.innerWidth;
        let newSrc;

        if (width < 900) {
            newSrc = 'video/phone.mp4';
        } else if (width >= 900 && width <= 1024) {
            newSrc = 'video/ipad.mp4';
        } else {
            newSrc = 'video/wel.mp4';
        }

        // Only reload the video if the source has changed
        if (videoSource.src !== newSrc) {
            videoSource.src = newSrc;
            video.load();
            video.play();
        }
    }

    // Debounce function to limit how often setVideoSource is called
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Toggle play/pause on video click/tap
    function toggleVideoPlayback() {
        const video = document.querySelector('.welcome-video');
        if (video.paused) {
            video.play();
        } else {
            video.pause();
        }
    }

    // Initialize video source on load
    window.onload = setVideoSource;

    // Debounced resize event
    window.onresize = debounce(setVideoSource, 200);

    // Add click/tap event listener to toggle play/pause
    document.querySelector('.welcome-video').addEventListener('click', toggleVideoPlayback);
</script>
</body>
</html>