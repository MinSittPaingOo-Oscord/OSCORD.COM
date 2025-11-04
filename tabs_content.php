<?php
/* tabs_content.php – Fixed no spaces: Use 16:9 maxres thumbnail + fallback, one-click play, no custom button needed (relies on click anywhere on thumbnail) */
?>
<div class='intro3 container'>
    <div class='tab'>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="simpleLectureVideo" data-bs-toggle="tab" data-bs-target="#simple_lecture_video" type="button" role="tab" aria-controls="simple_lecture_video">Free Lecture Videos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="documents" data-bs-toggle="tab" data-bs-target="#documents_" type="button" role="tab" aria-controls="documents_">Documents</button>
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
                    $query4 = "SELECT * FROM oscord_vidlec WHERE videoFree = 1 AND courseID = ? ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED) LIMIT 20";
                    $stmt4 = $conn->prepare($query4);
                    $stmt4->bind_param("i", $id);
                    $stmt4->execute();
                    $result4 = $stmt4->get_result();

                    if ($result4 && $result4->num_rows > 0) {
                        while ($row4 = $result4->fetch_assoc()) {
                            $videoLink = convertToEmbed(htmlspecialchars($row4['videoLink']));
                            $videoId   = md5($videoLink);

                            if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                // Extract YouTube ID
                                $ytId = '';
                                preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([\w-]{11})#i', $videoLink, $m);
                                $ytId = $m[1] ?? '';
                                $thumbMax = $ytId ? "https://img.youtube.com/vi/{$ytId}/maxresdefault.jpg" : "https://via.placeholder.com/640x360?text=No+Thumb";
                                $thumbHq = $ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : "https://via.placeholder.com/640x360?text=No+Thumb";

                                echo "<div class='col-12 col-md-6 col-lg-4'>
                                        <div class='video-card'>
                                            <div class='video-wrapper' data-embed='$videoLink'>
                                                <iframe src='' title='" . htmlspecialchars($row4['videoName']) . "'
                                                        frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                                                        allowfullscreen loading='lazy' style='display:none;'></iframe>
                                                <img class='yt-thumb' src='$thumbMax' alt='" . htmlspecialchars($row4['videoName']) . "' loading='lazy' onerror=\"this.src='$thumbHq';\">
                                            </div>
                                            <div class='card-body'>
                                                <h5 class='card-title'>" . htmlspecialchars($row4['videoName']) . "</h5>
                                                <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId'>
                                                    Show Details
                                                </button>
                                                <div class='collapse video-details mt-2' id='details-$videoId'>
                                                    <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                </div>
                                            </div>
                                        </div>
                                      </div>";
                            } else {
                                echo "<p class='video-error'>Invalid video link for: " . htmlspecialchars($row4['videoName']) . "</p>";
                            }
                        }
                        $stmt4->close();
                    } else {
                        echo "<p class='text-center text-white mt-3'>No free lecture videos available.</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- ==================== DOCUMENTS ==================== -->
            <div class="tab-pane fade" id="documents_" role="tabpanel" aria-labelledby="documents">
                <div id='unlockeddocuments' style='display:none;'>
                    <div class="mt-4">
                        <?php
                        $query5 = "SELECT * FROM file WHERE courseID = ? LIMIT 50";
                        $stmt5 = $conn->prepare($query5);
                        $stmt5->bind_param("i", $id);
                        $stmt5->execute();
                        $result5 = $stmt5->get_result();

                        if ($result5 && $result5->num_rows > 0) {
                            echo "<div class='fileBox'><h2>Course Documents</h2><ul class='list-group mt-3'>";
                            while ($row = $result5->fetch_assoc()) {
                                echo "<li class='list-group-item'>
                                        <a href='download.php?id=" . htmlspecialchars($row['fileID']) . "'>" . htmlspecialchars($row['fileName']) . "</a>
                                        <span class='badge'>Download</span>
                                      </li>";
                            }
                            echo "</ul></div>";
                        } else {
                            echo "<div class='alert alert-info mt-3 text-center'>No documents available.</div>";
                        }
                        $stmt5->close();
                        ?>
                    </div>
                </div>
            </div>

            <!-- ==================== PRIVATE VIDEOS ==================== -->
            <div class="tab-pane fade" id="private_lecture_video" role="tabpanel" aria-labelledby="privateLectureVideo">
                <div id='unlockedcontent' style='display:none;'>
                    <div class="mt-4">
                        <div class="row">
                            <?php
                            $query9 = "SELECT * FROM oscord_vidlec WHERE courseID = ? ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED) LIMIT 20";
                            $stmt9 = $conn->prepare($query9);
                            $stmt9->bind_param("i", $id);
                            $stmt9->execute();
                            $result9 = $stmt9->get_result();

                            if ($result9 && $result9->num_rows > 0) {
                                while ($row9 = $result9->fetch_assoc()) {
                                    $videoLink = convertToEmbed(htmlspecialchars($row9['videoLink']));
                                    $videoId   = md5($videoLink);

                                    if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                        $ytId = '';
                                        preg_match('#(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([\w-]{11})#i', $videoLink, $m);
                                        $ytId = $m[1] ?? '';
                                        $thumbMax = $ytId ? "https://img.youtube.com/vi/{$ytId}/maxresdefault.jpg" : "https://via.placeholder.com/640x360?text=No+Thumb";
                                        $thumbHq = $ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : "https://via.placeholder.com/640x360?text=No+Thumb";

                                        echo "<div class='col-12 col-md-6 col-lg-4'>
                                                <div class='video-card'>
                                                    <div class='video-wrapper' data-embed='$videoLink'>
                                                        <iframe src='' title='" . htmlspecialchars($row9['videoName']) . "'
                                                                frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                                                                allowfullscreen loading='lazy' style='display:none;'></iframe>
                                                        <img class='yt-thumb' src='$thumbMax' alt='" . htmlspecialchars($row9['videoName']) . "' loading='lazy' onerror=\"this.src='$thumbHq';\">
                                                    </div>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>" . htmlspecialchars($row9['videoName']) . "</h5>
                                                        <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId'>
                                                            Show Details
                                                        </button>
                                                        <div class='collapse video-details mt-2' id='details-$videoId'>
                                                            <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>";
                                    } else {
                                        echo "<p class='video-error'>Invalid video link for: " . htmlspecialchars($row9['videoName']) . "</p>";
                                    }
                                }
                                $stmt9->close();
                            } else {
                                echo "<p class='text-center text-white mt-3'>No video lectures available.</p>";
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
/* Thumbnail fits without spaces (16:9 maxres fills perfectly) */
.yt-thumb {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: contain; /* Full image, no crop, no spaces for 16:9 thumbnails */
    background: #000; /* Black fill if any mismatch */
    cursor: pointer;
    transition: opacity .3s;
}
.yt-thumb:hover { opacity: .85; }

/* Video wrapper */
.video-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect */
    border-radius: 15px 15px 0 0;
    overflow: hidden;
    background: #000;
}
.video-wrapper iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
}

/* Card styles (unchanged) */
.video-card { background: transparent; border-radius: 15px; margin-bottom: 25px; overflow: hidden; transition: all .4s; animation: fadeIn 1s; height: auto; box-shadow: 0 0 2px rgba(0, 242, 255, .5); }
.video-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 0 25px rgba(0, 242, 255, .5); }
.video-card .card-body { padding: 20px; }
.video-card .card-title { font-family: 'Times New Roman', sans-serif; font-size: 1.2rem; font-weight: 500; margin-bottom: 20px; color: #fff; text-shadow: 0 0 5px rgba(0, 242, 255, .3); line-height: 30px; }
.details-btn { color: #ff00ff; background: transparent; border: 1px solid #ff00ff; padding: 8px 15px; font-size: .95rem; border-radius: 50px; transition: all .3s; animation: neonGlow 2s infinite; }
.details-btn:hover { background: #ff00ff; color: #fff; transform: scale(1.05); }
.video-details { font-size: .95rem; color: #d0d0d0; }
.video-details a { color: #ff00ff; transition: all .3s; }
.video-details a:hover { color: #fff; text-shadow: 0 0 10px #ff00ff; }

/* Tabs */
.intro3 .nav-tabs { border-bottom: 2px solid #444; margin-bottom: 25px; }
.intro3 .nav-link { color: #d0d0d0; font-family: 'Times New Roman', sans-serif; font-size: 1rem; font-weight: 500; padding: 12px 25px; border: none; transition: all .3s; }
.intro3 .nav-link.active { color:rgb(0, 0, 0); border-bottom: 3px solid #00f2ff; text-shadow: 0 0 10px rgba(0, 242, 255, .5); }
.intro3 .nav-link:hover { color: #00f2ff; transform: translateY(-2px); }
.under { background: url('./image/blur.svg') center/cover no-repeat fixed; border-radius: 15px; padding: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, .3); animation: fadeIn 1s; margin-bottom: 50px; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: none; } }
@keyframes neonGlow { 0%, 100% { box-shadow: 0 0 5px #ff00ff; } 50% { box-shadow: 0 0 20px #ff00ff; } }

@media (max-width: 767px) {
           
           .video-card {
               height: auto;
           }

           .video-card .card-title {
               font-size: 1.1rem;
           }

           .fileBox {
               padding: 20px;
           }

           .fileBox .list-group-item a {
               font-size: 0.85rem;
           }
        }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Scroll-in animation
    const obs = new IntersectionObserver(es => es.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('animate'); obs.unobserve(e.target); }
    }), { threshold: 0.1 });
    document.querySelectorAll('.video-card, .fileBox').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.classList.add('animate-on-scroll');
        obs.observe(el);
    });

    // ONE-CLICK PLAY: click thumbnail to load + autoplay
    document.querySelectorAll('.video-wrapper').forEach(wrap => {
        const iframe = wrap.querySelector('iframe');
        const thumb = wrap.querySelector('.yt-thumb');
        if (!iframe || !thumb) return;

        thumb.addEventListener('click', () => {
            const url = wrap.dataset.embed;
            iframe.src = url + (url.includes('?') ? '&' : '?') + 'autoplay=1';
            iframe.style.display = 'block';
            thumb.style.display = 'none';
        }, { once: true });
    });

    // Fade-in keyframes
    const kf = document.createElement('style');
    kf.textContent = `
        .animate-on-scroll.animate { animation: fadeIn .8s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: none; } }
    `;
    document.head.appendChild(kf);
});
</script>