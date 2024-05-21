@extends('FE.master')
@section('title', 'Lỗi ')
@section('main')
    <base href="/">
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Error 404</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Error 404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Error 404 Area Start Here -->
    <div class="error-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h1>404</h1>
                        <h2>Opps! KHÔNG TÌM THẤY TRANG</h2>
                        <p>Xin lỗi nhưng trang bạn đang tìm kiếm không tồn tại, đã bị <br>
                            xóa, thay đổi tên hoặc tạm thời không khả dụng.</p>
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <a href="{{route('home.index')}}">QUAY LẠI TRANG CHỦ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error 404 Area End Here -->
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
    <!-- Support Area End Here -->
@endsection
