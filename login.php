<?php
session_start();
require_once 'config/koneksi.php';

if (isset($_POST['login'])) {
    $ne = $_POST['nama_email'];
    $pw = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$ne' OR username = '$ne'";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        
        $user = $result->fetch_object();
        if ($pw == $user->password) {
            $_SESSION['login'] = TRUE;
            $_SESSION['user'] = $user->id;

            header("Location: index.php");
            exit;
        } else {
            echo "Password Anda Salah!";   
        }    
    } else {
        echo "Anda Belum Mempunyai Akun!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="login">
        <h2>WD</h2>
        <h1>SELAMAT DATANG</h1>
        <form action="" method="post">
            <div class="input_login">
                <label for="nama_email">Masukkan Email Atau Username</label><br>
                <input type="text" name="nama_email" id="nama_email" placeholder="rahmat atau example@gmail.com" required><br>

                <label for="password">Masukkan Password</label><br>
                <input type="password" name="password" id="password" placeholder="Example: cihuy123" required><br>

                <button type="sumbit" name="login" class="btn-input">Login</button>
                
                <p>Belum punya akun? <a href="register.php">Daftar</a></p>
            </div>
        </form>
    </div>
</body>
</html>