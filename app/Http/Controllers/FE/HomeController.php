<?php

namespace App\Http\Controllers\FE;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        // $carts = Cart::where('customer_id', auth('customers')->id())->get();
        // $products = Product::orderBy("id", "desc")->take(30)->get();
        // dd($carts);
        $feature_product = Product::inRandomOrder()->take(30)->get();
        // $feature_product = Product::inRandomOrder()->where('status',1)->take(30)->get();
        // $categories = Category::orderBy("id", "asc")->get();
        return view("FE.index", compact("feature_product"));
    }
    public function shop()
    {
        $products = Product::orderBy("id", "desc")->paginate(16);

        // dd($products);
        return view('FE.Shop.index', compact("products"));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Kiểm tra xem từ khóa tìm kiếm có tồn tại không
        if ($searchTerm) {
            $products = Product::where('name', 'LIKE', "%{$searchTerm}%")->get();
        } else {
            $products = collect(); // Khởi tạo một Collection rỗng nếu không có từ khóa tìm kiếm
        }

        return view('FE.Shop.search', compact('searchTerm', 'products'));
    }

    public function home_search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Kiểm tra xem từ khóa tìm kiếm có tồn tại không
        if ($searchTerm) {
            $products = Product::where('name', 'LIKE', "%{$searchTerm}%")->get();
        } else {
            $products = collect(); // Khởi tạo một Collection rỗng nếu không có từ khóa tìm kiếm
        }

        return view('FE.search', compact('searchTerm', 'products'));
    }
    public function detail($slug, Request $request)
    {
        // Tìm sản phẩm bằng slug
        $product = Product::where("slug", $slug)->firstOrFail();
        $mayalsolike = Product::inRandomOrder()->take(30)->get();
        // dd($mayalsolike);
        // $comments= Comment::where("product_id",$product->id)->orderBy('id','desc')->get()->paginate(10);
        $comments = Comment::where("product_id", $product->id)->orderBy('id', 'desc')->paginate(3);
        $related = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->with('variants')->limit(12)->get();
        // dd($related);
        //Lấy sản phẩm cùng danh mục
        // Lấy kích thước mặc định từ form
        $defaultSize = 'Nhỏ';
        // Lấy biến thể tương ứng với kích thước mặc định
        $selectedVariant = $product->variants()->where('size', $defaultSize)->first();
        // dd($selectedVariant);
        // Nếu người dùng chọn kích thước mới, cập nhật biến thể cho kích thước mới
        if ($request->filled('size')) {
            $selectedSize = $request->input('size');
            $selectedVariant = $product->variants()->where('size', $selectedSize)->first();
        }
        // Truyền dữ liệu tới view
        return view('FE.product_detail', compact('product', 'selectedVariant','comments','related','mayalsolike'));
    }


    // public function updatePrice($slug, Request $request)
    // {
    //     dd($request->all());
    //     // Tìm sản phẩm bằng slug
    //     $product = Product::where("slug", $slug)->firstOrFail();

    //     // Thiết lập kích thước mặc định nếu không có kích thước được chọn
    //     $defaultSize = 'M'; // Thay đổi kích thước mặc định tùy theo yêu cầu

    //     // Lấy biến thể tương ứng với kích thước mặc định
    //     $selectedVariant = $product->variants()->where('size', $defaultSize)->first();
    //     dd($selectedVariant);
    //     // Truyền dữ liệu tới view
    //     return view('FE.product_detail', compact('product', 'selectedVariant'));
    // }
    public function homeCate(Category $category)
    {
        $products = $category->products()->paginate(9);
        return view('FE.Shop.about', compact('category', 'products'));
    }

    public function favorite(Product $product)
    {
        try {
            $user_id = auth('customers')->user()->id;
            $data = [
                'product_id' => $product->id,
                'customer_id' => $user_id
            ];
            $favorite = Favorite::where(['product_id' => $product->id, 'customer_id' => $user_id])->first();
            if ($favorite) {
                $favorite->delete();
                return redirect()->route('home.index')->with('success', 'Bạn đã bỏ yêu thích thành công ');
            }
            Favorite::create($data);
            return redirect()->back()->with('success', 'Thêm sản phẩm yêu thích thành công ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('success', 'Thêm sản phẩm yêu thích thành công ');
        }
    }

    // public function favoriteDestroy(Favorite $favorite, Product $product)
    // {
    //     try {
    //         $favorites = auth('customers')->user()->favorites->first();
    //         $favorites->delete();
    //         return redirect()->back()->with('success', 'Bạn đã bỏ yêu thích thành công ');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return redirect()->back()->with('error', 'Không thể xóa yêu thích.');
    //     }
    // }
}
