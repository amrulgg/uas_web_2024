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
    <title>Edit Item</title>
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
                    <a class="nav-link" href="index.php">Item List <span class="sr-only">(current)</span></a>
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
        <h2>Edit Item</h2>
        <?php
        include("../setting.php");

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $item_id = $_GET['id'];

            $sql = "SELECT * FROM item WHERE id = '$item_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category_id">
                            <?php
                            $category_id = $row["category_id"];
                            $sql_categories = "SELECT id, nama_kategori FROM category WHERE status='active'";
                            $result_categories = $conn->query($sql_categories);

                            while ($row_category = $result_categories->fetch_assoc()) {
                                $selected = ($category_id == $row_category["id"]) ? "selected" : "";
                                echo "<option value='" . $row_category["id"] . "' $selected>" . $row_category["nama_kategori"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_item">Nama Item</label>
                        <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?php echo $row['nama_item']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="img">Gambar</label>
                        <input type="file" class="form-control-file" id="img" name="img">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Item</button>
                </form>
        <?php
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
            $category_id = $_POST["category_id"];
            $nama_item = $_POST["nama_item"];
            $deskripsi = $_POST["deskripsi"];
            $harga = $_POST["harga"];

            $filename = "";
            if (!empty($_FILES['img']['name'])) {
                $filetmpname = $_FILES['img']['tmp_name'];
                $folder = '../uploads/';
                $random = rand(1, 10000);
                $filename = $random . $_FILES['img']['name'];
                move_uploaded_file($filetmpname, $folder . $filename);
            }

            $sql_update = "UPDATE item SET category_id='$category_id', nama_item='$nama_item', deskripsi='$deskripsi', harga='$harga', img='$filename' WHERE id='$item_id'";
            if (mysqli_query($conn, $sql_update)) {
                echo "Data berhasil diupdate";
            } else {
                echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
            }
        }

        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>