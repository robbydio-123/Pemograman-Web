<?php
session_start();
$editIndex = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
$isEdit = $editIndex !== null && $editIndex !== false && isset($_SESSION['anggota'][$editIndex]);
$page_title = $isEdit ? "Edit Anggota" : "Tambah Anggota";
$anggotaEdit = $isEdit ? $_SESSION['anggota'][$editIndex] : [];
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
        <li><a href="../buku/list.php"><span class="nav-icon icon-book" aria-hidden="true"></span>Daftar Buku</a></li>
        <li><a href="../buku/tambah.php"><span class="nav-icon icon-plus" aria-hidden="true"></span>Tambah Buku</a></li>
        <li><a href="list.php"><span class="nav-icon icon-users" aria-hidden="true"></span>Daftar Anggota</a></li>
        <li><a href="tambah.php"><span class="nav-icon icon-user-plus" aria-hidden="true"></span>Tambah Anggota</a></li>
    </ul></nav>
</header><main>
        <section>
            <h2><?php echo $isEdit ? 'Edit Anggota' : 'Tambah Anggota'; ?></h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="<?php echo $isEdit ? 'proses_ubah.php' : 'proses_tambah.php'; ?>">
                <?php if ($isEdit): ?><input type="hidden" name="index" value="<?php echo $editIndex; ?>"><?php endif; ?>
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
    </main><footer><p>&copy; <?php echo date('Y'); ?> SIMPUS Mini</p></footer>
    </body>
    </html>