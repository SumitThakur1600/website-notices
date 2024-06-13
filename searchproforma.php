<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Proforma</title>
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
    table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Set widths for each column */
        th:nth-child(1),
        td:nth-child(1) {
            width: 40%; /* Adjust the width as needed */
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 30%; /* Adjust the width as needed */
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 30%; /* Adjust the width as needed */
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
<form action="searchproforman.php" method="post">
    <h2>Search Proforma</h2>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter proforma title..">

    <label for="category">Category:</label>
    <select id="category" name="category">
        <option value="">Select Category</option>
        <option value="Student Forms">Student</option>
        <option value="Faculty/Staff Forms">Faculty</option>
        <option value="Departmental Forms">Department</option>
    </select>

    <label for="date">Date of Upload:</label>
    <input type="date" id="date" name="date">

    <input type="submit" value="Search">
</form>
<div id="proformaResults"></div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Retrieve form data
        const title = document.getElementById('title').value.trim();
        const category = document.getElementById('category').value;
        const date = document.getElementById('date').value;

        // Create FormData object and append form data
        const formData = new FormData();
        formData.append('title', title);
        formData.append('category', category);
        formData.append('date', date);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'searchproforman.php', true); // Fixed the filename here
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                displayProformaResults(response);
            } else {
                console.error('Request failed. Status: ' + xhr.status);
                alert('Error retrieving proforma. Please try again.');
            }
        };
        xhr.onerror = function() {
            console.error('Request error.');
            alert('Error retrieving proforma. Please try again.');
        };
        xhr.send(formData);
    });

    function displayProformaResults(results) {
        const proformaResults = document.getElementById('proformaResults');
        proformaResults.innerHTML = '';

        if (results.length === 0) {
            proformaResults.innerHTML = '<p>No Proforma found matching the search criteria.</p>';
            return;
        }
        const table = document.createElement('table');
        table.innerHTML = `
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date of Upload</th>
                </tr>
            </thead>
            <tbody></tbody>
        `;

        const tbody = table.querySelector('tbody');
        results.forEach(function(proforma) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${proforma.TITLE}</td>
                <td>${proforma.CATEGORY}</td>
                <td>${proforma.Date_of_Upload}</td>
            `;
            tbody.appendChild(row);
        });
        proformaResults.appendChild(table);
    }
}); 
</script>

</body>
</html>
