<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "prs_database";

// Δημιουργία σύνδεσης
$conn = new mysqli($host, $username, $password, $database);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

