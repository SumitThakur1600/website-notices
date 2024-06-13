<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all form fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Format the message
        $formattedMessage = "Hello,\n\n";
        $formattedMessage .= "My name is $name. You can reach me at my email address $email.\n\n";
        $formattedMessage .= "Here's the message I'd like to share with you:\n";
        $formattedMessage .= "---------------------------------------\n";
        $formattedMessage .= "$message\n";
        $formattedMessage .= "---------------------------------------";

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
            $mail->addAddress('messagereceive@gmail.com');
            $mail->isHTML(false); // Set to plain text
            $mail->Subject = "New message from $name ($email)";
            $mail->Body = $formattedMessage;
            $mail->send();

            http_response_code(200);
            echo json_encode(array("success" => "Form Sent"));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("error" => "Unable to send form: " . $mail->ErrorInfo));
        }
    } else {
        // If any form field is missing, send an error response
        http_response_code(400);
        echo json_encode(array("error" => "Incomplete form data"));
    }
} else {
    // If request method is not POST, send a method not allowed response
    http_response_code(405);
    echo json_encode(array("error" => "Method not allowed"));
}
?>
