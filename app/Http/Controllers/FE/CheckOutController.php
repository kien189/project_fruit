<?php

namespace App\Http\Controllers\FE;

use App\Mail\OderMail;
use App\Models\Cart;
use App\Models\Oder;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order_details;
use App\Models\orders;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    public function checkout()
    {
        $customers = auth('customers')->user();
        $cart = Cart::where('customer_id', auth('customers')->id())->get();

        return view('FE.Cart.checkout', compact('customers', 'cart'));
    }

    public function post_checkout(Request $request)
    {
        $customers = auth('customers')->user();
        $data  = $request->only(
            'name',
            'email',
            'phone',
            'address',
            'customer_id',
            'statu'
        );
        $data['customer_id'] = $customers->id;


        if ($order = orders::create($data)) {
            $token = Str::random(40);
            foreach ($customers->carts as $cart) {
                $data1 = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity
                ];
                OrderDetails::create($data1);
            }
            // $customers->carts->delete();
            foreach ($customers->carts as $cart) {
                $cart->delete();
            }
            $order->token = $token;
            $order->save();
            //Gửi mail xác nhận
            Mail::to($customers->email)->send(new OderMail($order, $token));
            return redirect()->route('home.index')->with('success', 'Đặt hàng thành công');
        } else {
            return redirect()->route('home.index')->with('error', 'Đặt hàng không thành công');
        }
    }

    public function verify($token)
    {
        $order = orders::where('token', $token)->first();
        if ($order) {
            $order->token = null;
            $order->status = 1;
            $order->save();
            return redirect()->route('home.index')->with('success', 'Xác nhận đơn hàng thành công');
        } else {
            return abort(404);
        }
    }


    public function history()
    {
        $items = auth('customers')->user();
        return view('FE.Acount.profile', compact('items'));
    }


    public function detail(orders $order){
        // $detail = OrderDetails::where('order_id',$order->id)->get();
        // dd($detail);
        $items = auth('customers')->user();
        return view('FE.Cart.detail_order',compact('order','items'));
    }
}
