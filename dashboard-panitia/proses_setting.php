<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: setting.php");
    exit;
}

require_once __DIR__ . "/../classes/users.php";

$usersModel      = new Users();
$id_user         = (int)$_SESSION['id_user'];
$nama_organisasi = trim($_POST['nama_organisasi'] ?? '');
$username        = trim($_POST['username'] ?? '');

if (!$nama_organisasi || !$username) {
    header("Location: setting.php");
    exit;
}

// Cek apakah username sudah dipakai orang lain
$existing = $usersModel->getUserByUsn($username);
if ($existing && (int)$existing['id_user'] !== $id_user) {
    header("Location: setting.php?msg=usn_taken");
    exit;
}

$usersModel->updateInfo([
    'id_user'         => $id_user,
    'username'        => $username,
    'nama_organisasi' => $nama_organisasi,
]);

// Perbarui session
$_SESSION['username']        = $username;
$_SESSION['nama_organisasi'] = $nama_organisasi;

header("Location: setting.php?msg=info_ok");
exit;
