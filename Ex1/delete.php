<?php
include 'ketnoi.php';

$conn->select_db('darkboard');

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    $stmt = $conn->prepare("DELETE FROM danhmuc WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
