<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search E-Tender</title>
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

<form id="searchETENDER" action="search_etender.php" method="POST"> <!-- Fixed action and method -->
    <h2>Search E-Tender</h2>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter e-tender title..">

    <label for="upload_date">Upload Date:</label>
    <input type="date" id="upload_date" name="upload_date">

    <label for="year">Year:</label>
    <select id="year" name="year">
        <option value="">Select Year</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
    </select>

    <input type="submit" value="Search">
</form>
<div id="noticeResults"></div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('#searchETENDER');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Retrieve form data
        const title = document.getElementById('title').value.trim();
        const uploadDate = document.getElementById('upload_date').value;
        const year = document.getElementById('year').value;

        // Create FormData object and append form data
        const formData = new FormData();
        formData.append('title', title);
        formData.append('upload_date', uploadDate);
        formData.append('year', year);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search_etender.php', true); // Fixed the filename here
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                displaySearchResults(response);
            } else {
                console.error('Request failed. Status: ' + xhr.status);
                alert('Error retrieving e-tender. Please try again.');
            }
        };
        xhr.onerror = function() {
            console.error('Request error.');
            alert('Error retrieving e-tender. Please try again.');
        };
        xhr.send(formData);
    });

    function displaySearchResults(results) {
        const noticeResults = document.getElementById('noticeResults');
        noticeResults.innerHTML = '';

        if (results.length === 0) {
            noticeResults.innerHTML = '<p>No E-Tenders found matching the search criteria.</p>';
            return;
        }
        
        const table = document.createElement('table');
        table.innerHTML = `
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Upload Date</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody></tbody>
        `;

        const tbody = table.querySelector('tbody');
        results.forEach(function(etender) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${etender.TITLE}</td>
                <td>${etender['UPLOAD DATE']}</td>
                <td>${etender.YEAR}</td>
            `;
            tbody.appendChild(row);
        });
        
        noticeResults.appendChild(table);
    }
}); 
</script>

</body>
</html>