// Handle form submission using AJAX
document.getElementById("uploadForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent normal form submission

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();

    // Reset the result and QR container
    document.getElementById("result").innerHTML = "";
    document.getElementById("qrContainer").innerHTML = "";
    document.getElementById("progressBar").style.width = "0%";

    // Show progress bar
    document.getElementById("progressContainer").style.display = "block";

    // Start the countdown timer
    startCountdown();

    // Listen for the progress event
    xhr.upload.addEventListener(
        "progress",
        function (e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                document.getElementById("progressBar").style.width = percentComplete + "%";
            }
        },
        false
    );

    xhr.open("POST", "upload.php", true);

    xhr.onload = function () {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.error) {
                document.getElementById("result").innerHTML =
                    `<p style="color: red;">${response.error}</p>`;
                document.getElementById("progressContainer").style.display = "none";
            } else {
                // Show the file download link
                document.getElementById("result").innerHTML =
                    `<p style="color:white;font-family: 'Geist Moto',monospace;margin-left:auto;margin-right:auto;text-align: center;">File uploaded successfully! ✅</p>`;

                // Show the QR code
                var qrCodeUrl = response.qrCodeUrl;
                document.getElementById("qrContainer").innerHTML = `
                    <h3 style="color:white;font-family:'geist moto',monospace;margin-left:auto;margin-right:auto">Your QR Code is ready:</h3>
                    <img src="${qrCodeUrl}" alt="QR Code">
                `;
            }

            // Hide the progress bar once the upload is complete
            document.getElementById("progressContainer").style.display = "none";
        } else {
            document.getElementById("result").innerHTML =
                "<p style='color: red;'>Error uploading file.</p>";
            document.getElementById("progressContainer").style.display = "none";
        }
    };

    xhr.send(formData); // Send the file data
});

// Timer function
let timer; // to hold the interval ID
let timeRemaining = 120; // 2 minutes = 120 seconds
let qrContainer = document.getElementById("qrContainer");

function startCountdown() {
    // Display the countdown
    const countdownElement = document.getElementById("countdown");

    // Start the countdown timer
    timer = setInterval(function() {
        // Calculate minutes and seconds
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        
        // Update the countdown display
        countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        // Decrease time by 1 second
        timeRemaining--;

        // When the countdown reaches 0, stop the timer and hide the QR code
        if (timeRemaining < 0) {
            clearInterval(timer);
            countdownElement.textContent = "Time's Up!";
            qrContainer.innerHTML = ""; // Remove the QR code when the timer expires
        }
    }, 1000); // Update every 1 second
}
