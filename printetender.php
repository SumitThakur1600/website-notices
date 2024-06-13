<?php
// Include the database connection file
include("./php/database.php");

// Query to select e-tender information
$sql = "SELECT * FROM `e-tenders`";
$result = $conn->query($sql);

// Check if there are any rows in the result set
if ($result && $result->num_rows > 0) {
    // Start building the HTML table to display e-tender information
    $output = "<table border='1'>
                <tr>
                    <th>Title</th>
                    <th>Upload Date</th>
                    <th>Upload Till</th>
                    <th>Year</th>
                </tr>";

    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append a new row to the HTML table for each e-tender
        $output .= "<tr>
                        <td>{$row['TITLE']}</td>
                        <td>{$row['UPLOAD DATE']}</td>
                        <td>{$row['UPLOAD TILL']}</td>
                        <td>{$row['YEAR']}</td>
                    </tr>";
    }

    // Close the HTML table
    $output .= "</table>";

    // Output the HTML table
    echo $output;
} else {
    // If no e-tenders found, display a message
    echo "<p>No e-tenders found.</p>";
}

?>
