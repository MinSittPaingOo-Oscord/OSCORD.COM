<?php
    $query2 = "SELECT * FROM oscord_course WHERE courseID = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $stmt2->close();
?>


<style>

.btn-course-detail-custom {
    background: #00f2ff; 
    border: none;
    color: #0a0a0a; 
    padding: 12px 30px;
    font-family: 'Orbitron', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 50px; 
    transition: all 0.3s ease;
    box-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff; 
    display: block;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 10px;
 
}

.btn-course-detail-custom:hover {
    background: #00ccff;
    transform: scale(1.05);
    box-shadow: 0 0 15px #00ccff, 0 0 30px #00ccff;
}

.course-details-content-custom {
    background: transparent;
    padding: 10px 15px;
    margin-bottom: 30px;
    max-height: 200px;
    overflow-y: auto;
    animation: fadeIn 1s ease-out;
    width: auto; 
    display: block;
    margin-left : -20px;

}

/* Custom course detail items */
.course-detail-item-custom {
    color: #e6e6e6; /* Light text for dark background */
    font-size: 0.95rem;
    padding: 10px 20px;
    margin-bottom: 5px;
    background: transparent;
    position: relative;
    width: auto; /* Fit content */
    display: inline-block; /* Allow natural width */
    transition: all 0.3s ease;
}

.course-detail-item-custom:hover {
    background: transparent; /* No background change on hover for item itself */
    color: #00f2ff; /* Neon cyan text on hover */
}

.course-detail-item-custom .indicator {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 20px;
    background: #00f2ff; /* Neon cyan indicator */
    border-radius: 2px;
    transition: all 0.3s ease;
}

.course-detail-item-custom:hover .indicator {
    height: 25px; /* Slightly taller indicator on hover */
    background: #00ccff; /* Lighter neon cyan on hover */
}


@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #00f2ff, #ff00ff);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 242, 255, 0.5);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #ff00ff, #00f2ff);
    box-shadow: 0 0 15px rgba(255, 0, 255, 0.5);
}


html {
    scrollbar-width: thin;
    scrollbar-color: #00f2ff rgb(0, 0, 0);
}

</style>

<div class='intro'>
    <?php
        if ($result2 && $result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                echo "
                    <div class='welcome-container'>
                        <div class='container'>
                            <div class='row align-items-center'>
                                <div class='main'>
                                    <h1 id='titleCourseTitle'>".htmlspecialchars($row2['courseName'])."</h1>
                                    <p id='courseDesc'>".htmlspecialchars($row2['courseDescription'])."</p>
                                    <div class='course-info'>
                                        <b>Course Fee</b>: ".htmlspecialchars($row2['courseFee'])."<br><br>
                                        <b>Course Period</b>: ".htmlspecialchars($row2['coursePeriod'])."<br>";
                if (!empty($row2['courseFbLink'])) {
                    echo "<br><div class='detail-item'><a class='fb-link' href='".htmlspecialchars($row2['courseFbLink'])."' target='_blank'>View on Facebook</a></div>";
                }
                echo "        </div>
                                    <button class='btn btn-course-detail-custom' type='button' data-bs-toggle='collapse' data-bs-target='#courseDetails".htmlspecialchars($row2['courseID'])."' aria-expanded='false' aria-controls='courseDetails".htmlspecialchars($row2['courseID'])."'>Course Details</button>
                                    <div class='collapse course-details-content-custom' id='courseDetails".htmlspecialchars($row2['courseID'])."' style='width: auto;'>";
                        $courseID = $row2['courseID'];
                        $query3 = "SELECT * FROM oscord_coursedetail WHERE courseID = ? LIMIT 50";
                        $stmt3 = $conn->prepare($query3);
                        $stmt3->bind_param("i", $courseID);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();

                        while ($row3 = $result3->fetch_assoc()) {
                            echo "<div class='course-detail-item-custom' style='width: auto;'>".htmlspecialchars($row3['coursedetailName'])."<span class='indicator'></span></div>";
                        }
                        $stmt3->close();
                echo "        </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "<p class='text-center'>Course not found.</p>";
        }
    ?>
</div>