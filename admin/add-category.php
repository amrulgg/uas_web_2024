<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category.php">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Add Category</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nama_kategori">Category Name:</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
include("../setting.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST["nama_kategori"];
    $deskripsi = $_POST["deskripsi"];
    $status = $_POST["status"];
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO category (nama_kategori, deskripsi, status, created_at) VALUES ('$nama_kategori', '$deskripsi', '$status', '$created_at')";
    if ($conn->query($sql) === TRUE) {
        header("Location: category.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>