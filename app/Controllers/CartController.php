<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $userId = session()->get('id');
        $cartItems = $this->cartModel->getCartItems($userId);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }

        return view('pages/cart/index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function add()
    {
        $userId = session()->get('id');
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;

        $existingItem = $this->cartModel->where('user_id', $userId)
                                        ->where('product_id', $productId)
                                        ->first();

        if ($existingItem) {
            $this->cartModel->update($existingItem['id'], [
                'quantity' => $existingItem['quantity'] + $quantity,
            ]);
        } else {
            $this->cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update()
    {
        // Ambil input dari form
    $cartId = $this->request->getPost('cart_id');
    $quantity = $this->request->getPost('quantity');

    // Validasi jumlah, pastikan lebih besar dari 0
    if ($quantity < 1) {
        return redirect()->back()->with('error', 'Jumlah produk tidak valid.');
    }

    // Update jumlah produk di keranjang
    $cartModel = new \App\Models\CartModel();
    $cartModel->update($cartId, ['quantity' => $quantity]);

    // Redirect kembali ke halaman keranjang belanja
    return redirect()->to('cart')->with('success', 'Jumlah produk telah diperbarui.');
    }

    public function delete()
    {
        $cartId = $this->request->getPost('cart_id');

        $this->cartModel->delete($cartId);

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
