<?= $this->extend('pages/layout-user'); ?>
<?= $this->section('content') ?>

<div class="card">
    <img src="<?= base_url('uploads/' . $product['image']); ?>" class="card-img-top" alt="<?= $product['name']; ?>">
    <div class="card-body">
        <h5 class="card-title"><?= $product['name']; ?></h5>
        <p class="card-text"><?= $product['description']; ?></p>
        <p class="card-text">Stok: <?= $product['stock']; ?></p>
        <p class="card-text">Harga: Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
        <a href="<?= base_url('cart/add/' . $product['id']); ?>" class="btn btn-primary">Tambah ke Keranjang</a>
        <a href="<?= base_url('checkout'); ?>" class="btn btn-success">Checkout</a>
    </div>
</div>

<?= $this->endSection() ?>
