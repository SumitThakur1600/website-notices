
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notices";
$conn = @new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo '<h4 id="db"> Unable to Connect to the Database Error : </h4>';
}
