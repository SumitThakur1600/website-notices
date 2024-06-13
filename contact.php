<?php
include("./php/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - Chandigarh College of Engineering and Technology</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }
    h1 {
        text-align: center;
    }
    .contact-info {
        margin-top: 20px;
    }
    .contact-info p {
        margin-bottom: 10px;
    }
    .contact-form {
        margin-top: 20px;
    }
    .contact-form input[type="text"],
    .contact-form input[type="email"],
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        box-sizing: border-box;
    }
    .contact-form textarea {
        height: 150px;
    }
    .contact-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
    .contact-form input[type="submit"]:hover {
        background-color: #45a049;
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
    <h1>Contact Chandigarh College of Engineering and Technology</h1>
    
    <div class="contact-info">
        <p><strong>Address:</strong> Chandigarh College of Engineering and Technology, Sector 26, Chandigarh, India</p>
        <p><strong>Phone:</strong> +91 XXXXXXXXXX</p>
        <p><strong>Email:</strong> info@ccet.ac.in</p>
    </div>
    <div class="contact-form">
        <h2>Send us a message</h2>
        <form id="contactForm">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <input type="submit" name="submit" value="Send Message">
        </form>
    </div>
</div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();
            var formData = new FormData(contactForm);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'contact_process.php', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Message sent successfully!');
                        contactForm.reset();
                    } else {
                        alert('Error sending message. Please try again.');
                    }
                }
            };
            xhr.send(formData);
        });
    });
</script>
</html>
