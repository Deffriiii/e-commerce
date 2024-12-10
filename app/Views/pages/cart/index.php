<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h2 class="text-center">Keranjang Belanja</h2>

    <?php if (empty($cartItems)): ?>
        <p class="text-center">Keranjang Anda kosong. <a href="<?= base_url('products'); ?>">Belanja sekarang</a>.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $grandTotal = 0;
                foreach ($cartItems as $item): 
                    $totalPrice = $item['product_price'] * $item['quantity'];
                    $grandTotal += $totalPrice;
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><img src="/uploads/<?= $item['product_image']; ?>" alt="<?= $item['product_name']; ?>" width="100"></td>
                    <td><?= $item['product_name']; ?></td>
                    <td>Rp <?= number_format($item['product_price'], 0, ',', '.'); ?></td>
                    <td>
                        <!-- Form untuk mengedit jumlah -->
                        <form action="<?= base_url('cart/update'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" class="form-control" style="width: 60px;">
                            <button type="submit" class="btn btn-warning btn-sm mt-2">Update</button>
                        </form>
                    </td>
                    <td>Rp <?= number_format($totalPrice, 0, ',', '.'); ?></td>
                    <td>
                        <!-- Form untuk menghapus item -->
                        <form action="<?= base_url('cart/delete'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="text-end"><strong>Total Keseluruhan:</strong></td>
                    <td colspan="2"><strong>Rp <?= number_format($grandTotal, 0, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="<?= base_url('checkout'); ?>" class="btn btn-primary">Lanjut ke Checkout</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
