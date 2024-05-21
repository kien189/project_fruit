@extends('FE.master')

@section('title', 'Trang giỏ hàng')
@section('main')
    <base href="/">
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">Shopping Cart</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                    src="{{ asset('storage/images/' . $item->products->image) }}"
                                                    alt="Product" /></a></td>
                                        <td class="pro-title"><a href="#">{{ $item->products->name }}<br> </a></td>
                                        <td class="pro-price"><span>{{ number_format($item->products->sale_price) }}
                                                VND</span></td>
                                        <td class="pro-quantity">
                                            <form action="{{ route('cart.update', $item->product_id) }}" method="get">
                                                <div class="quantity d-flex  align-items-center ">
                                                    <div class="cart-plus-minus me-3">
                                                        <input class="cart-plus-minus-box" value="{{ $item->quantity }}"
                                                            type="text" name="quantity">
                                                        <div class="dec qtybutton">-</div>
                                                        <div class="inc qtybutton">+</div>
                                                        <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                    </div>

                                                    <div class="border p-2">
                                                        <button><i class="fa-solid fa-file-pen"></i> Update</button>
                                                    </div>
                                            </form>
                    </div>
                    </td>
                    <td class="pro-subtotal">
                        <span>{{ number_format($item->quantity * $item->products->sale_price) }}VND</span>
                    </td>
                    <td class="pro-remove"><a href="{{ route('cart.delete', $item->product_id) }}"
                            onclick="return confirm('Bạn có muốn xóa sản phẩm khỏi giỏ hàng không ?')"><i
                                class="ion-trash-b"></i></a></td>
                    </tr>
                    @endforeach


                    </tbody>
                    </table>
                </div>
                @if ($carts->count())
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class=" d-block d-md-flex">
                                <input type="text" placeholder="Enter Your Coupon Code" required />
                                <button class="btn obrien-button primary-btn">Apply Coupon</button>
                            </form>
                        </div>
                        <div class="cart-update mt-sm-16">
                            <a onclick="return confirm('Bạn có muốn xóa hết sản phẩm khỏi giỏ hàng không ?')"
                                href="{{ route('cart.clear') }}" class="btn obrien-button primary-btn">Xóa tất cả </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 ml-auto">
                <!-- Cart Calculation Area -->
                @if ($carts->count() > 0)
                <div class="cart-calculator-wrapper">
                    <div class="cart-calculate-items">
                        <h3>Cart Totals</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>{{ number_format($item->totalPrice) }}VND</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$70</td>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <td class="total-amount">{{ number_format($item->totalPrice) }}VND</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="{{route('order.checkout')}}" class="btn obrien-button primary-btn d-block">Proceed To Checkout</a>
                </div>
                @endif

            </div>
        </div>
    </div>
    </div>

    <!-- cart main wrapper end -->
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
