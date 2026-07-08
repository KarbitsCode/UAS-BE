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

<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/events.php";
require_once __DIR__ . "/../classes/pendaftaran.php";

$eventsModel      = new Events();
$pendaftaranModel = new Pendaftaran();

$id_user        = (int)$_SESSION['id_user'];
$stats          = $eventsModel->getDashboardStats($id_user);
$totalPendaftar = $pendaftaranModel->getTotalByUser($id_user);
$recentEvents   = $eventsModel->getRecentByUser($id_user, 5);
?>

<?php include '../components/navbar.php'; ?>

<div class="container-fluid" style="padding: 80px 24px 24px;">

    <!-- Judul halaman -->
    <div class="page-title mb-4">
        <h2>👋 Selamat datang, <?php echo htmlspecialchars($_SESSION['nama_organisasi']); ?></h2>
        <p>Ini adalah ringkasan aktivitas event Anda.</p>
    </div>

    <!-- Statistik Event -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="event-card purple text-center p-3 rounded shadow-sm">
                <h6>Total Event</h6>
                <h2><?php echo $stats['total_event']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card blue text-center p-3 rounded shadow-sm">
                <h6>Total Pendaftar</h6>
                <h2><?php echo $totalPendaftar; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card orange text-center p-3 rounded shadow-sm">
                <h6>Event Aktif</h6>
                <h2><?php echo $stats['event_aktif']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card cyan text-center p-3 rounded shadow-sm">
                <h6>Event Selesai</h6>
                <h2><?php echo $stats['event_selesai']; ?></h2>
            </div>
        </div>
    </div>

    <!-- Event Terbaru -->
    <div class="table-container mt-4">
        <div class="table-header mb-3">
            <h4>Event Terbaru</h4>
            <a href="event.php" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
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
                <?php if ($recentEvents && $recentEvents->num_rows > 0): ?>
                    <?php while ($row = $recentEvents->fetch_assoc()): ?>
                        <?php $isAktif = strtotime($row['tanggal_event']) > time(); ?>
                        <tr>
                            <td>
                                <a href="detail-event.php?id=<?php echo $row['id_event']; ?>" class="text-decoration-none fw-semibold">
                                    <?php echo htmlspecialchars($row['nama_event']); ?>
                                </a>
                            </td>
                            <td><?php echo date('d M Y', strtotime($row['tanggal_event'])); ?></td>
                            <td>
                                <span class="badge <?php echo $isAktif ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $isAktif ? 'Aktif' : 'Selesai'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada event.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>