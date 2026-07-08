<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>

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

$id_event = (int)($_GET['id'] ?? 0);
if (!$id_event) {
    header("Location: event.php");
    exit;
}

$event = $eventsModel->getDataById($id_event);
if (!$event || (int)$event['id_user'] !== (int)$_SESSION['id_user']) {
    header("Location: event.php");
    exit;
}

$pendaftar  = $pendaftaranModel->getDataByEvent($id_event);
$isAktif    = strtotime($event['tanggal_event']) > time();
$msg        = $_GET['msg'] ?? '';
?>

<?php include '../components/navbar.php'; ?>

<div class="main-content">

    <div class="container-fluid">

        <!-- Judul -->
        <div class="page-title">
            <h2>&#128196; Detail Event</h2>
            <p>Informasi lengkap mengenai event.</p>
        </div>

        <?php if ($msg === 'edit'): ?>
            <div class="alert alert-success alert-dismissible fade show">Event berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>

        <div class="table-container">

            <div class="row">

                <!-- Poster Event -->
                <div class="col-md-4">
                    <?php if ($event['poster_event']): ?>
                        <img src="../uploads/posters/<?php echo htmlspecialchars($event['poster_event']); ?>"
                             class="img-fluid rounded shadow-sm" alt="Poster Event">
                    <?php else: ?>
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded shadow-sm" style="width:100%;height:350px;">
                            <span>Tidak ada poster</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Detail -->
                <div class="col-md-8">

                    <h3 class="mb-3">
                        <?php echo htmlspecialchars($event['nama_event']); ?>
                    </h3>

                    <table class="table">
                        <tr>
                            <th width="200">Kategori</th>
                            <td><?php echo htmlspecialchars($event['kategori']); ?></td>
                        </tr>
                        <tr>
                            <th>Kuota Peserta</th>
                            <td><?php echo $event['kuota']; ?> Orang</td>
                        </tr>
                        <tr>
                            <th>Tanggal Event</th>
                            <td><?php echo date('d M Y, H:i', strtotime($event['tanggal_event'])); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge <?php echo $isAktif ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $isAktif ? 'Aktif' : 'Selesai'; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Penyelenggara</th>
                            <td><?php echo htmlspecialchars($event['nama_organisasi']); ?></td>
                        </tr>
                    </table>

                    <h5 class="mt-4">Deskripsi Event</h5>
                    <p class="text-muted">
                        <?php echo nl2br(htmlspecialchars($event['deskripsi'] ?? '-')); ?>
                    </p>

                    <div class="mt-4">
                        <a href="edit-event.php?id=<?php echo $id_event; ?>" class="btn btn-warning">Edit Event</a>
                        <a href="event.php" class="btn btn-secondary">Kembali</a>
                    </div>

                </div>

            </div>

        </div>

        <!-- Daftar Pendaftar -->
        <div class="table-container mt-4">
            <h5>Daftar Pendaftar (<?php echo $pendaftar->num_rows; ?> orang)</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th>NIK/NIM</th>
                            <th>Nama Peserta</th>
                            <th>Email</th>
                            <th>Jenis</th>
                            <th>Tanggal Daftar</th>
                            <th>Kehadiran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pendaftar->num_rows > 0): ?>
                            <?php while ($p = $pendaftar->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['nik_nim']); ?></td>
                                    <td><?php echo htmlspecialchars($p['nama_peserta']); ?></td>
                                    <td><?php echo htmlspecialchars($p['email']); ?></td>
                                    <td><?php echo htmlspecialchars($p['jenis_identitas']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($p['tanggal_daftar'])); ?></td>
                                    <td>
                                        <span class="badge <?php echo $p['status_kehadiran'] === 'hadir' ? 'bg-success' : 'bg-secondary'; ?>">
                                            <?php echo ucfirst($p['status_kehadiran']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($p['status_kehadiran'] === 'tidak hadir'): ?>
                                            <a href="?id=<?php echo $id_event; ?>&aksi=hadir&pid=<?php echo $p['id_pendaftaran']; ?>"
                                               class="btn btn-success btn-sm">Tandai Hadir</a>
                                        <?php else: ?>
                                            <a href="?id=<?php echo $id_event; ?>&aksi=tidak_hadir&pid=<?php echo $p['id_pendaftaran']; ?>"
                                               class="btn btn-outline-secondary btn-sm">Batalkan</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center text-muted">Belum ada pendaftar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<?php
// Proses update status kehadiran
if (isset($_GET['aksi']) && isset($_GET['pid'])) {
    $pid    = (int)$_GET['pid'];
    $aksi   = $_GET['aksi'];
    $status = ($aksi === 'hadir') ? 'hadir' : 'tidak hadir';
    $pendaftaranModel->updateStatus($pid, $status);
    header("Location: detail-event.php?id={$id_event}");
    exit;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>