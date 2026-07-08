<?php

$id = $_GET['id'] ?? 1;

if ($id == 1) {

    $judul = "Lomba Foto Nasional 2026";

    $gambar1 = "assets/images/himatography_1.jpeg";
    $gambar2 = "assets/images/himatography_2.jpeg";
    $gambar3 = "assets/images/himatography_3.jpeg";
    $gambar4 = "assets/images/himatography_4.jpeg";

    $pendaftaran = "12 April - 15 Juli 2026";
    $biaya = "Rp 50.000";
    $hadiah = "Jutaan Rupiah + E-Sertifikat";
    $peserta = "Terbuka Untuk Umum";

    $cp1 = "Ria : +62 812349878911";
    $cp2 = "Diah : +62 812345678911";

    $instagram = "himatography_";
    $website = "https://www.himatography.com";

    $deskripsi = "Lomba Foto Nasional hadir kembali! Cerita Nusantara Vol. 5 mengajak kamu mengabadikan keindahan dan kisah Indonesia lewat lensa.";

} elseif ($id == 2) {

    $judul = "GETEKSI VOL. 3";

    $gambar1 = "assets/images/geteksi_1.jpeg";
    $gambar2 = "assets/images/geteksi_2.jpeg";
    $gambar3 = null;
    $gambar4 = null;

    $pendaftaran = "07 Juni 2026";
    $biaya = "Rp 40.000 (Online) / Rp 45.000 (Offline)";
    $hadiah = "SKKM, Knowledge, Relation, E-Certificate";
    $peserta = "Mahasiswa dan Pelajar";

    $cp1 = "Ria : +62 8128344577593";
    $cp2 = "Diah : +62 812345678911";

    $instagram = "@himaprodi_ti";
    $website = "";

    $deskripsi = "GETEKSI Vol. 3 menghadirkan Seminar Nasional, Esai Competition, dan Poster Competition untuk pelajar dan mahasiswa.";

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">

    <div class="row">

        <div class="col-md-5">

            <div id="eventCarousel" class="carousel slide shadow rounded">

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="<?php echo $gambar1; ?>"
                             class="d-block w-100 rounded"
                             alt="Event 1">
                    </div>

                    <div class="carousel-item">
                        <img src="<?php echo $gambar2; ?>"
                             class="d-block w-100 rounded"
                             alt="Event 2">
                    </div>

                    <div class="carousel-item">
                        <img src="<?php echo $gambar3; ?>"
                             class="d-block w-100 rounded"
                             alt="Event 3">
                    </div>

                     <div class="carousel-item">
                        <img src="<?php echo $gambar4; ?>"
                             class="d-block w-100 rounded"
                             alt="Event 4">
                    </div>

                </div>

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#eventCarousel"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#eventCarousel"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                </button>

            </div>

        </div>

        <div class="col-md-7">

            <h2 class="fw-bold">
                <?php echo $judul; ?>
            </h2>

            <hr>

            <p>📅 Pendaftaran : <?php echo $pendaftaran; ?></p>
            <p>💰 Biaya : <?php echo $biaya; ?></p>
            <p>🏆 Hadiah : <?php echo $hadiah; ?></p>
            <p>🌍 Peserta : <?php echo $peserta; ?></p>

            <p><strong>Contact Person :</strong></p>

            <p><?php echo $cp1; ?></p>
            <p><?php echo $cp2; ?></p>

            <p><strong>More Info :</strong></p>

            <p>Instagram : <?php echo $instagram; ?></p>

            <p>
                <a href="<?php echo $website; ?>" target="_blank">
                    <?php echo $website; ?>
                </a>
            </p>

            <h5>Deskripsi Event</h5>

            <p>
                <?php echo $deskripsi; ?>
            </p>

            <a href="daftar_event.php" class="btn btn-success">
                Daftar Sekarang
            </a>

        </div>

    </div>

</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>