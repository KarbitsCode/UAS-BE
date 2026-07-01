<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Penyelenggara</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f8f9fa;
        }

        .register-card{
            margin-top:60px;
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

            <div class="card shadow register-card">

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2 class="brand-title">Event Management System</h2>
                        <p class="text-muted">
                            Registrasi Penyelenggara Event
                        </p>
                    </div>

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Organisasi
                            </label>
                            <input
                                type="text"
                                name="nama_organisasi"
                                class="form-control"
                                placeholder="Contoh: HMTI"
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

</body>
</html>