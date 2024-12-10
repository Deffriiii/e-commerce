<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentHistoryModel extends Model
{
    protected $table = 'payment_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'amount', 'payment_date', 'payment_method', 'status'];

    // Fungsi untuk mencatat pembayaran
    public function recordPayment($orderId, $amount, $paymentMethod, $status)
    {
        return $this->save([
            'order_id' => $orderId,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'status' => $status,
        ]);
    }
}
