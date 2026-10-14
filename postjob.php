<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "job-platform");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $company = $_POST['company'];
    $title = $_POST['title'];
    $job_type = $_POST['job_type'];
    $location = $_POST['location'];
    $experience = $_POST['experience'];
    $salary = $_POST['salary'];
    $email = $_POST['email'];

    $sql = "INSERT INTO jobs 
            (company, title, job_type, location, experience, salary, email)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssss",
        $company,
        $title,
        $job_type,
        $location,
        $experience,
        $salary,
        $email
    );

    if ($stmt->execute()) {
        // Redirect back to form after success
        header("Location: postjob.html?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
