<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

if ($id === false || $id === null || $judul === '' || $pengarang === '' || !is_numeric($tahun) || $tahun < 1900 || $tahun > 2026 || !is_numeric($stok) || $stok < 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data buku tidak valid.'];
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare(
    'UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok, kategori = :kategori WHERE id = :id'
);
$stmt->execute([
    'id' => $id,
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil diubah.'];
header('Location: list.php');
exit;