<?php
include 'ketnoi.php';

$conn->select_db('darkboard');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    $stmt = $conn->prepare("UPDATE danhmuc SET name = ?, email = ?, address = ?, phone = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $email, $address, $phone, $id);

    if ($stmt->execute() === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
