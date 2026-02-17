<?php
session_start();
include("includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;

            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password. Try again.";
        }

    } else {
        echo "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Login - Sevra</title>
</head>
<body>
    <!-- Navigation Header -->
    <?php include('includes/header.php'); ?>

    <!-- Main Section -->
    <main class="welcome-container">
        <!-- Welcome Section -->
        <section class="welcome-text">
            <h1>Welcome to Sevra!</h1>
            <p>
            Welcome to your gentle space for journaling, reflection, and self-care — a cozy, comforting corner where you're always safe to be yourself. Here, you can take a deep breath, slow down, and find peace in your own rhythm. Whether you're writing your thoughts, exploring your feelings, or simply pausing to care for yourself, this is your quiet sanctuary to feel supported, understood, and refreshed.
            </p>
        </section>

        <!-- Login Section -->
        <section class="auth-section">
            <div class="auth-card">
                <img src="img/logo.jpg" alt="Sevra Logo" class="auth-logo">

                <!-- Login Form -->
                <form class="auth-form" id="login-form" method="POST" action="login.php">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="auth-btn">Login</button>
                    <p class="auth-link">
                        <a href="#" onclick="showForm('forgot')">Forgot Password?</a>
                    </p>
                    <p class="auth-link">
                        Don't have an account?
                        <a href="#" onclick="showForm('register')">Register</a>
                    </p>
                </form>

                <!-- Register/Sign Up Form -->
                <form class="auth-form hidden" id="register-form" method="POST" action="register.php">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Create Password" required>
                    <button type="submit" class="auth-btn">Register</button>
                    <p class="auth-link">
                        Already have an account?
                        <a href="#" onclick="showForm('login')">Login</a>
                    </p>
                </form>

                <!-- Recovery/Forgot Password Form -->
                <form class="auth-form hidden" id="forgot-form">
                    <input type="email" placeholder="Email" required>

                    <button type="submit" class="auth-btn">Recover Password</button>

                    <p class="auth-link">
                        <a href="#" onclick="showForm('login')">Back to Login</a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <!-- Form Script -->
    <script>
        function showForm(type) {
            document.getElementById("login-form").classList.add("hidden");
            document.getElementById("register-form").classList.add("hidden");
            document.getElementById("forgot-form").classList.add("hidden");
            document.getElementById(type + "-form").classList.remove("hidden");
        }
    </script>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>
</html>