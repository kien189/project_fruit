@extends('FE.master')
@section('main')
    <base href="/">
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3">My Account</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- my account wrapper start -->
    <div class="my-account-wrapper mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-custom">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                        Orders</a>
                                    <a href="#download" data-bs-toggle="tab"><i class="fa fa-cloud-download"></i>
                                        Download</a>
                                    <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                        Payment
                                        Method</a>
                                    <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                        address</a>
                                    <a href="#account-info " data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                        Details</a>
                                    <a href="{{ route('home.change_password') }}"><i class="fa fa-lock"></i> Thay đổi mật
                                        khẩu</a></a>
                                    <a href="{{ route('home.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8 col-custom">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>Alex Aya</strong> (If Not <strong>Aya !</strong><a
                                                        href="login-register.html" class="logout"> Logout</a>)</p>
                                            </div>
                                            <p class="mb-0">From your account dashboard. you can easily check & view your
                                                recent orders, manage your shipping and billing addresses and edit your
                                                password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($items->oders as $item)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $item->created_at }}</td>
                                                                <td>
                                                                    @if ($item->status == 0)
                                                                        <span>Chưa xác nhận đơn hàng</span>
                                                                    @elseif($item->status == 1)
                                                                        <span>Đã xác nhận đơn hàng</span>
                                                                    @elseif($item->status == 2)
                                                                        <span>Đang vận chuyển</span>
                                                                    @elseif($item->status == 3)
                                                                        <span>Đã giao hàng</span>
                                                                    @else
                                                                        <span>Đã hủy đơn hàng</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ number_format($item->totalPrice) }}VND</td>
                                                                <td>
                                                                    <a href="{{ route('order.detail', $item) }}"
                                                                        class="btn obrien-button-2 primary-color rounded-0">View</a>
                                                                    <a href="cart.html"
                                                                        class="btn obrien-button-2 primary-color rounded-0">Hủy
                                                                        đơn hàng</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="download" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Downloads</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Date</th>
                                                            <th>Expire</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Haven - Free Real Estate PSD Template</td>
                                                            <td>Aug 22, 2018</td>
                                                            <td>Yes</td>
                                                            <td><a href="#"
                                                                    class="btn obrien-button-2 primary-color rounded-0"><i
                                                                        class="fa fa-cloud-download mr-2"></i>Download
                                                                    File</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>HasTech - Profolio Business Template</td>
                                                            <td>Sep 12, 2018</td>
                                                            <td>Never</td>
                                                            <td><a href="#"
                                                                    class="btn obrien-button-2 primary-color rounded-0"><i
                                                                        class="fa fa-cloud-download mr-2"></i>Download
                                                                    File</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            <address>
                                                <p><strong>Alex Aya</strong></p>
                                                <p>1355 Market St, Suite 900 <br>
                                                    San Francisco, CA 94103</p>
                                                <p>Mobile: (123) 456-7890</p>
                                            </address>
                                            <a href="#" class="btn obrien-button-2 primary-color rounded-0"><i
                                                    class="fa fa-edit mr-2"></i>Edit Address</a>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">
                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="first-name" class="required mb-1"
                                                                    vlaue="">Họ tên</label>
                                                                <input type="text" id="first-name" name="name"
                                                                    placeholder="First Name"
                                                                    value="{{ $items->name }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3 d-flex ">
                                                        <label for="display-name" class="required mb-1">Quê quán</label>

                                                        <select class="form-control" name="gender" id="">
                                                            <option value="1"
                                                                {{ $items->gender == 1 ? 'selected' : '' }}>Nam
                                                            </option>
                                                            <option value="0"
                                                                {{ $items->gender == 0 ? 'selected' : '' }}>Nữ
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="display-name" class="required mb-1">Địa chỉ</label>
                                                        <input type="text" id="display-name" name="address"
                                                            placeholder="Địa chỉ nhận hàng"
                                                            value="{{ $items->address }}" />

                                                    </div>


                                                    <div class="single-input-item mb-3">
                                                        <label for="phone" class="required mb-1">Số điện thoại</label>
                                                        <input type="number" name="phone" id="phone"
                                                            placeholder="Số điện thoại" value="{{ $items->phone }}" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="email" class="required mb-1">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            placeholder="Email Address" value="{{ $items->email }}" />
                                                    </div>
                                                    <div class="single-input-item single-item-button">
                                                        <button type="submit" class="btn obrien-button primary-btn">Cập
                                                            nhật </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                    <div class="tab-pane fade" id="change_password" role="">
                                        @yield('main_change_password')
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div>

                            <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
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
