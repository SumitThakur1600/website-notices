<?php
include("./php/database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$response = ''; // Initialize an empty string

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT);
        $code = bin2hex(random_bytes(16));

        $sql = "SELECT * FROM login WHERE Email='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $response = 'User already exists. If not verified, please check your Gmail inbox for a verification email.';
        } else {
            $sql = "INSERT INTO login (Email, Password, Verification_Code, Is_Verified, Otp) VALUES ('$username', '$password', '$code', '0', '0')";
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
                    $mail->Subject = "Email Verification";
                    $mail->Body = "Hi $username, Thanks for registration! Click the link below to verify the email address <a href='https://localhost/sumit/sumit/verify.php?username=$username&code=$code'>Verify</a>";
                    $mail->send();
                    $response = 'Email sent. Please check your inbox and verify your email address.';
                } catch (Exception $e) {
                    $response = 'Email send failed: ' . $mail->ErrorInfo;
                }
            } else {
                $response = 'Unable to sign up';
            }
        }
    } else {
        $response = 'Form submission failed';
    }
} else {
    // If the request method is not POST
    $response = 'Invalid request method';
}

echo $response; // Output the response as a string
?>
