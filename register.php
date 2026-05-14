<?php
session_start();
require_once 'config/koneksi.php';

if (isset($_POST['register'])) {
    $em = $_POST["email"];
    $un = $_POST["username"];
    $pw = $_POST["password"];
    $cpw = $_POST["confirm_password"];

    if ($pw != $cpw) {
    echo "Konfirmasi Password!";
    }

    $check_email = "SELECT * FROM users WHERE email = '$em'";
    $result_check = $conn->query($check_email);
    
    if ($result_check->num_rows > 0) {
        echo "Email Tersebut Sudah Digunakan!";
    }

    $query = "INSERT INTO users (email, username, password) VALUES ('$em', '$un', '$pw')";
    $result = $conn->query($query);
    
    if ($result == TRUE) {
        header("Location: login.php");
    } else {
        echo "Register Gagal!" . $conn->error;
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
    <div class="register">
        <h2>WD</h2>
        <h1>BUAT AKUN</h1>
        <form action="" method="post">
            <div class="input_register">
                <label for="email">Masukkan Email</label><br>
                <input type="email" name="email" id="email" placeholder="Example@gmail.com" required><br>
                
                <label for="username">Masukkan Username</label><br>
                <input type="text" name="username" id="username" placeholder="Example: rahmat" required><br>

                <label for="password">Masukkan Password</label><br>
                <input type="password" name="password" id="password" placeholder="Example: cihuy123" required><br>

                <label for="confirm_password">Konfirmasi Password</label><br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Example: cihuy123" required><br>

                
                    <button type="sumbit" name="register" class="btn-input">Buat AKun</button>
                
                
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>