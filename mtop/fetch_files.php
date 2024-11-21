<?php
$directory = "uploads/";
$files = array_diff(scandir($directory), array('..', '.')); // Exclude special dirs
echo json_encode(array_values($files));
?>

