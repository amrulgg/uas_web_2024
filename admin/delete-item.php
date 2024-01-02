<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<?php
include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $item_id = $_GET['id'];

    $sql_select = "SELECT img FROM item WHERE id = '$item_id'";
    $result_select = mysqli_query($conn, $sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $filename = $row['img'];

        $sql_delete = "DELETE FROM item WHERE id = '$item_id'";
        if (mysqli_query($conn, $sql_delete)) {
            unlink('../uploads/' . $filename);
            header("Location: index.php");
        } else {
            echo "Error deleting item: " . mysqli_error($conn);
        }
    } else {
        echo "Item not found";
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>