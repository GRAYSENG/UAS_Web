<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card col-md-6 mx-auto">
            <div class="card-header bg-primary text-white">
                <?= isset($data) ? 'Edit Barang' : 'Tambah Barang'; ?>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php if(isset($data)): ?>
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= isset($data) ? $data['nama_barang'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= isset($data) ? $data['harga'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= isset($data) ? $data['stok'] : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= isset($data) ? '../../barang/index' : '../barang/index'; ?>" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>