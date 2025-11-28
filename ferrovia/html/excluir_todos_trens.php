<?php
header('Content-Type: application/json');
include 'bd.php';

$sql = "DELETE FROM trem";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
