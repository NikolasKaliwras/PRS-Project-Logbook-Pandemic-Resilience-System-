<?php
header("Content-Type: application/json");
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['user_id'], $data['vaccine_type'], $data['vaccination_date'], $data['location'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO vaccination_records (user_id, vaccine_type, vaccination_date, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $data['user_id'], $data['vaccine_type'], $data['vaccination_date'], $data['location']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Vaccination record inserted"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
