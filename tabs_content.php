<div id="oscord-tabs-content" class='intro3 container'>

    <div class='tab'>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="simpleLectureVideo" data-bs-toggle="tab" data-bs-target="#simple_lecture_video" type="button" role="tab" aria-controls="simple_lecture_video">Free Lecture Videos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="privateLectureVideo" data-bs-toggle="tab" data-bs-target="#private_lecture_video" type="button" role="tab" aria-controls="private_lecture_video">Private Video Lectures</button>
            </li>
        </ul>

        <div class="tab-content under" id="myTabContent">

            <!-- ==================== FREE VIDEOS ==================== -->
            <div class="tab-pane fade show active" id="simple_lecture_video" role="tabpanel" aria-labelledby="simpleLectureVideo">
                <div class="row">
                    <?php
                    $query4 = "SELECT * FROM video_file 
                               WHERE videoFree = 1 AND courseID = ? 
                               ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED) LIMIT 20";
                    $stmt4 = $conn->prepare($query4);
                    $stmt4->bind_param("i", $id);
                    $stmt4->execute();
                    $result4 = $stmt4->get_result();

                    if ($result4 && $result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $videoSrc = 'video/' . htmlspecialchars($row4['fileName']);
                            echo "<div class='col-12 col-md-6 col-lg-4'>
                                    <div class='video-card'>
                                        <div class='video-wrapper'>
                                            <video src='{$videoSrc}' 
                                                   controls 
                                                   controlsList='nodownload'
                                                   disablePictureInPicture
                                                   preload='metadata'
                                                   title='" . htmlspecialchars($row4['videoName']) . "'>
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" . htmlspecialchars($row4['videoName']) . "</h5>
                                        </div>
                                    </div>
                                  </div>";
                        }
                        $stmt4->close();
                    } else {
                        echo "<p class='text-center text-white mt-3'>No free lecture videos available.</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==================== PRIVATE VIDEOS ==================== -->
            <div class="tab-pane fade" id="private_lecture_video" role="tabpanel" aria-labelledby="privateLectureVideo">
                <div id='unlockedcontent' style='display:none;'>
                    <div class="mt-4">
                        <div class="row">
                            <?php
                            $query9 = "SELECT * FROM video_file 
                                       WHERE courseID = ? 
                                       ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED)";
                            $stmt9 = $conn->prepare($query9);
                            $stmt9->bind_param("i", $id);
                            $stmt9->execute();
                            $result9 = $stmt9->get_result();

                            if ($result9 && $result9->num_rows > 0) {
                                while ($row9 = $result9->fetch_assoc()) {
                                    $videoSrc = 'video/' . htmlspecialchars($row9['fileName']);
                                    echo "<div class='col-12 col-md-6 col-lg-4'>
                                            <div class='video-card'>
                                                <div class='video-wrapper'>
                                                    <video src='{$videoSrc}' 
                                                           controls 
                                                           controlsList='nodownload'
                                                           disablePictureInPicture
                                                           preload='metadata'
                                                           title='" . htmlspecialchars($row9['videoName']) . "'>
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                <div class='card-body'>
                                                    <h5 class='card-title'>" . htmlspecialchars($row9['videoName']) . "</h5>
                                                </div>
                                            </div>
                                          </div>";
                                }
                                $stmt9->close();
                            } else {
                                echo "<p class='text-center text-white mt-3'>No private video lectures available.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
     #oscord-tabs-content{
        margin-bottom : 70px;
     }
    
     #oscord-tabs-content .nav-link {
            color: #d0d0d0;
            font-family: 'Times New Roman', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            padding: 12px 25px;
            border: none;
            transition: all .3s;
            /* text-shadow: 0 0 5px rgba(0, 242, 255, 0.3); Subtle neon glow for inactive tabs */
        }

        #oscord-tabs-content .nav-link:hover {
            color: #00f2ff;
            transform: translateY(-2px);
            /* text-shadow: 0 0 10px rgba(0, 242, 255, 0.5); Enhanced glow on hover */
        }

        #oscord-tabs-content .nav-link.active {
            color: rgb(0, 0, 0);
            border-bottom: 3px solid #00f2ff;
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
            animation: neonGlow 2s infinite; /* Apply neon glow animation to active tab */
            box-shadow: 0 4px 15px rgba(0, 242, 255, 0.4); /* Add box shadow for tab glow */
        }

        @keyframes neonGlow {
            0%, 100% { text-shadow: 0 0 5px #00f2ff, 0 0 10px #00f2ff, 0 0 20px #00f2ff; }
            50% { text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff, 0 0 30px #00f2ff; }
        }


    #oscord-tabs-content .video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        border-radius: 15px 15px 0 0;
        overflow: hidden;
        background: #000;
    }
    #oscord-tabs-content .video-wrapper video {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none;
    }
    #oscord-tabs-content .video-card {
        background: transparent;
        border-radius: 15px;
        margin-bottom: 40px; /* Increased from 25px for more vertical space between cards */
        overflow: hidden;
        transition: all .4s;
        box-shadow: 0 0 2px rgba(0, 242, 255, .5);
    }
    #oscord-tabs-content .video-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 0 25px rgba(0, 242, 255, .5);
    }
    #oscord-tabs-content .card-body {
        padding: 20px 15px; /* Added padding for more vertical space around the title */
        text-align: center;
    }
    #oscord-tabs-content .card-title {
        font-family: 'Times New Roman', sans-serif;
        font-size: 1.2rem;
        font-weight: 500;
        color: #fff;
        text-shadow: 0 0 5px rgba(0, 242, 255, .3);
        margin: 0; /* Reset margin for consistent spacing */
        color : #00f2ff;
    }
    #oscord-tabs-content .under {
        background: url('./image/blur.svg') center/cover no-repeat fixed;
        border-radius: 15px;
        padding: 40px; /* Increased from 25px for more internal vertical space in the tab content */
        box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
    }
    #oscord-tabs-content .nav-link.active {
        color: rgb(0, 0, 0);
        border-bottom: 3px solid #00f2ff;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Extra protection: disable right-click on video
    document.addEventListener('contextmenu', function(e) {
        if (e.target.tagName === 'VIDEO') {
            e.preventDefault();
            return false;
        }
    });
});
</script>