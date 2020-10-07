@extends('layouts.masterAdmin')
@section('title')
{{$titlePage}}
@endsection

@section('main')
<div class="row pt-2 pl-3">
    <div class="col-12">

        <div class="card card-primary mt-5">
            <div class="card-header">
                <h4>{{$titlePage}}</h4>
            </div>
            <div class="card-body">
                <form class="form-inline" action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-2">
                            <label for="name" class="d-flex justify-content-end pr-5">Tên <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                placeholder="" value="{{old('name')}}">
                            @error('name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row w-100 mb-3">
                        <label for="path" class="col-2">Baner<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                        <input class="col-4 " type="file" class="form-control-file" name="path" id="file">
                        <div class="col-6">
                            <div class="form-group w-100 row">
                                <label for="active" class="col-4 ">Hiển Thị :</label>
                                <div class="col-4 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="active" id="active" @if (old('active'))
                                                    {{'checked'}} @endif>
                                    <label class="custom-control-label" for="active"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 mt-3 mb-5">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <img src="uploads/images/sliders/download.png" width="600px" alt="" id="baner_review">
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary ">Tạo </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
@section('js')
    <script src="admins/slider/create/js/app.js"></script>    
@endsection
