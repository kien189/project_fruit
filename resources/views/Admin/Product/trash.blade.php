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
                <div class="alert alert-danger  alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('product.create') }}" class="btn btn-success">+Thêm mới sản phẩm</a>

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
                                    <th>Tên sản phẩm </th>
                                    <th>Đường dẫn sản phẩm </th>
                                    <th>Ảnh sản phẩm </th>
                                    <th>Giá sản phẩm  </th>
                                    <th>Giá khuyến mãi </th>
                                    <th>Danh mục </th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo </th>
                                    <th>Tùy chọn</th>
                                </tr>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            <img src="{{asset('storage/images')}}/{{$item->image}}" alt="Lỗi"  width="150px">
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->sale_price }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{!! $item->status
                                            ? '<span class="label label-success">Hiển Thị</span>'
                                            : '<span class="label label-danger">Tạm Ẩn</span>' !!}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td style="display: flex;gap: 8px">

                                            <a href="{{ route('product.restore', $item) }}" class="btn btn-success">Khôi phục</a>
                                            <a href="{{ route('product.forceDelete', $item) }} " onclick="return confirm('Bạn có chắc chắn xóa hẳn sản phẩm này không ?')"  class="btn btn-danger ">Xóa</a>
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
            {{-- <div class="text-center "> {{ $products->links('pagination::bootstrap-4') }}</div> --}}
            <div>
                <a href="{{ route('category.trash') }}" class="btn btn-danger "> <i
                        class="fa-solid fa-trash-can-arrow-up "></i> Thùng rác</a>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


