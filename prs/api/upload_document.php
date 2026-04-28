<?php
header("Content-Type: application/json");
require_once 'db.php';

$upload_dir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['user_id']) || !isset($_FILES['file'])) {
        echo json_encode(["status" => "error", "message" => "Missing user_id or file"]);
        exit;
    }

    $user_id = intval($_POST['user_id']);
    $file = $_FILES['file'];

    // Έλεγχος για σφάλμα στο ανέβασμα
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["status" => "error", "message" => "File upload error"]);
        exit;
    }

    // Δημιουργία μοναδικού ονόματος αρχείου
    $filename = basename($file['name']);
    $target_path = $upload_dir . uniqid() . "_" . $filename;

    // Δημιουργία φακέλου αν δεν υπάρχει
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Μετακίνηση αρχείου στον φάκελο
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        $stmt = $conn->prepare("INSERT INTO documents (user_id, filename, filepath) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $filename, $target_path);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "File uploaded and record saved"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to move uploaded file"]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
