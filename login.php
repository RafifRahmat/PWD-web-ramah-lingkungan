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
    
    <title>Login Pilah.in</title>
</head>
<body class="background-light vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
       <div class="card shadow-lg border-0 overflow-hidden mx-auto" style="border-radius: 35px; max-width: 900px; min-height: 600px;">
            <div class="row g-0">
                
                <div class="col-md-6 d-none d-md-block position-relative">
                    <img src="img/bersih.jpeg" 
                         class="img-fluid h-100 w-100 position-absolute" 
                         style="object-fit: cover; object-position: center;" 
                         alt="Background">
                    
                    <div class="position-relative h-100 d-flex align-items-end p-5 text-white" style="background: rgba(0,0,0,0.2);">
                        <div>
                            <h1 class="fw-bold">Pilah.IN</h1>
                            <p>Jaga Bumi, Mulai dari hal kecil.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 bg-white p-4 p-md-5">
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark ">Pilah.IN</h5>
                        <h2 class="fw-bold mt-4 mb-1 text-center">Selamat Datang</h2>
                        <p class="text-muted small text-center">Silakan masuk untuk memulai menyelamatkan Bumi.</p>
                    </div>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Username</label>
                            <input type="text" name="nama_email" class="form-control form-control-lg border-0 bg-light fs-6" placeholder="rapip@gmail.com atau rapip" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg border-0 bg-light fs-6" placeholder="cihuy123" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-dark w-100 fw-bold py-3 mb-4">
                            Masuk Sekarang
                        </button>
                        
                        <p class="text-center small text-muted">
                            Belum punya akun? <a href="register.php" class="text-dark fw-bold">Daftar</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
