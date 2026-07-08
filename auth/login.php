<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['id_user'])) {
    header("Location: ../dashboard-panitia/dashboard.php");
    exit;
}

require_once __DIR__ . "/../classes/users.php";

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $usersModel = new Users();
        $user = $usersModel->getUserByUsn($username);

        if ($user && password_verify($password, $user['password'])) {
            if (!$user['aktif']) {
                $error = 'Akun Anda belum diverifikasi oleh administrator.';
            } else {
                $_SESSION['id_user']          = $user['id_user'];
                $_SESSION['username']         = $user['username'];
                $_SESSION['nama_organisasi']  = $user['nama_organisasi'];
                $_SESSION['role']             = $user['role'];
                if ($user['role'] === 'administrator') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../dashboard-panitia/dashboard.php");
                }
                exit;
            }
        } else {
            $error = 'Username atau password salah!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Penyelenggara</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f8f9fa;
        }

        .login-card{
            margin-top:80px;
        }

        .brand-title{
            color:#2563EB;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow login-card">

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2 class="brand-title">
                            SME
                        </h2>

                        <p class="text-muted">
                            Login Penyelenggara Event
                        </p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">

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

                        <button
                            type="submit"
                            class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Belum punya akun?
                        <a href="register.php">
                            Daftar
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>