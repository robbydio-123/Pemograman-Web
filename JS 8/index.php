<?php
session_start();
require __DIR__ . '/includes/koneksi.php';
$page_title = "Beranda";

$totalBuku = (int) $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = (int) $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
$totalDipinjam = 3;
$totalTerlambat = 4;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?> - SIMPUS Mini</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <a class="brand" href="index.php"><h1>SIMPUS Mini</h1></a>
        <input class="nav-toggle" type="checkbox" id="nav-toggle">
        <label class="nav-toggle-label" for="nav-toggle" aria-label="Buka menu">
            <span></span><span></span><span></span>
        </label>
        <nav>
            <ul>
                <li><a class="active" href="index.php"><span class="nav-icon icon-home" aria-hidden="true"></span>Beranda</a></li>
                <li><a href="buku/list.php"><span class="nav-icon icon-book" aria-hidden="true"></span>Daftar Buku</a></li>
                <li><a href="buku/tambah.php"><span class="nav-icon icon-plus" aria-hidden="true"></span>Tambah Buku</a></li>
                <li><a href="anggota/list.php"><span class="nav-icon icon-users" aria-hidden="true"></span>Daftar Anggota</a></li>
                <li><a href="anggota/tambah.php"><span class="nav-icon icon-user-plus" aria-hidden="true"></span>Tambah Anggota</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
            <p class="page-description">Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>
            <article>
                <h3><span class="stat-icon icon-book" aria-hidden="true"></span>Total Buku</h3>
                <p><?php echo $totalBuku; ?></p>
            </article>
            <article>
                <h3><span class="stat-icon icon-users" aria-hidden="true"></span>Total Anggota</h3>
                <p><?php echo $totalAnggota; ?></p>
            </article>
            <article>
                <h3><span class="stat-icon icon-book-open" aria-hidden="true"></span>Sedang Dipinjam</h3>
                <p><?php echo $totalDipinjam; ?></p>
            </article>
            <article>
                <h3><span class="stat-icon icon-clock" aria-hidden="true"></span>Buku Terlambat</h3>
                <p><?php echo $totalTerlambat; ?></p>
            </article>
        </section>
        </main>
        <footer><p>&copy; <?php echo date('Y'); ?> SIMPUS-Mini &mdash; Sistem Perpustakaan Mini</p></footer>
    </body>
    </html>