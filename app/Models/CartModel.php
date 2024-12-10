<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity'];

    public function getCartItems($userId)
    {
        return $this->select('cart.id as cart_id, cart.product_id, cart.quantity, products.name as product_name, products.price as product_price, products.image as product_image')
            ->join('products', 'products.id = cart.product_id', 'left')
            ->where('cart.user_id', $userId)
            ->findAll();
    }   
}
