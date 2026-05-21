<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: login.php");
    exit;
} 

$query = "SELECT * FROM kategori";
$result = $conn->query($query);

$categories = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $categories[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-hijau-custom shadow-sm sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold fs-3" href="index.php">Pilah.IN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" href="index.php">Home</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" role="search" action="search.php" method="GET">
                        <input class="form-control me-2 rounded-pill" type="search" name="keyword" placeholder="Nama Sampah..." aria-label="Search"/>
                        <button class="btn btn-light text-success fw-bold rounded-pill" type="submit">Search</button>
                    </form>
                    
                    <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3" onclick="return confirm('Ingin Logout?')">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero-section mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-2">SELAMAT DATANG</h1>
            <p class="lead fs-5">Pilih Kategori Sampah di Bawah Ini untuk Mulai Memilah</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4 justify-content-center">
            <?php foreach ($categories as $category): ?>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card h-100 shadow-sm text-center category-card p-3">
                        
                        <img src="<?= $category->logo_url ?>" class="card-img-top mx-auto category-img" alt="<?= $category->nama_kategori ?>" onerror="this.src='https://via.placeholder.com/100?text=No+Image'">
                        
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title fw-bold mt-3">
                                <a href="sampah.php?id_kategori=<?= $category->id_kategori ?>" class="text-success text-decoration-none">
                                    <?= $category->nama_kategori ?>
                                </a>
                            </h4>

                            <p class="card-text text-muted small mt-2 flex-grow-1">
                                <?= $category->definisi_kategori ?>
                            </p>
                            
                            <a href="sampah.php?id_kategori=<?= $category->id_kategori ?>" class="btn btn-outline-success btn-sm w-100 rounded-pill mt-3 fw-semibold">
                                Lihat Detail
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</body>
</html>