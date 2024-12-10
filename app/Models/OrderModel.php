<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';  // Nama tabel pesanan
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'total_price', 'status', 'created_at', 'updated_at'];

    public function getOrdersByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();  // Pastikan data yang dikembalikan sesuai
    }
}
