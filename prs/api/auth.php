<?php
header("Content-Type: application/json");
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required']);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ? AND password_hash = SHA2(?, 256)");
$stmt->execute([$data['username'], $data['password']]);
$user = $stmt->fetch();

if ($user) {
    unset($user['password_hash']);
    echo json_encode(['status' => 'success', 'user' => $user]);
} else {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
}
?>
