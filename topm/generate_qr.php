<?php
session_start();
require('phpqrcode/qrlib.php');

// Generate unique ID
$uniqueID = uniqid();
$_SESSION['unique_id'] = $uniqueID;

// Create folder for uploads
$uploadDir = __DIR__ . "/uploads/$uniqueID";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Generate QR code content
$qrContent = "https://qrsr.co.in/topm/receive.php?uid=$uniqueID";
$tempQRCodePath = __DIR__ . "/temp_qr_$uniqueID.png";

// Generate and save the QR code temporarily
QRcode::png($qrContent, $tempQRCodePath, QR_ECLEVEL_L, 10);

// Serve the QR code image to the browser
header('Content-Type: image/png');
readfile($tempQRCodePath);

// Delete the QR code image after sending it
unlink($tempQRCodePath);
