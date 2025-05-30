<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 bg-dark">
    <div class="card shadow p-4">
        <h2 class="text-center text-dark">Upload a File</h2>

        <form action="upload.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="file" class="form-label">Choose a file:</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Upload File</button>
        </form>
    </div>

    <div class="mt-5">
        <?php
        include "connectdb.php";
        
        $sql = "SELECT * FROM file";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='card shadow p-4'>";
            echo "<h2 class='text-center text-primary'>Uploaded Files</h2>";
            echo "<ul class='list-group mt-3'>";

            while ($row = $result->fetch_assoc()) {
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<a href='download.php?id=" . $row['fileID'] . "' class='text-decoration-none'>" . $row['fileName'] . "</a>";
                echo "<span class='badge bg-info text-dark'>Download</span>";
                echo "</li>";
            }

            echo "</ul>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning mt-4 text-center'>No files uploaded yet.</div>";
        }

        $conn->close();
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
