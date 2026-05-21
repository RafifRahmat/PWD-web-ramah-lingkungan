<?php
session_start();
require_once 'config/koneksi.php';

if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    if ($keyword == "") {
        echo "<script>
                alert('Masukkan Nama Sampah!');
                window.location.href = 'index.php';
              </script>";
        exit;
    }

    $query = "SELECT * FROM sampah WHERE nama_sampah LIKE '%$keyword%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $trash = $result->fetch_object();
        $id_sampah = $trash->id_sampah;

        header("Location: detail.php?id_sampah=" . $id_sampah);
        exit;
    } else {
        echo "<script>
                alert('Nama Sampah Tersebut Tidak DItemukan');
                window.location.href = 'index.php';
              </script>";
    }
}
?>