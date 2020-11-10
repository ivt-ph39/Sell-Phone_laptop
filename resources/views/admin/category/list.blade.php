@extends('layouts.masterAdmin')
@section('title')
    {{$titlePage}}
@endsection
@section('main')
    <div class="container p-3">
        @if (!isset($categories))
            <h4>No Data.</h4>
            <a href="{{route('admin.category.create')}}" class="btn btn-primary "> Thêm danh mục</a>
        @else
            <h4 class="float-left">{{$titlePage}}.</h4>
            <a href="{{route('admin.category.create')}}" class="btn btn-primary mb-3 float-right"> Thêm danh mục <i class="fas fa-plus-circle ml-1"></i></a>
            <div class="content ">
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
                        <th scope="col">Id</th>
                        <th scope="col">Tên DM</th>
                        <th scope="col">DM Cha</th>
                        <th scope="col">Icon / Ảnh</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Người Thêm</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                        <tr>
                        <th>{{$key +1}}</th>
                        <td>{{$category->name}}
                        </td>
                        <td >{{$category->parent_id['name']}}</td>
                        <td class="d-flex justify-content-center">
                            @if ($category->parent_id['id'] == 0)
                                <i class="fas fa-2x {{$category->icon}}"></i>
                            @else
                                <img src="{{$category->image}}" alt="Avatar" style="height: 70px">
                            @endif
                        </td>
                        <td>
                            @if ($category->active == 0)
                                <span class="badge badge-secondary">Ẩn</span>
                            @else   
                                <span class="badge badge-danger">Hiện</span>
                            @endif
                        </td>
                        <td>{{$category->createBy->name}}</td>
                        <td>
                            <a href="{{route('admin.category.edit',['id'=>$category->id])}}" class="badge badge-primary mr-1 ml-1">Edit</a>
                            <span>
                                <form action="{{route('admin.category.delete',['id'=>$category->id])}}" method="post" class="d-inline" >
                                @csrf
                                @method('delete')
                                <button type="submit" class=" badge badge-danger border-0" >Delete</button>
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
    </script>
@endsection