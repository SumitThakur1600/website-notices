<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Proforma</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    nav {
        width: 100%;
        background-color: #333;
        padding: 10px 0;
        text-align: center;
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
    input[type="file"] {
        margin-bottom: 15px;
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
<form>
    <h2>Add Proforma</h2>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter proforma title.." required>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="">Select Category</option>
        <option value="Student Forms">Student</option>
        <option value="Faculty/Staff Forms">Faculty</option>
        <option value="Department Forms">Department</option>
    </select>

    <label for="date">Date of Upload:</label>
    <input type="date" id="date" name="date" required>
    <input type="submit" value="Submit">
</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const title = document.getElementById('title').value;
            const category = document.getElementById('category').options[document.getElementById('category').selectedIndex].value;
            const date = document.getElementById('date').value;
            
            if (!title || !category || !date ) {
                alert('Please fill in all the required fields.');
                return;
            }

            const formData = new FormData();
            formData.append('title', title);
            formData.append('category', category);
            formData.append('date', date);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_proforma.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    alert('Proforma added successfully.');
                    form.reset(); // Optionally reset the form after successful submission
                } else {
                    console.error('Request failed. Status: ' + xhr.status);
                    alert('Error adding Proforma. Please try again.');
                }
            };
            xhr.onerror = function () {
                console.error('Request error.');
                alert('Error adding Proforma. Please try again.');
            };
            xhr.send(formData);
        });
    });
</script>

</body>
</html>
