<?php
session_start();

$index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($index === false || $index === null || !isset($_SESSION['anggota'][$index]) || $nama === '' || $noAnggota === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data anggota tidak valid.'];
    header('Location: list.php');
    exit;
}

$_SESSION['anggota'][$index] = [
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp,
];
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil diubah.'];
header('Location: list.php');
exit;