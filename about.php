<?php
include("./php/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - Chandigarh College of Engineering and Technology</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
  }
  
  .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h1, h2 {
    text-align: center;
    color: #333;
  }
  
  .section {
    margin-top: 30px;
  }
  
  .section h2 {
    margin-bottom: 20px;
    color: #555;
  }
  
  .section p {
    line-height: 1.6;
    color: #666;
  }
  
  ul, ol {
    margin-left: 20px;
    color: #666;
  }
  
  a {
    color: #007bff;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: underline;
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
  <h1>About Chandigarh College of Engineering and Technology</h1>

  <div class="section">
    <h2>Overview</h2>
    <p>Chandigarh College of Engineering and Technology (CCET) is one of the top finest Government engineering colleges, affiliated with Panjab University. Formerly known as Central Polytechnic Chandigarh (CPC), it was established in 1959. CCET was upgraded from CPC in 2002 by then Administrator Lt. Gn. JFR Jacob. It is the only technical college offering both Diploma and Degree qualifications in Chandigarh.</p>
  </div>

  <div class="section">
    <h2>Campus</h2>
    <p>The college campus spans over 32 acres of land situated close to the Shivalik ranges and Sukhna Lake in sector 26 of Madhya Marg, a posh area of Chandigarh. The campus is divided into zones like administration blocks for Degree and Diploma streams, hostels, residential complexes for faculty and staff, lecture halls, tutorial rooms, drawing halls, auditorium, library, computer centers, workshops, laboratories, playgrounds, a branch of State Bank of India with ATM facility, extension counter of Post Office, and a canteen. The campus also has a unit of the National Cadet Corps (NCC).</p>
  </div>

  <div class="section">
    <h2>Degree Wing</h2>
    <p>The Degree wing offers the following courses under the 4-year degree program:</p>
    <ul>
      <li>Civil Engineering </li>
      <li>Computer Science and Engineering </li>
      <li>Electronics and Communication Engineering </li>
      <li>Mechanical Engineering </li>
    </ul>
  </div>

  <div class="section">
    <h2>Diploma Wing</h2>
    <p>The Diploma wing offers the following courses:</p>
    <ul>
      <li>Architectural Assistantship </li>
      <li>Civil Engineering </li>
      <li>Computer Engineering </li>
      <li>Electrical Engineering </li>
      <li>Electronics and Communication Engineering </li>
      <li>Mechanical Engineering </li>
      <li>Production and Industrial Engineering </li>
    </ul>
  </div>

  <div class="section">
    <h2>Admissions</h2>
    <p>For admissions, please visit the <a href="https://jacchd.admissions.nic.in/">admissions portal</a>.</p>
  </div>

  <div class="section">
    <h2>References</h2>
    <ol>
      <li><a href="http://www.ccet.ac.in">Panjab University</a></li>
      <li><a href="http://www.dte.chd.gov.in">Directorate of Technical Education</a></li>
    </ol>
  </div>
</div>

</body>
</html>
