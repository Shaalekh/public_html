<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Files</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
    <script>
        function fetchFiles(event) {
            event.preventDefault(); // Prevent form from reloading the page

            const subfolder = document.getElementById('subfolder').value;
            const resultsDiv = document.getElementById('results');

            // AJAX request
            fetch('list_files_ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'subfolder=' + encodeURIComponent(subfolder),
            })
            .then(response => response.text())
            .then(data => {
                resultsDiv.innerHTML = data; // Display the response in the results div
            })
            .catch(error => {
                resultsDiv.innerHTML = '<p style="color:red;">Error fetching files.</p>';
                console.error('Error:', error);
            });
        }
    </script>
</head>
<body>
    <h1>List Files in Subfolder</h1>
    <form onsubmit="fetchFiles(event)">
        <input type="text" id="subfolder" name="subfolder" placeholder="Enter Subfolder Name" required>
        <button type="submit">Submit</button>
    </form>

    <!-- This is where the files will be displayed -->
    <div id="results" style="margin-top: 20px;"></div>
</body>
</html>
