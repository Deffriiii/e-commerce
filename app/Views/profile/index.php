<?= $this->extend('pages/layout'); ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Profil Pengguna</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Tampilkan Nama dan Email Pengguna -->
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <p><?= esc($user['name']); ?></p>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <p><?= esc($user['email']); ?></p>
    </div>

    <form action="<?= base_url('profile/update') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Form untuk Mengubah Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Baru</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $user['name']) ?>" required>
        </div>

        <!-- Form untuk Mengubah Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
<?= $this->endSection() ?>
