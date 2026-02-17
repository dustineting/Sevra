<?php
date_default_timezone_set('Asia/Manila');
include('includes/database.php');

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['journal_title'] ?? '';
    $answer_a = $_POST['answer_a'] ?? '';
    $answer_b = $_POST['answer_b'] ?? '';
    $answer_c = $_POST['answer_c'] ?? '';

    $stmt = $conn->prepare("INSERT INTO journals 
        (title, answer_a, answer_b, answer_c) 
        VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $title, $answer_a, $answer_b, $answer_c);
    $stmt->execute();
    $stmt->close();

    header("Location: journal.php");
    exit();
}

// Get Latest Journal Entry
$result = $conn->query("SELECT * FROM journals ORDER BY id DESC LIMIT 1");
$latestEntry = $result->fetch_assoc();

$journalEntryNumber = $latestEntry ? $latestEntry['id'] : 1;
$journalTitle = $latestEntry ? $latestEntry['title'] : "My Journal Entry";

$todayDate = date("m/d/Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Journal - Sevra</title>
</head>
<body>
    <!-- Navigation Header -->
    <?php include('includes/header.php'); ?>

    <!-- Main Section -->
    <main class="journal-container">
    <div class="journal-card">
        <!-- Journal Header -->
        <div class="journal-header">
            <div class="journal-title">
                <h1><?php echo htmlspecialchars($journalTitle); ?></h1>
            </div>

            <div class="journal-info">
                <p><strong>Journal Entry #<?php echo $journalEntryNumber; ?></strong></p>
                <p><?php echo $todayDate; ?></p>
            </div>
        </div>
        
        <!-- Title Customization Form -->
        <form method="POST" class="title-form">
            <input type="text" name="journal_title" placeholder="Enter Journal Entry Title">
            <button type="submit">Update Title</button>
        </form>

        <!-- Questions -->
        <form method="POST" class="journal-form">
            <label>What happened?</label>
            <textarea name="answer_a" required></textarea>

            <label>What do you feel right now?</label>
            <textarea name="answer_b" required></textarea>

            <label>What do you want to tell yourself?</label>
            <textarea name="answer_c" required></textarea>

            <label>Do you feel better now?</label>
            <button type="submit" class="submit-btn">Yes</button>
        </form>
    </div>
</main>