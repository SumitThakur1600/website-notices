<?php
require('php/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['date'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $date = $_POST['date'];

        // Escape inputs to prevent SQL injection
        $title = mysqli_real_escape_string($conn, $title);
        $category = mysqli_real_escape_string($conn, $category);
        $date = mysqli_real_escape_string($conn, $date);

        // SQL query to insert data
        $sql = "INSERT INTO proforma (TITLE, CATEGORY, Date_of_Upload) VALUES ('$title', '$category', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "Proforma added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "One or more required fields are missing.";
    }
}

$conn->close();
?>
