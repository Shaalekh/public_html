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
        // Generate the download link
        $fileUrl = "https://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $uniqueName;
        
        // Create QR code URL (GoQR API)
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($fileUrl) . "&size=150x150&color=FFFFFF&bgcolor=000000&qzone=2";
        
        // Display success message and QR code
        echo "File uploaded successfully ji!<br>";
        echo "Download link: <a href='$fileUrl' target='_blank'>$fileUrl</a><br><br>";
        echo "<h3>QR Code for Download Link:</h3>";
        echo "<img src='$qrCodeUrl' alt='QR Code' style='border:1px solid black;padding:5px; border-radius: 15px;' >";
        echo "<cite>By order of the peaky blinders";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded.";
}
?>
