<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $matric = $_GET['delete'];
    $sql = "DELETE FROM users WHERE matric = '$matric'";
    $conn->query($sql);
    header("Location: display.php");
    exit();
}

// Fetch all user data
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Users List</h1>
    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['matric'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['role'] . "</td>
                            <td>
                                <a class='action-link' href='update.php?matric=" . $row['matric'] . "'>Update</a> | 
                                <a class='action-link' href='display.php?delete=" . $row['matric'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
     <a href="logout.php">Logout</a>
</body>
</html>
<?php
$conn->close();
?>
