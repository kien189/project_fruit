<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $appends = ['totalPrice'];
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_id';
    protected $fillable = ['customer_id', 'product_id', 'price', 'quantity','size'];

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getTotalPriceAttribute()
    {
        // Lấy tất cả các mục trong giỏ hàng của khách hàng hiện đang đăng nhập
        $carts = Cart::where('customer_id', auth('customers')->id())->get();

        // Khởi tạo biến tổng tiền
        $totalPrice = 0;

        // Duyệt qua từng mục trong giỏ hàng và tính toán tổng tiền
        foreach ($carts as $cart) {
            $totalPrice += $cart->price * $cart->quantity;
        }

        // Trả về tổng tiền của đơn hàng
        return $totalPrice;
    }
}
