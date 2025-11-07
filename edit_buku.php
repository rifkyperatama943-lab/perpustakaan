<?php
require_once 'config.php';

// Pastikan ada parameter id
if (!isset($_GET['id'])) {
    die("Error: ID buku tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Ambil data buku dari database
$sql = "SELECT * FROM buku WHERE id_buku = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: Buku tidak ditemukan.");
}

$buku = $result->fetch_assoc();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok = (int) $_POST['stok'];

    $sql_update = "UPDATE buku SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, stok = ? WHERE id_buku = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("sssiii", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $id);

    if ($stmt_update->execute()) {
        echo "<script>
            alert('Data buku berhasil diperbarui!');
            window.location='buku.php';
        </script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal memperbarui data: " . $mysqli->error . "</div>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Data Buku</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" required
                       value="<?= htmlspecialchars($buku['judul']); ?>">
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required
                       value="<?= htmlspecialchars($buku['penulis']); ?>">
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" required
                       value="<?= htmlspecialchars($buku['penerbit']); ?>">
            </div>

            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required
                       value="<?= htmlspecialchars($buku['tahun_terbit']); ?>">
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required
                       value="<?= htmlspecialchars($buku['stok']); ?>">
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
