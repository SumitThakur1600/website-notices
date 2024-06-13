<?php
include("./php/database.php");

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $username = $_SESSION['user'];
        
        // Check if passwords match
        if ($password !== $confirm_password) {
            $response = "Passwords do not match.";
        } else {
            // Validate password strength
            if (strlen($password) < 8) {
                $response = "Password should be at least 8 characters long.";
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $response = "Password should contain at least one uppercase letter.";
            } elseif (!preg_match('/[a-z]/', $password)) {
                $response = "Password should contain at least one lowercase letter.";
            } elseif (!preg_match('/\d/', $password)) {
                $response = "Password should contain at least one number.";
            } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                $response = "Password should contain at least one special character.";
            } else {
                // Hash the password
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                
                // Update password in the database
                $sql = "UPDATE login SET Password='$password_hash' WHERE Email ='$username'";
                $result = $conn->query($sql);

                if ($result) {
                    $response = "Password updated successfully";
                } else {
                    $response = "Unable to update password";
                }
            }
        }
    } else {
        $response = "Invalid request.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .response-message {
            text-align: center;
            margin-top: 10px;
            color: red;
            /* Default color for error messages */
        }

        .success {
            color: green;
            /* Color for success messages */
        }
    </style>
</head>
<body>
<nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <div class="login-form">
            <h2 style="text-align: center;">Enter New Password</h2>
            <form method="post" action="">
                <input type="password" id="password" name="password" placeholder="New Password" required>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" value="Submit">
                <div id="response-message" class="response-message"><?php echo $response; ?></div>
            </form>
        </div>
    </div>
</body>
<script>
        // Hide the response message after 5 seconds
        setTimeout(function() {
            var responseMessage = document.getElementById('response-message');
            if (responseMessage.textContent.trim() === 'Password updated successfully') {
                window.location.href = 'login.php';
            } else {
                responseMessage.style.display = 'none';
            }
        }, 1000);
    </script>
</html>
