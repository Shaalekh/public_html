<?php
$uniqueID = $_GET['uid'];
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
    </style>
</head>
<body>
    <h1>Upload Files</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="uid" value="<?php echo $uniqueID; ?>">
        <input type="file" name="fileToUpload[]" multiple>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
