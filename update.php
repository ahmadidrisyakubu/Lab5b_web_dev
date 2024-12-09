<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current user data
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];
    $role = $_POST["role"];

    $sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";
    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form method="post" action="update.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo $user['matric']; ?>" readonly><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br><br>

        <label for="role">Access Level:</label>
        <select id="role" name="role" required>
            <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
            <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
        </select><br><br>

        <button type="submit">Update</button>
        <a href="display.php">Cancel</a>
    </form>
</body>
</html>
