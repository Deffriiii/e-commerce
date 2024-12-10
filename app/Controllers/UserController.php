<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('pages/user/index', $data);
    }

    public function create()
    {
        return view('pages/user/create');
    }

    public function store()
    {
        $this->userModel->save([
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
        ]);
        return redirect()->to('/manajemen_pengguna')->with('message', 'Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('pages/user/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }
        $this->userModel->update($id, $data);
        return redirect()->to('/manajemen_pengguna')->with('message', 'Pengguna berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/manajemen_pengguna')->with('message', 'Pengguna berhasil dihapus!');
    }
}
