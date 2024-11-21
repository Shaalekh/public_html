<?php
$uniqueID = $_GET['uid'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .unique-id {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 18px;
            display: inline-block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h1>Upload Files</h1>
    <p>Your Unique ID (Save this for future reference):</p>
    <div class="unique-id"><?php echo htmlspecialchars($uniqueID); ?></div>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uniqueID); ?>">
        <input type="file" name="fileToUpload[]" multiple>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
