<?= $this->extend('pages/layout'); ?>

<?= $this->section('content'); ?>
<h1>Daftar Produk</h1>
<a href="<?= base_url('products/create'); ?>" class="btn btn-primary">Tambah Produk</a>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Stock</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['name']; ?></td>
                <td><?= $product['description']; ?></td>
                <td><?= $product['stock']; ?></td>
                <td>Rp <?= number_format($product['price'], 0, ',', '.'); ?></td> <!-- Format harga rupiah -->
                <td>
                    <?php if ($product['image']): ?>
                        <img src="/uploads/<?= $product['image']; ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('products/edit/' . $product['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('products/delete/' . $product['id']); ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection(); ?>
