<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Event</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include '../components/navbar.php'; ?> <!-- Navbar di atas -->

<div class="container-fluid mt-5 pt-4">
  <h3 class="mb-4">Daftar Event</h3>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle w-100 shadow-sm">
      <thead class="table-light">
        <tr>
          <th style="width:120px;">Poster</th>
          <th>Nama Event</th>
          <th>Tanggal</th>
          <th>Kuota</th>
          <th>Status</th>
          <th style="width:200px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="poster-ai.jpg" alt="Poster Seminar AI" class="img-fluid" style="max-width:100px;"></td>
          <td>Seminar AI</td>
          <td>10 Juli 2026</td>
          <td>120</td>
          <td><span class="badge bg-success">Aktif</span></td>
          <td>
            <a href="#" class="btn btn-info btn-sm">Detail</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
        <tr>
          <td><img src="poster-uiux.jpg" alt="Poster Workshop UI/UX" class="img-fluid" style="max-width:100px;"></td>
          <td>Workshop UI/UX</td>
          <td>15 Juli 2026</td>
          <td>80</td>
          <td><span class="badge bg-secondary">Selesai</span></td>
          <td>
            <a href="#" class="btn btn-info btn-sm">Detail</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
        <tr>
          <td><img src="poster-web.jpg" alt="Poster Lomba Web" class="img-fluid" style="max-width:100px;"></td>
          <td>Lomba Web</td>
          <td>20 Juli 2026</td>
          <td>50</td>
          <td><span class="badge bg-success">Aktif</span></td>
          <td>
            <a href="#" class="btn btn-info btn-sm">Detail</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
