@extends('FE.master')
@section('main')
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Đăng nhập - Đăng ký </h3>
                        <ul>
                            <li><a href="index.html">Trang chủ</a></li>
                            <li>Đăng nhập-Đăng ký</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Login Area Start Here -->
    {{-- @if ($message = Session::get('error'))
        <div class="alert alert-danger  alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <script>
            alert('{{ $message }}');
        </script>
    @endif --}}

    <div class="login-register-area mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2">Đăng nhập </h2>
                            <p class="desc-content">Vui lòng đăng nhập bằng chi tiết tài khoản bên dưới.</p>
                        </div>
                        <form action="" method="post">
                            @csrf

                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="Nhập Email " name="email">
                                @error('email')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Nhập mật khẩu" name="password">
                                @error('password')
                                    <span class="text-danger  ">{{ $message }}</span>
                                @enderror
                                @if (Session::has('error'))
                                    <span class="text-danger">{{ Session::get('error') }}</span>
                                @endif
                            </div>
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Nhớ tôi</label>
                                        </div>
                                    </div>
                                    <a href="{{ route('home.forgot_password') }}" class="forget-pwd mb-3">Quên mật khẩu?</a>
                                </div>
                            </div>
                            <div class="single-input-item mb-3">
                                <button class="btn obrien-button-2 primary-color">Đăng nhập</button>
                            </div>
                            <div class="single-input-item">
                                <a href="{{ route('home.register') }}">Tạo tài khoản</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
