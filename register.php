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

<body class="background-light vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
       <div class="card shadow-lg border-0 overflow-hidden mx-auto" style="border-radius: 35px; max-width: 900px; min-height: 600px;">
            <div class="row g-0">
                
                <div class="col-md-6 d-none d-md-block position-relative">
                    <img src="assets/bersih.jpg" 
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
