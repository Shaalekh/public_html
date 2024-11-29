<?php
$uniqueID = $_GET['uid'] ?? '';
$uploadDir = __DIR__ . "/uploads/$uniqueID";

if (!is_dir($uploadDir)) {
    echo json_encode(['files' => []]);
    exit;
}

$files = array_diff(scandir($uploadDir), ['.', '..']);
$fileList = [];

foreach ($files as $file) {
    $fileList[] = [
        'name' => $file,
        'url' => "uploads/$uniqueID/$file"
    ];
}

header('Content-Type: application/json');
echo json_encode(['files' => $fileList]);
?>
