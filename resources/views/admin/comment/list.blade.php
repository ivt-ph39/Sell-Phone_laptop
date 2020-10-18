@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container-fluid">
        @if (!isset($comments))
            <h4>No Data.</h4>
        @else
            <div class="pt-5">
                <h4 class="float-left">{{ $titlePage }}.</h4>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Tên User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col" >Nội Dung</th>
                            <th scope="col" class="text-center">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr class="text-center">
                                <th>{{ $comment->id }}</th>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->phone }}</td>
                                <td>{{ $comment->content }}</td>
                                <td><span class="badge badge-{{ $comment->status ? 'danger' : 'secondary'}}">{{ $comment->status ? 'commented' : 'notyet'}}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success">Reply</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
