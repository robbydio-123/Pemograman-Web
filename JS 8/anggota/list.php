<?php
session_start();
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
        <section>
            <h2><span class="stat-icon icon-users" aria-hidden="true"></span>Daftar Anggota</h2>
            <p class="page-description">Kelola data anggota perpustakaan SIMPUS-Mini</p>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <input type="text" id="search-input" class="search-box" placeholder="Cari anggota..." aria-label="Cari anggota">

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
                        <?php foreach ($daftarAnggota as $anggota): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($anggota['no_anggota'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($anggota['alamat'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($anggota['no_hp'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="action-buttons">
                                <a class="action-edit" href="tambah.php?edit=<?php echo (int) $anggota['id']; ?>">Edit</a>
                                <form method="post" action="proses_hapus.php" onsubmit="return confirm('Hapus anggota ini?');">
                                    <input type="hidden" name="id" value="<?php echo (int) $anggota['id']; ?>">
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
<?php include __DIR__ . '/../includes/footer.php'; ?>