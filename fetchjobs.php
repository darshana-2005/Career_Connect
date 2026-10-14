<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "job-platform");

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT title, company, location, experience FROM jobs ORDER BY id DESC";
$result = $conn->query($sql);

$jobs = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

echo json_encode($jobs);
?>
