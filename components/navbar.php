<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm px-3 fixed-top">
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
            RADE
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="setting.php">Settingan</a></li>
            <!-- Logout diarahkan ke logout.php -->
            <li><a class="dropdown-item text-danger" href="auth/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>
