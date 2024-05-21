<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view("Admin.index");
    }
    public function register()
    {
        return view("Admin.register");
    }

    public function login()
    {
        return view('Admin.login');
    }

    public function checklogin()
    {
        request()->validate([

            'email' => 'required|email|exists:users',
            'password' => 'required',

        ]);
        $data = request()->all('email', 'password');
        // dd($data);
        try {
            auth()->attempt($data);
            return redirect()->route('admin.index')->with('success','Đăng nhập thành công');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Đăng nhập thất bại');

        }
    }
    public function check_register(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $data = request()->all('email', 'name');
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        return redirect()->route('admin.login');
    }

    public function logout(){
        auth::logout();
        return redirect()->route('home.index');
    }
}
