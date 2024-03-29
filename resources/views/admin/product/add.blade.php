@extends('admin.master')
@section('content')
 <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif

            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <form action="admin/product/add" method="POST" enctype="multipart/form-data">
              @csrf
             <div class="form-group">
                <label>Chọn loại sản phẩm</label>
                <select class="form-control" name="product_type" id="theloai">
                    @foreach($theloai as $tl)
                        <option value="{{$tl->id}}">{{$tl->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nhập tên sản phẩm</label>
                <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" />
            </div>
            <div class="form-group">
                <label>Tóm tắt</label>
                <textarea class="form-control" name="description" rows="3" id="editor1"></textarea>
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control ckeditor" id="noidung" name="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Hình Ảnh</label>
                <input type="file" name="image" />
                {{-- @if(isset($error_img))
                    <div class="alert alert-danger">{{$error_img}}</div>
                @endif --}}
            </div>
            <div class="form-group">
                <label>Đơn Giá</label>
                <input class="form-control" name="unit_price" value="0" />
            </div>
            <div class="form-group">
                <label>Giá Khuyến Mãi</label>
                <input class="form-control" name="promotion_price" value="0" />
            </div>
            <div class="form-group">
                <label>Đơn vị</label>
                <input class="form-control" name="unit" placeholder="đơn vị của sàn phẩm ví dụ như hộp, cái" />
            </div>
            <div class="form-group">
                <label>Sản Phẩm Mới &nbsp;</label>
                <label class="radio-inline">
                    <input name="new" value="0" checked="" type="radio">Không
                </label>
                <label class="radio-inline">
                    <input name="new" value="1" type="radio">Có
                </label>
            </div>

            <button type="submit" class="btn btn-success">Thêm</button>
            <button type="reset" class="btn btn-info">Làm mới</button>
            <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection