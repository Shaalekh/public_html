function updateH1Content() {
    const h1 = document.getElementById("responsive");
    if (window.innerWidth < 500) {
        h1.textContent = "QRSR";
    } else {
        h1.textContent = "Quick Response Share Receive";
    }
}

// Check on page load
updateH1Content();

// Check on window resize
window.addEventListener("resize", updateH1Content);
