<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
$page_title = "Daftar Buku";
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
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
            <h2><span class="stat-icon icon-book" aria-hidden="true"></span>Daftar Buku</h2>
            <p class="page-description">Kelola koleksi buku SIMPUS-Mini</p>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <input type="text" id="search-input" class="search-box" placeholder="Cari buku..." aria-label="Cari buku">

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
                        <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($buku['pengarang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo (int) $buku['tahun']; ?></td>
                            <td><?php echo (int) $buku['stok']; ?></td>
                            <td class="action-buttons">
                                <a class="action-edit" href="tambah.php?edit=<?php echo (int) $buku['id']; ?>">Edit</a>
                                <form method="post" action="proses_hapus.php" onsubmit="return confirm('Hapus buku ini?');">
                                    <input type="hidden" name="id" value="<?php echo (int) $buku['id']; ?>">
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