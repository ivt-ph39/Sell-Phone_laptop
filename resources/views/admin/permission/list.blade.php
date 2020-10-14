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
            <div class="pt-3">
                <h4 class="float-left m-3">{{ $titlePage }}.</h4>
            <a href="{{ route('admin.permission.create', ['parent' => 1]) }}" class="btn btn-outline-success m-3 float-right" ><i class="fas fa-plus-square"></i> Thêm Quyền</a>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên Quyền Cha</th>
                            <th scope="col">Mô tả Quyền</th>
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
                                <td>{{ $permission->parent_id }}</td>
                                <td>
                                    <div class="form-inline">
                                        <a href="{{ route('admin.permission.edit', $permission->id) }}" class="btn btn-sm btn-outline-dark mr-2"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.permission.listChildren', $permission->id) }}" class="btn btn-sm btn-outline-success mr-2"><i class="fas fa-list"></i></a>
                                        <form action="{{ route('admin.permission.delete', $permission->id) }}" method="post">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="far fa-trash-alt"></i></button>
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
