<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $user = $userModel->where('email', $email)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            // Simpan role dan status login di session
            session()->set([
                'isLoggedIn' => true,
                'role' => $user['role'],
                'email' => $user['email'],
                'id' => $user['id'], // Menyimpan ID pengguna di session
            ]);                       
    
            // Tambahkan pesan sukses
            session()->setFlashdata('success', 'Login berhasil!');
    
            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/user/dashboard');
            }
        }
    
        return redirect()->back()->with('error', 'Email atau Password salah');
    }
    

    public function register()
    {
        return view('auth/register');
    }

    public function store()
{
    $userModel = new UserModel();

    // Validasi input
    $validation = $this->validate([
        'name' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'confirm_password' => 'required|matches[password]',
        'role' => 'required|in_list[admin,user]', // Validasi role
    ]);

    if (!$validation) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Hash password sebelum menyimpan ke database
    $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

    // Simpan data user ke database
    $userModel->save([
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => $hashedPassword,
        'role' => $this->request->getPost('role'), // Menyimpan role yang dipilih
    ]);

    return redirect()->to('/auth/login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }


    public function logout()
    {
        // Hancurkan session
        session()->destroy();

        // Redirect ke halaman login dengan pesan sukses
        session()->setFlashdata('success', 'Anda telah berhasil logout');
        return redirect()->to('/auth/login');
    }


}
