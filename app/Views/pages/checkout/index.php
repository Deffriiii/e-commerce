<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <h2>Checkout</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= $item['product_name']; ?></td>
                    <td>Rp <?= number_format($item['product_price'], 0, ',', '.'); ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td>Rp <?= number_format($item['product_price'] * $item['quantity'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-end">
        <h4>Total: Rp <?= number_format($total, 0, ',', '.'); ?></h4>
        <form action="<?= base_url('checkout/process'); ?>" method="post">
            <?= csrf_field(); ?>
            <button type="submit" class="btn btn-success">Proses Checkout</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
