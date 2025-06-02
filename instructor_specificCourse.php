<?php
session_start();
require_once 'connectdb.php';

// Check if instructor is logged in
if (!isset($_SESSION['instructor_id']) || !is_numeric($_SESSION['instructor_id'])) {
    header("Location: oscord_instructorControlLogin.php?error=Please login first");
    exit();
}

$instructorID = (int)$_SESSION['instructor_id'];
$courseID = isset($_GET['courseID']) ? (int)$_GET['courseID'] : 0;
$message = '';

// Debug log function
function logDebug($message) {
    $log = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    file_put_contents('debug.log', $log, FILE_APPEND);
}

// Check database connection
if ($conn->connect_error) {
    $error = "Database connection failed: " . $conn->connect_error;
    logDebug($error);
    $message = "Database connection error.";
}

// Validate courseID and instructor access
$query = "SELECT c.courseID, c.courseName, c.courseDescription, c.courseFee, c.coursePeriod, c.courseFbLink 
          FROM oscord_course c 
          JOIN oscord_instructorxcourse ic ON c.courseID = ic.courseID 
          WHERE ic.instructorID = ? AND c.courseID = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("ii", $instructorID, $courseID);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    $error = "Failed to prepare course query: " . $conn->error;
    logDebug($error);
    $message = "Error fetching course details.";
}

// Fetch course details from oscord_coursedetail
if ($course) {
    $query = "SELECT coursedetailID, coursedetailName FROM oscord_coursedetail WHERE courseID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $courseID);
        $stmt->execute();
        $courseDetails = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = "Failed to prepare course details query: " . $conn->error;
        logDebug($error);
        $message = "Error fetching course details.";
    }

    // Fetch video lectures from oscord_vidlec
    $query = "SELECT videoID, videoName, videoLink, videoFree,videoNumber FROM oscord_vidlec WHERE courseID = ? ORDER BY CAST(SUBSTRING_INDEX(videoName, '.', 1) AS UNSIGNED)";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $courseID);
        $stmt->execute();
        $videoLectures = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = "Failed to prepare video lectures query: " . $conn->error;
        logDebug($error);
        $message = "Error fetching video lectures.";
    }

    // Fetch lecture files from file table
    $query = "SELECT fileID, fileName FROM file WHERE courseID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $courseID);
        $stmt->execute();
        $files = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = "Failed to prepare files query: " . $conn->error;
        logDebug($error);
        $message = "Error fetching lecture files.";
    }

    // Fetch enrolled students
    $query = "SELECT * 
              FROM oscord_student s 
              JOIN oscord_studentxcourse sc ON s.studentID = sc.studentID 
              WHERE sc.courseID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $courseID);
        $stmt->execute();
        $students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $error = "Failed to prepare students query: " . $conn->error;
        logDebug($error);
        $message = "Error fetching enrolled students.";
    }
} else {
    $message = "Course not found or access denied.";
    $courseDetails = [];
    $videoLectures = [];
    $files = [];
    $students = [];
}

// Handle file deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_file') {
    logDebug("Processing delete_file action for instructorID: $instructorID");
    $pin = trim($_POST['pin'] ?? '');
    $fileID = isset($_POST['fileID']) ? (int)$_POST['fileID'] : 0;

    logDebug("Received PIN: '$pin', FileID: $fileID");

    // Verify PIN
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $dbPin = trim($result['instructorPin'] ?? '');
        logDebug("Database PIN: '$dbPin' for instructorID: $instructorID");
        logDebug("PIN comparison: input='$pin' vs db='$dbPin'");

        if ($dbPin && (string)$pin === (string)$dbPin) {
            $query = "DELETE FROM file WHERE fileID = ? AND courseID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $fileID, $courseID);
                if ($stmt->execute()) {
                    logDebug("File ID $fileID deleted");
                    echo json_encode(['success' => true, 'message' => 'File deleted successfully']);
                } else {
                    $error = "Execute failed: " . $stmt->error;
                    logDebug($error);
                    echo json_encode(['success' => false, 'message' => 'Error deleting file']);
                }
                $stmt->close();
            } else {
                $error = "Prepare failed: " . $conn->error;
                logDebug($error);
                echo json_encode(['success' => false, 'message' => 'Database error']);
            }
        } else {
            logDebug("PIN mismatch for delete_file, input: '$pin', db: '$dbPin'");
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN']);
        }
    } else {
        $error = "Failed to prepare PIN query: " . $conn->error;
        logDebug($error);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}

// Handle form submission for updating course
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'update_course') {
    logDebug("Processing update_course action for instructorID: $instructorID");
    $pin = trim($_POST['pin'] ?? '');
    $courseName = trim($_POST['courseName'] ?? '');
    $courseDescription = trim($_POST['courseDescription'] ?? '');
    $courseFee = trim($_POST['courseFee'] ?? '');
    $coursePeriod = trim($_POST['coursePeriod'] ?? '');
    $courseFbLink = trim($_POST['courseFbLink'] ?? '');
    $courseDetailsInputs = $_POST['courseDetails'] ?? [];
    $newCourseDetails = $_POST['newCourseDetails'] ?? [];

    logDebug("Received PIN: '$pin', CourseName: '$courseName', Fee: '$courseFee'");

    // Verify PIN
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $dbPin = trim($result['instructorPin'] ?? '');
        logDebug("Database PIN: '$dbPin' for instructorID: $instructorID");
        logDebug("PIN comparison: input='$pin' vs db='$dbPin'");

        if ($dbPin && (string)$pin === (string)$dbPin) {
            $conn->begin_transaction();
            try {
                // Update course
                $query = "UPDATE oscord_course SET courseName = ?, courseDescription = ?, courseFee = ?, coursePeriod = ?, courseFbLink = ? WHERE courseID = ? AND EXISTS (SELECT 1 FROM oscord_instructorxcourse WHERE courseID = ? AND instructorID = ?)";
                $stmt = $conn->prepare($query);
                if (!$stmt) {
                    throw new Exception("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param("sssssiii", $courseName, $courseDescription, $courseFee, $coursePeriod, $courseFbLink, $courseID, $courseID, $instructorID);
                if (!$stmt->execute()) {
                    throw new Exception("Execute failed: " . $stmt->error);
                }
                $stmt->close();

                // Update existing course details
                foreach ($courseDetailsInputs as $detailID => $detailName) {
                    $detailName = trim($detailName);
                    $query = "UPDATE oscord_coursedetail SET coursedetailName = ? WHERE coursedetailID = ? AND courseID = ?";
                    $stmt = $conn->prepare($query);
                    if (!$stmt) {
                        throw new Exception("Prepare failed: " . $conn->error);
                    }
                    $stmt->bind_param("sii", $detailName, $detailID, $courseID);
                    if (!$stmt->execute()) {
                        throw new Exception("Execute failed: " . $stmt->error);
                    }
                    $stmt->close();
                }

                // Add new course details
                foreach ($newCourseDetails as $newDetail) {
                    $newDetail = trim($newDetail);
                    if (!empty($newDetail)) {
                        $query = "INSERT INTO oscord_coursedetail (courseID, coursedetailName) VALUES (?, ?)";
                        $stmt = $conn->prepare($query);
                        if (!$stmt) {
                            throw new Exception("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("is", $courseID, $newDetail);
                        if (!$stmt->execute()) {
                            throw new Exception("Execute failed: " . $stmt->error);
                        }
                        $stmt->close();
                    }
                }

                $conn->commit();
                logDebug("Course updated successfully for courseID: $courseID");
                echo json_encode(['success' => true, 'message' => 'Course updated successfully']);
            } catch (Exception $e) {
                $conn->rollback();
                $error = "Failed to update course: " . $e->getMessage();
                logDebug($error);
                echo json_encode(['success' => false, 'message' => 'Error updating course: ' . $e->getMessage()]);
            }
        } else {
            logDebug("PIN mismatch for update_course, input: '$pin', db: '$dbPin'");
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN']);
        }
    } else {
        $error = "Failed to prepare PIN query: " . $conn->error;
        logDebug($error);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}

// Handle course detail deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_course_detail') {
    logDebug("Processing delete_course_detail action for instructorID: $instructorID");
    $pin = trim($_POST['pin'] ?? '');
    $coursedetailID = isset($_POST['coursedetailID']) ? (int)$_POST['coursedetailID'] : 0;

    logDebug("Received PIN: '$pin', CourseDetailID: $coursedetailID");

    // Verify PIN
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $dbPin = trim($result['instructorPin'] ?? '');
        logDebug("Database PIN: '$dbPin' for instructorID: $instructorID");
        logDebug("PIN comparison: input='$pin' vs db='$dbPin'");

        if ($dbPin && (string)$pin === (string)$dbPin) {
            $query = "DELETE FROM oscord_coursedetail WHERE coursedetailID = ? AND courseID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $coursedetailID, $courseID);
                if ($stmt->execute()) {
                    logDebug("Course detail ID $coursedetailID deleted");
                    echo json_encode(['success' => true, 'message' => 'Course detail deleted successfully']);
                } else {
                    $error = "Execute failed: " . $stmt->error;
                    logDebug($error);
                    echo json_encode(['success' => false, 'message' => 'Error deleting course detail']);
                }
                $stmt->close();
            } else {
                $error = "Prepare failed: " . $conn->error;
                logDebug($error);
                echo json_encode(['success' => false, 'message' => 'Error preparing deletion']);
            }
        } else {
            logDebug("PIN mismatch for delete_course_detail, input: '$pin', db: '$dbPin'");
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN']);
        }
    } else {
        $error = "Failed to prepare PIN query: " . $conn->error;
        logDebug($error);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}

// Handle video lecture deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete_video_lecture') {
    logDebug("Processing delete_video_lecture action for instructorID: $instructorID");
    $pin = trim($_POST['pin'] ?? '');
    $videoID = isset($_POST['videoID']) ? (int)$_POST['videoID'] : 0;

    logDebug("Received PIN: '$pin', VideoID: $videoID");

    // Verify PIN
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $dbPin = trim($result['instructorPin'] ?? '');
        logDebug("Database PIN: '$dbPin' for instructorID: $instructorID");
        logDebug("PIN comparison: input='$pin' vs db='$dbPin'");

        if ($dbPin && (string)$pin === (string)$dbPin) {
            $query = "DELETE FROM oscord_vidlec WHERE videoID = ? AND courseID = ?";
            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $videoID, $courseID);
                if ($stmt->execute()) {
                    logDebug("Video lecture ID $videoID deleted");
                    echo json_encode(['success' => true, 'message' => 'Video lecture deleted successfully']);
                } else {
                    $error = "Execute failed: " . $stmt->error;
                    logDebug($error);
                    echo json_encode(['success' => false, 'message' => 'Error deleting video lecture']);
                }
                $stmt->close();
            } else {
                $error = "Prepare failed: " . $conn->error;
                logDebug($error);
                echo json_encode(['success' => false, 'message' => 'Database error']);
            }
        } else {
            logDebug("PIN mismatch for delete_video_lecture, input: '$pin', db: '$dbPin'");
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN']);
        }
    } else {
        $error = "Failed to prepare PIN query: " . $conn->error;
        logDebug($error);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}

// Handle video lectures update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'update_video_lectures') {
    logDebug("Processing update_video_lectures action for instructorID: $instructorID");
    $pin = trim($_POST['pin'] ?? '');
    $videoLecturesInputs = $_POST['videoLectures'] ?? [];
    $newVideoLectures = $_POST['newVideoLectures'] ?? [];

    logDebug("Received PIN: '$pin'");

    // Verify PIN
    $query = "SELECT instructorPin FROM oscord_instructor WHERE instructorID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $instructorID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $dbPin = trim($result['instructorPin'] ?? '');
        logDebug("Database PIN: '$dbPin' for instructorID: $instructorID");
        logDebug("PIN comparison: input='$pin' vs db='$dbPin'");

        if ($dbPin && (string)$pin === (string)$dbPin) {
            $conn->begin_transaction();
            try {
                // Update existing video lectures
                foreach ($videoLecturesInputs as $videoID => $data) {
                    $videoName = trim($data['name'] ?? '');
                    $videoLink = trim($data['link'] ?? '');
                    $videoFree = isset($data['free']) && in_array($data['free'], ['0', '1']) ? (int)$data['free'] : 0;
                    if (!empty($videoName) && !empty($videoLink)) {
                        $query = "UPDATE oscord_vidlec SET videoName = ?, videoLink = ?, videoFree = ? WHERE videoID = ? AND courseID = ?";
                        $stmt = $conn->prepare($query);
                        if (!$stmt) {
                            throw new Exception("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("ssiii", $videoName, $videoLink, $videoFree, $videoID, $courseID);
                        if (!$stmt->execute()) {
                            throw new Exception("Execute failed: " . $stmt->error);
                        }
                        $stmt->close();
                    }
                }

                // Add new video lectures
                foreach ($newVideoLectures as $data) {
                    $videoName = trim($data['name'] ?? '');
                    $videoLink = trim($data['link'] ?? '');
                    $videoFree = isset($data['free']) && in_array($data['free'], ['0', '1']) ? (int)$data['free'] : 0;
                    if (!empty($videoName) && !empty($videoLink)) {
                        $query = "INSERT INTO oscord_vidlec (courseID, videoName, videoLink, videoFree) VALUES (?, ?, ?, ?)";
                        $stmt = $conn->prepare($query);
                        if (!$stmt) {
                            throw new Exception("Prepare failed: " . $conn->error);
                        }
                        $stmt->bind_param("issi", $courseID, $videoName, $videoLink, $videoFree);
                        if (!$stmt->execute()) {
                            throw new Exception("Execute failed: " . $stmt->error);
                        }
                        $stmt->close();
                    }
                }

                $conn->commit();
                logDebug("Video lectures updated successfully for courseID: $courseID");
                echo json_encode(['success' => true, 'message' => 'Video lectures updated successfully']);
            } catch (Exception $e) {
                $conn->rollback();
                $error = "Failed to update video lectures: " . $e->getMessage();
                logDebug($error);
                echo json_encode(['success' => false, 'message' => 'Error updating video lectures: ' . $e->getMessage()]);
            }
        } else {
            logDebug("PIN mismatch for update_video_lectures, input: '$pin', db: '$dbPin'");
            echo json_encode(['success' => false, 'message' => 'Incorrect PIN']);
        }
    } else {
        $error = "Failed to prepare PIN query: " . $conn->error;
        logDebug($error);
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - Oscord</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            background: linear-gradient(135deg, #0d0d2b 0%, #2a0a4e 100%);
            min-height: 100vh;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
            color: #e0e0ff;
        }
        canvas#particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .cyber-card {
            background: rgba(20, 20, 40, 0.5);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            border: 2px solid rgba(255, 20, 147, 0.5);
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .cyber-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.5);
        }
        .btn-cyber {
            background: linear-gradient(45deg, #ff1493, #00ffea);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            text-align: center;
            width: auto;
            cursor: pointer;
        }
        .btn-cyber:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 234, 0.7);
        }
        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            border-radius: 50%;
        }
        .btn-cyber:hover::before {
            width: 300%;
            height: 300%;
        }
        .btn-group {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            white-space: nowrap;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
        }
        .btn-group::-webkit-scrollbar {
            height: 6px;
        }
        .btn-group::-webkit-scrollbar-track {
            background: rgba(255, 20, 147, 0.1);
            border-radius: 3px;
        }
        .btn-group::-webkit-scrollbar-thumb {
            background: #00ffea;
            border-radius: 3px;
        }
        .btn-delete {
            background: linear-gradient(45deg, #ff4444, #ff9999);
            padding: 0.4rem 0.8rem;
            border-radius: 0.4rem;
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .btn-delete:hover {
            transform: scale(1.05);
            box-shadow: 0 0 8px rgba(255, 68, 68, 0.7);
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .profile-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff1493, #00ffea);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fff;
        }
        .alert-cyber {
            animation: glitch 0.3s ease;
            background: rgba(255, 20, 147, 0.2);
            border: 2px solid #ff1493;
            color: #ffccff;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, 0); }
            80% { transform: translate(2px, 2px); }
            100% { transform: translate(0); }
        }
        .course-button {
            background: rgba(40, 40, 60, 0.4);
            border: 1px solid rgba(0, 255, 234, 0.3);
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            color: #e0e0ff;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .course-button:hover {
            border-color: #00ffea;
            transform: translateX(5px);
            background: rgba(0, 255, 234, 0.1);
        }
        .section {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .section.active {
            display: block;
            opacity: 1;
        }
        .form-input {
            background: rgba(255, 255, 255, 0.05);
            color: #e0e0ff;
            border: 2px solid rgba(255, 20, 147, 0.4);
            border-radius: 0.5rem;
            padding: 0.8rem;
            width: 100%;
            margin-bottom: 1rem;
        }
        .form-input:focus {
            border-color: #00ffea;
            box-shadow: 0 0 10px rgba(0, 255, 234, 0.5);
            outline: none;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: rgba(20, 20, 40, 0.9);
            padding: 2rem;
            border-radius: 1rem;
            border: 2px solid #ff1493;
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.5);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .modal-content input {
            background: rgba(255, 255, 255, 0.05);
            color: #e0e0ff;
            border: 2px solid rgba(255, 20, 147, 0.4);
            border-radius: 0.5rem;
            padding: 0.8rem;
            width: 100%;
            margin-bottom: 1rem;
        }
        .modal-content input:focus {
            border-color: #00ffea;
            box-shadow: 0 0 10px rgba(0, 255, 234, 0.5);
            outline: none;
        }
        .modal-content .btn-cyber {
            width: auto;
            padding: 0.8rem 2rem;
            margin: 0.5rem;
        }
        .table-cyber {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .table-cyber th, .table-cyber td {
            padding: 0.8rem;
            border: 1px solid rgba(255, 20, 147, 0.3);
            text-align: left;
            color: #e0e0ff;
        }
        .table-cyber th {
            background: rgba(255, 20, 147, 0.2);
            font-weight: bold;
        }
        .table-cyber tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.02);
        }
        .table-cyber a {
            color: #00ffea;
            text-decoration: none;
        }
        .table-cyber a:hover {
            text-decoration: underline;
        }
        @media (max-width: 640px) {
            .cyber-card {
                padding: 1.5rem;
            }
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            .profile-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            .btn-cyber {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
            .btn-group {
                gap: 0.3rem;
            }
            .table-cyber {
                font-size: 0.9rem;
            }
            .table-cyber th, .table-cyber td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container mx-auto">
        <!-- PIN Verification Modal -->
        <div id="pinModal" class="modal">
            <div class="modal-content">
                <h3 class="text-xl font-bold text-white mb-4">Enter Your PIN</h3>
                <input type="number" id="pinInput" class="form-input" placeholder="Enter 6-digit PIN">
                <p id="pinError" class="text-red-500 hidden mb-4"></p>
                <div class="flex justify-center space-x-4">
                    <button class="btn-cyber" onclick="verifyPin()">Submit</button>
                    <button class="btn-cyber" onclick="closePinModal()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Course Profile -->
        <div class="cyber-card">
            <?php if (!empty($message)): ?>
                <div class="alert-cyber">
                    <span><?php echo htmlspecialchars($message); ?></span>
                    <button onclick="button" onclick="this.parentElement.remove()"> class="hover:text-white">×</button>
                </div>
            <?php endif; ?>
            <?php if ($course): ?>
                <div class="profile-header">
                    <div class="profile-icon"><?php echo htmlspecialchars(strtoupper(substr($course['courseName'], 0, 1))); ?></div>
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-2"><?php echo htmlspecialchars($course['courseName']); ?></h2>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn-cyber" onclick="toggleSection('edit-course')">Edit Course</button>
                    <button class="btn-cyber" onclick="toggleSection('video-lectures-section')">Video Lectures</button>
                    <button class="btn-cyber" onclick="toggleSection('lecture-file-section')">Lecture Files</button>
                    <button class="btn-cyber" onclick="toggleSection('students-section')">Students Enrolled</button>
                    <a href="admin_dashboard.php" class="btn-cyber">Back to Dashboard</a>
                </div>
            <?php else: ?>
                <p class="text-gray-400 mb-4">Course not found or access denied.</p>
                <a href="admin_dashboard.php" class="btn-cyber">Back to Dashboard</a>
            <?php endif; ?>
        </div>

        <!-- Edit Course Section -->
        <div id="edit-course" class="section cyber-card">
            <h3 class="text-xl font-semibold text-cyan-400 mb-4">Edit Course</h3>
            <form id="editCourseForm" onsubmit="return showPinModal('editCourseForm', 'update_course')">
                <input type="hidden" name="action" value="update_course">
                <input type="hidden" name="pin" id="pinField">
                <div class="mb-4">
                    <label for="courseName" class="block text-gray-300 mb-1">Course Name</label>
                    <input type="text" id="courseName" name="courseName" class="form-input" required value="<?php echo htmlspecialchars($course['courseName'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label for="courseDescription" class="block text-gray-300 mb-1">Description</label>
                    <textarea id="courseDescription" name="courseDescription" class="form-input" rows="4"><?php echo htmlspecialchars($course['courseDescription'] ?? ''); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="courseFee" class="block text-gray-300 mb-1">Fee</label>
                    <input type="text" id="courseFee" name="courseFee" class="form-input" required value="<?php echo htmlspecialchars($course['courseFee'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label for="coursePeriod" class="block text-gray-300 mb-1">Period</label>
                    <input type="text" id="coursePeriod" name="coursePeriod" class="form-input" required value="<?php echo htmlspecialchars($course['coursePeriod'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label for="courseFbLink" class="block text-gray-300 mb-1">Facebook Link</label>
                    <input type="url" id="courseFbLink" name="courseFbLink" class="form-input" value="<?php echo htmlspecialchars($course['courseFbLink'] ?? ''); ?>">
                </div>
                <h4 class="text-lg font-semibold text-cyan-400 mb-2">Course Details</h4>
                <div id="courseDetailsContainer">
                    <?php foreach ($courseDetails as $detail): ?>
                        <div class="flex mb-2 course-detail-item" id="detail-<?php echo $detail['coursedetailID']; ?>">
                            <input type="text" name="courseDetails[<?php echo $detail['coursedetailID']; ?>]" class="form-input mr-2" value="<?php echo htmlspecialchars($detail['coursedetailName']); ?>">
                            <button type="button" class="btn-delete" onclick="showPinModal('detail-<?php echo $detail['coursedetailID']; ?>', 'delete_course_detail', <?php echo $detail['coursedetailID']; ?>)">Delete</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="btn-cyber mb-4" onclick="addCourseDetailInput()">Add New Course Detail</button>
                <button type="submit" class="btn-cyber">Save Changes</button>
            </form>
        </div>

        <!-- Video Lectures Section -->
        <div id="video-lectures-section" class="section cyber-card">
            <h3 class="text-xl font-semibold text-cyan-400 mb-4">Video Lectures</h3>
            <form id="videoLecturesForm" onsubmit="return validateAndShowPinModal('videoLecturesForm', 'update_video_lectures')">
                <input type="hidden" name="action" value="update_video_lectures">
                <input type="hidden" name="pin" id="videoPinField">
                <div id="videoLecturesContainer">
                    <?php foreach ($videoLectures as $lecture): ?>
                        <div class="flex mb-2 video-lecture-item" id="video-<?php echo $lecture['videoID']; ?>">
                            <div class="flex-1 mr-2">
                                <input type="text" name="videoLectures[<?php echo $lecture['videoID']; ?>][name]" class="form-input mb-1" placeholder="Video Name" required value="<?php echo htmlspecialchars($lecture['videoName']); ?>">
                                <input type="url" name="videoLectures[<?php echo $lecture['videoID']; ?>][link]" class="form-input mb-1" placeholder="Video Link" required value="<?php echo htmlspecialchars($lecture['videoLink']); ?>">
                                <input type="text" name="videoLectures[<?php echo $lecture['videoID']; ?>][free]" class="form-input mb-1" placeholder="0 or 1" required value="<?php echo htmlspecialchars($lecture['videoFree']); ?>" pattern="[0-1]">
                            </div>
                            <button type="button" class="btn-delete mt-6" onclick="showPinModal('video-<?php echo $lecture['videoID']; ?>', 'delete_video_lecture', <?php echo $lecture['videoID']; ?>)">Delete</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="btn-cyber mb-4" onclick="addVideoLectureInput()">Add New Video Lecture</button>
                <button type="submit" class="btn-cyber">Save Changes</button>
            </form>
        </div>

        <!-- Lecture File Section -->
        <div id="lecture-file-section" class="section cyber-card">
            <h3 class="text-xl font-semibold text-cyan-400 mb-4">Lecture Files</h3>
            <!-- Upload Form -->
            <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-4">
                <input type="hidden" name="courseID" value="<?php echo $courseID; ?>">
                <label for="file" class="block text-gray-300 mb-1">Select File to Upload</label>
                <div class="flex items-center">
                    <input type="file" name="file" id="file" class="form-input mr-2" required>
                    <button type="submit" class="btn-cyber w-auto px-6">Upload</button>
                </div>
            </form>
            <!-- Files Table -->
            <table class="table-cyber">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($files)): ?>
                        <?php foreach ($files as $file): ?>
                            <tr id="file-<?php echo $file['fileID']; ?>">
                                <td><?php echo htmlspecialchars($file['fileName']); ?></td>
                                <td>
                                    <a href="download.php?id=<?php echo $file['fileID']; ?>" class="mr-2">Download</a>
                                    <button type="button" class="btn-delete" onclick="showPinModal('file-<?php echo $file['fileID']; ?>', 'delete_file', <?php echo $file['fileID']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-gray-400">No lecture files found for this course.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Students Enrolled Section -->
        <div id="students-section" class="section cyber-card">
            <h3 class="text-xl font-semibold text-cyan-400 mb-4">Students Enrolled</h3>
            <table class="table-cyber">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Enrolled Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['studentName']); ?></td>
                                <td><?php echo htmlspecialchars($student['studentEmail']); ?></td>
                                <td><?php echo htmlspecialchars($student['registrationDate'] ?? 'Unknown'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-gray-400">No students enrolled in this course.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Particle Animation
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        const particleCount = 50;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.size > 0.2) this.size -= 0.05;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = 'rgba(0, 255, 234, 0.5)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach((particle, index) => {
                particle.update();
                particle.draw();
                if (particle.size <= 0.2) {
                    particles.splice(index, 1);
                    particles.push(new Particle());
                }
            });
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        // Section Toggling
        function toggleSection(sectionId) {
            console.log('Toggling section:', sectionId);
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.remove('active');
            });
            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.classList.add('active');
                console.log('Section', sectionId, 'is now visible');
            } else {
                console.error('Section not found:', sectionId);
            }
        }

        // Add New Course Detail Input
        let newDetailIndex = 0;
        function addCourseDetailInput() {
            console.log('Adding new course detail input');
            const container = document.getElementById('courseDetailsContainer');
            const div = document.createElement('div');
            div.className = 'flex mb-2 course-detail-item';
            div.innerHTML = `
                <input type="text" name="newCourseDetails[${newDetailIndex}]" class="form-input mr-2" placeholder="New course detail" required>
                <button type="button" class="btn-delete" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(div);
            newDetailIndex++;
        }

        // Add New Video Lecture Input
        let newVideoIndex = 0;
        function addVideoLectureInput() {
            console.log('Adding new video lecture input');
            const container = document.getElementById('videoLecturesContainer');
            const div = document.createElement('div');
            div.className = 'flex mb-2 video-lecture-item';
            div.innerHTML = `
                <div class="flex-1 mr-2">
                    <input type="text" name="newVideoLectures[${newVideoIndex}][name]" class="form-input mb-1" placeholder="Video Name" required>
                    <input type="url" name="newVideoLectures[${newVideoIndex}][link]" class="form-input mb-1" placeholder="Video Link" required>
                    <input type="text" name="newVideoLectures[${newVideoIndex}][free]" class="form-input mb-1" placeholder="0 or 1" required value="0" pattern="[0-1]">
                </div>
                <button type="button" class="btn-delete mt-6" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(div);
            newVideoIndex++;
        }

        // PIN Modal Functions
        let currentFormId = null;
        let currentAction = null;
        let currentDetailId = null;

        function showPinModal(formId, action, detailId = null) {
            console.log('Showing PIN modal for action:', action, 'formId:', formId, 'detailId:', detailId);
            currentFormId = formId;
            currentAction = action;
            currentDetailId = detailId;
            const modal = document.getElementById('pinModal');
            const pinInput = document.getElementById('pinInput');
            const pinError = document.getElementById('pinError');
            pinInput.value = '';
            pinError.classList.add('hidden');
            modal.style.display = 'flex';
            pinInput.focus();
            return false; // Prevent form submission
        }

        function closePinModal() {
            console.log('Closing PIN modal');
            const modal = document.getElementById('pinModal');
            modal.style.display = 'none';
            currentFormId = null;
            currentAction = null;
            currentDetailId = null;
        }

        function validateAndShowPinModal(formId, action) {
            console.log('Validating form:', formId, 'for action:', action);
            const form = document.getElementById(formId);
            const freeInputs = form.querySelectorAll('input[name*="[free]"]');
            let valid = true;

            freeInputs.forEach(input => {
                const value = input.value.trim();
                if (!/^[0-1]$/.test(value)) {
                    valid = false;
                    input.classList.add('border-red-500');
                    input.placeholder = 'Must be 0 or 1';
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = 'Please enter 0 or 1 for Free Status.<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>';
                document.querySelector('.cyber-card').prepend(alertDiv);
                console.log('Form validation failed');
                return false;
            }

            return showPinModal(formId, action);
        }

        function verifyPin() {
            console.log('Verifying PIN');
            const pinInput = document.getElementById('pinInput');
            const pinError = document.getElementById('pinError');
            const pin = pinInput.value.trim();

            if (!pin || pin.length !== 6 || !/^\d+$/.test(pin)) {
                pinError.textContent = 'Please enter a valid 6-digit PIN.';
                pinError.classList.remove('hidden');
                console.log('Invalid PIN input');
                return;
            }

            if (currentAction === 'delete_course_detail') {
                deleteCourseDetail(pin, currentDetailId);
            } else if (currentAction === 'update_course') {
                submitForm(pin);
            } else if (currentAction === 'delete_video_lecture') {
                deleteVideoLecture(pin, currentDetailId);
            } else if (currentAction === 'update_video_lectures') {
                submitVideoForm(pin);
            } else if (currentAction === 'delete_file') {
                deleteFile(pin, currentDetailId);
            }
        }

        function deleteCourseDetail(pin, detailId) {
            console.log('Deleting course detail:', detailId);
            const formData = new FormData();
            formData.append('action', 'delete_course_detail');
            formData.append('pin', pin);
            formData.append('coursedetailID', detailId);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Delete course detail response:', data);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `${data.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
                if (data.success) {
                    const detailElement = document.getElementById(`detail-${detailId}`);
                    if (detailElement) {
                        detailElement.remove();
                        console.log('Course detail removed from DOM');
                    }
                }
            })
            .catch(error => {
                console.error('Error deleting course detail:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `Error: ${error.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
            })
            .finally(() => {
                closePinModal();
            });
        }

        function deleteVideoLecture(pin, videoID) {
            console.log('Deleting video lecture:', videoID);
            const formData = new FormData();
            formData.append('action', 'delete_video_lecture');
            formData.append('pin', pin);
            formData.append('videoID', videoID);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Delete video lecture response:', data);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `${data.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
                if (data.success) {
                    const videoElement = document.getElementById(`video-${videoID}`);
                    if (videoElement) {
                        videoElement.remove();
                        console.log('Video lecture removed from DOM');
                    }
                }
            })
            .catch(error => {
                console.error('Error deleting video lecture:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `Error: ${error.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
            })
            .finally(() => {
                closePinModal();
            });
        }

        function deleteFile(pin, fileID) {
            console.log('Deleting file:', fileID);
            const formData = new FormData();
            formData.append('action', 'delete_file');
            formData.append('pin', pin);
            formData.append('fileID', fileID);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Delete file response:', data);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `${data.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
                if (data.success) {
                    const fileElement = document.getElementById(`file-${fileID}`);
                    if (fileElement) {
                        fileElement.remove();
                        console.log('File removed from DOM');
                    }
                }
            })
            .catch(error => {
                console.error('Error deleting file:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `Error: ${error.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
            })
            .finally(() => {
                closePinModal();
            });
        }

        function submitForm(pin) {
            console.log('Submitting form with PIN:', pin);
            const form = document.getElementById(currentFormId);
            const formData = new FormData(form);
            formData.set('pin', pin);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Form submission response:', data);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `${data.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
                if (data.success) {
                    setTimeout(() => window.location.reload(), 2000);
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `Error: ${error.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
            })
            .finally(() => {
                closePinModal();
            });
        }

        function submitVideoForm(pin) {
            console.log('Submitting video form with PIN:', pin);
            const form = document.getElementById(currentFormId);
            const formData = new FormData(form);
            formData.set('pin', pin);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Video form submission response:', data);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `${data.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
                if (data.success) {
                    setTimeout(() => window.location.reload(), 2000);
                }
            })
            .catch(error => {
                console.error('Error submitting video form:', error);
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert-cyber';
                alertDiv.innerHTML = `Error: ${error.message}<button onclick="this.parentElement.remove()" class="hover:text-white">×</button>`;
                document.querySelector('.cyber-card').prepend(alertDiv);
            })
            .finally(() => {
                closePinModal();
            });
        }
    </script>
</body>
</html>