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
        }

        nav {
            background-color: #444;
            text-align: center;
            width: 20%;
            height: 100vh;
            padding-top: 15px;
        }

        nav a {
            margin-bottom: 10px;
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
        }

        nav a:hover {
            color: #ffd700;
        }

        .container {
            display: flex;
            width: auto;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-bottom: 20px;
        }

        .content {
            width: 80%;
            padding: 20px;
            background-color: #fff;
            /* Add a background color for better visibility */
            border-radius: 0 8px 8px 0;
            /* Rounded border on the right side */
        }

        h2 {
            color: #333;
            padding-top: 20px;
        }

        h3 {
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>CCET Chandigarh - Notices</h1>
    </header>
    <div class="container">
        <nav>
            <a href="#" class="notices">NOTICES</a>
            <a href="#" class="etender">E-TENDER</a>
            <a href="#" class="proforma">PROFORMA</a>
            <a href="logout.php">LOGOUT</a>
        </nav>
        <div class="content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Here you can manage notices, edit them, delete them, and perform other administrative tasks.</p>
            <h3>Instructions:</h3>
            <ul>
                <li>To edit a notice, click on the edit button next to the notice you want to modify.</li>
                <li>To delete a notice, click on the delete button next to the notice you want to remove.</li>
                <li>You can also add new notices by clicking on the "Add Notice" button.</li>
                <li>For any assistance or queries, please contact the administrator.</li>
            </ul>
        </div>
    </div>
</body>
<script>
   // Corrected JavaScript
document.addEventListener('DOMContentLoaded', function () {
    const result = document.querySelector('.content'); // Change to querySelector('.content')
    const noticesLink = document.querySelector(".notices");
    const etenderLink = document.querySelector(".etender");
    const proformaLink = document.querySelector(".proforma");

    // Function to fetch and display notices
    function fetchNotices() {
        fetch("noticeprint.php")
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching notices:', error);
                result.innerHTML = '<p>Error fetching notices. Please try again later.</p>';
            });
    }

    // Function to fetch and display e-tender information
    function fetchEtenders() {
        fetch("printetender.php")
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching e-tender information:', error);
                result.innerHTML = '<p>Error fetching e-tender information. Please try again later.</p>';
            });
    }

    // Function to fetch and display proforma information
    function fetchProforma() {
        fetch("printproforma.php")
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching proforma information:', error);
                result.innerHTML = '<p>Error fetching proforma information. Please try again later.</p>';
            });
    }

    // Event listener for notices link
    noticesLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        fetchNotices();
    });

    // Event listener for e-tender link
    etenderLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        fetchEtenders();
    });

    // Event listener for proforma link
    proformaLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior
        fetchProforma();
    });
});

</script>

</html>