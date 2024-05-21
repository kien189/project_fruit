<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    // Khai báo các thuộc tính sẽ được thêm vào kết quả khi chuyển đổi đối tượng model thành dạng mảng hoặc JSON
    protected $appends = ['totalPrice'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'customer_id',
        'status',
        'note',
        'token'
    ];

    public function customers()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetails::class,  "order_id", "id");
    }

    public function getTotalPriceAttribute()
    {
        $tongGia = 0;

        foreach ($this->details as $item) {
            $tongGia += $item->price * $item->quantity;
        }

        return $tongGia;
    }
}
