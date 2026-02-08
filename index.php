<?php
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Dashboard - Sevra</title>
</head>
<body>
    <!-- Navigation Header -->
    <?php include('includes/header.php'); ?>

    <!-- Welcome Section -->
    <main class="welcome-container">
        <section class="welcome-text">
            <h1>Welcome to Sevra!</h1>
            <p>
            Welcome to your gentle space for journaling, reflection, and self-care — a cozy, comforting corner where you're always safe to be yourself. Here, you can take a deep breath, slow down, and find peace in your own rhythm. Whether you're writing your thoughts, exploring your feelings, or simply pausing to care for yourself, this is your quiet sanctuary to feel supported, understood, and refreshed.
            </p>
        </section>

        <!-- Widgets: Time, Date, and Picture -->
        <div class="info-grid">
            <section class="welcome-pic">
                <img src="img/quote.png" alt="Welcome Image">
            </section>

            <section class="time-date">
                <p><?php echo date("l, jS \\of F Y"); ?></p>
                <h1><?php echo date("h:i A"); ?></h1>
                <a href="archives.php"><p>Do you want to write a Time Capsule?</p></a>
            </section>
        
        <!-- Widget: Mood Checker -->
            <section class="mood-checker">
                <h2>How are you feeling today?</h2>
                <form onsubmit="submitMood(event)">
                <div class="emoji-labels">
                    <span>😢</span><span>😌</span><span>😊</span><span>😖</span>
                </div>
                <input
                    type="range"
                    min="1"
                    max="4"
                    step="1"
                    value="1"
                    id="moodSlider"
                    oninput="updateMood(this.value)"/>
                </form>
            </section>
        </div>
    </main>

    <!-- Widget: Mood Checker Script -->
    <script>
        const moods = [
        "😢 Sad",
        "😌 Calm",
        "😊 Happy",
        "😖 Stressed"
        ];

        function updateMood(value) {
        document.getElementById("moodLabel").textContent = moods[value];
        }

        function submitMood(e) {
        e.preventDefault();
        const value = document.getElementById("moodSlider").value;
        alert("Your mood today: " + moods[value]);
        }
    </script>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>
</html>
