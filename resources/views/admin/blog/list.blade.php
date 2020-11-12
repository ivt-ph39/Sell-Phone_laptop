@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="p-2">
        @if (!isset($blogs))
            <h4>No Data.</h4>
        @else
            @if (\Session::has('message'))
                <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <div class="pt-3 pb-3 row">
                <h4 class="col">{{ $titlePage }}.</h4>
                <form action="{{ route('admin.blog.list') }}" method="get" class="form-inline col">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="search" placeholder="Tìm tên bài viết">
                        <div class="input-group-append">
                            <button title="Tìm kiếm nhân viên theo tên" class="btn btn-outline-success col" type="submit"><i
                                    class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus-square"></i> Add blog</a>
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
                                <td><span
                                        class="badge badge-{{ $blog->status ? 'info' : 'danger' }}">{{ $blog->status ? 'show' : 'hidden' }}</span>
                                </td>
                                <td>
                                    @foreach ($blog->blog_tag as $tag)
                                        <span class="badge badge-success">{{ $tag->tag }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="form-inline">
                                        <form action="{{ route('admin.blog.delete', $blog->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Del</button>
                                        </form>
                                        <a href="{{ route('admin.blog.show', $blog->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $blogs->appends(request()->query())->links() }}

            </div>
        @endif
    </div>

@endsection
@section('js')
    <script>
        $(function() {
            $('.message').click(function() {
                let $this = $(this);
                setTimeout(function() {
                    $this.hide();
                }, 600);
            });
        });

    </script>
@endsection
