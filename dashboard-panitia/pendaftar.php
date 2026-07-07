<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Peserta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include '../components/navbar.php'; ?> <!-- Navbar di atas -->

<div class="container-fluid mt-5 pt-4">
  <h3 class="mb-4">Daftar Peserta</h3>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle w-100 shadow-sm">
      <thead class="table-light">
        <tr>
          <th>Nama Peserta</th>
          <th>Email</th>
          <th>No. HP</th>
          <th>Event</th>
          <th>Tanggal Daftar</th>
          <th style="width:200px;">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data peserta akan ditampilkan di sini dari database -->
        <!-- Contoh baris kosong -->
        <!--
        <tr>
          <td>...</td>
          <td>...</td>
          <td>...</td>
          <td>...</td>
          <td>...</td>
          <td><span class="badge bg-success">Aktif</span></td>
          <td>
            <a href="#" class="btn btn-info btn-sm">Detail</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
        -->
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
