@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container">
        @if (empty($permissionParents))
            <h4>No Data.</h4>
            <a href="{{ route('admin.permission.create', ['parent' => 1]) }}" class="btn btn-outline-success" ><i class="fas fa-plus-square"></i> Thêm Quyền</a>
        @else
            @if(\Session::has('message'))
                 <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!} 
                </div>
            @endif
            <div class="pt-3 pb-3 row">
                <h4 class="float-left col">{{ $titlePage }}.</h4>
                <form action="{{ route('admin.permission.list') }}" method="get" class="form-inline col">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="search" placeholder="Tìm theo tên module">
                        <div class="input-group-append">
                            <button title="Tìm kiếm quyền" class="btn btn-outline-success" type="submit"><i
                                    class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('admin.permission.create', ['parent' => 1]) }}" class="btn btn-outline-success" ><i class="fas fa-plus-square"></i> Thêm Quyền</a>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên Quyền Cha</th>
                            <th scope="col">Mô tả Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày chỉnh sửa</th>
                            <th scope="col">ParentID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissionParents as $permission)
                            <tr>
                                <th>{{ $permission->id }}</th>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                                <td>{{ $permission->parent_id }}</td>
                                <td>
                                    <div class="form-inline">
                                        <a title="Chỉnh sửa quyền cha" href="{{ route('admin.permission.edit', $permission->id) }}" class="btn btn-sm btn-outline-dark mr-2"><i class="fas fa-edit"></i></a>
                                        <a title="Xem danh sách quyền con" href="{{ route('admin.permission.listChildren', $permission->id) }}" class="btn btn-sm btn-outline-success mr-2"><i class="fas fa-list"></i></a>
                                        <form action="{{ route('admin.permission.delete', $permission->id) }}" method="post">
                                            @csrf 
                                            @method('DELETE')
                                            <button title="Xóa quyền cha" class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa??')"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permissionParents->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script>
        $(function(){
            $('.message').click(function(){
                let $this = $(this);
               setTimeout(function(){
                    $this.hide();
               }, 600);
            });
        });
    </script>
@endsection 
