<?php
include("./php/database.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCET Chandigarh - Notices</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        nav {
            background-color: #444;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        nav a {
            margin: 0 15px;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #ffd700;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-bottom: 20px;
        }

        .notice {
            border-bottom: 1px solid #ccc;
            padding: 20px 0;
        }

        .notice:last-child {
            border-bottom: none;
        }

        h2 {
            color: #333;
            padding-top: 20px;
        }

        h3 {
            color: #333;
            margin-top: 20px;
        }

        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>CCET Chandigarh - Notices</h1>
    </header>
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
    <div class="container" id="noticeContainer">
        <h2>Welcome to CCET Chandigarh Notices</h2>
        <p>Stay informed with the latest notices and announcements from Chandigarh College of Engineering and Technology (CCET). Whether it's changes in examination schedules, upcoming events, workshops, internship opportunities, scholarships, academic achievements, or important updates from various departments, this is your go-to place for all the important information.</p>
        <p>At CCET, we believe in fostering an environment of continuous learning and growth. Keeping our students, faculty, and staff well-informed about the happenings on campus is integral to our mission. Through these notices, we aim to provide timely information, foster engagement, and ensure smooth communication across the entire CCET community.</p>
        <p>From reminders about registration deadlines to announcements about guest lectures by industry experts, the notices here are designed to keep you updated and engaged throughout your journey at CCET. We encourage you to check back regularly for the latest updates and opportunities that can enrich your academic and professional experience.</p>
        <h3>Recent Notices</h3>
    </div>
    <footer>
        <p>&copy; 2024 CCET Chandigarh. All rights reserved.</p>
        <p>Contact us: info@ccetchandigarh.edu</p>
    </footer>

</body>

</html>