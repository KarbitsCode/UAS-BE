<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

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

$eventsModel = new Events();
$id_event    = (int)($_GET['id'] ?? 0);

if (!$id_event) {
    header("Location: event.php");
    exit;
}

$event = $eventsModel->getDataById($id_event);
if (!$event || (int)$event['id_user'] !== (int)$_SESSION['id_user']) {
    header("Location: event.php");
    exit;
}

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
        // Upload poster baru jika ada
        if (isset($_FILES['poster_event']) && $_FILES['poster_event']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType     = mime_content_type($_FILES['poster_event']['tmp_name']);
            if (!in_array($fileType, $allowedTypes)) {
                $error = 'Format file poster tidak valid. Gunakan JPG, PNG, GIF, atau WEBP.';
            } else {
                $ext          = pathinfo($_FILES['poster_event']['name'], PATHINFO_EXTENSION);
                $poster_event = uniqid('poster_', true) . '.' . $ext;
                $uploadDir    = __DIR__ . "/../uploads/posters/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                // Hapus poster lama
                if ($event['poster_event'] && file_exists($uploadDir . $event['poster_event'])) {
                    unlink($uploadDir . $event['poster_event']);
                }
                move_uploaded_file($_FILES['poster_event']['tmp_name'], $uploadDir . $poster_event);
            }
        }

        if (!$error) {
            $result = $eventsModel->updateData([
                'id_event'      => $id_event,
                'nama_event'    => $nama_event,
                'kategori'      => $kategori,
                'kuota'         => $kuota,
                'tanggal_event' => $tanggal_event,
                'deskripsi'     => $deskripsi,
                'poster_event'  => $poster_event,
            ]);

            if ($result) {
                header("Location: detail-event.php?id={$id_event}&msg=edit");
                exit;
            } else {
                $error = 'Gagal menyimpan perubahan, coba lagi.';
            }
        }
    }
    // Re-load event untuk form
    $event = $eventsModel->getDataById($id_event);
}

// Format tanggal untuk input datetime-local
$tanggalInput = date('Y-m-d', strtotime($event['tanggal_event']));
$waktuInput   = date('H:i', strtotime($event['tanggal_event']));
?>

<?php include '../components/navbar.php'; ?>

<div class="main-content">

    <div class="container-fluid">

        <!-- Judul -->
        <div class="page-title">
            <h2>Edit Event</h2>
            <p>Perbarui informasi event.</p>
        </div>

        <!-- Form Edit -->
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
                        value="<?php echo htmlspecialchars($_POST['nama_event'] ?? $event['nama_event']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Event</label>
                    <select name="kategori" class="form-select" required>
                        <?php foreach (['Seminar', 'Workshop', 'Lomba', 'Pameran'] as $kat): ?>
                            <?php $selected = (($_POST['kategori'] ?? $event['kategori']) === $kat) ? 'selected' : ''; ?>
                            <option value="<?php echo $kat; ?>" <?php echo $selected; ?>><?php echo $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kuota Peserta</label>
                    <input
                        type="number"
                        name="kuota"
                        class="form-control"
                        min="1"
                        value="<?php echo htmlspecialchars($_POST['kuota'] ?? $event['kuota']); ?>"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Event</label>
                        <input
                            type="date"
                            name="tanggal_event_date"
                            class="form-control"
                            value="<?php echo $tanggalInput; ?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Event</label>
                        <input
                            type="time"
                            name="tanggal_event_time"
                            class="form-control"
                            value="<?php echo $waktuInput; ?>"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="5"><?php echo htmlspecialchars($_POST['deskripsi'] ?? $event['deskripsi']); ?></textarea>
                </div>

                <?php if ($event['poster_event']): ?>
                <div class="mb-3">
                    <label class="form-label">Poster Saat Ini</label><br>
                    <img src="../uploads/posters/<?php echo htmlspecialchars($event['poster_event']); ?>"
                         class="img-thumbnail mb-3" alt="Poster Event" style="max-width:250px;">
                </div>
                <?php endif; ?>

                <div class="mb-4">
                    <label class="form-label">Ganti Poster Event</label>
                    <input type="file" name="poster_event" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti poster.</small>
                </div>

                <!-- Gabungkan tanggal & waktu sebelum submit -->
                <input type="hidden" name="tanggal_event" id="tanggal_event_hidden">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="detail-event.php?id=<?php echo $id_event; ?>" class="btn btn-secondary">Batal</a>
                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Gabungkan input tanggal + waktu menjadi format datetime sebelum form di-submit
document.querySelector('form').addEventListener('submit', function () {
    var tgl   = document.querySelector('[name="tanggal_event_date"]').value;
    var waktu = document.querySelector('[name="tanggal_event_time"]').value;
    document.getElementById('tanggal_event_hidden').value = tgl + ' ' + waktu + ':00';
});
</script>

</body>
</html>