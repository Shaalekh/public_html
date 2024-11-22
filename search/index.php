<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Files</title>
     <link
            href="https://fonts.googleapis.com/css2?family=Cutive+Mono&family=Geist+Mono:wght@100..900&family=Monofett&family=Raleway:ital,wght@0,100..900;1,100..900&family=VT323&display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS file -->
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
    <h4><a href="../index.html" id="bar">  <i class="fa fa-home"></i> Home</a> <a href="topm/index.html" id="login"> PC to Phone</a> </h4>
    <main>
    <form onsubmit="fetchFiles(event)">
        <input type="text" id="subfolder" name="subfolder" placeholder="Enter Subfolder Name" required>
        <button type="submit">Fetch</button>
    </form>

    <!-- This is where the files will be displayed -->
    <div id="results" style="margin-top: 20px;"></div>
    </main>
</body>
</html>
