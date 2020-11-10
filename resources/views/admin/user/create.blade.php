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
                    <div class="card ">
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label>Họ tên</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                            >
                                        @if ($errors->has('name'))
                                            <span style="color: #e23d63;"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                            >
                                        @if ($errors->has('email'))
                                            <span style="color: #e23d63;"> {{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" >
                                        @if ($errors->has('password'))
                                            <span style="color: #e23d63;"> {{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label>Nhập lại mật khẩu</label>
                                        <input type="password" name="password_confirmation" class="form-control" >
                                        @if ($errors->has('password'))
                                            <span style="color: #e23d63;"> {{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <textarea type="text" name="address" class="form-control" ></textarea>
                                    @if ($errors->has('address'))
                                        <span style="color: #e23d63;"> {{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò</label>
                                    <select name="role_id" class="form-control">
                                        <option value="">---- Chọn vai trò cho nhân viên ----</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span style="color: #e23d63;"> {{ $errors->first('role_id') }}</span>
                                    @endif
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-outline-info"><i class="fas fa-plus"></i> Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
