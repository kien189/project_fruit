<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [ 'product_id', 'comment','customer_id'];

    public function Customers()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
        // Chỉ rõ khóa ngoại 'user_id' và tên của lớp User
    }
}
