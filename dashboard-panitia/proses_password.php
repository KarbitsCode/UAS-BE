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

$usersModel   = new Users();
$id_user      = (int)$_SESSION['id_user'];
$oldPass      = $_POST['oldPass'] ?? '';
$newPass      = $_POST['newPass'] ?? '';
$confirmPass  = $_POST['confirmPass'] ?? '';

// Ambil user dari DB untuk cek password lama
$user = $usersModel->getDataById(['id_user' => $id_user])->fetch_assoc();

if (!$user || !password_verify($oldPass, $user['password'])) {
    header("Location: setting.php?msg=pass_err");
    exit;
}

if ($newPass !== $confirmPass || strlen($newPass) < 6) {
    header("Location: setting.php?msg=pass_err");
    exit;
}

$usersModel->updatePassword($id_user, $newPass);

header("Location: setting.php?msg=pass_ok");
exit;
