<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\orders;

class CartController extends Controller
{
    public function index(orders $order)
    {
        $carts = Cart::where('customer_id', auth('customers')->id())->get();
        // dd($carts);
        return view("FE.Cart.index", compact("carts"));
    }

    public function add(Product $product, Request $request)
    {
        // Lấy số lượng sản phẩm từ request, nếu không có thì mặc định là 1
        $quantity = $request->quantity ? floor($request->quantity) : 1;

        // Lấy ID của khách hàng hiện tại
        $customers_id =  auth('customers')->id();

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của khách hàng chưa
        $cartExists = Cart::where([
            "product_id" => $product->id,
            "customer_id" => $customers_id
        ])->first();

        // Nếu sản phẩm đã tồn tại trong giỏ hàng của khách hàng
        if ($cartExists) {
            // Tăng số lượng sản phẩm trong giỏ hàng lên thêm $quantity
            Cart::where([
                "product_id" => $product->id,
                "customer_id" => $customers_id
            ])->increment("quantity", $quantity);

            // Chuyển hướng đến trang giỏ hàng với thông báo thành công
            return redirect()->route('cart.index')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công ');
        }
        // Nếu sản phẩm chưa tồn tại trong giỏ hàng của khách hàng
        else {
            // Tạo dữ liệu mới cho giỏ hàng
            $data = [
                "customer_id" => $customers_id,
                'product_id' => $product->id,
                // Lấy giá và kích thước của sản phẩm nếu có biến thể, ngược lại để trống
                'price' => $product->variants->isNotEmpty() ? $product->variants->first()->price : '',
                'quantity' => $quantity,
                'size' => $product->variants->isNotEmpty() ? $product->variants->first()->size : '',
            ];

            // Nếu tạo giỏ hàng thành công
            if (Cart::create($data)) {
                // Chuyển hướng đến trang giỏ hàng với thông báo thành công
                return redirect()->route('cart.index')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công ');
            }
        }

        // Nếu có lỗi xảy ra, hiển thị dữ liệu và thông báo lỗi
        dd($data);
        return redirect()->back()->with('error', 'Thêm sản phẩm vào giỏ hàng thất bại , Vui lòng thử lại');
    }

    public function update(Product $product, Request $request)
    {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $customers_id =  auth('customers')->id();
        $cartExists = Cart::where([
            "product_id" => $product->id,
            "customer_id" => $customers_id
        ])->first();
        if ($cartExists) {
            Cart::where([
                "product_id" => $product->id,
                "customer_id" => $customers_id
            ])->update([
                "quantity" => $quantity
            ]);
            return redirect()->route('cart.index')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công ');
        } else {
            $data = [
                "customer_id" => $customers_id,
                'product_id' => $product->id,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' =>   $quantity,
            ];
            if (Cart::create($data)) {
                return redirect()->route('cart.index')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công ');
            }
        }
    }
    public function delete(Product $product)
    {
        Cart::where([
            "product_id" => $product->id,
            "customer_id" => auth("customers")->id()
        ])->delete();
        return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công ');
    }
    public function clear()
    {
        Cart::where([
            "customer_id" => auth("customers")->id()
        ])->delete();
        return redirect()->route('cart.index')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công ');
    }
}
