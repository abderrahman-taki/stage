<?php
if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}

if (!defined('ROOT')) {
    define('ROOT', 'root');
}

if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}

if (!defined('DATABASE')) {
    define('DATABASE', 'login_db');
}

if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/php.account/');
}

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_connect_error());
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

session_start();
?>
