@extends('Admin.master')
@section('title', 'Thêm mới danh mục')
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
                        <form role="form" method="POST" action="{{ route('product.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body" style="">


                                <div class="form-group @error('name') has-error @enderror">
                                    <label for="productName">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="productName" name="name"
                                        onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group @error('slug') has-error @enderror">
                                    <label for="exampleInputEmail1">Đường dẫn Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                    @error('slug')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group @error('name') has-error @enderror">
                                    <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="photo"
                                        onchange="readURL(this)">
                                    <img src="" alt="" id="Show_images" width="50%">
                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('photos') has-error @enderror">
                                    <label for="exampleInputEmail1">Ảnh mô tả</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="photos[]"
                                        multiple onchange="showImg(this)">
                                    <hr>
                                    <div class="row" id="Show_IMG">

                                    </div>
                                    @error('photos')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group @error('category_id') has-error @enderror">
                                    <label for="exampleInputEmail1">Chọn danh mục</label>
                                    <select name="category_id" id="input" class="form-control">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('description') has-error @enderror">
                                    <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                                    <textarea name="description" id="editor1"></textarea>
                                    @error('description')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="variants">

                                        <div id="form-group">
                                            <label for="variantSize">Kích thước</label>
                                            <input type="text" class="form-control" name="variants[0][size]">
                                        </div>
                                        <div class="form-group">
                                            <label for="variantPrice">Giá</label>
                                            <input type="text" class="form-control"  name="variants[0][price]">
                                        </div>
                                        <div class="form-group">
                                            <label for="variantSalePrice">Giá khuyến mãi</label>
                                            <input type="text" class="form-control"
                                                name="variants[0][sale_price]">
                                        </div>
                                </div>
                                <button type="button" onclick="addVariant()">Add Variant</button>
                            </div>
                            <!-- Container để thêm các trường dữ liệu của các biến thể sản phẩm -->
                            {{-- <button type="button" class="btn btn-success" onclick="addVariant()">Thêm biến thể</button> --}}


                            <div class="form-group">
                                <label for="exampleInputEmail1">FEATURED PRODUCTS</label>
                                <input type="checkbox" id="exampleInputEmail1" name="stock" value="1">
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
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
 <script>
    let variantIndex = 1;

    function addVariant() {
        const variantsDiv = document.getElementById('variants');
        const variantDiv = document.createElement('div');
        variantDiv.innerHTML = `
        <div id="form-group">
                                            <label for="variantSize">Kích thước</label>
                                            <input type="text" class="form-control" name="variants[${variantIndex}][size]">
                                        </div>
                                        <div class="form-group">
                                            <label for="variantPrice">Giá</label>
                                            <input type="text" class="form-control" name="variants[${variantIndex}][price]">
                                        </div>
                                        <div class="form-group">
                                            <label for="variantSalePrice">Giá khuyến mãi</label>
                                            <input type="text" class="form-control" name="variants[${variantIndex}][sale_price]"
                                        </div>
        `;
        variantsDiv.appendChild(variantDiv);
        variantIndex++;
    }
</script>

@endsection
