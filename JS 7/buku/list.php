<?php
session_start();
$page_title = "Daftar Buku";
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
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $_SESSION['buku'] ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?> - SIMPUS Mini</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body><header>
    <a class="brand" href="../index.php"><h1>SIMPUS Mini</h1></a>
    <input class="nav-toggle" type="checkbox" id="nav-toggle">
    <label class="nav-toggle-label" for="nav-toggle" aria-label="Buka menu"><span></span><span></span><span></span></label>
    <nav><ul>
        <li><a href="../index.php"><span class="nav-icon icon-home" aria-hidden="true"></span>Beranda</a></li>
        <li><a href="list.php"><span class="nav-icon icon-book" aria-hidden="true"></span>Daftar Buku</a></li>
        <li><a href="tambah.php"><span class="nav-icon icon-plus" aria-hidden="true"></span>Tambah Buku</a></li>
        <li><a href="../anggota/list.php"><span class="nav-icon icon-users" aria-hidden="true"></span>Daftar Anggota</a></li>
        <li><a href="../anggota/tambah.php"><span class="nav-icon icon-user-plus" aria-hidden="true"></span>Tambah Anggota</a></li>
    </ul></nav>
</header><main>
        <section>
            <h2>Daftar Buku</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <label for="search-input">Cari Judul Buku</label>
                <input type="text" id="search-input" placeholder="Ketik judul buku...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <td colspan="5">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBuku as $index => $buku): ?>
                        <tr>
                            <td><?php echo $buku['judul']; ?></td>
                            <td><?php echo $buku['pengarang']; ?></td>
                            <td><?php echo $buku['tahun']; ?></td>
                            <td><?php echo $buku['stok']; ?></td>
                            <td class="action-buttons">
                                <a class="action-edit" href="tambah.php?edit=<?php echo $index; ?>">Edit</a>
                                <form method="post" action="proses_hapus.php" onsubmit="return confirm('Hapus buku ini?');">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
    </main><footer><p>&copy; <?php echo date('Y'); ?> SIMPUS Mini</p></footer>
    </body>
    </html>