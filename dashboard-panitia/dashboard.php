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

<?php include '../components/sidebar.php'; ?>

<div class="main-content">

    <?php include '../components/navbar.php'; ?>

    <div class="container-fluid">

        <div class="page-title">
            <h2>Dashboard Event</h2>
            <p>Kelola event dan peserta dengan mudah.</p>
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="event-card purple">
                    <h5>Seminar AI</h5>
                    <p>Seminar</p>
                    <h4>100 Peserta</h4>
                    <small>10 Juli 2026</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="event-card blue">
                    <h5>Workshop UI/UX</h5>
                    <p>Workshop</p>
                    <h4>50 Peserta</h4>
                    <small>15 Juli 2026</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="event-card orange">
                    <h5>Lomba Web</h5>
                    <p>Lomba</p>
                    <h4>75 Peserta</h4>
                    <small>20 Juli 2026</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="event-card cyan">
                    <h5>Tech Expo</h5>
                    <p>Pameran</p>
                    <h4>120 Peserta</h4>
                    <small>25 Juli 2026</small>
                </div>
            </div>

        </div>

        <div class="table-container">

            <div class="table-header">
                <h4>Kelola Event</h4>

                <button class="btn btn-primary">
                    + Tambah Event
                </button>
            </div>

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Kategori</th>
                        <th>Kuota</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Seminar AI</td>
                        <td>Seminar</td>
                        <td>100</td>
                        <td>10 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Workshop UI/UX</td>
                        <td>Workshop</td>
                        <td>50</td>
                        <td>15 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Lomba Web</td>
                        <td>Lomba</td>
                        <td>75</td>
                        <td>20 Juli 2026</td>
                        <td>
                            <span class="badge bg-secondary">
                                Selesai
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');
const toggleBtn = document.getElementById('toggleSidebar');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
    mainContent.classList.toggle('full');
});
</script>

</body>
</html>