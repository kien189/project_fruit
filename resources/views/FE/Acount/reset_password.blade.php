@extends('FE.master')
@section('main')
    <base href="/">
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
    <form action="" method="post">
        @csrf
        <div class="login-register-area mt-no-text mb-no-text">
            <div class="container container-default-2 custom-area">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                        <div class="login-register-wrapper">
                            <div class="section-content text-center mb-5">
                                <h2 class="title-4 mb-2">Tạo mật khẩu mới</h2>
                                <p class="desc-content">Vui lòng điền đầy đủ thông dưới đây.</p>
                            </div>
                            <form action="" method="post">
                                <div class="single-input-item mb-3">
                                    <input type="password" placeholder=" Nhập mật khẩu mới " name="password">
                                </div>
                                <div class="single-input-item mb-3">
                                    <input type="password" placeholder="Xác nhận mật khẩu" name="confirm_password">
                                </div>
                                <div class="single-input-item mb-3">
                                    <button class="btn obrien-button-2 primary-color">Gửi</button>
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
