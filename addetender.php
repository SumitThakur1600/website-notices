<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add E-Tender</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    nav {
        text-align: center;
        background-color: #333;
        padding: 10px 0;
    }
    nav a {
        margin: 0 10px;
        text-decoration: none;
        color: #fff;
    }
    form {
        width: 50%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
    }
    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
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
             session_start();
             
            if (isset($_SESSION['login']) && $_SESSION['login'] === true)    {
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        <a href="signup.php">Sign up</a>
    </nav>
    <nav>
    <a href="add.php">Add Notice</a>
    <a href="search.php">Search Notice</a>
    <a href="addetender.php">Add E-tender</a>
    <a href="searchetender.php">Search E-tender</a>
    <a href="addproforma.php">Add Proforma</a>
    <a href="searchproforma.php">Search Proforma</a>
</nav>
<form >
    <h2>Add E-Tender</h2>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter e-tender title.." required>

    <label for="upload_date">Upload Date:</label>
    <input type="date" id="upload_date" name="upload_date" required>

    <label for="upload_till">Upload Till:</label>
    <input type="date" id="upload_till" name="upload_till" required>

    <label for="year">Year:</label>
    <select class="form-select" id="year" name="year" required>
        <option value="">Select Year</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
    </select>

    <input type="submit" id="submit" value="Submit">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector('form');
    
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const title = document.getElementById('title').value;
                const uploadDate = document.getElementById('upload_date').value;
                const uploadTill = document.getElementById('upload_till').value;
                const year = document.getElementById('year').value;
                const currentDate = new Date().toISOString().split('T')[0];
    
                if (uploadDate > currentDate || uploadTill < currentDate) {
                    alert('Invalid date.');
                    return;
                }
    
                const formData = new FormData();
                formData.append('title', title);
                formData.append('upload_date', uploadDate);
                formData.append('upload_till', uploadTill);
                formData.append('year', year);
    
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'process_etender.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        alert('E-Tender added successfully.');
                        form.reset(); 
                    } else {
                        console.error('Request failed. Status: ' + xhr.status);
                        alert('Error adding E-Tender. Please try again.');
                    }
                };
                xhr.onerror = function () {
                    console.error('Request error.');
                    alert('Error adding E-Tender. Please try again.');
                };
                xhr.send(formData);
            });
        });
    </script>
    
</form>

</body>
</html>
