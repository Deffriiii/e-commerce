<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>

<h1>Daftar Pesanan</h1>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<!-- Tambahkan kelas Bootstrap pada tabel -->
<?php if (empty($orders)): ?>
    <div class="alert alert-warning" role="alert">
        <strong>Oops!</strong> Anda belum memiliki pesanan. Segera lakukan pembelian untuk melihat pesanan Anda di sini.
    </div>
<?php else: ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; // Inisialisasi variabel no dengan nilai 1
        foreach ($orders as $order): ?>
        <tr>
            <td><?= $no++; ?></td> <!-- Menampilkan nomor urut yang bertambah setiap iterasi -->
            <td><?= number_format($order['total_price'], 2); ?></td>
            <td><?= ucfirst($order['status']); ?></td>
            <td><?= $order['created_at']; ?></td>
            <td>
                <!-- Gabungkan aksi Selesaikan Pesanan dan Hapus dalam satu kolom -->
                <?php if ($order['status'] === 'completed'): ?>
                    <a href="<?= base_url('orders/payment-history/' . $order['id']); ?>" class="btn btn-info btn-sm">Lihat Riwayat Pembayaran</a>
                <?php else: ?>
                    <a href="<?= base_url('orders/complete/' . $order['id']); ?>" class="btn btn-success btn-sm">Selesaikan Pesanan</a>
                <?php endif; ?>

                <!-- Tombol Hapus Pesanan -->
                <form action="<?= base_url('orders/delete/' . $order['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');" class="d-inline-block">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= $this->endSection(); ?>
