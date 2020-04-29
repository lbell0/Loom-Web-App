<?php
//https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

DEFINE ('DB_SERVER', 'localhost');
DEFINE ('DB_USERNAME', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_NAME', 'Loom');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* Error checking & message if connection fails */
if($link === false){
    die("ERROR: Could not connect. Try again." . mysqli_connect_error());
}
?>
