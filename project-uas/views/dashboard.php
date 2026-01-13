<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Inventory System</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    Halo, <?= ucfirst($_SESSION['username']); ?> (<?= ucfirst($_SESSION['role']); ?>)
                </span>
                <a href="../auth/logout" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="create" class="btn btn-success">+ Tambah Barang</a>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <form action="" method="GET" class="d-flex">
                    <input type="text" name="keyword" class="form-control me-2" placeholder="Cari barang..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = $start + 1;
                    foreach($barang as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                        <td>
                            <a href="edit/<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete/<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?');">Hapus</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination">
                <?php for($i=1; $i<=$totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>&keyword=<?= $keyword; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</body>
</html>