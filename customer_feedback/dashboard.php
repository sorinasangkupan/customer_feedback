<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];

        $sql = "UPDATE feedbacks SET name='$name', email='$email', feedback='$feedback' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Feedback updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM feedbacks WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Feedback deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$feedbacks = $conn->query("SELECT * FROM feedbacks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Feedback System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Customer Feedback System</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>! 
            <form method="POST" action="logout.php" style="display:inline;">
                <br><br><button type="submit">Logout</button>
            </form>
        </p>
        <form method="GET" action="add_feedback.php" style="display:inline;">
            <button type="submit">Add New Feedback</button>
        </form>
<br><br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $feedbacks->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['feedback']; ?></td>
                        <td>
                            <form method="POST" action="edit_feedback.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="edit">Edit</button>
                            </form>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
