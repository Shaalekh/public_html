<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $session = $_GET['session'] ?? null;

    if (!$session) {
        die("Session ID missing.");
    }

    $targetDir = "uploads/" . $session . "/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create session directory
    }

    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully: " . htmlspecialchars($targetFile);
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file received.";
}
?>
