<?php
include("./php/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
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

        .signup-form {
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

        .login-link {
            text-align: center;
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
        <?php
         
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
        }
        ?>
        <a href="signup.php">Sign up</a>
    </nav>

    <div class="container">
        <div class="signup-form">
            <h2 style="text-align: center;">Sign Up</h2>
            <form id="signupForm">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Your username.." required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password.." required>

                <input type="submit" value="Sign Up">
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
            <div id="responseMessage" class="response-message"></div> <!-- Display response message here -->
        </div>
    </div>

    <script>
        window.onload = function () {
            var urlParams = new URLSearchParams(window.location.search);
            var message = urlParams.get('message');
            if (message) {
                alert(message);
            }
        };
        document.addEventListener('DOMContentLoaded', function () {
            var signupForm = document.getElementById('signupForm');
            var responseMessage = document.getElementById('responseMessage'); // Get the response message element

            signupForm.addEventListener('submit', function (event) {
                event.preventDefault();
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                if (username.endsWith('@ccet.ac.in')) {
                    if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]).{8,}$/.test(password)) {
                        console.log('Password is valid');

                        // AJAX request to send form data to the server
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'your_signup_handler.php'); // Replace 'your_signup_handler.php' with your server-side script URL
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                var response = xhr.responseText; // Get the response from the server
                                if (response === 'EMAIL SENT') {
                                    responseMessage.classList.add('success'); // Add success class to change text color
                                }
                                responseMessage.textContent = response; // Display the response message
                                signupForm.reset(); // Reset the form
                                setTimeout(function () {
                                    responseMessage.textContent = ''; // Clear the response message after 5 seconds
                                }, 5000);
                            } else {
                                responseMessage.textContent = 'Request failed. Please try again later.'; // Display error message
                            }
                        };

                        var formData = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
                        xhr.send(formData);
                    } else {
                        responseMessage.textContent = 'Invalid password. It must have at least one lowercase, one uppercase, one special character, and be at least 8 characters long.'; // Display error message
                    }
                } else {
                    responseMessage.textContent = 'Invalid username. It must end with ccet.ac.in'; // Display error message
                }
            });
        });
    </script>

</body>

</html>