<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Peserta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/pendaftaran.php";

$pendaftaranModel = new Pendaftaran();
$id_user          = (int)$_SESSION['id_user'];
$pendaftar        = $pendaftaranModel->getDataByUser($id_user);
?>

<?php include '../components/navbar.php'; ?>

<div class="container-fluid" style="padding:80px 24px 24px;">
  <div class="page-title mb-4">
    <h2>&#128101; Daftar Peserta</h2>
    <p>Semua peserta yang terdaftar di event Anda.</p>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle w-100 shadow-sm">
      <thead class="table-light">
        <tr>
          <th>Nama Peserta</th>
          <th>Email</th>
          <th>Jenis</th>
          <th>Event</th>
          <th>Tanggal Daftar</th>
          <th style="width:150px;">Kehadiran</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($pendaftar && $pendaftar->num_rows > 0): ?>
          <?php while ($row = $pendaftar->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['nama_peserta']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['jenis_identitas']); ?></td>
              <td><?php echo htmlspecialchars($row['nama_event']); ?></td>
              <td><?php echo date('d M Y', strtotime($row['tanggal_daftar'])); ?></td>
              <td>
                <span class="badge <?php echo $row['status_kehadiran'] === 'hadir' ? 'bg-success' : 'bg-secondary'; ?>">
                  <?php echo ucfirst($row['status_kehadiran']); ?>
                </span>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada peserta terdaftar.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>