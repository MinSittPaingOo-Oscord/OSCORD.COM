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
                                $videoId = md5($videoLink);
                                if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                    // Extract YouTube video ID
                                    $ytVideoId = '';
                                    if (preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/)|youtu\.be\/)([\w-]{11})/i', $videoLink, $match)) {
                                        $ytVideoId = $match[1];
                                    }
                                    $thumbnailUrl = $ytVideoId ? "https://img.youtube.com/vi/{$ytVideoId}/hqdefault.jpg" : "https://via.placeholder.com/640x360?text=Thumbnail+Not+Available";
                                    echo "
                                        <div class='col-12 col-md-6 col-lg-4'>
                                            <div class='video-card'>
                                                <div class='video-wrapper' data-src='$videoLink'>
                                                    <iframe src='' title='".htmlspecialchars($row4['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen loading='lazy' style='display: none;'></iframe>
                                                    <div class='video-placeholder loaded' style='background-image: url(\"$thumbnailUrl\");'>
                                                        <div class='play-button'></div>
                                                    </div>
                                                </div>
                                                <div class='card-body'>
                                                    <h5 class='card-title'>".htmlspecialchars($row4['videoName'])."</h5>
                                                    <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId' aria-expanded='false' aria-controls='details-$videoId'>
                                                        Show Details
                                                    </button>
                                                    <div class='collapse video-details mt-2' id='details-$videoId'>
                                                        <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                } else {
                                    echo "<p class='video-error'>Invalid video link for: ".htmlspecialchars($row4['videoName'])."</p>";
                                }
                            }
                            $stmt4->close();
                        } else {
                            echo "<p class='text-center text-white mt-3'>No free lecture videos available.</p>";
                        }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade" id="documents_" role="tabpanel" aria-labelledby="documents">
                <div id='unlockeddocuments' style='display: none;'>
                    <div class="mt-4">
                        <?php
                            $query5 = "SELECT * FROM file WHERE courseID = ? LIMIT 50";
                            $stmt5 = $conn->prepare($query5);
                            $stmt5->bind_param("i", $id);
                            $stmt5->execute();
                            $result5 = $stmt5->get_result();

                            if ($result5 && $result5->num_rows > 0) {
                                echo "<div class='fileBox'>";
                                echo "<h2>Course Documents</h2>";
                                echo "<ul class='list-group mt-3'>";
                                while ($row = $result5->fetch_assoc()) {
                                    echo "<li class='list-group-item'>";
                                    echo "<a href='download.php?id=".htmlspecialchars($row['fileID'])."'>".htmlspecialchars($row['fileName'])."</a>";
                                    echo "<span class='badge'>Download</span>";
                                    echo "</li>";
                                }
                                echo "</ul>";
                                echo "</div>";
                            } else {
                                echo "<div class='alert alert-info mt-3 text-center'>No documents available.</div>";
                            }
                            $stmt5->close();
                        ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="private_lecture_video" role="tabpanel" aria-labelledby="privateLectureVideo">
                <div id='unlockedcontent' style='display: none;'>
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
                                        $videoId = md5($videoLink);
                                        if (!empty($videoLink) && filter_var($videoLink, FILTER_VALIDATE_URL)) {
                                            // Extract YouTube video ID
                                            $ytVideoId = '';
                                            if (preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/)|youtu\.be\/)([\w-]{11})/i', $videoLink, $match)) {
                                                $ytVideoId = $match[1];
                                            }
                                            $thumbnailUrl = $ytVideoId ? "https://img.youtube.com/vi/{$ytVideoId}/hqdefault.jpg" : "https://via.placeholder.com/640x360?text=Thumbnail+Not+Available";
                                            echo "
                                                <div class='col-12 col-md-6 col-lg-4'>
                                                    <div class='video-card'>
                                                        <div class='video-wrapper' data-src='$videoLink'>
                                                            <iframe src='' title='".htmlspecialchars($row9['videoName'])."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen loading='lazy' style='display: none;'></iframe>
                                                            <div class='video-placeholder loaded' style='background-image: url(\"$thumbnailUrl\");'>
                                                                <div class='play-button'></div>
                                                            </div>
                                                        </div>
                                                        <div class='card-body'>
                                                            <h5 class='card-title'>".htmlspecialchars($row9['videoName'])."</h5>
                                                            <button class='details-btn' type='button' data-bs-toggle='collapse' data-bs-target='#details-$videoId' aria-expanded='false' aria-controls='details-$videoId'>
                                                                Show Details
                                                            </button>
                                                            <div class='collapse video-details mt-2' id='details-$videoId'>
                                                                <p>If the video doesn't load, <a href='$videoLink' target='_blank'>watch here</a>.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                        } else {
                                            echo "<p class='video-error'>Invalid video link for: ".htmlspecialchars($row9['videoName'])."</p>";
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
    .video-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        cursor: pointer;
        z-index: 1;
        opacity: 1;
    }

    .video-placeholder.loaded {
        opacity: 1;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 64px;
        height: 64px;
        background: url('https://img.icons8.com/ios-filled/64/ffffff/play.png') no-repeat center;
        background-size: contain;
        opacity: 0.8;
        transition: opacity 0.3s ease;
        z-index: 2;
    }

    .play-button:hover {
        opacity: 1;
    }

    .video-placeholder::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .video-wrapper {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        border-radius: 15px 15px 0 0;
        overflow: hidden;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.video-card, .fileBox').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.classList.add('animate-on-scroll');
            observer.observe(el);
        });

        document.querySelectorAll('.video-wrapper').forEach(wrapper => {
            const iframe = wrapper.querySelector('iframe');
            const placeholder = wrapper.querySelector('.video-placeholder');
            if (iframe && placeholder) {
                placeholder.classList.add('loaded');
                placeholder.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent tab click interference
                    iframe.src = wrapper.dataset.src;
                    iframe.style.display = 'block';
                    placeholder.style.display = 'none';
                }, { once: true }); // Ensure single execution
            }
        });

        const style = document.createElement('style');
        style.innerHTML = `
            .animate-on-scroll.animate {
                animation: fadeIn 0.8s ease-out forwards;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    });
</script>