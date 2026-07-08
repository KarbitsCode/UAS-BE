<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setting Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/users.php";

$usersModel = new Users();
$user       = $usersModel->getDataById(['id_user' => $_SESSION['id_user']])->fetch_assoc();
$msg        = $_GET['msg'] ?? '';
?>

<?php include '../components/navbar.php'; ?>

<div class="container" style="padding-top:80px; padding-bottom:40px;">
  <div class="page-title mb-4">
    <h2>&#9881;&#65039; Pengaturan Akun</h2>
    <p>Kelola informasi dan keamanan akun Anda.</p>
  </div>

  <?php if ($msg === 'info_ok'): ?>
    <div class="alert alert-success alert-dismissible fade show">Informasi akun berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php elseif ($msg === 'pass_ok'): ?>
    <div class="alert alert-success alert-dismissible fade show">Password berhasil diubah! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php elseif ($msg === 'pass_err'): ?>
    <div class="alert alert-danger alert-dismissible fade show">Password lama salah! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php elseif ($msg === 'usn_taken'): ?>
    <div class="alert alert-danger alert-dismissible fade show">Username sudah digunakan! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php endif; ?>

  <!-- Informasi Akun -->
  <div class="card mb-4 border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-header fw-bold bg-white" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f0f0f0;">&#128100; Informasi Akun</div>
    <div class="card-body">
      <form action="proses_setting.php" method="POST">
        <div class="mb-3">
          <label for="org" class="form-label">Nama Organisasi</label>
          <input type="text" class="form-control" id="org" name="nama_organisasi"
                 value="<?php echo htmlspecialchars($user['nama_organisasi']); ?>" required>
        </div>
        <div class="mb-3">
          <label for="user" class="form-label">Username</label>
          <input type="text" class="form-control" id="user" name="username"
                 value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <!-- Ganti Password -->
  <div class="card mb-4 border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-header fw-bold bg-white" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f0f0f0;">&#128274; Ganti Password</div>
    <div class="card-body">
      <form action="proses_password.php" method="POST">
        <div class="mb-3">
          <label for="oldPass" class="form-label">Password Lama</label>
          <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Masukkan password lama" required>
        </div>
        <div class="mb-3">
          <label for="newPass" class="form-label">Password Baru</label>
          <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Masukkan password baru" minlength="6" required>
        </div>
        <div class="mb-3">
          <label for="confirmPass" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Ulangi password baru" required>
        </div>
        <button type="submit" class="btn btn-warning">Ganti Password</button>
      </form>
    </div>
  </div>

  <!-- Informasi Readonly -->
  <div class="card mb-4 border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-header fw-bold bg-white" style="border-radius:16px 16px 0 0; border-bottom:1px solid #f0f0f0;">&#128203; Info Akun</div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" value="<?php echo ucfirst(htmlspecialchars($user['role'])); ?>" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" class="form-control" value="<?php echo $user['aktif'] ? 'Aktif' : 'Pending Verifikasi'; ?>" readonly>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>