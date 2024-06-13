<?php
include('php/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['title']) || !empty($_POST['category']) || !empty($_POST['date'])) {
        $sql = "SELECT * FROM `proforma` WHERE ";
        $conditions = array();

        if (!empty($_POST['title'])) {
            $conditions[] = "TITLE LIKE '%" . $conn->real_escape_string($_POST['title']) . "%'";
        }
        if (!empty($_POST['category'])) {
            $conditions[] = "CATEGORY = '" . $conn->real_escape_string($_POST['category']) . "'";
        }
        if (!empty($_POST['date'])) {
            $conditions[] = "Date_of_Upload = '" . $conn->real_escape_string($_POST['date']) . "'";
        }
        $sql .= implode(" AND ", $conditions);
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($rows);
        } else {
            echo json_encode(array('message' => 'No Proforma found matching the search criteria.'));
        }
    } else {
        echo json_encode(array('message' => 'Please provide at least one search criterion.'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method.'));
}

$conn->close();
?>
