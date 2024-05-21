@extends('Admin.master')

@section('main_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý danh mục

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header pt-4">
                        {{-- <a href="{{ route('product.create') }}" class="btn btn-success">+Thêm mới sản phẩm</a> --}}

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> <br>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <tbody>
                                <tr>

                                    <th>STT</th>
                                    <th>Người đặt </th>
                                    <th>Ngày đặt </th>
                                    <th>Trạng thái </th>
                                    <th>Tổng hóa đơn </th>
                                    <th>Thao tác </th>
                                </tr>

                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="btn btn-warning  ">Chưa xác nhận đơn hàng</span>
                                            @elseif($item->status == 1)
                                                <span class="btn btn-primary   ">Đã xác nhận đơn hàng</span>
                                            @elseif($item->status == 2)
                                                <span class="btn btn-success   ">Đang vận chuyển</span>
                                            @elseif($item->status == 3)
                                                <span class="btn btn-success   ">Đã giao hàng</span>
                                            @else
                                                <span class="btn btn-danger   ">Đã hủy đơn hàng</span>
                                            @endif
                                        </td>
                                        <td class=" fw-bold ">{{ number_format($item->totalPrice) }} đ </td>
                                        <td>
                                            <a href="{{ route('shopping.edit', $item) }}" class="btn btn-danger  ">Xem</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.box -->
            <div class="text-center "> </div>
            {{-- <div>
                <a href="{{ route('product.trash') }}" class="btn btn-danger "> <i
                        class="fa-solid fa-trash-can-arrow-up "></i> Thùng rác</a>
            </div> --}}
        </section>
        <!-- /.content -->
    </div>
@endsection
