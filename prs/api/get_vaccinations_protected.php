<?php
header("Content-Type: application/json");
require_once("../config.php");

$input = json_decode(file_get_contents("php://input"), true);
$user_id = $input['user_id'] ?? null;
$key = $input['key'] ?? null;

if (!$user_id || !$key) {
    echo json_encode(["status" => "error", "message" => "Missing user_id or key"]);
    exit();
}

// Έλεγχος αν το API key είναι σωστό για τον χρήστη
$key_stmt = $conn->prepare("SELECT * FROM secure_keys WHERE user_id = ? AND `key` = ?");
$key_stmt = $conn->prepare("SELECT * FROM secure_keys WHERE user_id = ? AND `key` = ?");
$key_stmt->bind_param("is", $user_id, $key);
$key_stmt->execute();
$key_result = $key_stmt->get_result();

if ($key_result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid API key"]);
    exit();
}

// Αν το key είναι σωστό, φέρνουμε τα vaccination records
$stmt = $conn->prepare("SELECT * FROM vaccination_records WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode(["status" => "success", "data" => $records]);
?>
