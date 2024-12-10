<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        // Ambil data profil berdasarkan session
        $userModel = new UserModel();
        $user = $userModel->where('email', session()->get('email'))->first();

        // Tampilkan profil
        return view('profile/index', ['user' => $user]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('id'); // Mengambil ID dari session (ID pengguna yang sedang login)
    
        // Ambil data pengguna yang akan diperbarui
        $user = $userModel->find($userId);
    
        if (!$user) {
            return redirect()->to('/profile')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Validasi input
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[50]',
            'password' => 'permit_empty|min_length[6]',
            'confirm_password' => 'permit_empty|matches[password]',
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Persiapkan data yang akan diperbarui
        $data = [
            'name' => $this->request->getPost('name'),
        ];
    
        // Jika password diubah, hash password baru dan simpan
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }
    
        // Update data pengguna berdasarkan ID
        $userModel->update($userId, $data);
    
        // Pesan sukses
        session()->setFlashdata('success', 'Profil berhasil diperbarui.');
    
        return redirect()->to('/profile');
    }    
}
