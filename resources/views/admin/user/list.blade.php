@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container p-3">
        @if (!isset($users))
            <h4>No Data.</h4>
        @else
            @if(\Session::has('message'))
                 <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!} 
                </div>
            @endif
            <div class="row mb-3">
                <h4 class=" col-5">{{ $titlePage }}.</h4>
                <div class="col">
                    @isset($trashed)
                        @if (!$trashed)
                            <form action="{{ route('admin.user.list') }}" method="get" class="form-inline">
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="search" placeholder="(*)Search name">
                                    <div class="input-group-append">
                                        <button title="Tìm kiếm nhân viên theo tên" class="btn btn-outline-success" type="submit"><i
                                                class="fas fa-search-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endisset
                </div>
                <div class="form-inline col">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-child"></i> Thêm User</a>
                    @isset($trashed)
                        @if ($trashed)
                            <a href="{{ route('admin.user.list') }}" class="btn btn-primary"><i class="far fa-list-alt"></i>
                                Danh sách hệ thống</a>
                        @else
                            <a href="{{ route('admin.user.onlyTrashed') }}" class="btn btn-warning"><i
                                    class="fas fa-list-ul" ></i> Danh sách đã xóa</a>
                        @endif
                    @endisset
                </div>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày chỉnh sửa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user) 
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>
                                    @foreach ($user->roles()->get() as $role)
                                        <span class="badge badge-pill badge-secondary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <div class="form-inline">
                                        @isset($trashed)
                                            @if (!$trashed)
                                                <a title="Chỉnh sửa vai trò cho nhân viên" href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-sm btn-outline-primary mr-1"><i
                                                        class="fas fa-user-edit"></i></a>
                                                <form action="{{ route('admin.user.delete', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button title="Xóa mềm một người dùng" onclick="return confirm('Bạn có chắc muốn xóa nhân viên không??')" class="btn btn-sm btn-outline-danger"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            @else
                                                <a onclick="return confirm('Bạn có chắc muốn restore không??')" href="{{ route('admin.user.restore', $user->id) }}" title="Restore nhân viên đã được xóa" class="btn btn-sm btn-outline-success"><i class="fas fa-trash-restore"></i></a>
                                            <form action="{{ route('admin.user.hardDelete', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Xóa cứng nhân viên" class="btn btn-sm btn-outline-danger ml-2" onclick="return confirm('Bạn có chắc muốn xóa hoàn toàn không??')"><i class="fas fa-user-slash"></i></button>
                                            </form>
                                            @endif
                                        @endisset
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
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