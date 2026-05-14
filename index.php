<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
    } else {
        $query = "SELECT * FROM kategori";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $categories = [];
            while ($row = $result->fetch_object()) {
                $categories[] = $row;
            }
        } else {
            $categories = [];
        }
        $conn->close();
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" role="search" action="search.php" method="GET">
                        <input class="form-control me-2" type="search" name="keyword" placeholder="Cari sampah..." aria-label="Search"/>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    
                    <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Ingin Logout?')">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">
        <h2>SELAMAT DATANG</h2>
        <p>Pilih Kategori Sampah di Bawah Ini</p>

        <table border="0" cellpadding="15">
            <?php foreach ($categories as $category): ?>
                <td style="text-align: center; border: 1px solid">
                    <img src="img/organik.png" alt="organik" width="100"><br>

                    <h3>
                        <a href="sampah.php?id_kategori=<?= $category->id_kategori ?>">
                            <?= $category->nama_kategori ?>
                        </a>
                    </h3>

                    <p><?= $category->definisi_kategori ?></p>
                </td>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>