<?php
include('php\database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if at least one search criterion is provided
    if (!empty($_POST['title']) || !empty($_POST['date']) || !empty($_POST['category']) || !empty($_POST['year'])) {
        $sql = "SELECT * FROM notices WHERE ";
        $conditions = array();

        // Check each provided criterion and add it to the SQL query
        if (!empty($_POST['title'])) {
            $conditions[] = "TITLE LIKE '%" . $_POST['title'] . "%'";
        }
        if (!empty($_POST['date'])) {
            $conditions[] = "DATE = '" . $_POST['date'] . "'";
        }
        if (!empty($_POST['upload_till'])) {
            $conditions[] = "`UPLOAD TILL` = '" . $_POST['upload_till'] . "'";
        }
        if (!empty($_POST['category'])) {
            $conditions[] = "CATEGORY = '" . $_POST['category'] . "'";
        }
        if (!empty($_POST['year'])) {
            $conditions[] = "YEAR = '" . $_POST['year'] . "'";
        }

        // Combine all conditions using "AND" operator
        $sql .= implode(" AND ", $conditions);

        // Execute the SQL query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            // Fetch all matching rows
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            // Send the JSON response containing all matching rows
            echo json_encode($rows);
        } else {
            echo "No notice found matching the search criteria.";
        }
    } else {
        echo "Please provide at least one search criterion.";
    }
} else {

    echo "Invalid request method.";
}

$conn->close();
?>
