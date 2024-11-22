<?php
// Ensure the file parameter is provided
if (isset($_GET['file'])) {
    $file = basename($_GET['file']); // Prevent directory traversal
    $filePath = "uploads/" . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and send it to the output buffer
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
