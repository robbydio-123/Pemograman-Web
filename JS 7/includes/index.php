<?php
session_start();
$page_title = "Beranda";

if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [
        ['judul' => 'Laskar Pelangi', 'pengarang' => 'Andrea Hirata', 'tahun' => 2005, 'isbn' => '9789793062792', 'stok' => 4, 'kategori' => 'fiksi'],
        ['judul' => 'Bumi Manusia', 'pengarang' => 'Pramoedya Ananta Toer', 'tahun' => 1980, 'isbn' => '9789799731234', 'stok' => 2, 'kategori' => 'fiksi'],
        ['judul' => 'Negeri 5 Menara', 'pengarang' => 'Ahmad Fuadi', 'tahun' => 2009, 'isbn' => '9789792248616', 'stok' => 0, 'kategori' => 'fiksi'],
        ['judul' => 'Filosofi Teras', 'pengarang' => 'Henry Manampiring', 'tahun' => 2018, 'isbn' => '9786024125189', 'stok' => 5, 'kategori' => 'referensi'],
        ['judul' => 'Ronggeng Dukuh Paruk', 'pengarang' => 'Ahmad Tohari', 'tahun' => 1982, 'isbn' => '9789794072524', 'stok' => 1, 'kategori' => 'fiksi'],
        ['judul' => 'Perahu Kertas', 'pengarang' => 'Dee Lestari', 'tahun' => 2009, 'isbn' => '9789791227648', 'stok' => 3, 'kategori' => 'fiksi'],
        ['judul' => 'Ayat-Ayat Cinta', 'pengarang' => 'Habiburrahman El Shirazy', 'tahun' => 2004, 'isbn' => '9789793604059', 'stok' => 2, 'kategori' => 'fiksi'],
        ['judul' => 'Pulang', 'pengarang' => 'Tere Liye', 'tahun' => 2015, 'isbn' => '9786020331607', 'stok' => 4, 'kategori' => 'fiksi'],
        ['judul' => 'Dilan 1990', 'pengarang' => 'Pidi Baiq', 'tahun' => 2014, 'isbn' => '9786027870994', 'stok' => 3, 'kategori' => 'fiksi'],
        ['judul' => 'Cantik Itu Luka', 'pengarang' => 'Eka Kurniawan', 'tahun' => 2002, 'isbn' => '9786020312589', 'stok' => 2, 'kategori' => 'fiksi'],
        ['judul' => 'Madilog', 'pengarang' => 'Tan Malaka', 'tahun' => 1943, 'isbn' => '9789799731296', 'stok' => 1, 'kategori' => 'referensi'],
        ['judul' => 'Laut Bercerita', 'pengarang' => 'Leila S. Chudori', 'tahun' => 2017, 'isbn' => '9786024246942', 'stok' => 3, 'kategori' => 'fiksi'],
    ];
}
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [
        ['nama' => 'Siti Aminah', 'no_anggota' => 'A001', 'alamat' => 'Malang', 'no_hp' => '0812xxxx'],
        ['nama' => 'Budi Santoso', 'no_anggota' => 'A002', 'alamat' => 'Batu', 'no_hp' => '0813xxxx'],
        ['nama' => 'Citra Lestari', 'no_anggota' => 'A003', 'alamat' => 'Malang', 'no_hp' => '0814xxxx'],
        ['nama' => 'Dimas Pratama', 'no_anggota' => 'A004', 'alamat' => 'Kepanjen', 'no_hp' => '0815xxxx'],
        ['nama' => 'Rina Kartika', 'no_anggota' => 'A005', 'alamat' => 'Lawang', 'no_hp' => '0816xxxx'],
        ['nama' => 'Andi Wijaya', 'no_anggota' => 'A006', 'alamat' => 'Singosari', 'no_hp' => '0817xxxx'],
        ['nama' => 'Maya Putri', 'no_anggota' => 'A007', 'alamat' => 'Blitar', 'no_hp' => '0818xxxx'],
        ['nama' => 'Fajar Hidayat', 'no_anggota' => 'A008', 'alamat' => 'Kediri', 'no_hp' => '0819xxxx'],
    ];
}
$_SESSION['dipinjam'] = max((int) ($_SESSION['dipinjam'] ?? 0), 3);
$_SESSION['terlambat'] = max((int) ($_SESSION['terlambat'] ?? 0), 4);

$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
$totalDipinjam = $_SESSION['dipinjam'];
$totalTerlambat = $_SESSION['terlambat'];
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
                <li><a href="index.php"><span class="nav-icon icon-home" aria-hidden="true"></span>Beranda</a></li>
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
            <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
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
        <footer><p>&copy; <?php echo date('Y'); ?> SIMPUS Mini</p></footer>
    </body>
    </html>