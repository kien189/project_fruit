<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login_Register\LoginRequest;
use App\Http\Requests\Login_Register\RegisterRequest;
use App\Mail\VerifyAccount;
use App\Models\Customers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ChangePasswordConfirmation;
use App\Mail\ForgotPasswordConfirm;
use App\Models\CustomerResetToken;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    // public function login(Request $request)
    // {
    //     return view('FE.login');
    // }
    // public function Post_login(Request $request)
    // {

    //     try {
    //         if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //             return redirect()->route('home.index');
    //         } else {
    //             $error = 'Đăng nhập thất bại';
    //             return redirect()->back()->with('error', $error);
    //         }
    //     } catch (\Exception $e) {
    //         dd($e->getMessage()); // In ra thông báo lỗi để xem có vấn đề gì xảy ra
    //         return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đăng nhập.');
    //     }
    // }
    // public function register(Request $request)
    // {
    //     return view('FE.register');
    // }
    // public function Post_register(Request $request)
    // {
    //     $request->merge(['password' => Hash::make($request->password)]);
    //     // dd($request->all());
    //     try {
    //         Customers::create($request->all());
    //         return redirect()->route('home.login')->with('success', 'Tạo tài khoản thành công');
    //     } catch (\Throwable $th) {
    //         dd($th->getMessage());
    //         return back()->with('error', 'Tạo tài khoản thất bại');
    //     }
    // }

    public function index()
    {
        $users = Customers::all();
        return view('Admin.User.list', compact('users'));
    }

    public function logout()
    {
        auth('customers')->logout(); // Đăng xuất khỏi guard 'customers'
        return redirect()->back();
    }

    public function login(Request $request)
    {
        return view('FE.login');
    }
    public function Post_login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|exists:customers,email',
            'password' => 'required'
        ]);
        try {
            $customers = $request->only('email', 'password');
            $check = auth('customers')->attempt($customers);
            if ($check) {
                if (auth('customers')->user()->email_verified_at == '') {
                    auth('customers')->logout();
                    return redirect()->back()->with('error', 'Tài khoản chưa xác thực, vui lòng kiểm tra hộp thư của bạn .');
                }
                return redirect()->route('home.index')->with('susscess', 'Chào mừng bạn trở lại.');
            }

            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng ');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function register(Request $request)
    {
        return view('FE.register');
    }
    public function Post_register(RegisterRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|min:6|max|100',
        //     'email' => 'required|email|min:6|max|100|unique|customers',
        //     'password' => 'required|min:4',
        //     'confirm_password' => 'required|same:password'
        // ], [
        //     'name.required' => 'Họ tên không được để trống ',
        //     'name.min' => 'Họ tên tối thiểu là 6 ký tự  '
        // ]);

        try {
            $customers = $request->only('name', 'email', 'passoword');
            $customers['password'] = bcrypt($request->password);

            if ($acc = Customers::create($customers)) {
                Mail::to($acc->email)->send(new VerifyAccount($acc));
                return redirect()->route('home.login')->with('success', 'Đăng ký thành công , Vui lòng kiểm tra hộp thư của bạn ');
            };
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi sảy ra , vui lòng đăng ký lại ');
        }
    }
    public function verify($email)
    {
        $acc = Customers::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        // dd($acc);
        Customers::where('email', $email)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
        return redirect()->route('home.login')->with('success', 'Xác thực tài khoản thành công , Vui lòng đăng nhập ');
    }
    public function profile(Request $request)
    {
        $items = auth('customers')->user();
        return view('FE.Acount.profile', compact('items'));
    }
    public function Post_profile(Customers $customers, Request $request)
    {
        // $auth = auth('customers')->user();
        // $customers = $request->only('name','email','phone','address','gender');
        // // dd($customers);
        // $check = Customers::where('email', $auth->email)->update($customers);
        // // dd($request->all());

        try {
            $auth = auth('customers')->user();
            $data = $request->only('name', 'email', 'phone', 'address', 'gender');
            Customers::where('email', $auth->email)->update($data);
            return redirect()->route('home.profile')->with('success', 'Xác thực tài khoản thành công , Vui lòng đăng nhập ');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect()->back()->with('success', 'Xác thực tài khoản thành công , Vui lòng đăng nhập ');
        }
    }
    public function change_password(Request $request)
    {
        $items = auth('customers')->user();
        return view('FE.Acount.change_password', compact('items'));
    }
    // public function Post_change_password(Request $request)
    // {
    //     $items = auth('customers')->user();
    //     $request->validate([
    //         'current_password' => ['required', function ($attr, $value, $fail) use ($items) {

    //             if (!Hash::check($value, $items->password)) {
    //                 $fail('Mật khẩu không đúng !');
    //             };
    //         }],
    //         'new_password' => 'required|string|min:6|different:current_password',
    //         'confirm_password' => 'required|same:new_password',
    //     ]);

    //     $data['password'] = bcrypt($request->new_password);

    //     if ($items->update($data)) {
    //         //Gửi email xác nhận thay đổi mật khẩu
    //         auth('customers')->logout();
    //         return redirect()->route('home.login')->with('success','Thay đổi mật khẩu thành công');
    //     }
    //     return redirect()->back()->with('error','Thay đổi mật khẩu thất bại');
    // }
    public function Post_change_password(Request $request)
    {
        $user = auth('customers')->user();

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Mật khẩu không đúng!');
                }
            }],
            'new_password' => 'required|string|min:6|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $data['password'] = bcrypt($request->new_password);

        // Cập nhật mật khẩu mới cho người dùng
        if ($user->update($data)) {
            // Gửi email xác nhận thay đổi mật khẩu
            Mail::to($user->email)->send(new ChangePasswordConfirmation($user));

            // Đăng xuất người dùng sau khi thay đổi mật khẩu thành công
            auth('customers')->logout();

            return redirect()->route('home.login')->with('success', 'Thay đổi mật khẩu thành công');
        }

        return redirect()->back()->with('error', 'Thay đổi mật khẩu thất bại');
    }
    public function forgot_password(Request $request)
    {
        return view('FE.Acount.forgot_password');
    }
    // public function Post_forgot_password(Request $request)
    // {

    //     $request->validate([
    //         'email' => 'required|exists:customers'
    //     ]);
    //     // dd($request->all());
    //     $customers = Customers::where('email', $request->email)->first();
    //     $token = str::random(40);
    //     $tokenData = [
    //         'email' => $request->email,
    //         'token' => $token
    //     ];
    //     // dd($tokenData);
    //     if (CustomerResetToken::create($tokenData)) {
    //         Mail::to($request->email)->send(new ForgotPasswordConfirm($customers, $token));
    //         return redirect()->back()->with('success', 'Chúng tôi đã gửi mail đến bạn , Vui lòng check email');
    //     }
    //     // dd( $th->getMessage());
    // }

    // }
    // public function Post_forgot_password(Request $request)
    // {
    //     $now = Carbon::now('Asia/Ho_Chi_Minh');

    //     // $request->validate([
    //     //     'email' => 'required|exists:customers'
    //     // ]);

    //     $customer = Customers::where('email', $request->email)->first();

    //     $resetToken = CustomerResetToken::where('email', $request->email)->first();

    //     if ($resetToken && !$resetToken->isExpired()) {
    //         // Nếu token cũng như thời gian hết hạn của nó vẫn còn hiệu lực, sử dụng lại token đó
    //         $token = $resetToken->token;
    //     } else {
    //         // Tạo một token mới
    //         $token = Str::random(40);
    //         CustomerResetToken::where('email', $request->email)->updateOrCreate(
    //             ['email' => $request->email], // Điều kiện WHERE
    //             ['token' => $token, 'expires_at' => $now->addMinutes(15)] // Dữ liệu cần cập nhật hoặc tạo mới
    //         );
    //     }

    //     Mail::to($request->email)->send(new ForgotPasswordConfirm($customer, $token));

    //     return redirect()->back()->with('success', 'Chúng tôi đã gửi mail đến bạn. Vui lòng kiểm tra email để đặt lại mật khẩu.');
    // }

    public function Post_forgot_password(Request $request)
    {
        // Lấy thời gian hiện tại
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        $request->validate([
            'email' => 'required|email|exists:customers' // Xác minh email hợp lệ và tồn tại
        ]);

        // Tạo token ngẫu nhiên, bảo mật
        $token = Str::random(40);

        // Tính thời gian hết hạn là 2 phút sau thời điểm hiện tại
        $expiresAt = $now->addMinutes(2);

        // In ra thời gian hết hạn để kiểm tra
        // dd('Thời gian hết hạn của token: ' . $expiresAt->toDateTimeString());

        // Sử dụng updateOrCreate để xử lý hiệu quả việc tạo hoặc cập nhật token
        $tokenData = CustomerResetToken::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'token' => $token,
                'expires_at' => $expiresAt, // Sử dụng thời gian hết hạn tính toán
            ]
        );

        // Gửi email đặt lại mật khẩu sử dụng lớp ForgotPasswordConfirm
        Mail::to($request->email)->send(new ForgotPasswordConfirm($tokenData->customers, $token));

        return redirect()->back()->with('success', 'Chúng tôi đã gửi mail đến bạn. Vui lòng kiểm tra email để đặt lại mật khẩu.');
    }



    public function reset_password(Request $request, $token)
    {

        $tokenData = CustomerResetToken::CheckToken($token);

        return view("FE.Acount.reset_password");
    }
    public function Post_reset_password(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:4',
            'confirm_password' => 'required|min:4|same:password'
        ]);
        $data = [
            'password' => bcrypt($request->password),
        ];
        // dd($data);
        $tokenData = CustomerResetToken::CheckToken($token);

        // $customers = Customers::where('email',$tokenData->email)->firstOrFail();
        $customers = $tokenData->customers;
        // dd($customers);
        // dd($tokenData);
        $data = [
            'password' => bcrypt($request->password),
        ];
        $check = $customers->update($data);
        if ($check) {
            return redirect()->route('home.login')->with('success', 'Thay đổi mật khẩu thành công ');
        }
        return redirect()->back()->with('error', 'Có lỗi xảy ra  , vui lòng thao tác lại');
    }


    public function favorite()
    {
        $favorites = auth('customers')->user()->favorites;

        // dd($favorites);

        return view('FE.Acount.Favorite', compact('favorites'));
    }
    public function favoriteDestroy(Favorite $favorite, Product $product)
    {
        try {
            $favorites = auth('customers')->user()->favorites->first();
            $favorites->delete();
            return redirect()->back()->with('success', 'Bạn đã bỏ yêu thích thành công ');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Không thể xóa yêu thích.');
        }
    }
}
