<?php
header("Content-Type: application/json");
require_once("../config.php");

$query = "SELECT * FROM vaccination_records";
$result = $conn->query($query);

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode(["status" => "success", "data" => $records]);
?>
