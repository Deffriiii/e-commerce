<?= $this->extend('pages/layout-admin'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <h1>Edit Pengguna</h1>

    <form action="<?= base_url('manajemen_pengguna/update/' . $user['id']); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" id="role" required>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('manajemen_pengguna'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection(); ?>
