@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container-fluid">
        @if (!isset($comments))
            <h4>No Data.</h4>
        @else
            <div class="pt-3">
                <h4 class="float-left">{{ $titlePage }}.</h4>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Infor User</th>
                            <th scope="col">Nội Dung</th>
                            <th scope="col">Thời gian <br> Comment </th>
                            <th scope="col">Hiển Thị</th>
                            <th scope="col" class="text-center">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $comment)
                            <tr class="text-center">
                                <th class="text-left">
                                    <ul>
                                        <li>ID : {{ $comment->id }}</li>
                                        <li>Name : {{ $comment->name }}</li>
                                        <li>Email: {{ $comment->email }}</li>
                                        <li>Phone:{{ $comment->phone }}</li>
                                    </ul>
                                </th>
                                <td>{{ $comment->content }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.comment.active', $comment->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="badge badge-{{ $comment->active ? 'primary' : 'danger' }}">{{ $comment->active ? 'show' : 'hidden' }}</button>
                                    </form>
                                </td>
                                <td><span
                                        class="badge badge-{{ $comment->status ? 'success' : 'danger' }}">{{ $comment->status ? 'commented' : 'notyet' }}</span>
                                </td>
                                <td>
                                    @if ($comment->status == 0)
                                        <a href="{{ route('admin.comment.showReply', $comment->id) }}" class="btn btn-sm btn-success" >Reply</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{ $comments->links() }}
            </div>
        @endif
    </div>
@endsection
