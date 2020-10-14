@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('main')
    <div class="container">
        <div class="pt-3">
            <h4 class="float-left">{{ $titlePage }}.</h4>
        </div>
        <div class="content mt-5">
            <form action="{{ route('admin.role.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Tên vai trò</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Mô tả vai trò</label>
                    <textarea type="text" name="description" class="form-control"></textarea>
                </div>
                <div class="card mb-3 bg-success">
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input checkbox_wrapper" id="check_all">
                            <label class="custom-control-label" for="check_all">Check
                                All Module</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    {{-- checkbox permission --}}
                    @foreach ($permissionParents as $perParent)
                        <div class="col-6">
                            <div class="card bg-light ">
                                <div class="card-header bg-primary text-white">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox_wrapper"
                                            id="chk_all{{ $perParent->id }}">
                                        <label class="custom-control-label" for="chk_all{{ $perParent->id }}">Check
                                            All</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Module {{ $perParent->description }}</h5><br>
                                    @foreach ($perParent->permissionChildren as $perChildren)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkbox_children"
                                                id="chk_child{{ $perChildren->id }}" name="permission_id[]"
                                                value="{{ $perChildren->id }}">
                                            <label class="custom-control-label"
                                                for="chk_child{{ $perChildren->id }}">{{ $perChildren->name }} </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- end checkbox --}}

                </div>
                <button type="submit" class="btn btn-primary">Create Role</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#check_all').on('click', function() {
                $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
                $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
            });

            $('.checkbox_wrapper').on('click', function() {
                $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
            });
        });

    </script>
@endsection
