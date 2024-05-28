<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $appends = ['favorite'];
    protected $fillable = ["name", "slug", "image", "category_id", "description", "status"];

    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
    //Mối liên hệ giữa danh mục và sản phẩm
    //dùng để lấy các thuộc tính của danh mục như tên ....vv
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($product) {
    //         // Xóa mềm tất cả các hình ảnh liên quan đến sản phẩm
    //         $product->images()->delete();
    //     });
    // }
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    //Mối quan hệ giữa sản phẩm và ảnh sản phẩm cho phép sản phẩm
    //lưu nhiều bản ghi vào ảnh sản phẩm

    public function getFavoriteAttribute()
    {
        $favorite = Favorite::where(["product_id" => $this->id, 'customer_id' => auth('customers')->id()])->first();
        return $favorite ? true : false;
    }
    // Phương thức getFavoriteAttribute được sử dụng để trả về giá trị thuộc tính 'favorite' cho mỗi đối tượng Product.
    // public function getFavoriteAttribute()
    // {
    //     // Truy vấn cơ sở dữ liệu để kiểm tra xem sản phẩm này có trong danh sách sản phẩm yêu thích của khách hàng hiện tại hay không.
    //     // Truy vấn này tìm kiếm bản ghi trong bảng Favorite, với điều kiện là product_id trùng với id của sản phẩm hiện tại và customer_id trùng với id của khách hàng hiện tại.
    //     $favorite = Favorite::where(["product_id" => $this->id, 'customer_id' => auth('customers')->id()])->first();
    //     // Kiểm tra xem có bản ghi yêu thích nào phù hợp với điều kiện tìm kiếm hay không.
    //     // Nếu có, $favorite sẽ chứa bản ghi đầu tiên, nếu không, $favorite sẽ là null.
    //     // Toán tử ba ngôi được sử dụng ở đây để trả về true nếu $favorite không null và false nếu nó là null.
    //     return $favorite ? true : false;
    // }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
