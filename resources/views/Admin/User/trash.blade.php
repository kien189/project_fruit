@extends('Admin.master')
@section('title', 'Thùng rác')
@section('main_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý thùng rác

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
                    <div class="box-header">
                        {{-- <a href="{{ route('category.create') }}" class="btn btn-success">+Thêm mới danh mục</a> --}}

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>

                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo </th>
                                    <th>Tùy chọn</th>
                                </tr>
                                @forelse ($categories as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! $item->status
                                            ? '<span class="label label-success">Hiển Thị</span>'
                                            : '<span class="label label-danger">Tạm Ẩn</span>' !!}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td style="display: flex;gap: 8px">

                                            <a href="{{route('category.restore', $item->id)}}" class="btn btn-success">Khôi phục</a>
                                            <a href="{{ route('category.forceDelete', $item->id) }}"  onclick="return confirm('Bạn có chắc chắn xóa hẳn danh mục này không ?')" class="btn btn-danger ">Xóa</a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <span>Chưa có dữ liệu </span> --}}
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.box -->
            {{-- <div class="text-center "> {{ $categories->links('pagination::bootstrap-4') }}</div> --}}
        </section>
        <!-- /.content -->
    </div>
@endsection
