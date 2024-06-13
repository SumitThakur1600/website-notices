<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Notices</title>
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
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>
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
<form id="searchForm">
    <h2>Search Notices</h2>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter notice title..">

    <label for="date">Date of Upload:</label>
    <input type="date" id="date" name="date">

    <label for="category">Category:</label>
    <select id="category" name="category">
        <option value="">Select Category</option>
        <option value="ADMISSIONS">ADMISSIONS</option>
        <option value="SCHOLARSHIP">SCHOLARSHIPS</option>
        <option value="EXAMS">EXAMS</option>
        <option value="GENERAL">GENERAL</option>
        <option value="FEES">FEES</option>
        <option value="COMMITTEE">COMMITTEES</option>
    </select>
    <label for="year">Year:</label>
    <select class="form-select" id="year" name="year">
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
        const form = document.querySelector('#searchForm');
        const noticeResults = document.getElementById('noticeResults');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Retrieve form data
            const title = document.getElementById('title').value.trim();
            const date = document.getElementById('date').value;
            const category = document.getElementById('category').value;
            const year = document.getElementById('year').value;
            const currentDate = new Date().toISOString().split('T')[0];

            // Validation
            if (date > currentDate) {
                alert('Invalid date. Please select a date not later than today.');
                return;
            }

            // Create FormData object and append form data
            const formData = new FormData();
            formData.append('title', title);
            formData.append('date', date);
            formData.append('category', category);
            formData.append('year', year);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'search_notice.php', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    displaySearchResults(response);
                } else {
                    console.error('Request failed. Status: ' + xhr.status);
                    alert('Error retrieving notice. Please try again.');
                }
            };
            xhr.onerror = function() {
                console.error('Request error.');
                alert('Error retrieving notice. Please try again.');
            };
            xhr.send(formData);
        });

        function displaySearchResults(results) {
            noticeResults.innerHTML = '';

            if (results.length === 0) {
                noticeResults.innerHTML = '<p>No notices found matching the search criteria.</p>';
                return;
            }
            const table = document.createElement('table');
            table.innerHTML = `
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Upload Till</th>
                        <th>Category</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `;

            const tbody = table.querySelector('tbody');
            results.forEach(function(notice) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${notice.TITLE}</td>
                    <td>${notice.DATE}</td>
                    <td>${notice['UPLOAD_TILL']}</td>
                    <td>${notice.CATEGORY}</td>
                    <td>${notice.YEAR}</td>
                `;
                tbody.appendChild(row);
            });
            noticeResults.appendChild(table);
        }
    }); 
    
</script>

</body>
</html>
