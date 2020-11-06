@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="p-2">
        @if (!isset($blogs))
            <h4>No Data.</h4>
        @else
            <div>
                <h4 class="col-5 float-left">{{ $titlePage }}.</h4>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus-square"></i> Add blog</a>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Author</th>
                            <th scope="col" style="width: 100px;">Ẩn/Hiện nội dung</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <th>{{ $blog->id }}</th>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->slug }}</td>
                                <td>{{ $blog->author }}</td>
                                <td>{{ ($blog->status) ? 'show' : 'hiden' }}</td>
                                <td>
                                    @foreach ($blog->blog_tag as $tag)
                                        <span class="badge badge-success">{{ $tag->tag }}</span>
                                    @endforeach
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
