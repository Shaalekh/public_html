<?php
require 'src/Endroid/QrCode/QrCode.php';  // Include the QR code library

use Endroid\QrCode\QrCode;

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

        // Generate QR code for the download link
        $qrCode = new QrCode($fileUrl);
        $qrCode->setSize(150);

        // Save the QR code as an image file
        $qrCodeImagePath = $targetDir . "qr_" . $uniqueName . ".png";
        $qrCode->writeFile($qrCodeImagePath);

        // Display success message with download link and QR code
        echo "File uploaded successfully! <br>";
        echo "Download link: <a href='$fileUrl'>$fileUrl</a><br>";
        echo "Scan this QR code to download: <br>";
        echo "<img src='$qrCodeImagePath' alt='QR Code for download link'>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded.";
}
?>
