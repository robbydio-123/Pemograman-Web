<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($id === false || $id === null || $nama === '' || $noAnggota === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data anggota tidak valid.'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'UPDATE anggota SET nama = :nama, no_anggota = :no_anggota, alamat = :alamat, no_hp = :no_hp WHERE id = :id'
    );
    $stmt->execute([
        'id' => $id,
        'nama' => $nama,
        'no_anggota' => $noAnggota,
        'alamat' => $alamat,
        'no_hp' => $noHp,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil diubah.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'No. Anggota sudah dipakai, gunakan nomor lain.'];
    header('Location: tambah.php?edit=' . $id);
    exit;
}
