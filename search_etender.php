<?php
include('php\database.php'); // Assuming the database connection file is in the php directory

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['title']) || !empty($_POST['upload_date']) || !empty($_POST['year'])) {
        $sql = "SELECT * FROM `e-tenders` WHERE ";
        $conditions = array();

        if (!empty($_POST['title'])) {
            $conditions[] = "TITLE LIKE '%" . $conn->real_escape_string($_POST['title']) . "%'";
        }
        if (!empty($_POST['upload_date'])) {
            $conditions[] = "`UPLOAD DATE` = '" . $conn->real_escape_string($_POST['upload_date']) . "'";
        }
        if (!empty($_POST['year'])) {
            $conditions[] = "YEAR = '" . $conn->real_escape_string($_POST['year']) . "'";
        }

        // Combine all conditions using "AND" operator
        $sql .= implode(" AND ", $conditions);

        // Prepare and execute the SQL query using prepared statements
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // Send the JSON response containing all matching rows
            echo json_encode($rows);
        } else {
            echo json_encode(array('message' => 'No E-Tenders found matching the search criteria.'));
        }
    } else {
        echo json_encode(array('message' => 'Please provide at least one search criterion.'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method.'));
}

$conn->close();
?>
