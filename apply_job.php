<?php
$conn = new mysqli("localhost", "root", "", "job-platform");

if ($conn->connect_error) {
    echo "DB Error";
    exit;
}

$firstName = $_POST['firstName'];
$lastName  = $_POST['lastName'];
$email     = $_POST['email'];
$gender    = $_POST['gender'];
$worked    = $_POST['workedBefore'];

$resumeName = $_FILES['resume']['name'];
$resumeTmp  = $_FILES['resume']['tmp_name'];

$uploadDir = "resumes/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

move_uploaded_file($resumeTmp, $uploadDir . $resumeName);

$sql = "INSERT INTO job_applications 
(first_name, last_name, email, gender, worked_before, resume)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $firstName,
    $lastName,
    $email,
    $gender,
    $worked,
    $resumeName
);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
