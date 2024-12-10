<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>

<h1>Riwayat Pembayaran untuk Pesanan #<?= $order['id']; ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
            <th>Jumlah</th>
            <th>Tanggal Pembayaran</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($paymentHistory)): ?>
        <?php $no = 1; // Inisialisasi nomor urut ?>
        <?php foreach ($paymentHistory as $payment): ?>
        <tr>
            <td><?= $no++; ?></td> <!-- Menampilkan nomor urut yang bertambah -->
            <td><?= $payment['payment_method']; ?></td>
            <td><?= ucfirst($payment['status']); ?></td>
            <td>Rp <?= number_format($payment['amount'], 2, ',', '.'); ?></td>
            <td><?= $payment['payment_date']; ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Belum ada riwayat pembayaran untuk pesanan ini.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="<?= base_url('orders'); ?>" class="btn btn-primary">Kembali ke Daftar Pesanan</a>

<?= $this->endSection(); ?>
