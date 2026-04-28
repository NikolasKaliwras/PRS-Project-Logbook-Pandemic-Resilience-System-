<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "prs_database";

// Δημιουργία σύνδεσης με mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
