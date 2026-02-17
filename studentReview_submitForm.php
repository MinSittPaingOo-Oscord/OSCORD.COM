
<div class="form-container animate-on-scroll">
            <h2>Review a Course</h2>
            <form class="form" action="oscord_savereview.php" method="post">
                <div class="mb-3">
                    <label for="student_name" class="form-label">Select Your Name</label>
                    <select class="form-select" id="student_name" name="student_name" required>
                        <option value="">Select</option>
                        <?php
                        if ($result_students && $result_students->num_rows > 0) {
                            while ($row_student = $result_students->fetch_assoc()) {
                                echo "<option value='".htmlspecialchars($row_student['studentID'])."'>".htmlspecialchars($row_student['studentName'])."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="courseID" class="form-label">Select Course</label>
                    <select class="form-select" id="courseID" name="courseID" required>
                        <option value="">Select</option>
                        <?php
                        if ($result_courses && $result_courses->num_rows > 0) {
                            while ($row_course = $result_courses->fetch_assoc()) {
                                echo "<option value='".htmlspecialchars($row_course['courseID'])."'>".htmlspecialchars($row_course['courseName'])."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="textarea_review" class="form-label">Your Review Here</label>
                    <textarea class="form-control" id="textarea_review" rows="5" placeholder="Type your review here" name="review_text" required></textarea>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>