<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<?php
include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql_delete = "DELETE FROM users WHERE id = '$user_id'";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: user.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>