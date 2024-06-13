<?php
include("./php/database.php");
session_destroy();
header("LOCATION:login.php");
exit;
?>