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
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-lightblue"><div class="card-title"><i class="fas fa-user-tie"></i> <strong>Thêm Quyền Cha</strong></div></div>
                        <div class="card-body">
                            <form action="{{ route('admin.permission.storeParent') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tên quyền</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả quyền</label>
                                    <textarea type="text" name="description" class="form-control"></textarea>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-purple"><div class="card-title"><i class="fas fa-child"></i> Thêm Quyền Con</div></div>
                        <div class="card-body">
                            <form action="{{ route('admin.permission.storeChildren') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tên quyền</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả quyền</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Key code</label>
                                    <input type="text" name="keycode" placeholder="Ex: role_list" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Chọn quyền cha</label>
                                    <select name="parent_id"  class="form-control">
                                        <option value="">----Choose your children----</option>
                                       @foreach ($permissionParents as $per)
                                           <option value="{{ $per->id }}">{{ $per->name }}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-outline-warning">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
