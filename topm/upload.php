<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uniqueID = $_POST['uid'];
    $targetDir = __DIR__ . "/uploads/$uniqueID/";

    if (!is_dir($targetDir)) {
        die('Invalid upload directory.');
    }

    foreach ($_FILES['fileToUpload']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['fileToUpload']['name'][$key]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($tmpName, $targetFile)) {
            echo "File $fileName uploaded successfully.<br>";
        } else {
            echo "Error uploading file $fileName.<br>";
        }
    }
}
?>
