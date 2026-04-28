<?php
require_once 'db.php';

header('Content-Type: application/json');

// Λήψη JSON δεδομένων από το POST
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->user_id) || !isset($data->action)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
    exit;
}

$user_id = $data->user_id;
$action = $data->action;
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

$stmt = $conn->prepare("INSERT INTO audit_logs (user_id, action, ip_address) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $action, $ip);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Action logged']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to log action']);
}
?>