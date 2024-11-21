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

// Generate QR code
$qrContent = "https://qrsr.co.in/topm/receive.php?uid=$uniqueID";
$qrCodeFile = "uploads/$uniqueID.png";
QRcode::png($qrContent, $qrCodeFile, QR_ECLEVEL_L, 10);

// Return response
header('Content-Type: application/json');
echo json_encode([
    'uniqueID' => $uniqueID,
    'qrCodeUrl' => $qrCodeFile
]);
?>
