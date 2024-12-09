<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Secure password hashing
    $role = $_POST["role"];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. <a href='login.php'>Go to Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Registration Form</h1>
    <form method="post" action="register.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="" disabled selected>Please select</option>
            <option value="lecturer">Lecturer</option>
            <option value="student">Student</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>
    <p>
        Already have an account? <a href="login.php">Login here</a>.
    </p>
</body>
</html>
