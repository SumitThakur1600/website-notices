<?php
require('php/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['upload_date']) && !empty($_POST['upload_till']) && !empty($_POST['year'])) {
        $title = $_POST['title'];
        $uploadDate = $_POST['upload_date'];
        $uploadTill = $_POST['upload_till'];
        $year = $_POST['year'];

        // Use underscores in column names instead of spaces
        $sql = "INSERT INTO `e-tenders` (TITLE, `UPLOAD DATE`, `UPLOAD TILL`, YEAR) VALUES ('$title', '$uploadDate', '$uploadTill', '$year')";
        
        if ($conn->query($sql) === TRUE) {
            echo "E-Tender added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "One or more required fields are missing.";
    }
}

$conn->close();
?>
