<?= $this->extend('pages/layout-user'); ?>

<?= $this->section('content'); ?>

<script>
   document.addEventListener('DOMContentLoaded', function () {
       const buttons = document.querySelectorAll('.btn-see-more');

       buttons.forEach(button => {
           button.addEventListener('click', function () {
               const cardBody = this.closest('.card-body');
               const shortDesc = cardBody.querySelector('.short-description');
               const fullDesc = cardBody.querySelector('.full-description');

               if (fullDesc.classList.contains('d-none')) {
                   fullDesc.classList.remove('d-none');
                   shortDesc.classList.add('d-none');
                   this.textContent = 'Lihat Lebih Sedikit';
               } else {
                   fullDesc.classList.add('d-none');
                   shortDesc.classList.remove('d-none');
                   this.textContent = 'Lihat Selengkapnya';
               }
           });
       });
   });
</script>

<div class="container mt-5">
    <!-- Banner Slider -->
    <div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Banner 1 -->
            <div class="carousel-item active position-relative">
                <img src="<?= base_url('assets/img/banner1.jpg'); ?>" class="d-block w-100" alt="Banner 1">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h1 class="text-white fw-bold">Selamat Datang di Toko Kami</h1>
                    <p class="text-white fs-5">Temukan produk terbaik untuk kebutuhan Anda</p>
                </div>
            </div>

            <!-- Banner 2 -->
            <div class="carousel-item position-relative">
                <img src="<?= base_url('assets/img/banner2.jpg'); ?>" class="d-block w-100" alt="Banner 2">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h1 class="text-white fw-bold">Selamat Datang di Toko Kami</h1>
                    <p class="text-white fs-5">Belanja mudah, aman, dan terpercaya</p>
                </div>
            </div>

            <!-- Banner 3 -->
            <div class="carousel-item position-relative">
                <img src="<?= base_url('assets/img/banner3.jpg'); ?>" class="d-block w-100" alt="Banner 3">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <h1 class="text-white fw-bold">Selamat Datang di Toko Kami</h1>
                    <p class="text-white fs-5">Nikmati penawaran spesial setiap hari</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Daftar Produk -->
<div class="container mt-5">
    <h2 class="text-center">Produk Kami</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-6 col-md-4 mb-4">
                <!-- col-6 untuk ponsel (2 produk per baris) dan col-md-4 untuk tablet (3 produk per baris) -->
                <div class="card shadow-lg">
                    <img src="/uploads/<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['name']; ?>">
                    <div class="card-body">
                    <h5 class="card-title"><?= $product['name']; ?></h5>
                    <p class="card-text short-description">
                        <?= substr($product['description'], 0, 100); ?>...
                    </p>
                    <p class="card-text full-description d-none">
                        <?= $product['description']; ?>
                    </p>
                    <button class="btn btn-link btn-see-more p-0">Lihat Selengkapnya</button>
                    <p class="text-success fw-bold">Rp <?= number_format($product['price'], 0, ',', '.'); ?></p>
                    <a href="<?= base_url('checkout'); ?>" class="btn btn-primary btn-block">Check Out</a>
                    <form action="<?= base_url('cart/add'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <button type="submit" class="btn btn-success btn-block">Tambah ke Keranjang</button>
                    </form>
                </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div>

<?= $this->endSection(); ?>
