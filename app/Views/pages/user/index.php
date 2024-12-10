<?= $this->include('pages/layout') ?>

<div class="container mt-5">
    <h1>Manajemen Pengguna</h1>
    <a href="<?= base_url('manajemen_pengguna/create') ?>" class="btn btn-primary mb-3">Tambah Pengguna</a>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <a href="<?= base_url('manajemen_pengguna/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('manajemen_pengguna/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
