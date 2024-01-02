<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>

    <div class="container mt-5">
        <center>
            <div class="card col-6">
                <div class="card-body">
                    <h1 class="text-center">Login</h1>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email">Alamat Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Alamat email">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Pasword">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
        </center>
    </div>
    </div>
</body>

</html>
<?php
session_start();

include("../setting.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        header("Location: index.php");
    } else {
        echo "Invalid email or password";
    }
}

$conn->close();
?>