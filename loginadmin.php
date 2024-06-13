<?php
// Define the valid admin username and password (Replace these with your actual admin credentials)
$validAdminUsername = "admin";
$validAdminPassword = "admin123";

// Check if the form is submitted and the login button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]))  {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if both username and password are provided
    if (!empty($username) && !empty($password)) {
        // Validate the admin credentials
        if ($username === $validAdminUsername && $password === $validAdminPassword) {
            // Set session variables to indicate the user is logged in as an admin
            $_SESSION["admin_logged_in"] = true;

            // Redirect to the admin page
            header("Location: admin.php");
            exit(); // Ensure that code execution stops after the redirect
        } else {
            // If the credentials are invalid, redirect back to the login page with an error message
            header("Location: login.php?message=Invalid username or password");
            exit(); // Ensure that code execution stops after the redirect
        }
    } else {
        // If username or password is empty, redirect back to the login page with an error message
        header("Location: login.php?message=Please provide both username and password");
        exit(); // Ensure that code execution stops after the redirect
    }
} else {
    // If the form is not submitted or the login button is not clicked, do nothing
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
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
        <a href="notices.php">Notices</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign up</a>
    </nav>

    <div class="container">
        <div class="login-form">
            <h2>Admin Login</h2>
            <form id="loginForm" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Your username.." required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password.." required>

                <input type="submit" value="Login" name="login">

            </form>
            <div class="response-message" id="responseMessage"></div> 
        </div>
    </div>
</body>

</html>
