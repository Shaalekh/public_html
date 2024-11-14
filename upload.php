<?php
$targetDir = "uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if a file has been uploaded
if (isset($_FILES["fileToUpload"])) {
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $uniqueName = uniqid() . "_" . $filename;
    $targetFilePath = $targetDir . $uniqueName;

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
        // Generate a link to the file
        $fileUrl = "https://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $uniqueName;
        echo "File uploaded successfully! Download link: <a href='$fileUrl'>$fileUrl</a>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded.";
}
?>
