@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container-fluid">
        @if (!isset($comments))
            <h4>No Data.</h4>
        @else
            @if (\Session::has('message'))
                <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <div class="pt-3 mb-3 mr-3">
                <h4 class="float-left">{{ $titlePage }}.</h4>
                <form action="{{ route('admin.comment.list') }}" method="get" class="form-inline float-right mb-3" >
                    <input type="number" class="form-control mr-2" name="id" placeholder="Tìm theo mã sản phẩm">
                    <input type="date" class="form-control mr-2" name="created_at">
                    <button title="Tìm kiếm comment" class="btn btn-outline-success" type="submit"><i
                            class="fas fa-search-plus"></i></button>
                </form>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Info User</th>
                            <th scope="col" class="w-25">Nội Dung</th>
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
                                        <li>Mã sản phẩm: ID{{ $comment->products['id'] }}</li>
                                        <li>Tên sản phẩm: {{ $comment->products['name'] }}</li>
                                    </ul>
                                </th>
                                <td class="w-25" style="width: 20%">{{ $comment->content }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.comment.active', $comment->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button title="Ẩn or Hiện nội dung comment lên trang sản phẩm" type="submit"
                                            class="badge badge-{{ $comment->active ? 'primary' : 'danger' }}">{{ $comment->active ? 'Hiện' : 'Ẩn' }}</button>
                                    </form>
                                </td>
                                <td><span
                                        class="badge badge-{{ $comment->status ? 'success' : 'danger' }}">{{ $comment->status ? 'Đã trả lời' : 'Chưa trả lời' }}</span>
                                </td>
                                <td class="">
                                    @if ($comment->status == 0)
                                        <a href="{{ route('admin.comment.showReply', $comment->id) }}"
                                            class="btn btn-sm btn-success">Reply</a>
                                    @endif
                                    <span>
                                        <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="post" class=" d-inline">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Bạn có chắc muốn xóa comment')" title="Xóa comment" type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class=" d-flex justify-content-center">
                    {{ $comments->appends(request()->query())->links() }}
                </div>
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
