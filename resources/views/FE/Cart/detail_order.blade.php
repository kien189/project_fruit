@extends('FE.master')
@section('main')
    <div class="container mt-5 p-5 ">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Obrien</h1>
                        <p>Địa chỉ: 123 Đường ABC, TP XYZ</p>
                        <p>Điện thoại: 0337955330</p>
                        <p>Email: obrien@gmail.com</p>
                    </div>
                    <div class="col-md-4 text-right">
                            <div class="header-logo pt-5 ">
                                <a href="{{ route('home.index') }}">
                                    <img class="img-full" src="{{ asset('assets') }}/images/logo/logo.png"
                                        alt="Header Logo">
                                </a>
                            </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row container  d-flex justify-content-center ">
                    <div class="col-md-6 ">
                        <h4>Thông Tin Khách Hàng</h4>
                        <p>Khách hàng: {{ auth('customers')->user()->name }}</p>
                        <p>Địa chỉ:{{ auth('customers')->user()->address }}</p>
                        <p>Điện thoại:{{ auth('customers')->user()->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Thông Tin Hóa Đơn</h4>
                        <p>Mã hóa đơn: HD123456</p>
                        <p>Ngày lập: {{ $order->created_at->format('Y-m-d ') }}</p>
                        <p>Nhân viên: Nguyễn Văn Kiên</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>ĐVT</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }} kg</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->product->sale_price) }} đ</td>
                                    <td>{{ number_format($item->quantity * $item->product->sale_price) }} đ</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="total-section text-right">
                    <p>Tổng tiền hàng: <span>{{ number_format($order->totalPrice) }}</span></p>
                    <p>Thuế (0%): <span>0</span></p>
                    <p>Giảm giá: <span>0 đ</span></p>
                    <p class="total">Tổng tiền thanh toán: <span class="fw-bold text-danger ">{{ number_format($order->totalPrice) }} đ</span></p>
                </div>

                <div class="mb-4">
                    <h4>Phương Thức Thanh Toán</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cash">
                        <label class="form-check-label" for="cash">Tiền mặt</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="bank">
                        <label class="form-check-label" for="bank">Chuyển khoản</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="card">
                        <label class="form-check-label" for="card">Thanh toán bằng thẻ</label>
                    </div>
                </div>

                <div class="row signature-section">
                    <div class="col-md-6 text-center ">
                        <p>Nhân viên lập hóa đơn</p>
                        <p>(Ký và ghi rõ họ tên)</p>
                        <p>Nguyễn Văn Kiên</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <p>Khách hàng</p>
                        <p>(Ký và ghi rõ họ tên)</p>
                        <p>{{auth('customers')->user()->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
