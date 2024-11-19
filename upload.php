<?php
// Database connection settings
$dbHost = 'localhost';
$dbUser = 'qrsrajxy_aalekhbabu';
$dbPass = 'AalekhBabu121';
$dbName = 'qrsrajxy_uploads';

// Connect to the database
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$targetDir = "uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if a file has been uploaded
if (isset($_FILES["fileToUpload"])) {
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $uniqueName = uniqid() . "_" . $filename;
    $targetFilePath = $targetDir . $uniqueName;
    $fileSize = $_FILES["fileToUpload"]["size"];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $uploadTime = date("Y-m-d H:i:s");

    // Fetch location details using ip-api.com
    $geoInfo = @file_get_contents("http://ip-api.com/json/$userIP");
    $geoData = json_decode($geoInfo, true);

    if ($geoData && $geoData['status'] == 'success') {
        $userCity = $geoData['city'] ?? 'Unknown';
        $userRegion = $geoData['regionName'] ?? 'Unknown';
        $userCountry = $geoData['country'] ?? 'Unknown';
    } else {
        $userCity = $userRegion = $userCountry = 'Unknown';
    }

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
        // Generate the download link
        $fileUrl = "https://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $uniqueName;

        // Save details to the database
        $stmt = $conn->prepare("INSERT INTO uploads (filename, file_url, file_size, user_ip, upload_time, city, region, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $filename, $fileUrl, $fileSize, $userIP, $uploadTime, $userCity, $userRegion, $userCountry);

        if ($stmt->execute()) {
            // Create QR code URL with rounded edges, black background, and white bars
            $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($fileUrl) . "&size=150x150&color=FFFFFF&bgcolor=000000&qzone=2";

            // Return a JSON response with the file URL, QR code URL, and location info
            echo json_encode([
                'fileUrl' => $fileUrl,
                'qrCodeUrl' => $qrCodeUrl,
                'city' => $userCity,
                'region' => $userRegion,
                'country' => $userCountry
            ]);
        } else {
            echo json_encode(['error' => 'Error saving file details to the database: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo '<p style="color: red;text-align: center;background-color: antiquewhite;font-family: \"geist mono\", monospace;font-size: 2vh;"> Sorry, there was an error uploading your file <i class="material-icons">error_outline</i></p>';
    }
} else {
    echo json_encode(['error' => 'No file uploaded.']);
}

// Close the database connection
$conn->close();
?>
