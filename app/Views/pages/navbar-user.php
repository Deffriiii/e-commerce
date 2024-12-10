<!-- Navbar (User) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">E-Commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('home'); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('product-user'); ?>">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('cart'); ?>">Keranjang Belanja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('orders'); ?>">Pesanan Saya</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Akun
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('profile'); ?>">Profil</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmLogout()">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- JavaScript untuk konfirmasi logout -->
<script>
    function confirmLogout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            window.location.href = '<?= base_url('auth/logout'); ?>';
        }
    }
</script>
