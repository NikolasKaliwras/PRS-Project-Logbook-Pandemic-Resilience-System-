<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM Users");
        echo json_encode($stmt->fetchAll());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO Users (role_id, username, password_hash, email, national_id, prs_id)
                               VALUES (?, ?, SHA2(?, 256), ?, ?, UUID())");
        $stmt->execute([$data['role_id'], $data['username'], $data['password'], $data['email'], $data['national_id']]);
        echo json_encode(['message' => 'User created']);
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $pdo->prepare("UPDATE Users SET email = ? WHERE user_id = ?");
        $stmt->execute([$data['email'], $data['user_id']]);
        echo json_encode(['message' => 'User updated']);
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $pdo->prepare("DELETE FROM Users WHERE user_id = ?");
        $stmt->execute([$data['user_id']]);
        echo json_encode(['message' => 'User deleted']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>
