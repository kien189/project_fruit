<?php

use App\Http\Controllers\FE\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Order\OderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FE\CartController;
use App\Http\Controllers\FE\CheckOutController;
use App\Http\Controllers\FE\CommenrController;
use App\Http\Controllers\FE\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('Admin.master');
// });


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home_search', [HomeController::class, 'home_search'])->name('home.search');
//Trang chu
//Chức năng lọc theo route

//Sản phẩm yêu thích
Route::get('favorite/{product}', [HomeController::class, 'favorite'])->name('home.favorite');

//Chức năng hiển thị danh sách sản phẩm
Route::group(['prefix' => 'shop'], function () {
    Route::get('/', [HomeController::class, 'shop'])->name('shop.index');
    Route::get('category/{category}', [HomeController::class, 'homeCate'])->name('shop.Cate');
    Route::get('/search', [HomeController::class, 'search'])->name('shop.search');
});
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resources([
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'user' => UserController::class,
    ]);
    Route::resource('shopping',OderController::class);
    //Chức năng xóa tạm thời _ khôi phục _ xóa hẳn trong danh mục
    Route::get('category_trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::get('category_trash/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('category_forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');
    //kết thúc chức năng
    //Chức năng xóa tạm thời _ khôi phục _ xóa hẳn trong sản phẩm
    Route::get('product_trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('product_trash/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('product_forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('product.forceDelete');
    //kết thúc chức năng

    //Xóa ảnh mô tả
    Route::get('product_delete_image/{image}', [ProductController::class, 'destroyImg'])->name('product.destroyImg');
});

// Chức năng đăng ký đăng nhập bên Admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'checklogin']);
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'check_register']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
// Chức năng bên fe

Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('home.detail');
Route::post('/detail/{slug}', [HomeController::class, 'detail'])->name('home.updatePrice');

Route::group(['prefix' => 'account'], function () {

    //Chức năng đăng ký đăng nhập
    Route::get('/login', [UserController::class, 'login'])->name('home.login');
    Route::get('/verify-account/{email}', [UserController::class, 'verify'])->name('account.verify');
    Route::get('/logout', [UserController::class, 'logout'])->name('home.logout');
    Route::post('/login', [UserController::class, 'Post_login']);

    //Chức năng đăng ký
    Route::get('/register', [UserController::class, 'register'])->name('home.register');
    Route::post('/register', [UserController::class, 'Post_register']);


    Route::group(['middleware' => 'customers'], function () {

        // Chức năng cập nhật thông tin người dùng
        Route::get('/profile', [UserController::class, 'profile'])->name('home.profile');
        Route::post('/profile', [UserController::class, 'Post_profile']);

        // Chức năng thay đổi mật khẩu
        Route::get('/change_password', [UserController::class, 'change_password'])->name('home.change_password');
        Route::post('/change_password', [UserController::class, 'Post_change_password'])->name('home.post_change_password');

        // Yêu thích sản phẩm
        Route::get('/favorite', [UserController::class, 'favorite'])->name('home.favoritis');
        Route::get('/favorite/{id}', [UserController::class, 'favoriteDestroy'])->name('favorite.destroy');
    });

    // Chức năng quên mật khẩu
    Route::get('/forgot_password', [UserController::class, 'forgot_password'])->name('home.forgot_password');
    Route::post('/forgot_password', [UserController::class, 'Post_forgot_password']);

    // Chức năng reset mật khẩu
    Route::get('/reset_password/{token}', [UserController::class, 'reset_password'])->name('home.reset_password');
    Route::post('/reset_password/{token}', [UserController::class, 'Post_reset_password']);
});

//Chức năng bình luận
Route::post('/comment/{product_id}', [CommenrController::class, 'comments'])->name('comments');

//Chức năng giỏ hàng

Route::group(['prefix' => 'cart', 'middleware' => 'customers'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/delete/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});
// chức năng check_out
Route::group(['prefix' => 'order', 'middleware' => 'customers'], function () {
    Route::get('/checkout', [CheckOutController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [CheckOutController::class, 'post_checkout']);
    Route::get('/detail/{order}', [CheckOutController::class, 'detail'])->name('order.detail');
    Route::get('/verify/{token}', [CheckOutController::class, 'verify'])->name('order.verify');
    Route::get('/history', [CheckOutController::class, 'history'])->name('order.history');
    //Lịch sử đơn hàng
});
