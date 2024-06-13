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

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
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
            <h2>Recover Your Account</h2>
            <!-- PHP error/success messages -->


            <form id="otpForm">
                <label for="otp">Enter OTP</label>
                <input type="number" id="otp" name="otp" placeholder="Enter OTP.." required>
                <input type="submit" value="Submit">
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
            <div style="color: red; text-align: center;" id="responseMessage" class="response-message"></div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var otpForm = document.getElementById('otpForm');
            var responseMessage = document.getElementById('responseMessage');

            otpForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var otp = document.getElementById('otp').value;

                // AJAX request to send OTP for verification
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'otpphp.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        responseMessage.innerHTML = response;
                        if(response.trim() === 'OTP verified successfully'){
                        setTimeout(function() {
                            responseMessage.innerHTML = ''; 
                            window.location.href="newpassword.php";
                        }, 3000);}
                        else{
                        setTimeout(function(){
                            responseMessage.innerHTML='';
                        },5000);}
                    } else {
                        responseMessage.innerHTML = 'Error: Request failed. Please try again later.';
                    }
                };

                var formData = 'otp=' + encodeURIComponent(otp);
                xhr.send(formData);
            });
        });
    </script>
</body>

</html>