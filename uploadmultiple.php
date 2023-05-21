<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $files = $_FILES['files'];

    // Loop through each uploaded file
    foreach ($files['name'] as $index => $name) {
        $fileTmp = $files['tmp_name'][$index];
        $filePath = 'uploads/' . $name;

        // Move the file to the desired directory
        move_uploaded_file($fileTmp, $filePath);
    }

    echo 'Files uploaded successfully!';
}
?>
