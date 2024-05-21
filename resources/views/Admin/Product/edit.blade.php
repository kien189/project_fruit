@extends('Admin.master')
@section('title', 'Sửa sản phẩm')
@section('main_admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <h1>
                Quản lý sản phẩm

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li class="active">Thêm mới sản phẩm</li>
            </ol>
        </section> <br>

        <!-- Main content -->
        <div class="container-fluid">
            <section class="contentd-flex  ">

                <!-- Default box -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm mới sản phẩm</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('product.update', $product) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body" style="">

                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label for="productName">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="productName" name="name"
                                        value="{{ $product->name }}" onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group @error('slug') has-error @enderror">
                                    <label for="exampleInputEmail1">Đường dẫn Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ $product->slug }}">
                                    @error('slug')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('price') has-error @enderror">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                        value="{{ $product->price }}">
                                    @error('price')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group @error('sale_price') has-error @enderror">
                                    <label for="exampleInputEmail1">Giá khuyến mãi</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="sale_price"
                                        value="{{ $product->sale_price }}">
                                    @error('sale_price')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('photo') has-error @enderror">
                                    <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                    <div>
                                        <img src="{{ asset('storage/images/' . $product->image) }}"
                                            alt="Ảnh sản phẩm hiện tại" style="max-width: 100px;" id="Show_images">
                                    </div>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="photo"
                                        onchange="readURL(this)">
                                    @error('photo')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('photos') has-error @enderror">
                                    <label for="exampleInputEmail1">Ảnh mô tả</label>
                                    <div>
                                        @foreach ($product->images as $imgpro)
                                            <div style="position: relative; display: inline-block;">
                                                <img src="{{ asset('storage/images/' . $imgpro->image) }}" alt="Ảnh mô tả"
                                                    style="max-width: 200px;">
                                                <a onclick="return confirm('Bạn có muốn xóa ảnh này không ?')"
                                                    href="{{ route('product.destroyImg', $imgpro->id) }}" type="button"
                                                    class="btn btn-danger btn-sm delete-image"
                                                    data-image-id="{{ $imgpro->id }}"
                                                    style="position: absolute; top: 5px; right: 5px;">X</a>
                                            </div>
                                        @endforeach
                                        <hr>
                                        <p>Các ảnh mới chọn sẽ thay thế ảnh cũ trước đó </p>
                                        <div class="row" id="Show_IMG">

                                        </div>
                                    </div>
                                    @error('photos')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <input type="file" class="form-control" id="exampleInputEmail1" name="photos[]" multiple onchange="showImg(this)">
                                @error('photos')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group @error('category_id') has-error @enderror">
                                <label for="exampleInputEmail1">Chọn danh mục</label>
                                <select name="category_id" id="input" class="form-control">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('description') has-error @enderror">
                                <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                                <textarea name="description" id="editor1">{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">FEATURED PRODUCTS</label>
                                <input type="checkbox" id="exampleInputEmail1" name="stock" value="1">
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                    </div>
                    </form>
                </div>


                <!-- /.box -->

        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content -->
    </div>
@endsection
@section('checkEditor-js')


    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("productName").value;

            //Loại bỏ các khoảng trắng thừa
            title = title.trim();

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');

            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '-');

            //Xóa các khoảng trắng
            slug = slug.replace(/\s+/g, '-');

            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');

            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Show_images').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function showImg(input) {
            if (input.files && input.files.length) {
                // console.log(input.files.length);
                var _html = '';
                for (let i = 0; i < input.files.length; i++) {
                    var file = input.files[i];


                    var reader = new FileReader();

                    reader.onload = function(e) {
                        _html += `
                                <div class="thumbnail col-md-3">
                                    <img src="${ e.target.result}" alt="" width="100%">
                                </div>

                                    `;
                        // $('#Show_IMG').attr('src', e.target.result);
                        $('#Show_IMG').html(_html)
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
