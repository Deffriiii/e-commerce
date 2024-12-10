<?php

namespace App\Controllers;

use App\Models\ProductModel; // Pastikan model produk di-load

class HomeUser extends BaseController
{
    public function index() 
    {
        // Data statistik untuk dashboard
        $stats = [
            'users' => 1200,
            'transactions' => 340,
            'products' => 150,
            'pending_orders' => 25,
        ];

        // Mengambil data produk dari database
        $productModel = new ProductModel();
        $products = $productModel->findAll(); // Mendapatkan semua produk

        // Mengembalikan tampilan halaman home-user dengan statistik dan produk
        return view('pages/home-user', [
            'stats' => $stats,
            'products' => $products, // Menyediakan data produk ke view
        ]);
    }
}
