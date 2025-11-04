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

        /* New: Transparent overlay to prevent direct interaction with video */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1; /* Above video, but below any other content if added */
            background: transparent; /* Invisible */
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <video class="welcome-video" autoplay loop muted playsinline webkit-playsinline>
        <source id="video-source" src="video/wel.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- New: Overlay div to block taps on the video -->
    <div class="video-overlay"></div>
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

        // Only change if source is different
        if (videoSource.src !== newSrc) {
            const wasPlaying = !video.paused;
            const currentTime = video.currentTime;
            videoSource.src = newSrc;
            video.load();
            // Wait for metadata to load before seeking (more reliable on mobile)
            video.onloadedmetadata = () => {
                video.currentTime = currentTime;
                if (wasPlaying) {
                    video.play().catch(error => {
                        console.log('Playback resumption failed:', error);
                    });
                }
                video.onloadedmetadata = null; // Clean up
            };
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

    // Initialize video source on load
    window.onload = setVideoSource;

    // Debounced resize event (for orientation changes, etc.)
    window.addEventListener('resize', debounce(setVideoSource, 200));

    // Optional: If you ever want to add play/pause toggle, do it on the overlay instead
    // document.querySelector('.video-overlay').addEventListener('click', () => {
    //     const video = document.querySelector('.welcome-video');
    //     if (video.paused) {
    //         video.play();
    //     } else {
    //         video.pause();
    //     }
    // });
</script>
</body>
</html>