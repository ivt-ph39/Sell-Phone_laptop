@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="admins/product/create/css/app.css">
    <link href="{{ asset('bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet"
        type="text/css" />

@endsection
@section('main')
    <div class="container-fluid pt-5">
        <div class="text-center">
            @if (session('error'))
                <p class=" alert alert-danger"> {{ session('error') }}</p>
            @endif
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $titlePage }}</h3>
            </div>
            <form role="form" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 border-right border-dark ">
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end"><label for="name">Tên SP <span
                                            class=" text-danger">(<sup>*</sup>)</span>:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" value="{{ old('name') }}"
                                        class="form-control w-75 @error('name') is-invalid @enderror" id="name" name="name"
                                        placeholder="Iphone X">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end"><label for="title">Tiêu đề SP <span
                                            class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                                <div class="col-9">
                                    <input type="text" value="{{ old('title') }}"
                                        class="form-control w-75 @error('title') is-invalid @enderror" name="title"
                                        id="title" placeholder="Iphone X chính hãng | LTShop.com">
                                    @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end"><label for="category_id">Thuộc DM <span
                                            class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                                <div class="col-9">
                                    <select
                                        class="form-control w-75 select2-category @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                        <option></option>
                                        @if (old('category_id'))
                                            {!! $htmlOption->recursiveCategory(old('category_id')) !!}
                                        @else
                                            {!! $htmlOption->recursiveCategory('') !!}
                                        @endif
                                    </select>
                                    <br>
                                    @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end"><label for="brand_id">Thương Hiệu<span
                                            class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                                <div class="col-9">
                                    <select class="form-control w-75 select2-brand " name="brand_id" id="brand_id">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @error('brand_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4 ">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="price" class="mr-2">Giá <span
                                            class=" text-danger">(<sup>*</sup>)</span>:</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group w-50">
                                        <input type="text" value="{{ old('price') }}"
                                            class="form-control @error('price') is-invalid @enderror" id="price"
                                            name="price" placeholder="29600000" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">vnđ</span>
                                        </div>
                                    </div>
                                    @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="sale">Giảm giá:</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group w-50">
                                        <input type="number" value="{{ old('sale') }}" class="form-control" name="sale"
                                            id="sale" placeholder="30" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="quantity">Số Lượng <span class=" text-danger">(<sup>*</sup>)</span>:</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group w-50">
                                        <input type="quantity" value="{{ old('quantity') }}"
                                            class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                            id="quantity" placeholder="300">
                                    </div>
                                    @error('number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="tag">Từ khóa<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control select2_tag w-100  " multiple="multiple" name="tag[]"
                                        id="tag">
                                        @if (old('tag'))
                                            @foreach (old('tag') as $key => $value)
                                                <option value="{{ $value }}" selected>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('tag')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4 d-flex justify-content-end">
                                    <label for="hot">Sản phẩm hot:</label>
                                </div>
                                <div class="col-8">
                                    <div class="custom-control custom-switch">
                                        <div class="col-9">
                                            <input type="checkbox" class="custom-control-input" id="hot" name="hot"
                                                @if (old('hot')) {{ 'checked' }} </beautify
                                                end="   @endif">>
                                            <label class="custom-control-label" for="hot"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-4 d-flex justify-content-end">
                                    <label for="active">Trạng thái hiện:</label>
                                </div>
                                <div class="col-8">
                                    <div class="custom-control custom-switch">
                                        <div class="col-9">
                                            <input type="checkbox" class="custom-control-input" name="active" id="active"
                                                @if (old('active')) {{ 'checked' }} </beautify
                                                end="   @endif">>
                                            <label class="custom-control-label" for="active"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="form-group w-100">
                                <label for="avatar" class="">Ảnh SP<span
                                        class=" text-danger">(<sup>*</sup>)</span>:</label><br>
                                @error('avatar')
                                <small class="text text-danger ml-2">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="avatar" type="file" class="file" name="avatar">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group w-100">
                                <label for="image_detail" class="">Ảnh Chi Tiết<span
                                        class=" text-danger">(<sup>*</sup>)</span>:</label>
                                <br>
                                @error('image_detail')
                                <small class="text text-danger ml-2">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="image_detail" type="file" multiple class="file" name="image_detail[]">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex justify-content-center ">
                                <div class="card card-dark w-100 mt-4">
                                    <div class="card-header">
                                        Thông Số Kĩ Thuật
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th> Thống Số</th>
                                                    <th>Giá trị</th>
                                                </tr>
                                            </thead>
                                            <tbody id="main_technical">
                                                @if (old('name_technical') == null)
                                                    <tr>
                                                        <td style="width: 30%"><input type="text" class="form-control "
                                                                name="name_technical[]" placeholder="Màn hình"></td>
                                                        <td style="width: 70%"><input type="text" class="form-control "
                                                                name="value_technical[]"
                                                                placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                    </tr>
                                                @else
                                                    @for ($i = 0; $i < count(old('name_technical')); $i++)
                                                        <tr>
                                                            <td style="width: 30%"><input type="text" class="form-control "
                                                                    name="name_technical[]"
                                                                    value="{{ old('name_technical')[$i] }}"
                                                                    placeholder="Màn hình">
                                                            </td>
                                                            <td style="width: 70%"><input type="text" class="form-control "
                                                                    name="value_technical[]"
                                                                    value="{{ old('value_technical')[$i] }}"
                                                                    placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                        </tr>
                                                    @endfor
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" id="add_technical"> Thêm Thông Số
                                            &nbsp;<i class="fas fa-plus-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="car card-green  w-100 mt-4">
                                <div class=" card-header">Khuyến mãi</div>
                                <div class=" card-body" id="main_promotion">
                                    @if (old('promotion') == null)
                                        <input type="text" class="form-control mb-2" name="promotion[]"
                                            placeholder="Nộ dung khuyến mãi">
                                    @else
                                        @for ($i = 0; $i < count(old('promotion')); $i++)
                                            <input type="text" class="form-control mb-2" name="promotion[]"
                                                value="{{ old('promotion')[$i] }}" placeholder="Nộ dung khuyến mãi">
                                        @endfor
                                    @endif
                                </div>
                                <div class=" card-footer">
                                    <button type="button" class="btn btn-primary" id="add_promotion"> Thêm Khuyến
                                        mãi&nbsp;<i class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center">

                    <button type="submit" class="btn btn-danger">Tạo Sản Phẩm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')

    <!-- Select2 -->
    <script src="https://kit.fontawesome.com/8a60c16813.js" crossorigin="anonymous"></script>

    <script src="{{ asset('bootstrap-fileinput/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

    <script src="adminlte/plugins/select2/js/select2.min.js"></script>


    <script src="admins/product/create/js/app.js"></script>

    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script src="{{ asset('editors/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                ckfinder: {
                    uploadUrl: '/editors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                }
            })
            .catch(function(error) {
                console.error(error);
            });
    </script>

@endsection
