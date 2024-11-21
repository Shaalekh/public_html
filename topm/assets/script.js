let uniqueID = null;

document.getElementById('generateBtn').addEventListener('click', () => {
    const qrCode = document.getElementById('qrCode');
    qrCode.style.display = 'block';

    // Fetch the QR code and unique ID
    fetch('generate_qr.php')
        .then(response => response.json())
        .then(data => {
            qrCode.src = data.qrCodeUrl;
            uniqueID = data.uniqueID;
            fetchFiles(); // Start fetching files
        })
        .catch(error => console.error('Error generating QR code:', error));
});

function fetchFiles() {
    if (!uniqueID) return;

    fetch(`list_files.php?uid=${uniqueID}`)
        .then(response => response.json())
        .then(data => {
            const fileList = document.getElementById('files');
            fileList.innerHTML = ''; // Clear old list

            data.files.forEach(file => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = file.url;
                a.textContent = file.name;
                a.target = '_blank';
                li.appendChild(a);
                fileList.appendChild(li);
            });

            // Re-fetch files every 3 seconds
            setTimeout(fetchFiles, 3000);
        })
        .catch(error => console.error('Error fetching files:', error));
}
