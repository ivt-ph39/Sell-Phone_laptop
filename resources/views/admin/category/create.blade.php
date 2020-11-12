@extends('layouts.masterAdmin')
@section('title')
Tạo Danh Mục
@endsection
@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
@endsection
@section('main')
<div class="row pt-2 pl-3">
    <div class="col-2"></div>
    <div class="col-8">

        <div class="card card-primary mt-5">
            <div class="card-header">
                <h4>Tạo Danh Mục</h4>
            </div>
            <div class="card-body">
                <form class="form-inline" action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="name" class="d-flex justify-content-end pr-5">Tên Danh Mục <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                placeholder="Điện Thoại" value="{{old('name')}}">
                            @error('name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4 d-flex justify-content-end pr-5">
                            <label for="parent_id">Danh Mục cha<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control select-parent w-100 " name="parent_id" id="parent_id" >
                                <option></option>
                                <option value="0">Không có DM cha</option>
                                {!!$htmlOption!!}
                            </select>
                            @error('parent')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="icon" class="col-4 d-flex justify-content-end pr-5">Icon:</label>
                        <div class="col-4">
                            <input type="text" name="icon" id="icon" class="form-control w-100 @error('icon') is-invalid @enderror"
                            placeholder="fas fa-laptop"  value="{{old('icon')}}">
                            @error('icon')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-4 pl-5">
                            <div ><i id="icon_preview" class="fas fa-3x "></i></div>
                        </div>

                    </div>
                    <div class="form-group w-100 mb-3 row">

                        <label for="file " class="col-4 d-flex justify-content-end pr-5">Ảnh đại diện:</label>
                        <div class="col-4">
                            <input type="file" class="form-control-file" name="image" id="file">
                            @error('image')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-4 pl-5">
                            <div id="image" class="mt-2">
                                <img id="image_upload_preview" src="uploads/images/products/phones/download.jpeg"
                                    style="height:100px;" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="active" class="col-4 d-flex justify-content-end pr-5">Hiển Thị :</label>
                        <div class="col-8 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="active" id="active" @if (old('active'))
                                            {{'checked'}} @endif>
                            <label class="custom-control-label" for="active"></label>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary ">Tạo danh mục</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="col-2"></div>
</div>
@endsection
@section('js')
    <!-- Select2 -->
    <script src="adminlte/plugins/select2/js/select2.min.js"></script>
    <script src="admins/category/create/js/app.js"></script>
@endsection