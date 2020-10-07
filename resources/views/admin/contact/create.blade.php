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
                <form class="form-inline" action="{{route('admin.contact.store')}}" method="post" >
                    @csrf
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="name" class="d-flex justify-content-end pr-5">Tên <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="name" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                placeholder="Phone" value="{{old('name')}}">
                            @error('name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="content" class="d-flex justify-content-end pr-5">Nội dung <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="content" id="content" class="form-control w-100 @error('content') is-invalid @enderror"
                                placeholder="Phone" value="{{old('content')}}">
                            @error('content')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="icon" class="col-4 d-flex justify-content-end pr-5">Icon:</label>
                        <div class="col-4">
                            <input type="text" name="icon" id="icon" class="form-control w-100 @error('icon') is-invalid @enderror"
                            placeholder=" fa-phone"  value="{{old('icon')}}">
                            @error('icon')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-4 pl-5">
                            <div ><i id="icon_preview" class="fas fa-3x "></i></div>
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
                        <button type="submit" class="btn btn-primary ">Tạo </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="col-2"></div>
</div>
@endsection
