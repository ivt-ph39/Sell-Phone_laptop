@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container">
        <h1>Update User</h1>
             
        <form action="{{ route('admin.user.update', $user->id) }}" class="w-50" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $user->name }}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" disabled class="form-control">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id[]" class="selectpicker form-control"  multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $roleChecked->contains('id', $role->id) ? 'selected' : ' ' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $('select').selectpicker();
        });
    </script>
@endsection
