<?php
session_start();
require_once 'config/koneksi.php';

$error = "";

if (isset($_POST['register'])) {
    $em = $_POST["email"];
    $un = $_POST["username"];
    $pw = $_POST["password"];
    $cpw = $_POST["confirm_password"];

    if ($pw != $cpw) {
        $error = "Konfirmasi Password tidak cocok!";
    }

    if (empty($error)) {
        $check_email = "SELECT * FROM users WHERE email = '$em' OR username = '$un'";
        $result_check = $conn->query($check_email);
        
        if ($result_check && $result_check->num_rows > 0) {
            $sudahada = $result_check->fetch_object();
            if ($sudahada->email == $em) {
                $error = "Email Tersebut Sudah Digunakan!";
            } else if ($sudahada->username == $un) {
                $error = "Username tersebut sudah digunakan!";
            }
        }
    }

    if (empty($error)) {
        $query = "INSERT INTO users (email, username, password) VALUES ('$em', '$un', '$pw')";
        $result = $conn->query($query);
        
        if ($result == TRUE) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Register Gagal! " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Register</title>
</head>
<body class="background-light vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="card shadow-lg border-0 overflow-hidden mx-auto" style="border-radius: 35px; max-width: 900px; min-height: 600px;">
            <div class="row g-0">
                
                <div class="col-md-6 d-none d-md-block position-relative">
                    <img src="img/bersih.jpeg" 
                         class="img-fluid h-100 w-100 position-absolute" 
                         style="object-fit: cover;" 
                         alt="Background">
                    
                    <div class="position-relative h-100 d-flex align-items-end p-5 text-white" style="background: rgba(0,0,0,0.2);">
                        <div>
                            <h1 class="fw-bold">Pilah.IN</h1>
                            <p>Jaga Bumi, Mulai dari hal kecil.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 bg-white p-4 p-md-5">
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark">Pilah.IN</h5>
                        <h2 class="fw-bold mt-3 mb-1 text-center">Buat Akun</h2>
                        <p class="text-muted small text-center">Daftar sekarang untuk ikut melestarikan lingkungan.</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 small py-2 mb-3" role="alert">
                            <?= $error ?>
                            <button type="button" class="btn-close py-2 small" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="mb-2">
                            <label class="form-label small fw-bold text-secondary">Email</label>
                            <input type="email" name="email" class="form-control border-0 bg-light fs-6" placeholder="Example@gmail.com" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small fw-bold text-secondary">Username</label>
                            <input type="text" name="username" class="form-control border-0 bg-light fs-6" placeholder="Username" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Password</label>
                                <input type="password" name="password" class="form-control border-0 bg-light fs-6" placeholder="Password" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Konfirmasi</label>
                                <input type="password" name="confirm_password" class="form-control border-0 bg-light fs-6" placeholder="Password" required>
                            </div>
                        </div>

                        <button type="submit" name="register" class="btn btn-dark w-100 fw-bold py-3 mb-3" style="background-color: #1a1c2b; border-radius: 12px;">
                            Daftar Sekarang
                        </button>
                        
                        <p class="text-center small text-muted">
                            Sudah punya akun? <a href="login.php" class="text-dark fw-bold text-decoration-none">Login</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>