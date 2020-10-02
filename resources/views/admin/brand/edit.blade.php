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
                <form class="form-inline" action="{{route('admin.brand.update',['id'=>$brand->id])}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$brand->id}}">
                    <input type="hidden" id="input_delete_avatar" name="delete_avatar" value="0">

                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="name" class="d-flex justify-content-end pr-5">Tên Thương Hiệu <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                placeholder="IPhone" value="{{!empty(old('name'))? old('name') : $brand->name}}">
                            @error('name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="file " class="col-4 d-flex justify-content-end pr-5">Ảnh đại diện:</label>
                        <div class="col-4">
                            <div class="card delete_avatar">
                                <div class=" d-flex ">
                                    <button type="button" id="delete_avatar" class="btn ml-auto pb-0"><i class="fas fa-exchange-alt"></i></button>
                                </div>
                                <div id="image" class="mr-3 ml-3 mb-3">
                                    <img id="image_upload_preview" src="{{$brand->avatar}}" style="width:150px;" class="img-thumbnail">
                                </div>
                            </div>
                            <div class="add_avatar d-none">
                                <input type="file" class="form-control-file"  name="avatar" id="file">
                                @error('avatar')
                                    <small id="message_add_avatar" data-add_avatar="{{$message}}" class="text-danger mx-auto mt-1">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary ">Lưu Thương Hiệu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
@endsection
@section('js')
    <script src="admins/brand/edit/js/app.js"></script>
@endsection