document.getElementById('generateBtn').addEventListener('click', () => {
    const qrCode = document.getElementById('qrCode');
    qrCode.style.display = 'block';
    qrCode.src = 'generate_qr.php';
});
