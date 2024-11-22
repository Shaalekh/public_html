<?php
$uniqueID = $_GET['uid'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .unique-id {
            background-color: #e9ecef;
            border: 1px solid #0d6efd;
            color: #212529;
            padding: 15px;
            font-size: 18px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px auto;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center">Upload Files</h1>
        <p class="text-center text-muted">
            This is a system-generated unique key. In case you lose the access to the uploaded files. You can use this key to retreive them. Save this for future reference:
        </p>
        <div class="unique-id text-center"><?php echo htmlspecialchars($uniqueID); ?></div>

        <div class="form-container mt-4">
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($uniqueID); ?>">

                <div class="mb-3">
                    <label for="fileToUpload" class="form-label">Select files to upload:</label>
                    <input class="form-control" type="file" id="fileToUpload" name="fileToUpload[]" multiple>
                </div>

                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
