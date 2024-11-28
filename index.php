<?php
// Prevent caching of this script
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Detect the User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// List of keywords for mobile devices
$mobileKeywords = ['Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 'Opera Mini', 'IEMobile', 'Mobile'];

// Assume desktop by default
$isMobile = false;

// Check if any mobile keyword exists in the User-Agent
foreach ($mobileKeywords as $keyword) {
    if (strpos($userAgent, $keyword) !== false) {
        $isMobile = true;
        break;
    }
}

// Redirect based on the device type
if ($isMobile) {
    // Redirect to mobile-specific page
    header("Location: mobile.html");
    exit();
} else {
    // Redirect to desktop-specific page
    header("Location: main/index.html");
    exit();
}
?>
