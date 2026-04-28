<?php
header("Content-Type: application/json");
require_once 'db.php';

$sql = "SELECT * FROM vaccination_records";
$result = $conn->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $records]);
} else {
    echo json_encode(["status" => "success", "data" => []]);
}

$conn->close();
?>
