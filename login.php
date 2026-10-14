<?php
session_start();
$conn = new mysqli("localhost", "root", "", "job-platform");

if ($conn->connect_error) {
    die("DB Error");
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'];

// ================= LOGIN =================
if ($action == "login") {

    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);
    $role = $conn->real_escape_string($data['role']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='$role'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $_SESSION['user'] = $email;
        $_SESSION['role'] = $role;

        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "invalid"]);
    }
}

// ================= SIGNUP =================
if ($action == "signup") {

    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);
    $role = $conn->real_escape_string($data['role']);

    // check existing user
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo json_encode(["status" => "exists"]);
        exit();
    }

    $conn->query("INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password','$role')");

    $_SESSION['user'] = $email;
    $_SESSION['role'] = $role;

    echo json_encode(["status" => "registered"]);
}
?>
