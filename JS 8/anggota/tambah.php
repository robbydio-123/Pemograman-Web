<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
$isEdit = $editId !== null && $editId !== false;
if ($isEdit) {
    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
    $stmt->execute(['id' => $editId]);
    $anggotaEdit = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    $isEdit = !empty($anggotaEdit);
} else {
    $anggotaEdit = [];
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Anggota</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="<?php echo $isEdit ? 'proses_ubah.php' : 'proses_tambah.php'; ?>">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo (int) ($anggotaEdit['id'] ?? 0); ?>">
                <?php endif; ?>
                <p>
                    <label for="nama">Nama</label><br>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($anggotaEdit['nama'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </p>
                <p>
                    <label for="no_anggota">No. Anggota</label><br>
                    <input type="text" id="no_anggota" name="no_anggota" value="<?php echo htmlspecialchars($anggotaEdit['no_anggota'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </p>
                <p>
                    <label for="alamat">Alamat</label><br>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($anggotaEdit['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </p>
                <p>
                    <label for="no_hp">No. HP</label><br>
                    <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($anggotaEdit['no_hp'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </p>
                <p>
                    <button type="submit"><?php echo $isEdit ? 'Simpan Perubahan' : 'Simpan'; ?></button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>