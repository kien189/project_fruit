<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CustomerResetToken extends Model
{
    use HasFactory;

    protected $primaryKey = 'email'; // Đặt cột 'email' làm khóa chính

    protected $fillable = ['email', 'token', 'expires_at'];

    public function customers()
    {
        return $this->hasOne(Customers::class, 'email', 'email');
    }

    public function scopeCheckToken($query, $token)
    {
        return $query->where('token', $token)
            ->where('expires_at', '>', Carbon::now()) // Chỉ lấy token chưa hết hạn
            ->firstOrFail();
    }


    // public function isExpired()
    // {
    //     // Tạo một đối tượng Carbon đại diện cho thời gian hiện tại với múi giờ 'Asia/Ho_Chi_Minh'
    //     $now = Carbon::now('Asia/Ho_Chi_Minh');

    //     // Kiểm tra nếu $expires_at không phải là null
    //     if ($this->expires_at !== null) {
    //         // Chuyển đổi trường expires_at sang đối tượng Carbon nếu nó không phải là đối tượng Carbon
    //         $expires_at = $this->expires_at instanceof Carbon ? $this->expires_at : Carbon::parse($this->expires_at);

    //         // Thiết lập múi giờ của thời gian hết hạn của token thành 'Asia/Ho_Chi_Minh'
    //         $expires_at->setTimezone('Asia/Ho_Chi_Minh');

    //         // So sánh thời gian hiện tại với thời gian hết hạn của token
    //         return $now->greaterThan($expires_at);
    //     }

    //     // Trả về true nếu $expires_at là null
    //     return true;
    // }

    // public function isUsed()
    // {
    //     return !is_null($this->expires_at);
    // }

    // public function markAsUsed()
    // {
    //     $this->update(['expires_at' => now()]);
    // }
}
