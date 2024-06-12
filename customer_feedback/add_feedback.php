<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO feedbacks (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        echo "New feedback created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Feedback</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Feedback</h1>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="feedback" placeholder="Your Feedback" required></textarea>
            <button type="submit" name="add">Add Feedback</button>
        </form>
        <form method="GET" action="dashboard.php">
            <button type="submit">Go to Dashboard</button>
        </form>
    </div>
</body>
</html>
