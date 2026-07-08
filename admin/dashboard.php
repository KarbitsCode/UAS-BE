<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .admin-nav { background-color: #1e3a5f; }
    </style>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'administrator') {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/users.php";

$usersModel = new Users();
$msg        = $_GET['msg'] ?? '';

// Proses verifikasi / nonaktifkan
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $targetId = (int)$_GET['id'];
    if ($_GET['aksi'] === 'verifikasi') {
        $usersModel->verifyPenyelenggara($targetId);
        header("Location: dashboard.php?msg=verified");
        exit;
    } elseif ($_GET['aksi'] === 'hapus') {
        $usersModel->removeData(['id_user' => $targetId]);
        header("Location: dashboard.php?msg=hapus");
        exit;
    }
}

$allPenyelenggara = $usersModel->getAllPenyelenggara();
?>

<nav class="navbar navbar-expand-lg navbar-dark admin-nav px-3">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">SME Admin</a>
        <div class="ms-auto">
            <span class="text-white me-3">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="../auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">Kelola Penyelenggara</h3>

    <?php if ($msg === 'verified'): ?>
        <div class="alert alert-success alert-dismissible fade show">Akun berhasil diverifikasi! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php elseif ($msg === 'hapus'): ?>
        <div class="alert alert-warning alert-dismissible fade show">Akun berhasil dihapus. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header fw-bold">Daftar Penyelenggara</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama Organisasi</th>
                            <th>Status</th>
                            <th style="width:200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($allPenyelenggara && $allPenyelenggara->num_rows > 0): ?>
                            <?php while ($row = $allPenyelenggara->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_user']; ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_organisasi']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $row['aktif'] ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                            <?php echo $row['aktif'] ? 'Aktif' : 'Pending'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!$row['aktif']): ?>
                                            <a href="?aksi=verifikasi&id=<?php echo $row['id_user']; ?>"
                                               class="btn btn-success btn-sm">Verifikasi</a>
                                        <?php else: ?>
                                            <span class="text-muted">Sudah aktif</span>
                                        <?php endif; ?>
                                        <a href="?aksi=hapus&id=<?php echo $row['id_user']; ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin hapus akun <?php echo htmlspecialchars(addslashes($row['username'])); ?>?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada penyelenggara terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
