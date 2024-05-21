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
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-wrapper mt-no-password mb-no-password">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row p-5">

                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-12 col-custom ">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="myaccount-content">
                                        <h3>Quên mật khẩu ? </h3>
                                        <div class="account-details-form">
                                            <form action="" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12 col-custom">
                                                        <div class="single-input-item mb-3">
                                                            <label for="first-name" class="required mb-1"
                                                                vlaue="">Nhập email</label>
                                                            <input type="text" id="first-name" name="email"
                                                                placeholder="email" />
                                                            @if ($message = Session::get('error'))
                                                                <div class="alert alert-success alert-block">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">×</button>
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @endif
                                                            @if ($message = Session::get('success'))
                                                                <div class="alert alert-success alert-block">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">×</button>
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @endif
                                                            @error('email')
                                                                <small
                                                                    class="help-block text-danger ">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="single-input-item single-item-button">
                                                    <button type="submit"
                                                        class="btn obrien-button primary-btn">Gửi</button>
                                                </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- Single Tab Content End -->
                            <!-- Single Tab Content End -->
                        </div>
                    </div>

                    <!-- My Account Tab Content End -->
                </div>
            </div> <!-- My Account Page End -->
        </div>
    </div>
    </div>
    </div>
@endsection
