<?php
// This PHP block fetches the data. It's assumed to be at the top of your file.
// NOTE: Make sure your query also selects the coursePhoto column, e.g., "SELECT *, coursePhoto FROM..."
$query2 = "SELECT * FROM oscord_course WHERE courseID = ?";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();
?>

<style>
    /* --- Breadcrumb Navigation --- */
    .breadcrumb-nav {
        background-color: #1a1a2e;
        /* Dark navy-blue background */
        padding: 15px 0;
        border-bottom: 1px solid #ff00ff;
        /* Neon pink separator line */
    }

    .breadcrumb {
        margin-bottom: 0;
        /* Remove default margin */
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .breadcrumb-item a {
        color: #bdc3c7;
        /* Light grey for links */
        text-decoration: none;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
    }

    .breadcrumb-item a:hover {
        color: #ffffff;
        /* White on hover */
    }

    .breadcrumb-item.active {
        color: #ffffff;
        /* White for the active page */
    }

    /* This styles the ">" separator */
    .breadcrumb-item+.breadcrumb-item::before {
        color: #bdc3c7;
        padding: 0 .75rem;
        /* Add some space around the separator */
    }

    .breadcrumb-home-icon {
        width: 18px;
        height: 18px;
        fill: currentColor;
        /* Inherits the link's color */
        margin-right: 8px;
    }

    /* General Page & Theme Styles */
    .course-detail-section {
        padding: 60px 0;
        font-family: 'Arial', sans-serif;
    }

    .course-title {
        font-family: 'Orbitron', sans-serif;
        color: #e6e6e6;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 0 10px rgba(200, 63, 246, 0.7);
    }

    .course-description {
        color: #bdc3c7;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    /* Left Column: Image & Meta Info Box */
    .course-image-container {
        border: 2px solid #ff00ff;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 0 25px rgba(234, 68, 246, 0.5);
    }

    .course-image-container img {
        width: 100%;
        height: auto;
        display: block;
    }

    .course-meta-box {
        background-color: rgba(26, 26, 46, 0.7);
        /* Translucent navy */
        border: 1px solid #ff00ff;
        border-radius: 10px;
        padding: 25px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: #e6e6e6;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .meta-item:last-child {
        margin-bottom: 0;
    }

    .meta-item svg {
        width: 24px;
        height: 24px;
        margin-right: 15px;
        fill: #ff00ff;
    }

    .meta-item a {
        color: #e6e6e6;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .meta-item a:hover {
        color: #ff00ff;
    }


    /* Right Column: Details Button & Collapsible Content */
    .btn-toggle-details {
        background: #ff00ff;
        border: none;
        color: #0a0a0a;
        padding: 12px 30px;
        font-family: 'Orbitron', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
        cursor: pointer;
    }

    .btn-toggle-details:hover {
        background: #ff00ff;
        transform: scale(1.05);
        box-shadow: 0 0 15px #ff00ff, 0 0 30px #ff00ff;
    }

    .details-content-wrapper {
        margin-top: 25px;
        background-color: rgba(26, 26, 46, 0.7);
        border-left: 3px solid #ff00ff;
        max-height: 300px;
        /* Set a max height for the scrollable area */
        overflow-y: auto;
        /* Enable vertical scrolling */
        padding: 10px 0;
        animation: fadeIn 1s ease-out;
    }

    .course-detail-item {
        color: #e6e6e6;
        font-size: 1rem;
        padding: 12px 25px;
        position: relative;
        transition: all 0.3s ease;
        cursor: default;
    }

    .course-detail-item:hover {
        background-color: rgba(0, 242, 255, 0.1);
        color: #ff00ff;
    }

    /* Custom Scrollbar (from your original code) */
    .details-content-wrapper::-webkit-scrollbar {
        width: 8px;
    }

    .details-content-wrapper::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    .details-content-wrapper::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #ff00ff, #ff00ff);
        border-radius: 10px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="course-detail-section">
    <div class="container">
        <?php if ($result2 && $result2->num_rows > 0): ?>
            <?php while ($row2 = $result2->fetch_assoc()): ?>
                <nav class="breadcrumb-nav mb-5" aria-label="breadcrumb">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="oscord_home.php"> <svg class="breadcrumb-home-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?= htmlspecialchars($row2['courseName']) ?>
                            </li>
                        </ol>
                    </div>
                </nav>
                <div class="row ">

                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="course-image-container">
                            <img src="image/<?= htmlspecialchars($row2['coursePhoto']) ?>" alt="<?= htmlspecialchars($row2['courseName']) ?>">
                        </div>
                        <p class="course-description"><?= nl2br(htmlspecialchars($row2['courseDescription'])) ?></p>
                    </div>

                    <div class="col-lg-7">
                        <h1 class="course-title"><?= htmlspecialchars($row2['courseName']) ?></h1>
                        <div class="course-meta-box">
                            <div class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c2.16-.43 3.5-1.66 3.5-3.6 0-2.31-1.91-3.46-4.7-4.13z"></path>
                                </svg>
                                <span><b>Fee:</b> <?= htmlspecialchars($row2['courseFee']) ?></span>
                            </div>
                            <div class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path>
                                    <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                                </svg>
                                <span><b>Period:</b> <?= htmlspecialchars($row2['coursePeriod']) ?></span>
                            </div>
                            <?php if (!empty($row2['courseFbLink'])): ?>
                                <div class="meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"></path>
                                    </svg>
                                    <a href="<?= htmlspecialchars($row2['courseFbLink']) ?>" target="_blank">View on Facebook</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <br><br>
                        <button class="btn-toggle-details" type="button" data-bs-toggle="collapse" data-bs-target="#courseSyllabus" aria-expanded="false" aria-controls="courseSyllabus">
                            Course Details
                        </button>

                        <div class="collapse" id="courseSyllabus">
                            <div class="details-content-wrapper">
                                <?php
                                $courseID = $row2['courseID'];
                                $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ? LIMIT 50";
                                $stmt3 = $conn->prepare($query3);
                                $stmt3->bind_param("i", $courseID);
                                $stmt3->execute();
                                $result3 = $stmt3->get_result();

                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "<div class='course-detail-item'>" . htmlspecialchars($row3['coursedetailName']) . "</div>";
                                }
                                $stmt3->close();
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-light">Course not found.</p>
        <?php endif; ?>
        <?php $stmt2->close(); ?>
    </div>
</div>