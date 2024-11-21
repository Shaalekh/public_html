let uniqueID = null;

document.getElementById('generateBtn').addEventListener('click', () => {
    const qrCode = document.getElementById('qrCode');
    qrCode.style.display = 'block';
    qrCode.src = 'generate_qr.php';

    // Fetch the QR code and unique ID
   /* fetch('generate_qr.php')
        .then(response => response.json())
        .then(data => {
            qrCode.src = data.qrCodeUrl;
            uniqueID = data.uniqueID;
            fetchFiles(); // Start fetching files
        });*/
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

            // Fetch files again after 3 seconds
            setTimeout(fetchFiles, 3000);
        });
}
