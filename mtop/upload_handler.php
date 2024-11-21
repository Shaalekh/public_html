<?php
// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = "uploads/"; // Folder in public_html for uploaded files
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Ensure uploads folder is writable
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully: " . htmlspecialchars($targetFile);
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file received.";
}
?>
