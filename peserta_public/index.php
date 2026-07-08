<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Kampus</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold text-primary fs-2" href="#">
            SME
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold" href="../dashboard-panitia/pendaftar.php">
                        Login
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<!-- Hero -->
<section class="hero d-flex align-items-center">

    <div class="container text-center text-white">

        <span class="badge bg-light text-primary px-3 py-2 mb-3">
            🎓 Sistem Manajemen Event Kampus
        </span>

        <h1 class="display-4 fw-bold">
            Temukan Event Kampus Terbaik
        </h1>

        <p class="lead mt-3">
            Daftar seminar, workshop, lomba, dan berbagai kegiatan kampus dengan mudah melalui SME.
        </p>

        <a href="#event" class="btn btn-light btn-lg mt-4">
            Jelajahi Event
        </a>

    </div>

</section>

<!-- Event -->
<section class="container py-5" id="event">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Event Kampus
        </h2>

        <p class="text-muted">
            Pilih event yang ingin kamu ikuti.
        </p>

    </div>

    <div class="row g-4 justify-content-center">

        <!-- Card 1 -->
        <div class="col-lg-6 col-md-6">

            <div class="card event-card h-100">

                <img src="assets/images/himatography_1.jpeg"
                    class="card-img-top event-img"
                    alt="Lomba Foto Nasional">

                <div class="card-body">

                    <span class="badge bg-primary mb-3">
                        Lomba
                    </span>

                    <h4 class="fw-bold">
                        Lomba Foto Nasional 2026
                    </h4>

                    <p class="text-muted mb-2">
                        📅 12 April - 15 Juli 2026
                    </p>

                    <p class="text-success fw-bold">
                        💰 Rp50.000
                    </p>

                    <a href="detail_event.php?id=1"
                        class="btn btn-primary w-100">
                        Lihat Detail
                    </a>

                </div>

            </div>

        </div>

        <!-- Card 2 -->
        <div class="col-lg-6 col-md-6">

            <div class="card event-card h-100">

                <img src="assets/images/geteksi_1.jpeg"
                    class="card-img-top event-img"
                    alt="GETEKSI">

                <div class="card-body">

                    <span class="badge bg-success mb-3">
                        Seminar
                    </span>

                    <h4 class="fw-bold">
                        GETEKSI VOL. 3
                    </h4>

                    <p class="text-muted mb-2">
                        📅 07 Juni 2026
                    </p>

                    <p class="text-secondary">
                        📍 Aula ITB STIKOM Bali & Zoom Meeting
                    </p>

                    <a href="detail_event.php?id=2"
                        class="btn btn-primary w-100">
                        Lihat Detail
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>