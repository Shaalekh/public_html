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

// Send QR code directly as an image
ob_start();
QRcode::png($qrContent, null, QR_ECLEVEL_L, 10);
$qrImage = base64_encode(ob_get_clean());

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'uniqueID' => $uniqueID,
    'qrCodeUrl' => 'data:image/png;base64,' . $qrImage,
]);
?>
