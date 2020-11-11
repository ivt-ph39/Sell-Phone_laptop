@extends('layouts.masterAdmin')
@section('title')
    {{$titlePage}}
@endsection
@section('main')
    <div class="container p-3">
        @if (empty($contacts))
            <h4>No Data.</h4>
            <a href="{{route('admin.contact.create')}}" class="btn btn-primary "> Thêm Liên Hệ</a>
        @else
            <h4 class="float-left">{{$titlePage}}.</h4>
            <a href="{{route('admin.contact.create')}}" class="btn btn-primary mb-3 float-right"> Thêm Liên Hệ <i class="fas fa-plus-circle ml-1"></i></a>
            <div class="content">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th class=" text-center">#</th>
                    <th class=" text-center">Tên</th>
                    <th class=" text-center">Nội dung</th>
                    <th class=" text-center">Icon</th>
                    <th class=" text-center">Trạng thái</th>
                    <th class=" text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key=>$contact) 
                        <tr>
                            <th class=" text-center">{{$key+1}}</th>
                            <td class=" text-center">{{$contact->name}}</td>
                            <td class=" text-center">{{$contact->content}}</td>
                            <td class=" text-center"><i class=" fa-2x {{$contact->icon}}"></i></td>
                            <td class=" text-center"><span class="badge {{$contact->active['class']}}">{{$contact->active['name']}}</span></td>
                            <td class=" text-center" >
                                <span>
                                    <form action="{{route('admin.contact.delete',['id'=>$contact->id])}}" method="post" class="d-inline" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" badge badge-danger border-0">Delete</button>
                                    </form>
                                </span>
                                <a href="{{route('admin.contact.edit',['id'=>$contact->id])}}" class=" badge badge-primary mr-2">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection