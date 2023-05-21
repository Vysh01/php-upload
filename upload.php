<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// File upload directory
$targetDir = "uploads/";

// Check if file was uploaded successfully
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Move the uploaded file to the desired location
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // File uploaded successfully, save file information to the database
        $sql = "INSERT INTO files (filename, filepath) VALUES ('$fileName', '$targetFilePath')";
        if ($conn->query($sql) === true) {
            echo "File uploaded and saved to the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file selected or error occurred during upload.";
}

// Close the database connection
$conn->close();
?>