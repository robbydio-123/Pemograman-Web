<?php
session_start();
$page_title = "Daftar Anggota";
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
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['anggota'] ?? [];
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
        <li><a href="../buku/list.php"><span class="nav-icon icon-book" aria-hidden="true"></span>Daftar Buku</a></li>
        <li><a href="../buku/tambah.php"><span class="nav-icon icon-plus" aria-hidden="true"></span>Tambah Buku</a></li>
        <li><a href="list.php"><span class="nav-icon icon-users" aria-hidden="true"></span>Daftar Anggota</a></li>
        <li><a href="tambah.php"><span class="nav-icon icon-user-plus" aria-hidden="true"></span>Tambah Anggota</a></li>
    </ul></nav>
</header><main>
        <section>
            <h2>Daftar Anggota</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <label for="search-input">Cari Nama Anggota</label>
                <input type="text" id="search-input" placeholder="Ketik nama anggota...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No. Anggota</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarAnggota)): ?>
                    <tr>
                        <td colspan="5">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarAnggota as $index => $anggota): ?>
                        <tr>
                            <td><?php echo $anggota['no_anggota']; ?></td>
                            <td><?php echo $anggota['nama']; ?></td>
                            <td><?php echo $anggota['alamat']; ?></td>
                            <td><?php echo $anggota['no_hp']; ?></td>
                            <td class="action-buttons">
                                <a class="action-edit" href="tambah.php?edit=<?php echo $index; ?>">Edit</a>
                                <form method="post" action="proses_hapus.php" onsubmit="return confirm('Hapus anggota ini?');">
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