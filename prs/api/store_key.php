<?php
header('Content-Type: application/json');
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id = isset($data['user_id']) ? intval($data['user_id']) : 0;
$key = isset($data['key']) ? trim($data['key']) : '';

if ($user_id === 0 || empty($key)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing user_id or key']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO secure_keys (user_id, `key`) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $key);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to store key']);
}
?>