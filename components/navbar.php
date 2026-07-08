<?php
// Tentukan halaman aktif berdasarkan nama file
$currentPage = basename($_SERVER['PHP_SELF']);
function navActive(string $page, string $current): string {
    return $current === $page ? 'active fw-semibold' : '';
}
?>
<nav class="navbar navbar-expand-lg shadow-sm px-3 fixed-top" style="background:#fff; border-bottom:1px solid #e5e7eb;">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand fw-bold fs-4" href="dashboard.php" style="color:#1d4ed8; letter-spacing:-.5px;">
      &#127775; SME
    </a>

    <!-- Toggle mobile -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">

      <!-- Menu tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
        <li class="nav-item">
          <a class="nav-link px-3 rounded <?php echo navActive('dashboard.php', $currentPage); ?>"
             href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded <?php echo navActive('event.php', $currentPage); ?>"
             href="event.php">Kelola Event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 rounded <?php echo navActive('pendaftar.php', $currentPage); ?>"
             href="pendaftar.php">Daftar Peserta</a>
        </li>
      </ul>

      <!-- Menu kanan -->
      <ul class="navbar-nav ms-auto align-items-center gap-2">
        <li class="nav-item">
          <a href="tambah-event.php" class="btn btn-primary btn-sm px-3 fw-semibold">
            &#43; Tambah Event
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 ps-2 pe-1" href="#"
             id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                  style="width:34px;height:34px;font-size:.85rem;">
              <?php echo strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)); ?>
            </span>
            <span class="d-none d-lg-inline text-dark" style="font-size:.9rem;">
              <?php echo htmlspecialchars($_SESSION['nama_organisasi'] ?? $_SESSION['username'] ?? 'User'); ?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown"
              style="min-width:180px; border-radius:12px;">
            <li class="px-3 pt-2 pb-1">
              <small class="text-muted">Login sebagai</small>
              <div class="fw-semibold" style="font-size:.9rem;">
                <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>
              </div>
            </li>
            <li><hr class="dropdown-divider my-1"></li>
            <li>
              <a class="dropdown-item rounded <?php echo navActive('setting.php', $currentPage); ?>"
                 href="setting.php">&#9881;&#65039; Pengaturan</a>
            </li>
            <li>
              <a class="dropdown-item text-danger rounded" href="../auth/logout.php">&#x2B06; Keluar</a>
            </li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>

  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="dashboard.php">SME</a>

    <!-- Toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Menu tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="event.php">Kelola Event</a></li>
        <li class="nav-item"><a class="nav-link" href="pendaftar.php">Daftar Peserta</a></li>
      </ul>

      <!-- Menu kanan -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="tambah-event.php" class="btn btn-primary me-3">+ Tambah Event</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <img src="../assets/img/profile.png" alt="Profile" width="30" height="30" class="rounded-circle me-2">
            <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="setting.php">Settingan</a></li>
            <!-- Logout diarahkan ke logout.php -->
            <li><a class="dropdown-item text-danger" href="../auth/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>
