<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\ProductModel;

class CheckoutController extends BaseController
{
    protected $orderModel;
    protected $cartModel;
    protected $productModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();  // Menambahkan model produk
    }

    public function index()
    {
        $userId = session()->get('id');
        
        if (!$userId) {
            return redirect()->to('auth/login');  // Redirect ke login jika session tidak ada
        }

        $cartItems = $this->cartModel->getCartItems($userId);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }

        return view('pages/checkout/index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function process()
    {
        $userId = session()->get('id'); // Ambil user ID dari session
        
        if (!$userId) {
            return redirect()->to('auth/login');  // Jika user tidak ada di session, arahkan ke login
        }

        $cartItems = $this->cartModel->getCartItems($userId); // Dapatkan item dari keranjang

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Validasi setiap item dan proses pemesanan
        foreach ($cartItems as $item) {
            if (!isset($item['product_id'], $item['product_price'], $item['quantity'])) {
                return redirect()->back()->with('error', 'Data produk tidak valid.');
            }

            // Proses menyimpan data order
            $orderData = [
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['product_price'] * $item['quantity'],
                'status' => 'pending',
            ];

            if (!$this->orderModel->save($orderData)) {
                return redirect()->back()->with('error', 'Gagal menyimpan pesanan.');
            }

            // Update stok produk
            try {
                $this->updateProductStock($item['product_id'], $item['quantity']);
            } catch (\RuntimeException $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        // Hapus semua item dari keranjang setelah checkout
        $this->cartModel->where('user_id', $userId)->delete();

        return redirect()->to('orders')->with('success', 'Checkout berhasil.');
    }

    // Fungsi untuk memperbarui stok produk
    private function updateProductStock($productId, $quantity)
    {
        $product = $this->productModel->find($productId);

        if (!$product) {
            throw new \RuntimeException("Produk tidak ditemukan.");
        }

        if ($product['stock'] >= $quantity) {
            // Mengurangi stok produk
            $this->productModel->update($productId, [
                'stock' => $product['stock'] - $quantity,
            ]);
        } else {
            throw new \RuntimeException("Stok produk tidak mencukupi untuk produk ID: $productId");
        }
    }

    public function processPayment($orderId)
{
    $order = $this->orderModel->find($orderId);

    if ($order && $order['status'] === 'completed') {
        $paymentHistoryModel = new \App\Models\PaymentHistoryModel();

        // Misalnya pembayaran berhasil dengan metode transfer bank
        $paymentHistoryModel->recordPayment(
            $orderId,
            $order['total_price'], // Amount sesuai dengan total harga pesanan
            'Transfer Bank', // Metode pembayaran
            'completed' // Status pembayaran
        );

        return redirect()->to('orders')->with('success', 'Pembayaran berhasil dan tercatat.');
    }

    return redirect()->to('orders')->with('error', 'Pesanan tidak ditemukan atau sudah dibayar.');
}

}
