@extends('Admin.master')
@section('title')
    Quản lý tài khoản
@endsection
@section('main_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý tài khoản

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="#">Người dùng</a></li>
                <li class="active">Quản lý tài khoản
                </li>
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
                    <div class="box-header mt-4">
                        <div class="box-tools mb-4">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Search">

                                <div class="input-group-btn ">
                                    <button type="submit" class="btn btn-default "><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> <br>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>

                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email người dùng</th>
                                    <th>Mật khẩu</th>

                                    <th>Ngày tạo </th>
                                    <th>Tùy chọn</th>
                                </tr>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->password }}</td>

                                    <td>{!! $item->status
                                        ? '<span class="label label-success">Hiển Thị</span>'
                                        : '<span class="label label-danger">Tạm Ẩn</span>' !!}
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td style="display: flex;gap: 8px">

                                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-success">Sửa</a>
                                        <form action="{{ route('category.destroy', $item) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn xóa không ?')"> Xóa</button>
                                        </form>

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

        </section>
        <!-- /.content -->
    </div>
@endsection
