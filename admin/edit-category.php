<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Item List<span class="sr-only">(current)</span></a>
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
        <h2>Edit Category</h2>
        <?php
        include("../setting.php");

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $category_id = $_GET['id'];

            $sql = "SELECT * FROM category WHERE id = '$category_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="POST" action="">
                    <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama_kategori">Category Name:</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        <?php
            } else {
                echo "Category not found";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_id'])) {
            $category_id = $_POST['category_id'];
            $nama_kategori = $_POST["nama_kategori"];
            $deskripsi = $_POST["deskripsi"];
            $status = $_POST["status"];

            $sql_update = "UPDATE category SET nama_kategori='$nama_kategori', deskripsi='$deskripsi', status='$status' WHERE id='$category_id'";
            if ($conn->query($sql_update) === TRUE) {
                header("Location: category.php");
            } else {
                echo "Error updating category: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>