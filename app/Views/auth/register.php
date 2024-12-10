<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
        }

        a {
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrasi Pengguna</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="error-message">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/store'); ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="<?= old('name'); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email'); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="">Pilih Role</option>
                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= old('role') === 'user' ? 'selected' : '' ?>>User</option>
            </select>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="<?= base_url('auth/login'); ?>">Login di sini</a>.</p>
</div>

</body>
</html>
