<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM feedbacks WHERE id=$id";
    $result = $conn->query($sql);
    $feedback = $result->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    $sql = "UPDATE feedbacks SET name='$name', email='$email', feedback='$feedback' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Feedback</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Feedback</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $feedback['id']; ?>">
            <input type="text" name="name" value="<?php echo $feedback['name']; ?>" required>
            <input type="email" name="email" value="<?php echo $feedback['email']; ?>" required>
            <textarea name="feedback" required><?php echo $feedback['feedback']; ?></textarea>
            <button type="submit" name="update">Update Feedback</button>
        </form>
        <form action="dashboard.php">
            <button type="submit">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>
