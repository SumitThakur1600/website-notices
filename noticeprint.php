<?php
include("./php/database.php");
$sql = "SELECT * FROM notices";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    // Start building the table HTML
    $tableHTML = "<table border='1'>
        <tr>
            <th>Sr.No</th>
            <th>Title</th>
            <th>Date</th>
            <th>Upload Till</th>
            <th>Year</th>
            <th>Category</th>
        </tr>";

    // Loop through the result set and add rows to the table HTML
    while ($row = $result->fetch_assoc()) {
        $tableHTML .= "<tr>
            <td>{$row['SrNo']}</td>
            <td>{$row['TITLE']}</td>
            <td>{$row['DATE']}</td>
            <td>{$row['UPLOAD_TILL']}</td>
            <td>{$row['YEAR']}</td>
            <td>{$row['CATEGORY']}</td>
        </tr>";
    }

    // Close the table HTML
    $tableHTML .= "</table>";

    // Output the table HTML
    echo $tableHTML;
} else {
    // If no notices found, display a message
    echo "<p>No notices found.</p>";
}
?>