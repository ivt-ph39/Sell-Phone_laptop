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
                {{-- create children --}}
                <div class="col">
                    <div class="card w-75">
                        <div class="card-header bg-maroon">
                            <div class="card-title"><i class="fas fa-child"></i> Thêm Người Dùng</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label><span class="text-red">(*)</span> Full Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label><span class="text-red">(*)</span> Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-col">
                                        <label><span class="text-red">(*)</span> Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea type="text" name="address" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò</label>
                                    <select name="role_id" class="form-control">
                                        <option value="">----Choose role for user----</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-outline-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
