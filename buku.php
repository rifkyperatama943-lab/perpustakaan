<?php
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-4">
      <h1 class="mb-4">Manajemen Data Buku</h1>
      <a href="tambah_buku.php" class="btn btn-primary mb-3">Tambah Buku</a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Penulis</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM buku ORDER BY id_buku DESC";
          $result = $mysqli->query($sql);
          $no = 1;
          while ($row = $result->fetch_assoc()) :
          ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['penulis']) ?></td>
            <td><?= htmlspecialchars($row['penerbit']) ?></td>
            <td><?= htmlspecialchars($row['tahun_terbit']) ?></td>
            <td><?= htmlspecialchars($row['stok']) ?></td>
            <td>
              <a href="edit_buku.php?id=<?= $row['id_buku'] ?>" class="btn btn-success btn-sm">Edit</a>
              <a href="hapus_buku.php?id=<?= $row['id_buku'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php
            $no++;
          endwhile;
          ?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
