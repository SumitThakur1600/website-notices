<?php
include('php/database.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the JSON data from the request body
    $jsonData = file_get_contents('php://input');
    
    // Check if any data is received
    if (!empty($jsonData)) {
        
        // Decode the JSON data
        $noticeData = json_decode($jsonData, true);
        
        // Check if all required fields are present
        if (!empty($noticeData['title']) && !empty($noticeData['date']) && !empty($noticeData['uploadTill']) && !empty($noticeData['category']) && !empty($noticeData['year'])) {
            $title = $noticeData['title'];
            $date = $noticeData['date'];
            $uploadTill = $noticeData['uploadTill'];
            $category = $noticeData['category'];
            $year = $noticeData['year'];

            // Insert the data into the database
            $sql = "INSERT INTO notices (TITLE, DATE, `UPLOAD_TILL`, YEAR, CATEGORY) VALUES ('$title', '$date', '$uploadTill', '$year', '$category')";
            if ($conn->query($sql) === TRUE) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "One or more required fields are missing.";
        }
    } else {
        echo "No data received.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
