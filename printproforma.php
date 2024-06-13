<?php
// Include the database connection file
include("./php/database.php");

// Query to select proforma information
$sql = "SELECT * FROM proforma";
$result = $conn->query($sql);

// Check if there are any rows in the result set
if ($result && $result->num_rows > 0) {
    // Start building the HTML table to display proforma information
    $output = "<table border='1'>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date of Upload</th>
                </tr>";

    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Append a new row to the HTML table for each proforma entry
        $output .= "<tr>
                        <td>{$row['TITLE']}</td>
                        <td>{$row['CATEGORY']}</td>
                        <td>{$row['Date_of_Upload']}</td>
                    </tr>";
    }

    // Close the HTML table
    $output .= "</table>";

    // Output the HTML table
    echo $output;
} else {
    // If no proforma entries found, display a message
    echo "<p>No proforma entries found.</p>";
}

?>
