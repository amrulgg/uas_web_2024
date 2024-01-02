<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk menengahkan gambar */
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Untuk menggunakan seluruh tinggi viewport */
        }
    </style>
</head>

<body>
    <!-- Navbar Bootstrap (opsional) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Beranda<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Item List <span class="sr-only"></span></a>
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
    <center>
        <div class="container mt-5">
            <div class="card-body">
                <h1 class="text-center">ZIK GUNSHOP</h1>
                <form method="POST" action="">
            </div>
    </center>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="centered">
                    <img src="../uploads/bSOv9YRR_400x400.jpg" class="img-fluid" alt="Foto Beranda">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>