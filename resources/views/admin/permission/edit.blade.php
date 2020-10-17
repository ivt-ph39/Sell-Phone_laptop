@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="pt-3">
        <h4 class="m-3">{{ $titlePage }}.</h4>
    </div>
    <div class="container">
        <div class="content">
            <div class="row">
                {{-- quyen cha --}}
                @if ($flagParent)
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-lightblue">
                                <div class="card-title"><i class="fas fa-user-tie"></i> <strong>Cập Nhập Quyền Cha</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.permission.updateParent', $permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Tên quyền</label>
                                        <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
                                        @if ($errors->has('name'))
                                            <span style="color: red">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả quyền</label>
                                        <textarea type="text" name="description" value="{{ $permission->description }}"
                                            class="form-control">{{ $permission->description }}</textarea>
                                        @if ($errors->has('name'))
                                            <span style="color: red">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- quyen con --}}
                    <div class="col">
                        <div class="card">
                            <div class="card-header bg-purple">
                                <div class="card-title"><i class="fas fa-child"></i> Thêm Quyền Con</div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.permission.updateChildren', $permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Tên quyền</label>
                                        <input type="text" name="name" value="{{ $permission->name }}" class="form-control"
                                            required>
                                        @if ($errors->has('name'))
                                            <span style="color: red">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả quyền</label>
                                        <input type="text" name="description" value="{{ $permission->description }}"
                                            class="form-control" required>
                                        @if ($errors->has('description'))
                                            <span style="color: red">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Key code</label>
                                        <input type="text" name="keycode" value="{{ $permission->keycode }}"
                                            placeholder="Ex: role_list" class="form-control" required>
                                        @if ($errors->has('keycode'))
                                            <span style="color: red">{{ $errors->first('keycode') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Chọn quyền cha</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="">----Choose your children----</option>
                                            @foreach ($permissionParents as $per)
                                                <option value="{{ $per->id }}"
                                                    {{ $permission->parent_id == $per->id ? 'selected' : '' }}>
                                                    {{ $per->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-sm btn-outline-warning">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
