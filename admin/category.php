<!DOCTYPE html>
<html lang="en">

<head>
    <title>Category List</title>
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
                    <a class="nav-link" href="home.php">Beranda<span class="sr-only">(current)</span></a>
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
    <div class="container mb-3">
        <center>
            <h2>Category List</h2>
        </center>
        <a class="btn btn-primary mb-2" href="add-category.php">Add Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../setting.php");

                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);
                $i = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr></tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['nama_kategori']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="edit-category.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a onclick="return alert('anda yakin?')" class="btn btn-danger btn-sm" href="delete-category.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No categories found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>