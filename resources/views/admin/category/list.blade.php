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
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tên DM</th>
                        <th scope="col">DM Cha</th>
                        <th scope="col">Icon / Ảnh</th>
                        
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Tổng SP</th>
                        <th scope="col">Người Thêm</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                        <tr>
                        <th>{{$key +1}}</th>
                        <td>{{$category->c_name}}
                            <ul>
                                <li><span class=" text-danger">{{$category->total_cate_child}}</span> --> DM con</li>
                            </ul>
                        </td>
                        <td >{{$category->c_parent['name']}}</td>
                        <td class="d-flex justify-content-center">
                            @if ($category->c_parent['id'] == 0)
                                <i class="fas fa-2x {{$category->c_icon}}"></i>
                            @else
                                <img src="{{$category->c_image}}" alt="Avatar" style="height: 100px">
                            @endif
                        </td>
                        
                        <td>
                            @if ($category->c_active == 0)
                                <span class="badge badge-secondary">Ẩn</span>
                            @else   
                                <span class="badge badge-danger">Hiện</span>
                            @endif
                        </td>
                        <td>{{$category->c_total_product}}</td>
                        <td>{{$category->createBy->adminName}}</td>
                        <td>
                            <a href="{{route('admin.category.edit',['id'=>$category->id])}}" class="badge badge-primary mr-1 ml-1">Edit</a>
                            <a href="{{route('admin.category.delete',['id'=>$category->id])}}" class="badge badge-danger mr-1 ml-1">Delete</a>
                        </td>
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                    </table>
            </div>
        @endif
    </div>
@endsection