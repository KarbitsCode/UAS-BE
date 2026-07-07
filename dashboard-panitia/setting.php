<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setting Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include '../components/navbar.php'; ?> <!-- Navbar di atas -->

<div class="container mt-5 pt-4">
  <h3 class="mb-4">Pengaturan Akun</h3>

  <!-- Informasi Akun -->
  <div class="card mb-4">
    <div class="card-header fw-bold">Informasi Akun</div>
    <div class="card-body">
      <form action="proses_setting.php" method="POST">
        <div class="mb-3">
          <label for="org" class="form-label">Nama Organisasi</label>
          <input type="text" class="form-control" id="org" name="org" placeholder="Masukkan nama organisasi">
        </div>
        <div class="mb-3">
          <label for="user" class="form-label">User</label>
          <input type="text" class="form-control" id="user" name="user" placeholder="Masukkan nama user">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <!-- Ganti Password -->
  <div class="card mb-4">
    <div class="card-header fw-bold">Ganti Password</div>
    <div class="card-body">
      <form action="proses_password.php" method="POST">
        <div class="mb-3">
          <label for="oldPass" class="form-label">Password Lama</label>
          <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Masukkan password lama">
        </div>
        <div class="mb-3">
          <label for="newPass" class="form-label">Password Baru</label>
          <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Masukkan password baru">
        </div>
        <div class="mb-3">
          <label for="confirmPass" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Ulangi password baru">
        </div>
        <button type="submit" class="btn btn-warning">Ganti Password</button>
      </form>
    </div>
  </div>

  <!-- Informasi Akun Readonly -->
  <div class="card mb-4">
    <div class="card-header fw-bold">Informasi Akun (Readonly)</div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" value="Admin" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" class="form-control" value="Aktif" readonly>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
