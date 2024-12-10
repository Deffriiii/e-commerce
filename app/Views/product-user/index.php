<?= $this->extend('pages/layout-user'); ?>
<?= $this->section('content') ?>

<h1>Produk Kami</h1>
<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="<?= base_url('uploads/' . $product['image']); ?>" class="card-img-top" alt="<?= $product['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name']; ?></h5>
                    <p class="card-text">Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
                    <form action="<?= base_url('cart/add'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <button type="submit" class="btn btn-success btn-block">Tambah ke Keranjang</button>
                        </form>
                    <a href="<?= base_url('product-user/detail/' . $product['id']); ?>" class="btn btn-secondary">Lihat Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
