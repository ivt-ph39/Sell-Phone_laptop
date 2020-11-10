@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container">
        @if (!isset($roles))
            <h4>No Data.</h4>
            <a href="{{ route('admin.role.create') }}" class="btn btn-outline-success"><i class="fas fa-plus-square"></i>
                Thêm vai trò</a>
        @else
            @if (\Session::has('message'))
                <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <div class="pt-3">
                <h4 class="float-left">{{ $titlePage }}.</h4>
                <a href="{{ route('admin.role.create') }}" class="btn btn-outline-success float-right"><i
                        class="fas fa-plus-square"></i> Thêm vai trò</a>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên Vai Trò</th>
                            <th scope="col">Mô tả Vai trò</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày chỉnh sửa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th>{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    <div class="form-inline">
                                        <a href="{{ route('admin.role.edit', $role->id) }}"
                                            class="btn btn-sm btn-outline-dark mr-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.role.delete', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Bạn có muốn xóa vai trò này không???')" title="Xoa vai tro" class="btn btn-sm btn-outline-danger" type="submit"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
