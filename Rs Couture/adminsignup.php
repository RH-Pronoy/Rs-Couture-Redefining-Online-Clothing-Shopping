<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $checkQuery = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $checkQuery->bind_param('s', $username);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            $query = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
            $query->bind_param('ss', $username, $hashed_password);

            if ($query->execute()) {
                $success = "Sign-up successful! You can now log in.";
            } else {
                $error = "Database error.";
            }
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="signup-container">
        <form method="POST">
            <h2>Admin Signup</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php elseif (isset($success)): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="adminlogin.php">Log In</a></p>
        </form>
    </div>
</body>
</html>
