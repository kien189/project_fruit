@extends('FE.master')
@section('main')
    {{-- Cho  <base href="/"> để không phải sửa giao diện --}}
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Login-Register</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Login-Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Login Area Start Here -->
    {{-- <form action="" method="post"> --}}
    {{-- <div class="form-group @error('name') has-error @enderror">
        <label for="exampleInputEmail1">Tên danh mục</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Giới thiệu" name="name">
        @error('name')
            <span class="help-block">{{ $message }}</span>
        @enderror
    </div> --}}
    <div class="login-register-area mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2">Tạo tài khoản</h2>
                            <p class="desc-content">Vui lòng đăng ký bằng cách sử dụng chi tiết tài khoản dưới đây.</p>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="single-input-item mb-3 @error('name') has-error @enderror">
                                <input type="text" placeholder=" Nhập tên " name="name">
                                @error('name')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="eamil" placeholder="Email" name="email">
                                @error('email')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Nhập mật khẩu " name="password">
                                @error('password')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Xác nhận mật khẩu " name="confirm_password">
                                @error('confirm_password')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            {{-- <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Đăng ký nhận bản tin
                                                của chúng tôi</label> --}}
                                            <a href="{{ route('home.login') }}">Bạn đã có tài khoản ?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item mb-3">
                                <button class="btn obrien-button-2 primary-color">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- Login Area End Here -->
    <!-- Support Area Start Here -->
    <div class="support-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <div class="support-wrapper d-flex">
                        <div class="support-content">
                            <h1 class="title">Need Help ?</h1>
                            <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                        </div>
                        <div class="support-button d-flex align-items-center">
                            <a class="obrien-button primary-btn" href="contact-us.html">Contact now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
