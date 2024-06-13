<?php
include("./php/database.php");

$response = ""; // Initialize the response variable

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];
    
    if(isset($_SESSION['user'])) {
        $username = $_SESSION['user'];
        
        $sql = "SELECT * FROM login WHERE Email='$username' AND Otp='$otp'";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0) {
            // Valid OTP, update the database and notify success
            $sql = "UPDATE login SET Otp='0' WHERE Email='$username' AND Otp='$otp'";
            $result = $conn->query($sql);
            
            if($result) {
                $response = 'OTP verified successfully';
            } else {
                $response = 'Unable to update OTP';
            }
        } else {
            // Invalid OTP
            $response = 'Invalid OTP';
        }
    } else {
        // Invalid session or user not set
        $response = 'Invalid session or user';
    }
}

// Send the response back
echo $response;
?>
