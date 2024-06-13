<?php
include("./php/database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$response = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $_SESSION['user'] = $username;
    $sql = "SELECT * FROM login WHERE Email='$username'";
    $result = $conn->query($sql);
    $otp = random_int(100000, 999999);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sql = "UPDATE login SET Otp='$otp' WHERE Email ='$username'";
        $result = $conn->query($sql);

        if ($result) {
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'example@gmail.com';
                $mail->Password = 'examplepassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('example@gmail.com'); 
                $mail->addAddress($username);
                $mail->isHTML(true);
                $mail->Subject = "RESET PASSWORD";
                $mail->Body = "HII $username. Here is your OTP: $otp";
                
                $mail->send();
                
                $response = "Check your email to reset your account.";
            } catch (Exception $e) {
                $response = "Email sending failed: " . $mail->ErrorInfo;
            }
        } else {
            $response = "Unable to send OTP.";
        }
    } else {
        $response = "Input valid email address.";
    }
}

echo $response;
?>
