@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container">
        @if (empty($permissionChildren))
            <h4>No Data.</h4>
        @else

            <div class="pt-3">
                @if (\Session::has('message'))
                    <div class="alert alert-primary message" role="alert">
                        {!! \Session::get('message') !!}
                    </div>
                @endif
                <h4 class="float-left m-3">{{ $titlePage }} <strong
                        class="text-purple">{{ $permissionParent->name }}</strong> </h4>
                <a href="{{ route('admin.permission.create', ['parent' => 0]) }}"
                    class="btn btn-outline-success m-3 float-right"><i class="fas fa-plus-square"></i> Thêm Quyền</a>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên Quyền</th>
                            <th scope="col">Mô tả Quyền</th>
                            <th scope="col">Key code</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày chỉnh sửa</th>
                            <th scope="col">ParentID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissionChildren as $permission)
                            <tr>
                                <th>{{ $permission->id }}</th>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->keycode }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                                <td>{{ $permission->parent_id }}</td>
                                <td>
                                    <div class="form-inline">
                                        <a title="Chỉnh sửa quyền" href="{{ route('admin.permission.edit', $permission->id) }}"
                                            class="btn btn-sm btn-outline-dark mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.permission.deleteChildren', $permission->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Xóa quyền" class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa??')"><i
                                                    class="far fa-trash-alt" ></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permissionChildren->links() }}
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
