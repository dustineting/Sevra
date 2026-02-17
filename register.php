<?php
session_start();
include("includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Registration successful! Please login.";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Username/Email already exists.";
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
?>