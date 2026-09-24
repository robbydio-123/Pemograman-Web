<?php
session_start();
$index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
if ($index !== false && $index !== null && isset($_SESSION['buku'][$index])) {
    array_splice($_SESSION['buku'], $index, 1);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil dihapus.'];
}
header('Location: list.php');
exit;