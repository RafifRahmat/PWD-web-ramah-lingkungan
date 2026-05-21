<?php
session_start();
require_once 'config/koneksi.php';

if (isset($_GET['id_sampah'])) {
    $id_sampah = $_GET['id_sampah'];
    $id_user = $_SESSION['user'];

    $query = "SELECT sampah.*, kategori.nama_kategori 
              FROM sampah 
              JOIN kategori ON sampah.id_kategori = kategori.id_kategori 
              WHERE sampah.id_sampah = '$id_sampah'";
    $result = $conn->query($query);
    $check_query = "SELECT * FROM bookmark WHERE id = '$id_user' AND id_sampah = '$id_sampah'";
    $result_check = $conn->query($check_query);
    
    $bookmark = ($result_check && $result_check->num_rows > 0);

    if ($result->num_rows > 0) {
        $data = $result->fetch_object();
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Detail: <?= $data->nama_sampah ?></title>
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
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" href="bookmarkpage.php">Bookmark</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <form class="d-flex me-3" role="search" action="search.php" method="GET">
                        <input class="form-control me-2 rounded-pill" type="search" name="keyword" placeholder="Nama Sampah" aria-label="Search"/>
                        <button class="btn btn-light text-success fw-bold rounded-pill" type="submit">Search</button>
                    </form>
                    
                    <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3" onclick="return confirm('Ingin Logout?')">Logout</a>
                </div>
            </div>
        </div>
    </nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-detail shadow-lg">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="<?= $data->image_url ?>" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 400px;" alt="<?= $data->nama_sampah ?>">
                    </div>

                    <div class="col-md-7 p-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <?php if ($bookmark): ?>
                                    <button class="btn btn-success rounded-pill" disabled>Bookmarked</button>
                                <?php else: ?>
                                    <a href="bookmark.php?id_sampah=<?= $id_sampah ?>" class="btn btn-outline-success rounded-pill">Bookmark</a>
                                <?php endif; ?>
                            </ol>
                        </nav>

                        <h1 class="fw-bold mb-1"><?= $data->nama_sampah ?></h1>
                        
                        <?php 
                            $bg = ($data->tingkat_bahaya == 'Tinggi') ? 'bg-danger' : (($data->tingkat_bahaya == 'Sedang') ? 'bg-warning text-dark' : 'bg-success');
                        ?>
                        <span class="badge <?= $bg ?> badge-bahaya mb-4">Bahaya: <?= $data->tingkat_bahaya ?></span>

                        <hr>

                        <div class="mb-4">
                            <h5 class="fw-bold text-success">Definisi Sampah</h5>
                            <p class="text-muted"><?= nl2br($data->definisi_sampah) ?></p>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold text-success">Cara Pengolahan</h5>
                            <div class="p-3 bg-light border-start border-success border-4 rounded">
                                <p class="mb-0 text-dark"><?= nl2br($data->cara_pengolahan) ?></p>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <a href="javascript:history.back()" class="btn btn-outline-dark">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mt-4 text-muted small">ID Sampah: #<?= $data->id_sampah ?> | Terdaftar dalam sistem Pilah.IN</p>
        </div>
    </div>
</div>

</body>
</html>