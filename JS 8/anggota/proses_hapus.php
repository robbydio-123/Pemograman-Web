<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID anggota tidak valid.'];
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM anggota WHERE id = :id');
$stmt->execute(['id' => $id]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
header('Location: list.php');
exit;
