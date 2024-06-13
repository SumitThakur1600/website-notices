<?php
include("./php/database.php");

$response = ""; // Initialize response variable as a string

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login WHERE Email ='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
            
        if ($row['Is_Verified'] == 1) {
            $hashed_password = $row['Password'];
            
            if (password_verify($password, $hashed_password)) {
                $response = "LOGIN SUCCESSFUL";
                $_SESSION['login']=true;
            } else {
                $response = "Invalid password";
            }
        } else {
            $response = "Account not verified. Please check your email for verification.";
        }
    } else {
        $response = "User not found. Please create your account.";
    }
} else {
    $response = "Invalid request.";
}

echo $response;
?> 
