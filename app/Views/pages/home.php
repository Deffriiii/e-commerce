<?= $this->extend('pages/layout'); ?>

<?= $this->section('content'); ?>
<?php
// Data Dummy
$stats = [
    'users' => 3, // Jumlah total pengguna
    'transactions' => 5, // Jumlah total transaksi
    'products' => 4, // Jumlah total produk
    'pending_orders' => 0, // Pesanan yang belum selesai
];
?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Statistik E-Commerce</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Pengguna</h5>
                    <p class="card-text display-4"><?= $stats['users']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Transaksi</h5>
                    <p class="card-text display-4"><?= $stats['transactions']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box"></i> Produk</h5>
                    <p class="card-text display-4"><?= $stats['products']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-clock"></i> Pesanan Pending</h5>
                    <p class="card-text display-4"><?= $stats['pending_orders']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div
<?= $this->endSection(); ?>
