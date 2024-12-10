<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5 text-center">
    <h1>Checkout Berhasil</h1>
    <p>Pesanan Anda sedang diproses. Terima kasih telah berbelanja di toko kami!</p>
    <a href="<?= base_url('/'); ?>" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>

<?= $this->endSection(); ?>
