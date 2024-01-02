<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>GunMarket</title>
</head>

<body>
    <div class="container mt-4">
        <h2>GunMarket</h2>

        <div class="row">
            <?php
            include("setting.php");

            $sql = "SELECT item.id, category.nama_kategori, item.deskripsi, item.harga, item.img
                    FROM item
                    INNER JOIN category ON item.category_id = category.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<img src='uploads/{$row['img']}' class='card-img-top' alt='Item Image'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$row['deskripsi']}</h5>";
                    echo "<p class='card-text'>Category: {$row['nama_kategori']}</p>";
                    echo "<p class='card-text'>Price: " . formatCurrency($row['harga']) . "</p>";
                    echo "<a href='https://wa.me/6285963977891' target='_blank' class='btn btn-success'>Buy</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No items available</p>";
            }

            function formatCurrency($amount)
            {
                return 'Rp ' . number_format($amount, 0, ',', '.');
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>