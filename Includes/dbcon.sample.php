<?php
// SAMPLE DATABASE CONFIGURATION
// Copy this file to Includes/dbcon.php and put in your own database details.
// Includes/dbcon.php is listed in .gitignore so your real credentials are never committed.
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';              // your MySQL password
$DB_NAME = 'online_exam';

$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($con->connect_errno) {
    die("DB Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8mb4");
?>
