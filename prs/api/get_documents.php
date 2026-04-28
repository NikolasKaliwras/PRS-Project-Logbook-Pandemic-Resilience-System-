<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'db.php';

// Έλεγχος αν υπάρχουν user_id και key στο query string
$user_id = $_GET['user_id'] ?? null;
$key = $_GET['key'] ?? null;

if (!$user_id || !$key) {
    echo json_encode(["status" => "error", "message" => "Missing user_id or key"]);
    exit();
}

// Έλεγχος εγκυρότητας API key
$stmt = $conn->prepare("SELECT * FROM secure_keys WHERE user_id = ? AND api_key = ?");
$stmt->bind_param("is", $user_id, $key);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid API key"]);
    exit();
}

// Φέρνουμε τα έγγραφα μόνο του συγκεκριμένου χρήστη
$doc_stmt = $conn->prepare("SELECT filename, filepath, uploaded_at FROM documents WHERE user_id = ?");
$doc_stmt->bind_param("i", $user_id);
$doc_stmt->execute();
$doc_result = $doc_stmt->get_result();

$documents = [];

while ($row = $doc_result->fetch_assoc()) {
    $documents[] = $row;
}

echo json_encode(["status" => "success", "data" => $documents]);

$conn->close();
?>
