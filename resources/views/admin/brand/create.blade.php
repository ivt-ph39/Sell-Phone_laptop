@extends('layouts.masterAdmin')
@section('title')
{{$titlePage}}
@endsection
@section('main')
<div class="row pt-2 pl-3">
    <div class="col-2"></div>
    <div class="col-8">

        <div class="card card-primary mt-5">
            <div class="card-header">
                <h4>{{$titlePage}}</h4>
            </div>
            <div class="card-body">
                <form class="form-inline" action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="b_name" class="d-flex justify-content-end pr-5">Tên Thương Hiệu <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                placeholder="IPhone" value="{{old('name')}}">
                            @error('name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="file " class="col-4 d-flex justify-content-end pr-5">Ảnh đại diện:</label>
                        <div class="col-4">
                            <input type="file" class="form-control-file" name="avatar" id="file">
                            @error('avatar')
                                <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-4 pl-5">
                            <div id="image" class="mt-2">
                                <img id="image_upload_preview" src="uploads/images/products/phones/download.jpeg"
                                    style="width:100px;" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary ">Tạo Thương Hiệu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
@endsection
@section('js')
    <script src="admins/brand/create/js/app.js"></script>
@endsection