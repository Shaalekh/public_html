function uploadFile() {
    const formData = new FormData(document.getElementById('uploadForm'));
    fetch('/upload', { method: 'POST', body: formData })
        .then(response => response.text())
        .then(data => {
            alert('File uploaded successfully!');
            generateDownloadQR();
        })
        .catch(error => alert('Upload failed: ' + error));
}

function generateDownloadQR() {
    const qrContainer = document.getElementById('downloadQR');
    qrContainer.innerHTML = ''; // Clear existing QR

    const filename = document.getElementById('file').files[0].name;
    const downloadURL = ${window.location.origin}/download/${filename};

    const qr = new QRious({
        element: document.createElement('canvas'),
        value: downloadURL,
        size: 200
    });
    qrContainer.appendChild(qr.element);
}

function generateUploadQR() {
    const uploadLink = ${window.location.origin}/upload.html;
    const qrContainer = document.getElementById('uploadQR');
    qrContainer.innerHTML = ''; // Clear existing QR

    const qr = new QRious({
        element: document.createElement('canvas'),
        value: uploadLink,
        size: 200
    });
    qrContainer.appendChild(qr.element);
}