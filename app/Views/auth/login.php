<?= $this->extend('pages/layout'); ?>

<?= $this->section('content') ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <!-- Flash messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <h3 class="text-center mb-4">Login</h3>
            
            <form action="<?= base_url('auth/authenticate'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            
            <p class="mt-3 text-center">Belum punya akun? <a href="<?= base_url('auth/register'); ?>">Register</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
