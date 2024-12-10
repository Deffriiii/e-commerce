<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Menampilkan semua produk
    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('products/index', $data);
    }

    public function productUser()
    {
        $data = [
            'title' => 'Produk User',
            'products' => $this->productModel->findAll(), // Ambil semua produk
        ];
        return view('product-user/index', $data); // Tampilkan ke view khusus user
    }


    // Form tambah produk
    public function create()
    {
        return view('products/create');
    }

    // Simpan data produk
    public function store()
    {
        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('uploads', $imageName);

            // Simpan data produk beserta stock dan price
            $this->productModel->save([
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'image' => $imageName,
                'stock' => $this->request->getPost('stock'),
                'price' => $this->request->getPost('price'),
            ]);
        }

        return redirect()->to('/products');
    }

    // Form edit produk
    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    // Update data produk
    public function update($id)
    {
        $file = $this->request->getFile('image');
        $product = $this->productModel->find($id);

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('uploads', $imageName);

            // Hapus gambar lama
            if ($product['image']) {
                unlink('uploads/' . $product['image']);
            }
        } else {
            $imageName = $product['image'];
        }

        // Update produk beserta stock dan price
        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'stock' => $this->request->getPost('stock'),
            'price' => $this->request->getPost('price'),
        ]);

        return redirect()->to('/products');
    }

    // Hapus produk
    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if ($product['image']) {
            unlink('uploads/' . $product['image']);
        }

        $this->productModel->delete($id);

        return redirect()->to('/products');
    }

    public function detail($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Produk',
            'product' => $product,
        ];

        return view('product-user/detail', $data);
    }

    
}
