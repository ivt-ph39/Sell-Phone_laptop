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
        {{--  <button class="btn btn-sm mt-3 ml-4 btn-outline-primary" onclick="back()"><i class="fas fa-backward"></i> Back on Page</button>  --}}
            <div class="row">
                    {{-- create parent --}}
                    @if ($parent)
                        <div class="col">
                            <div class="card">
                                <div class="card-header bg-lightblue">
                                    <div class="card-title"><i class="fas fa-user-tie"></i> <strong>Thêm Quyền Cha</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.permission.storeParent') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên quyền</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <span style="color: red" >{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả quyền</label>
                                            <textarea type="text" name="description" value="{{ old('description') }}" class="form-control" required></textarea>
                                            @if ($errors->has('description'))
                                                <span style="color: red" >{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- create children --}}
                        <div class="col">
                            <div class="card">
                                <div class="card-header bg-purple">
                                    <div class="card-title"><i class="fas fa-child"></i> Thêm Quyền Con</div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.permission.storeChildren') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên quyền</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <span style="color: red" >{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả quyền</label>
                                            <input type="text" name="description" value="{{ old('description') }}" class="form-control" required>
                                            @if ($errors->has('description'))
                                                <span style="color: red" >{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Key code</label>
                                            <input type="text" name="keycode" value="{{ old('keycode') }}" placeholder="ex: 'list_user'" class="form-control" required>
                                            @if ($errors->has('keycode'))
                                                <span style="color: red" >{{ $errors->first('keycode') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Chọn quyền cha</label>
                                            <select name="parent_id" class="form-control" required>
                                                <option value="">----Choose your children----</option>
                                                @foreach ($permissionParents as $per)
                                                    <option value="{{ $per->id }}">
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
