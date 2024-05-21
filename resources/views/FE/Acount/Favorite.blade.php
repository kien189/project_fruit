@extends('FE.master')
@section('title', 'Trang sản phẩm yêu thích')
@section('main')
    <base href="/">
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Wishlist</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Wishlist main wrapper start -->
    <div class="wishlist-main-wrapper mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Wishlist Table Area -->
                    <div class="wishlist-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">STT</th>
                                    <th class="pro-thumbnail">Ảnh </th>
                                    <th class="pro-title">Tên sản phẩm</th>
                                    <th class="pro-price">Giá sản phẩm</th>
                                    <th class="pro-stock">Trạng thái </th>
                                    <th class="pro-cart">Thêm vào giỏ hàng</th>
                                    <th class="pro-remove">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favorites as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="pro-thumbnail"><a href="#"> <img
                                                    src="{{ asset('storage/images') }}/{{ $item->pro->image }}"
                                                    alt="Product" /></a></td>
                                        <td class="pro-title"><a href="#">{{ $item->pro->name }} <br> </a></td>
                                        <td class="pro-price"><span>{{ $item->pro->sale_price }}</span></td>
                                        <td class="pro-stock"><span><strong>In Stock</strong></span></td>
                                        <td class="pro-cart"><a href="{{route('cart.add',$item->pro->id)}}"
                                                class="btn obrien-button primary-btn text-uppercase">Add to Cart</a></td>

                                        <td class="pro-remove">
                                            <a onclick="return confirm('Bạn có muốn xóa sản phẩm yêu thích này không ?')"
                                                href="{{route('favorite.destroy',$item->id)}}">
                                                <i class="ion-trash-b"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist main wrapper end -->
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
