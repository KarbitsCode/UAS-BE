<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyelenggara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
<?php include '../components/navbar.php'; ?> <!-- Navbar di atas -->

<div class="container-fluid mt-5"> <!-- mt-5 biar konten tidak ketutup navbar fixed-top -->

    <!-- Judul halaman -->
    <div class="page-title mb-4">
        <p>👋</p>
        <P>Selamat datang, <strong>RADE</strong></P>
       
    </div>

    <!-- Statistik Event -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="event-card purple text-center p-3 rounded shadow-sm">
                <h6>Total Event</h6>
                <h2>12</h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card blue text-center p-3 rounded shadow-sm">
                <h6>Total Pendaftar</h6>
                <h2>245</h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card orange text-center p-3 rounded shadow-sm">
                <h6>Event Aktif</h6>
                <h2>5</h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card cyan text-center p-3 rounded shadow-sm">
                <h6>Event Selesai</h6>
                <h2>7</h2>
            </div>
        </div>
    </div>

    <!-- Event Terbaru -->
    <div class="table-container mt-4">
        <div class="table-header mb-3">
            <h4>Event Terbaru</h4>
        </div>
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Seminar AI</td>
                    <td>10 Juli 2026</td>
                    <td><span class="badge bg-success">Aktif</span></td>
                </tr>
                <tr>
                    <td>Workshop UI/UX</td>
                    <td>15 Juli 2026</td>
                    <td><span class="badge bg-success">Aktif</span></td>
                </tr>
                <tr>
                    <td>Lomba Web</td>
                    <td>20 Juli 2026</td>
                    <td><span class="badge bg-secondary">Selesai</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
