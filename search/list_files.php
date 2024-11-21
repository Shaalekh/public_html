<?php
// Define the base uploads directory
$uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/topm/uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the subfolder name from the form
    $subfolder = trim($_POST['subfolder']);

    // Sanitize input to prevent directory traversal attacks
    $subfolder = basename($subfolder);

    // Create the full path
    $subfolderPath = $uploadsDir . $subfolder;

    // Check if the subfolder exists and is a directory
    if (is_dir($subfolderPath)) {
        // Scan the directory for files
        $files = array_diff(scandir($subfolderPath), array('.', '..'));

        if (!empty($files)) {
            echo "<h1>Files in Subfolder: $subfolder</h1><ul>";
            foreach ($files as $file) {
                echo "<li>" . htmlspecialchars($file) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No files found in the subfolder: $subfolder</p>";
        }
    } else {
        echo "<p>The subfolder '$subfolder' does not exist.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
