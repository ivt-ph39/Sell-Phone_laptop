@extends('layouts.masterAdmin')
@section('title')
{{$titlePage}}
@endsection
@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">
    <link href="{{asset('bootstrap-fileinput/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset('bootstrap-fileinput/themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="admins/product/edit/css/app.css">
@endsection
@section('main')
<div class="container-fluid pt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$titlePage}}</h3>
        </div>
        <form role="form" action="{{route('admin.product.update',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6 border-right border-dark ">
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="name">Tên SP <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                            <input type="text" value="{{ old("name") ? old("name") : $product->name}}" class="form-control w-100 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Iphone X">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" value="{{$product->id}}" class="form-control" id="id" name="id" >
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="title">Tiêu đề SP <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <input type="text" value="{{old("title") ? old("title") : $product->title}}" class="form-control w-100 @error('title') is-invalid @enderror" name="title" id="title" placeholder="Iphone X chính hãng | LTShop.com">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="category_id">Thuộc DM <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <select class="form-control select-category w-100 @error('category_id') is-invalid @enderror"  name="category_id" id="category_id">
                                    <option></option>
                                    @if (old('category_id'))
                                        {!!$htmlOption->recursiveCategory(old('category_id'))!!}
                                    @else
                                        {!!$htmlOption->recursiveCategory($product->category_id)!!}
                                    @endif
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="brand_id">Thương Hiệu<span
                                        class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <select
                                    class="form-control w-75 select-brand "  name="brand_id" id="brand_id">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}" 
                                                @if (old('brand_id') )
                                                    {{(old('brand_id')==$brand->id) ? "selected" : ""}}
                                                @else
                                                    {{ ($brand->id == $product->brand_id) ? "selected" : ""}}
                                                @endif
                                                >{{$brand->name}}</option>
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
                                <label for="price" class="mr-2">Giá <span class=" text-danger">(<sup>*</sup>)</span>:</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group w-50">
                                    <input type="text" value="{{old("price") ? old("price") : $product->price['base']}}" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="29.600.000" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">vnđ</span>
                                    </div>
                                </div>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                         
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="sale">Giảm giá:</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group w-50">
                                    <input type="text" value="{{old("sale") ? old("sale") : $product->sale['base']}}" class="form-control" name="sale" id="sale" placeholder="30" aria-label="Username" aria-describedby="basic-addon1">
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
                                    <input type="number" value="{{old("quantity") ? old("quantity") : $product->quantity}}" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" placeholder="300">
                                </div>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="tag">Từ khóa:</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control select2_tag w-100" multiple="multiple" name="tag[]" id="tag" >
                                    @if (old('tag'))
                                        @foreach (old('tag') as $key=>$value)
                                            <option value="{{$value}}" selected>{{$value}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($product->tags as $tag)
                                            <option value="{{$tag->name}}" selected>{{$tag->name}}</option>  
                                        @endforeach 
                                    @endif
                                </select>
                                @error('tag')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="row mt-4">
                            <div class="col-2"></div>
                            <div class="col-2 d-flex justify-content-center">
                                <label for="hot">Sản phẩm hot:</label>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-switch">
                                    <div class="col-9">
                                        <input type="checkbox" class="custom-control-input" id="hot" name="hot"{{($product->hot['name'] == "Nổi bật")? "checked": ""}}>
                                        <label class="custom-control-label" for="hot"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center">
                                <label for="active">Trạng thái hiện:</label>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-switch">
                                    <div class="col-9">
                                        <input type="checkbox" class="custom-control-input" name="active" id="active" {{($product->active['name'] == "public")? "checked": ""}}>
                                        <label class="custom-control-label" for="active"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mt-4 d-flex justify-content-center">
                            <div class="card" style="width: 20rem;">
                                <div class="card-header bg-cyan">
                                    Avatar Sản phẩm:
                                </div>
                                <div class="card m-2 d-flex justify-content-center " >
                                    <div  id="show_avatar_old">
                                        <div class="card-body" >
                                            <img class="card-img-top img-thumbnail" src="{{$product->avatar}}" style="width: 200px">
                                        </div>
                                        <div class="card-footer d-flex">
                                            <button class="btn btn-secondary ml-auto delete_avatar" data-image-id="" id="delete_avatar" type="button"><i class=" fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group w-100 d-none" id="add_avatar_new">
                                        <label for="avatar" class="">Thêm ảnh sp<span class=" text-danger">(<sup>*</sup>)</span>:</label><br>
                                            @error('avatar')
                                                <small class="text text-danger ml-2">{{ $message }}</small>
                                            @enderror
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="avatar_new" type="file" class="file" name="avatar_new">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="card show_img_detail">
                            <div class="card-header bg-success">
                                Ảnh Chi Tiết (<span id="count_img_detail" data-count_img_detail="{{$product->images->count()}}">{{$product->images->count()}}</span> Ảnh)
                            </div>
                            <div class="row">
                                @if ($product->images)
                                    @foreach ($product->images as $image)
                                        <div class="card m-2" style="width: 12rem;">
                                            <div class="card-body">
                                                <img class="card-img-top" src="{{$image->path}}" alt="Card image cap" style="width:;">
                                            </div>
                                            <div class="card-footer d-flex">
                                                <button class="btn btn-secondary ml-auto delete_img_detail bg-aqua" data-image-id="{{$image->id}}"  type="button"><i class=" fas fa-trash-alt"></i></button>
                                            </div>
                                            <input type="hidden" value="{{$image->id}}" name="images_no_delete[]">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" class=" btn btn-primary"  id="btn-add-images">Thêm ảnh: <i class="fas fa-folder-plus"></i></button>
                        </div>
                        <div class="row mt-3 " id="add-images" style="display: none">
                            <div class="form-group w-100">
                                <label for="image_detail_new" class="">Thêm ảnh chi tiết<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                                <br>
                                @error('image_detail_new')
                                    <small class="text text-danger ml-2">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="image_detail_new" type="file" multiple  class="file" name="image_detail_new[]">
                                    </div>
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
                                            @if ($technical==null)
                                                <tr>
                                                    <td style="width:30%"><input type="text" class="form-control " name="name_technical[]"  placeholder="Màn hình"></td>                                           
                                                    <td style="width:70%"><input type="text" class="form-control " name="value_technical[]"  placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                </tr>
                                            @else
                                                @for ($i =0 ; $i< count($technical) ;$i++)
                                                    <tr>
                                                    <td style="width:30%"><input type="text" class="form-control " name="name_technical[]" value="{{$technical[$i]['name']}}"  placeholder="Màn hình"></td>                                           
                                                    <td style="width:70%"><input type="text" class="form-control " name="value_technical[]" value="{{$technical[$i]['value']}}"  placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                    </tr>
                                                @endfor
                                            @endif 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="add_technical"> Thêm Thông Số &nbsp;<i
                                            class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="car card-green  w-100 mt-4">
                            <div class=" card-header">Khuyến mãi</div>
                            <div class=" card-body" id="main_promotion">
                                @if ($promotion==null)
                                        <input type="text" class="form-control mb-2" name="promotion[]" placeholder="Nộ dung khuyến mãi">
                                    @else 
                                        @for ($i =0 ; $i< count($promotion) ;$i++)
                                            <input type="text" class="form-control mb-2" name="promotion[]" value="{{$promotion[$i]['name']}}" placeholder="Nội dung khuyến mãi">
                                        @endfor
                                @endif 
                            </div>
                            <div class=" card-footer">
                                <button type="button" class="btn btn-primary" id="add_promotion"> Thêm Khuyến mãi&nbsp;<i
                                            class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="width: 700px;margin: auto; margin-top:20px">
                    <h4>Đặc điểm nổi bật :</h4>
                    <textarea class="form-control" id="summary-ckeditor" name="description" cols="30" rows="20">{{ $product->description }}</textarea>
                    {{-- <textarea name="description" id="editor1" cols="30" rows="10" value="{{ $product->description }}">{{ $product->description }}</textarea> --}}
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer d-flex justify-content-center">
                @if (session('error_update'))
                    <small class="text text-danger ml-2">{{ session('error_update') }}</small>
                @endif
                <button type="submit" class="btn btn-danger" style="width:20%" >  Lưu  </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="https://kit.fontawesome.com/8a60c16813.js" crossorigin="anonymous"></script>
    
    <script src="{{asset('bootstrap-fileinput/js/plugins/piexif.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/js/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/js/locales/fr.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/themes/fas/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('bootstrap-fileinput/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

    <script src="adminlte/plugins/select2/js/select2.min.js"></script>
    <script src="admins/product/edit/js/app.js"></script>

    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    </script>
@endsection