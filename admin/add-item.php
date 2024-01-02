<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Add Item</title>
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
                    <a class="nav-link" href="home.php">Beranda <span class="sr-only">(current)</span></a>
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
        <h2>Tambah Item</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Kategori</label>
                <select class="form-control" id="category" name="category_id">
                    <?php
                    include("../setting.php");

                    $sql = "SELECT id, nama_kategori FROM category WHERE status='active'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["nama_kategori"] . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_item">Nama Item</label>
                <input type="text" class="form-control" id="nama_item" name="nama_item">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga">
            </div>
            <div class="form-group">
                <label for="img">Gambar</label>
                <input type="file" class="form-control-file" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Item</button>
        </form>
    </div>

</body>

</html>
<?php
include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST["category_id"];
    $nama_item = $_POST["nama_item"];
    $deskripsi = $_POST["deskripsi"];
    $harga = $_POST["harga"];
    $filetmpname = $_FILES['img']['tmp_name'];
    $folder = '../uploads/';
    $random = rand(1, 10000);
    $filename = $random . $_FILES['img']['name'];
    move_uploaded_file($filetmpname, $folder . $filename);

    $sql = "INSERT INTO item (category_id, nama_item, deskripsi, harga, img) VALUES ('$category_id', '$nama_item', '$deskripsi', '$harga', '$filename')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>