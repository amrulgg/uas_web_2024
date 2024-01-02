<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
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
                    <a class="nav-link" href="home.php">Beranda <span class="sr-only">(current)</span></a>
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
    <div class="container mt-3">
        <h2>Edit User</h2>
        <?php
        include("../setting.php");

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $user_id = $_GET['id'];

            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="POST" action="">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
        <?php
            } else {
                echo "User not found";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $nama = $_POST["nama"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = sha1($_POST["password"]);

            $sql_update = "UPDATE users SET nama='$nama', username='$username', email='$email', password='$password' WHERE id='$user_id'";
            if ($conn->query($sql_update) === TRUE) {
                header("Location: user.php");
            } else {
                echo "Error updating user: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>