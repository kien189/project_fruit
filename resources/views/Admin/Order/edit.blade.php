@extends('Admin.master')

@section('main_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header ">
            <h1 class="shadow position-fixed  top-0 ">
                Quản lý đơn hàng

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>
        <br>

        <!-- Main content -->
        <section class="container-fluid " style="background: #fff;padding: 4rem 4rem">

            <div class=" mt-5 p-5 ">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">

                            <div class="col text-end">
                                <h4 class="text-uppercase">Trạng thái: @if ($orders->status == 0)
                                        <span class="btn btn-warning  ">Chưa xác nhận đơn hàng</span>
                                    @elseif($orders->status == 1)
                                        <span class="btn btn-primary   ">Đã xác nhận đơn hàng</span>
                                    @elseif($orders->status == 2)
                                        <span class="btn btn-success   ">Đang vận chuyển</span>
                                    @elseif($orders->status == 3)
                                        <span class="btn btn-success   ">Đã giao hàng</span>
                                    @else
                                        <span class="btn btn-danger   ">Đã hủy đơn hàng</span>
                                    @endif
                                    {{-- 0 => 'Chờ xác nhận',
                                    1 => 'Đã xác nhận',
                                    2 => 'Đang vận chuyển',
                                    3 => 'Đã giao hàng',
                                    4 => 'Đã hủy', --}}
                                </h4>
                            </div>
                        </div>
                        <hr>
                    </div>


                    <div class="card-header pb-5">
                        <form action="{{ route('shopping.update', $orders->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="form-group mb-0">
                                        <label for="order-status" class="mb-0">
                                            <h4 class="mb-0">Thay đổi trạng thái đơn hàng</h4>
                                        </label>
                                        <select class="form-control border rounded-2" name="status" id="order-status"
                                            style="max-width: 15rem;">
                                            @foreach ($orderStatuses as $key => $status)
                                                <option value="{{ $key }}"
                                                    {{ $key == $orders->status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                    <!-- Thay input submit thành button -->
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="row   d-flex ">
                            <div class="col-md-6 ">
                                <h4>Thông Tin Khách Hàng</h4>
                                <p>Khách hàng:{{ $orders->name }}</p>
                                <p>Địa chỉ:{{ $orders->address }}</p>
                                <p>Điện thoại:{{ $orders->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Thông Tin Hóa Đơn</h4>
                                <p>Mã hóa đơn: HD123456</p>
                                <p>Ngày lập: {{ $orders->created_at->format('Y-m-d ') }}</p>
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
                                    @foreach ($orders->details as $item)
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


                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
