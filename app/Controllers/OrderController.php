<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\PaymentHistoryModel;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $paymentHistoryModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->paymentHistoryModel = new PaymentHistoryModel();
    }

    // Menampilkan daftar pesanan
    public function index()
    {
        $userId = session()->get('id');  // Pastikan session ID pengguna ada
        if (!$userId) {
            return redirect()->to('login');  // Arahkan ke halaman login jika pengguna tidak terautentikasi
        }

        $orders = $this->orderModel->getOrdersByUserId($userId);

        if (empty($orders)) {
            return view('pages/orders/index', ['message' => 'Anda belum memiliki pesanan.']);
        }

        return view('pages/orders/index', ['orders' => $orders]);
    }

    // Fungsi untuk menyelesaikan pesanan
    public function complete($orderId)
    {
        $userId = session()->get('id');
        $order = $this->orderModel->find($orderId);

        if ($order && $order['user_id'] == $userId && $order['status'] == 'pending') {
            // Simpan riwayat pembayaran sebelum mengubah status
            $paymentHistoryData = [
                'order_id' => $orderId,
                'payment_method' => 'Transfer Bank', // Ganti dengan metode pembayaran yang sebenarnya
                'amount' => $order['total_price'],
                'status' => 'completed',
                'payment_date' => date('Y-m-d H:i:s')
            ];
            
            // Simpan riwayat pembayaran
            $this->paymentHistoryModel->save($paymentHistoryData);

            // Update status pesanan menjadi 'completed'
            $this->orderModel->update($orderId, ['status' => 'completed']);

            // Redirect dengan pesan sukses
            return redirect()->to('orders')->with('message', 'Pesanan selesai dan riwayat pembayaran telah dicatat.');
        }

        // Jika pesanan tidak ditemukan atau sudah selesai, beri pesan error
        return redirect()->to('orders')->with('message', 'Pesanan tidak ditemukan atau sudah selesai.');
    }

    // Menampilkan riwayat pembayaran
    public function paymentHistory($orderId)
    {
        $order = $this->orderModel->find($orderId);

        if (!$order) {
            return redirect()->to('orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ambil riwayat pembayaran berdasarkan order_id
        $paymentHistory = $this->paymentHistoryModel->where('order_id', $orderId)->findAll();

        return view('pages/orders/payment_history', [
            'order' => $order,
            'paymentHistory' => $paymentHistory
        ]);
    }

    // Menghapus pesanan
    public function deleteOrder($orderId)
    {
        $order = $this->orderModel->find($orderId);

        if (!$order) {
            return redirect()->to('orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Menghapus pesanan
        $this->orderModel->delete($orderId);

        // Redirect kembali ke daftar pesanan dengan pesan sukses
        return redirect()->to('orders')->with('message', 'Pesanan berhasil dihapus.');
    }
}
