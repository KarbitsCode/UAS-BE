<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>

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

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_event    = trim($_POST['nama_event'] ?? '');
    $kategori      = $_POST['kategori'] ?? '';
    $kuota         = (int)($_POST['kuota'] ?? 0);
    $tanggal_event = $_POST['tanggal_event'] ?? '';
    $deskripsi     = trim($_POST['deskripsi'] ?? '');
    $poster_event  = null;

    if (!$nama_event || !$kategori || !$kuota || !$tanggal_event) {
        $error = 'Nama event, kategori, kuota, dan tanggal wajib diisi.';
    } else {
        // Upload poster jika ada
        if (isset($_FILES['poster_event']) && $_FILES['poster_event']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType     = mime_content_type($_FILES['poster_event']['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                $error = 'Format file poster tidak valid. Gunakan JPG, PNG, GIF, atau WEBP.';
            } else {
                $ext           = pathinfo($_FILES['poster_event']['name'], PATHINFO_EXTENSION);
                $poster_event  = uniqid('poster_', true) . '.' . $ext;
                $uploadDir     = __DIR__ . "/../uploads/posters/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                move_uploaded_file($_FILES['poster_event']['tmp_name'], $uploadDir . $poster_event);
            }
        }

        if (!$error) {
            $eventsModel = new Events();
            $result = $eventsModel->putData([
                'id_user'       => $_SESSION['id_user'],
                'nama_event'    => $nama_event,
                'kategori'      => $kategori,
                'kuota'         => $kuota,
                'tanggal_event' => $tanggal_event,
                'deskripsi'     => $deskripsi,
                'poster_event'  => $poster_event,
            ]);

            if ($result) {
                header("Location: event.php?msg=tambah");
                exit;
            } else {
                $error = 'Gagal menyimpan event, coba lagi.';
            }
        }
    }
}
?>

<?php include '../components/navbar.php'; ?>

<div class="main-content">

    <div class="container-fluid">

        <!-- Judul -->
        <div class="page-title">
            <h2>Tambah Event</h2>
            <p>Buat event baru untuk peserta.</p>
        </div>

        <!-- Form -->
        <div class="table-container">

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama Event</label>
                    <input
                        type="text"
                        name="nama_event"
                        class="form-control"
                        placeholder="Masukkan nama event"
                        value="<?php echo htmlspecialchars($_POST['nama_event'] ?? ''); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Event</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach (['Seminar', 'Workshop', 'Lomba', 'Pameran'] as $kat): ?>
                            <option value="<?php echo $kat; ?>" <?php echo (($_POST['kategori'] ?? '') === $kat) ? 'selected' : ''; ?>>
                                <?php echo $kat; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kuota Peserta</label>
                    <input
                        type="number"
                        name="kuota"
                        class="form-control"
                        placeholder="Contoh: 100"
                        min="1"
                        value="<?php echo htmlspecialchars($_POST['kuota'] ?? ''); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Event</label>
                    <input
                        type="datetime-local"
                        name="tanggal_event"
                        class="form-control"
                        value="<?php echo htmlspecialchars($_POST['tanggal_event'] ?? ''); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"
                        placeholder="Deskripsikan event"><?php echo htmlspecialchars($_POST['deskripsi'] ?? ''); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload Poster Event</label>
                    <input type="file" name="poster_event" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Event</button>
                    <a href="event.php" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>