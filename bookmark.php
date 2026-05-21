<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id_sampah'])) {
    $id_user = $_SESSION['user'];
    $id_sampah = $_GET['id_sampah'];

    $query = "SELECT * FROM bookmark WHERE id = '$id_user' AND id_sampah = '$id_sampah'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        $querymark = "INSERT INTO bookmark (id, id_sampah) VALUES ('$id_user', '$id_sampah')";
        $resultmark = $conn->query($querymark);    
    }

    header("Location: detail.php?id_sampah=" . $id_sampah);
    exit;
} else {
    header("Location: index.php");
    exit;
}


?>