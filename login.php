<?php
session_start(); // Start session

$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $user['matric']; // Store user info in session
            header("Location: display.php"); // Redirect to the main page
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>
        <a href="register.php">Register here if you have not.</a>
    </p>
</body>
</html>
