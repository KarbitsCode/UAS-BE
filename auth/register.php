<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Penyelenggara</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1d4ed8 0%, #7c3aed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }
        .register-card { border-radius: 20px; border: none; }
        .brand-title { color: #1d4ed8; font-weight: 800; font-size: 2rem; }
        .form-control { border-radius: 10px; padding: .65rem 1rem; }
        .btn-primary { border-radius: 10px; padding: .65rem; font-weight: 600; }
    </style>
</head>
<body>

<?php
session_start();

if (isset($_SESSION['id_user'])) {
    header("Location: ../dashboard-panitia/dashboard.php");
    exit;
}

require_once __DIR__ . "/../classes/users.php";

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_organisasi      = trim($_POST['nama_organisasi'] ?? '');
    $username             = trim($_POST['username'] ?? '');
    $password             = $_POST['password'] ?? '';
    $konfirmasi_password  = $_POST['konfirmasi_password'] ?? '';

    if (!$nama_organisasi || !$username || !$password) {
        $error = 'Semua field wajib diisi.';
    } elseif ($password !== $konfirmasi_password) {
        $error = 'Konfirmasi password tidak cocok.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        $usersModel = new Users();
        $existing   = $usersModel->getUserByUsn($username);

        if ($existing) {
            $error = 'Username sudah digunakan, pilih yang lain.';
        } else {
            $result = $usersModel->putData([
                'username'        => $username,
                'pswd'            => $password,
                'nama_organisasi' => $nama_organisasi,
            ]);

            if ($result) {
                $success = 'Registrasi berhasil! Akun Anda menunggu verifikasi administrator.';
            } else {
                $error = 'Registrasi gagal, coba lagi.';
            }
        }
    }
}
?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow register-card">

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2 class="brand-title">SME</h2>
                        <p class="text-muted">
                            Registrasi Penyelenggara Event
                        </p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Organisasi
                            </label>
                            <input
                                type="text"
                                name="nama_organisasi"
                                class="form-control"
                                placeholder="Contoh: RADE"
                                value="<?php echo htmlspecialchars($_POST['nama_organisasi'] ?? ''); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Username
                            </label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Konfirmasi Password
                            </label>
                            <input
                                type="password"
                                name="konfirmasi_password"
                                class="form-control"
                                placeholder="Ulangi password"
                                required>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">
                            Daftar
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Sudah punya akun?
                        <a href="login.php">Login</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>