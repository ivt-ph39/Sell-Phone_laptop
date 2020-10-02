@extends('layouts.masterAdmin')
@section('title')
{{$titlePage}}
@endsection
@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
@endsection
@section('main')
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card card-primary mt-5">
            <div class="card-header">
                <h4>{{$titlePage}}</h4>
            </div>
            <div class="card-body">
                <form class="form-inline" action="{{route('admin.category.update',['id' => $category->id ])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group w-100 mb-3 row">
                    <div class="col-4">
                        <label for="c_name" class="d-flex justify-content-end pr-5">Tên Danh Mục <span class=" text-danger">(<sup>*</sup>)</span> :</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="c_name" id="c_name" class="form-control w-100" placeholder="Điện Thoại" @if (old('c_name') !=null) value="{{ old('c_name')}}" @elseif($category->c_name)
                        value = "{{ $category->c_name}}"
                        @endif>
                        @error('c_name')
                        <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group w-100 mb-3 row">
                    <div class="col-4 d-flex justify-content-end pr-5">
                        <label for="c_parent">Danh Mục cha<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                    </div>
                    <div class="col-8">
                        <select class="form-control select-parent w-100" name="c_parent" id="c_parent">
                            {{-- <option></option> --}}
                            <option value="0">Không có DM cha</option>
                            {!!$htmlOption !!}
                        </select>

                    </div>
                </div>
                
                <div class="form-group w-100 mb-3 row">
                    <label for="c_icon" class="col-4 d-flex justify-content-end pr-5">Icon:</label>
                    <div class="col-4">
                        <input type="text" name="c_icon" id="c_icon" class="form-control w-100" placeholder=" fa-laptop" @if (old('c_icon') !=null) value="{{ old('c_icon')}}" @elseif($category->c_icon)
                        value = "{{ $category->c_icon}}"
                        @endif>
                        @error('c_icon')
                        <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-4 pl-5">
                        <div><i id="icon_preview" class="fas fa-3x "></i></div>
                    </div>
                </div>
                <div class="form-group w-100 mb-3 row">

                    <label for="file " class="col-4 d-flex justify-content-end pr-5">Ảnh đại diện:</label>
                    <div class="col-4">
                        <input type="file" class="form-control-file" name="c_image" id="file">
                        @error('c_image')
                        <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-4 pl-5">
                        <div id="image" class="mt-2">
                            <img id="image_upload_preview" style="height:100px;" class="img-thumbnail" @if ($category->c_image)
                            src = "{{$category->c_image}}"
                            @else
                            src = "uploads/images/products/phones/download.jpeg"
                            @endif>
                        </div>
                    </div>
                </div>
                <div class="form-group w-100 mb-3 row">
                    <label for="c_active" class="col-4 d-flex justify-content-end pr-5">Hiển Thị :</label>
                    <div class="col-8 custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="c_active" id="c_active" @if (old('c_active') !=null) {{ 'checked'}} @elseif($category->c_active)
                        {{ 'checked'}}
                        @endif>
                        <label class="custom-control-label" for="c_active"></label>
                    </div>
                </div>
                <div class="w-100 mb-3 ">
                    <p class=" mx-5"><b>Người Tạo: </b>{{$category->createBy->adminName}}</p>
                    <p class=" mx-5"><b>Thời gian Tạo: </b>{{$category->created_at}}</p>
                    @if ($category->c_update_by != null)
                    <p class=" mx-5"><b>Người Sửa gần nhất: </b>{{$category->updateBy->adminName}}</p>
                    <p class=" mx-5"><b>Thời Sửa gần nhất: </b>{{$category->updated_at}}</p>
                    @endif
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-primary ">Lưu</button><a href="{{route('admin.category.list')}}" class="btn btn-warning ml-2">Quay Lại</a>
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
    <script src="admins/category/edit/js/app.js"></script>
@endsection