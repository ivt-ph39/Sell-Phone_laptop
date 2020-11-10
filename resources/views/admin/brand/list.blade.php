@extends('layouts.masterAdmin')
@section('title')
    {{$titlePage}}
@endsection
@section('main')
    <div class="container p-3">
        @if (!isset($brands))
            <h4>No Data.</h4>
            <a href="{{route('admin.brand.create')}}" class="btn btn-primary "> Thêm thương hiệu</a>
        @else
            <h4 class="float-left">{{$titlePage}}.</h4>
            <a href="{{route('admin.brand.create')}}" class="btn btn-primary mb-3 float-right"> Thêm thương hiệu <i class="fas fa-plus-circle ml-1"></i></a>
            <div class="content">
                <div class="get_mess" 
                    @if (Session::has('success'))
                        data-success ="{{ Session::get('success') }}"
                    @endif
                    @if (Session::has('error'))
                        data-error  ="{{ Session::get('error') }}"
                    @endif>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="width: 10%">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                        <tr>
                        <th>{{$key +1}}</th>
                        <td>{{$brand->name}}<span class=" text-danger" >( Sản Phẩm)</span>
                        </td>
                        <td class="d-flex justify-content-center">
                            <img src="{{$brand->avatar}}" alt="Avatar" style="width:100px;" class=" img-thumbnail">
                        </td>
                        <td>
                            <a href="{{route('admin.brand.edit',['id'=>$brand->id])}}" class="badge badge-primary mr-1 ml-1">Edit</a>
                            <span>
                            <form action="{{route('admin.brand.delete',['id'=>$brand->id])}}" method="post" class="d-inline" >
                                @csrf
                                @method('delete')
                                <button type="submit" class=" badge badge-danger border-0">Delete</button>
                            </form>
                        </span>
                        </td>
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                    </table>
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            success = $('.get_mess').attr('data-success');
            error   = $('.get_mess').attr('data-error')
            if(success != undefined){
                Swal.fire({
                icon: 'success',
                text: success ,
                })
            }
            if(error != undefined){
               Swal.fire({
                icon: 'error',
                title: 'Lỗi...',
                text: error ,
                })
            }
        })
@endsection