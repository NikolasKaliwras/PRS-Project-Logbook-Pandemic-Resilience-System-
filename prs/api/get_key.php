<?php
header("Content-Type: application/json");
require_once("../config.php");

if (!isset($_GET["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Missing user_id"]);
    exit();
}

$user_id = $_GET["user_id"];

$stmt = $conn->prepare("SELECT `key` FROM secure_keys WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["status" => "success", "key" => $row["key"]]);
} else {
    echo json_encode(["status" => "error", "message" => "Key not found"]);
}

$stmt->close();
$conn->close();
?>
