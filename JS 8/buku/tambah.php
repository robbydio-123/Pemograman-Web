<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
$isEdit = $editId !== null && $editId !== false;
$page_title = $isEdit ? "Edit Buku" : "Tambah Buku";

$bukuEdit = [];
if ($isEdit) {
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
    $stmt->execute(['id' => $editId]);
    $bukuEdit = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    $isEdit = !empty($bukuEdit);
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
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
            <h2><?php echo $isEdit ? 'Edit Buku' : 'Tambah Buku'; ?></h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="<?php echo $isEdit ? 'proses_ubah.php' : 'proses_tambah.php'; ?>">
                <?php if ($isEdit): ?><input type="hidden" name="id" value="<?php echo (int) ($bukuEdit['id'] ?? 0); ?>"><?php endif; ?>
                <p>
                    <label for="judul">Judul</label><br>
                    <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($bukuEdit['judul'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </p>
                <p>
                    <label for="pengarang">Pengarang</label><br>
                    <input type="text" id="pengarang" name="pengarang" value="<?php echo htmlspecialchars($bukuEdit['pengarang'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </p>
                <p>
                    <label for="tahun">Tahun Terbit</label><br>
                    <input type="number" id="tahun" name="tahun" value="<?php echo htmlspecialchars((string) ($bukuEdit['tahun'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" min="1900" max="2026" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label><br>
                    <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($bukuEdit['isbn'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </p>
                <p>
                    <label for="stok">Stok</label><br>
                    <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars((string) ($bukuEdit['stok'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" min="0" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label><br>
                    <select id="kategori" name="kategori">
                        <option value="fiksi" <?php echo ($bukuEdit['kategori'] ?? '') === 'fiksi' ? 'selected' : ''; ?>>Fiksi</option>
                        <option value="non-fiksi" <?php echo ($bukuEdit['kategori'] ?? '') === 'non-fiksi' ? 'selected' : ''; ?>>Non-Fiksi</option>
                        <option value="referensi" <?php echo ($bukuEdit['kategori'] ?? '') === 'referensi' ? 'selected' : ''; ?>>Referensi</option>
                    </select>
                </p>
                <p>
                    <button type="submit"><?php echo $isEdit ? 'Simpan Perubahan' : 'Simpan'; ?></button>
                </p>
            </form>
        </section>
    </main><footer><p>&copy; <?php echo date('Y'); ?> SIMPUS Mini</p></footer>
    </body>
    </html>