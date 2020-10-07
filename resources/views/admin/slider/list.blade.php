@extends('layouts.masterAdmin')
@section('title')
    {{$titlePage}}
@endsection
@section('main')
    <div class="container p-3">
        @if (empty($sliders))
            <h4>No Data.</h4>
            <a href="{{route('admin.slider.create')}}" class="btn btn-primary "> Thêm Slider</a>
        @else
            <h4 class="float-left">{{$titlePage}}.</h4>
            <a href="{{route('admin.slider.create')}}" class="btn btn-primary mb-3 float-right"> Thêm Slider<i class="fas fa-plus-circle ml-1"></i></a>
            <div class="content">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th class=" text-center">#</th>
                    <th class=" text-center">Tên</th>
                    <th class=" text-center">Baner</th>
                    <th class=" text-center">Trạng thái</th>
                    <th class=" text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $key=>$slider) 
                        <tr>
                            <th class=" text-center">{{$key+1}}</th>
                            <td class=" text-center">{{$slider->name['base']}}</td>
                            <td class=" text-center"><img src="{{$slider->path}}" alt="" height="80px" ></td>
                            <td class=" text-center"><span class="badge {{$slider->active['class']}}">{{$slider->active['name']}}</span></td>
                            <td class=" text-center" >
                                <span>
                                    <form action="{{route('admin.slider.delete',['id'=>$slider->id])}}" method="post" class="d-inline" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" badge badge-danger border-0">Delete</button>
                                    </form>
                                </span>
                                <a href="{{route('admin.slider.edit',['id'=>$slider->id])}}" class=" badge badge-primary mr-2">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection