<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommenrController extends Controller
{
    public function comments($proID,Request $request){
        // dd($request->all());
        $comment = request()->all('comment');
        $comment['product_id'] = $proID;
        $comment['customer_id'] = Auth::guard('customers')->id();;
        if(Comment::create( $comment )){
            return redirect()->back()->with('success','Bình luận thành công');
        }else{
            return redirect()->back()->with('error','Bình luận thất bại');
        }
    }
    // public function comments($proID, Request $request)
    // {
    //     // Kiểm tra xem người dùng đã đăng nhập hay chưa
    //     if (Auth::guard('customers')->check()) {
    //         // Lấy id của người dùng đã đăng nhập qua guard 'customers'
    //         $customer_id = Auth::guard('customers')->id();

    //         // Lấy tất cả dữ liệu được gửi trong request
    //         $requestData = $request->all();

    //         // Tạo một mảng chứa dữ liệu bình luận
    //         $commentData = [
    //             'product_id' => $proID,
    //             'customer_id' => $customer_id,
    //             'comment' => $requestData['comment'] // Lấy giá trị của trường 'comment' từ request
    //         ];

    //         // Tạo một bình luận mới và lưu vào cơ sở dữ liệu
    //         $comment = Comment::create($commentData);

    //         if ($comment) {
    //             return redirect()->back()->with('success', 'Bình luận thành công');
    //         } else {
    //             return redirect()->back()->with('error', 'Bình luận thất bại');
    //         }
    //     } else {
    //         // Nếu người dùng chưa đăng nhập, chuyển hướng trở lại với thông báo lỗi
    //         return redirect()->back()->with('error', 'Bạn cần đăng nhập để bình luận');
    //     }
    // }
}
