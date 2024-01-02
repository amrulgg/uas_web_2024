<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<?php
include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $sql_delete = "DELETE FROM category WHERE id = '$category_id'";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: category.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>