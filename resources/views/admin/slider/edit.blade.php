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
                <form class="form-inline" action="{{route('admin.contact.update',['id'=>$contact->id])}}" method="post" >
                    @csrf
                    @method('put')
                    <input type="hidden" value="{{$contact->id}}" name="id">
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="ct_name" class="d-flex justify-content-end pr-5">Tên <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="ct_name" id="ct_name" class="form-control w-100 @error('ct_name') is-invalid @enderror"
                                placeholder="Phone" value="{{(old('ct_name')) ? old('ct_name') : $contact->ct_name}}">
                            @error('ct_name')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <div class="col-4">
                            <label for="ct_content" class="d-flex justify-content-end pr-5">Nội dung <span
                                    class=" text-danger">(<sup>*</sup>)</span> :</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="ct_content" id="ct_content" class="form-control w-100 @error('ct_content') is-invalid @enderror"
                                placeholder="Phone" value="{{(old('ct_content')) ? old('ct_content') : $contact->ct_content}}">
                            @error('ct_content')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="ct_icon" class="col-4 d-flex justify-content-end pr-5">Icon:</label>
                        <div class="col-4">
                            <input type="text" name="ct_icon" id="ct_icon" class="form-control w-100 @error('ct_icon') is-invalid @enderror"
                            placeholder=" fa-phone"  value="{{(old('ct_icon')) ? old('ct_icon') : $contact->ct_icon}}">
                            @error('ct_icon')
                            <small id="" class="text-danger mx-auto mt-1">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-4 pl-5">
                            <div ><i id="icon_preview" class="fas fa-3x "></i></div>
                        </div>

                    </div>
                    <div class="form-group w-100 mb-3 row">
                        <label for="ct_active" class="col-4 d-flex justify-content-end pr-5">Hiển Thị :</label>
                        <div class="col-8 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="ct_active" id="ct_active" 
                            @if (old('ct_active'))
                                {{'checked'}} 
                            @else
                                {{($contact->ct_active) ? "checked" : ""}}
                            @endif>
                            <label class="custom-control-label" for="ct_active"></label>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-primary ">Lưu</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="col-2"></div>
</div>
@endsection
