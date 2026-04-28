<?php
require_once 'db.php';

header('Content-Type: application/json');

// Ανάγνωση παραμέτρου user_id από τη διεύθυνση URL
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Missing or invalid user_id']);
    exit;
}

$stmt = $conn->prepare("SELECT log_id, user_id, action, timestamp, ip_address FROM audit_logs WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$logs = [];

while ($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $logs]);
?>