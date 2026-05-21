<?php
session_start();
require_once 'config/koneksi.php';

if (isset($_SESSION['user'])) {
    $id_user = $_SESSION['user'];
    $query = "SELECT bookmark.*, sampah.*, users.username 
          FROM bookmark
          JOIN sampah ON bookmark.id_sampah = sampah.id_sampah
          JOIN users ON bookmark.id = users.id
          WHERE bookmark.id = '$id_user'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {    
        $bookmarks = [];
        while ($row = $result->fetch_object()) {
            $bookmarks[] = $row;
            $username = $row->username;
        }
    } else {
        $bookmarks = [];
    }
} else {
    echo $conn->error;
    exit;
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
    <title>bookmark</title>
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

    <div class="container mt-5 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark">Daftar Sampah: <span class="text-success"><?= $username ?></span></h2>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="index.php" class="btn btn-outline-success rounded-pill px-4 fw-semibold">← Kembali ke Dashboard</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 justify-content-start">
            <?php foreach ($bookmarks as $bookmark): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm text-center category-card p-3">
                        
                        <img src="<?= $bookmark->image_url ?>" class="card-img-top mx-auto category-img" alt="<?= $bookmark->nama_sampah ?>" style="height: 120px; object-fit: contain;">
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold mt-3 mb-2">
                                    <a href="detail.php?id_sampah=<?= $bookmark->id_sampah ?>" class="text-dark text-decoration-none card-link">
                                        <?= $bookmark->nama_sampah ?>
                                    </a>
                                </h4>
                                
                                <?php 
                                    $badge_color = 'bg-success'; // Default: Rendah
                                    if ($bookmark->tingkat_bahaya == 'Tinggi') {
                                        $badge_color = 'bg-danger';
                                    } elseif ($bookmark->tingkat_bahaya == 'Sedang') {
                                        $badge_color = 'bg-warning text-dark';
                                    }
                                ?>
                                <span class="badge <?= $badge_color ?> rounded-pill px-3 py-2 small fw-semibold">
                                    Bahaya: <?= $bookmark->tingkat_bahaya ?>
                                </span>
                            </div>
                            
                            <div class="mt-4">
                                <a href="detail.php?id_sampah=<?= $bookmark->id_sampah ?>" class="btn btn-success btn-sm w-100 rounded-pill fw-semibold py-2">
                                    Lihat Pengolahan
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>