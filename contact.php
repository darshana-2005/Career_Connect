<?php
$conn = new mysqli("localhost", "root", "", "job-platform");

if ($conn->connect_error) {
    echo "DB Error";
    exit;
}

$name    = $_POST["name"]    ?? "";
$email   = $_POST["email"]   ?? "";
$subject = $_POST["subject"] ?? "";
$message = $_POST["message"] ?? "";

if ($name === "" || $email === "" || $subject === "" || $message === "") {
    echo "All fields required";
    exit;
}

$sql = "INSERT INTO contact_messages (name, email, subject, message)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
