<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Event</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary fs-3" href="index.php">
            SME
        </a>

        <!-- Tombol Responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
            <ul class="navbar-nav">

                <li class="nav-item mx-3">
                    <a class="nav-link fw-bold" href="index.php">
                        Home
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!-- Form -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Form Pendaftaran Event</h4>
                </div>

                <div class="card-body">

                    <form action="sukses.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" name="nim" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <select class="form-select" name="prodi" required>
                                <option value="">-- Pilih Program Studi --</option>
                                <option>Teknologi Informasi</option>
                                <option>Sistem Informasi</option>
                                <option>Sistem Komputer</option>
                                <option>Bisnis Digital</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Daftar Sekarang
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>