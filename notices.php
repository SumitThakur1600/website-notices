<?php
include("./php/database.php");
include("loginchecker.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notices Forms</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    .container {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    p {
        margin-bottom: 20px;
        color: #666;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin-bottom: 10px;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
    .notice-img {
        display: block;
        margin: 0 auto;
        width: 200px;
        height: auto;
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
    <h1>Notices Forms</h1>
    
    <p>Welcome to the notices page. Here, you can perform various actions related to notices such as adding,searching etc.</p>
    
    <ul>
        <li><a href="add.php">Add Notice</a> - Add a new notice to the system. This option allows users to input new notices into the system, providing relevant details and information.</li>
        <li><a href="search.php">Search Notice</a> - Search for notices based on specific criteria. Users can utilize this feature to find notices matching particular keywords, dates, or categories.</li>
        <li><a href="addetender.php">Add E-tender</a> - Submit electronic tenders. This function enables users to upload electronic tender documents for procurement processes.</li>
        <li><a href="searchetender.php">Search E-tender</a> - Search for electronic tenders. Users can search and filter through available e-tenders based on various parameters like deadline, category, or issuer.</li>
        <li><a href="addproforma.php">Add Proforma</a> - Upload proforma documents. This option allows users to upload standard proforma documents to the system for easy access and reference.</li>
        <li><a href="searchproforma.php">Search Proforma</a> - Search for proforma documents. Users can search and retrieve proforma documents based on specific criteria such as type, date, or title.</li>
    </ul>    
    
    <p>For any assistance or inquiries, please contact the administrator.</p>
</div>

</body>
</html>
