<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Your Account</title>
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

        .err {
            background-color: #FDA403;
            font-size: 20px;
            padding: 5px;
            color: #E8751A;
            border-radius: 5px;
            margin-top: 2px;
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
    </style>
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="notices.php">Notices</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <?php
        if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
        }
        ?>
        <a href="signup.php">Sign up</a>
    </nav>

    <div class="container">
        <div class="signup-form">
            <h2>Recover Your Account</h2>
            
            <form id="recoverForm">
                <label for="username">Email ID</label>
                <input type="text" id="username" name="username" placeholder="Your Email ID.." required>
                <input type="submit" value="Send Mail" name="forgot">
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
            <div style="color: red; padding-left:15px" id="responseMessage" class="response-message"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var recoverForm = document.getElementById('recoverForm');
            var responseMessage = document.getElementById('responseMessage');

            recoverForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var username = document.getElementById('username').value;

                // AJAX request to send form data to the server
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'forgotpass.php'); // Replace 'forgotpass.php' with your server-side script URL
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        responseMessage.innerHTML = response;
                        setTimeout(function() {
                            responseMessage.innerHTML = ''; // Clear the response message after 5 seconds
                            window.location.href="otppage.php";
                        }, 5000);
                    } else {
                        responseMessage.innerHTML = 'Request failed. Please try again later.';
                    }
                };

                var formData = 'username=' + encodeURIComponent(username);
                xhr.send(formData);
            });
        });
    </script>
</body>

</html>
