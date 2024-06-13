<?php
include("./php/database.php");

$response = ""; // Initialize response variable

if (isset($_GET['username']) && isset($_GET['code'])) {
    $username = $_GET['username'];
    $code = $_GET['code'];
    
    $sql = "SELECT * FROM login WHERE Email='$username' AND Verification_Code='$code'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row['Is_Verified'] == 0) {
            $sql_update = "UPDATE login SET Is_Verified='1', Verification_Code='1' WHERE Email='$username'";
            $result_update = $conn->query($sql_update);
            
            if ($result_update) {
                $response = "Successfully Verified";
            } else {
                $response = "Verification Failed";
            }
        } else {
            $response = "Already Verified";
        }
    } else {
        $response = "Verification Failed";
    }
} else {
    $response = "Invalid URL";
}

if ($response === "Successfully Verified") {
    header("Location: login.php?message=" . urlencode($response));
} else {
    $response = "Verification failed. Please verify your email again.";
    
    header("Location: signup.php?message=" .  urlencode($response));
}
?>
