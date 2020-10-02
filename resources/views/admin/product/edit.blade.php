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
                            <div class="col-3 d-flex justify-content-end"><label for="p_name">Tên SP <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                            <input type="text" value="{{ old("p_name") ? old("p_name") : $product->p_name}}" class="form-control w-100 @error('p_name') is-invalid @enderror" id="p_name" name="p_name" placeholder="Iphone X">
                                @error('p_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" value="{{$product->id}}" class="form-control" id="p_id" name="p_id" >
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="p_title">Tiêu đề SP <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <input type="text" value="{{old("p_title") ? old("p_title") : $product->p_title}}" class="form-control w-100 @error('p_title') is-invalid @enderror" name="p_title" id="p_title" placeholder="Iphone X chính hãng | LTShop.com">
                                @error('p_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="p_category_id">Thuộc DM <span class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <select class="form-control select-category w-100 @error('p_category_id') is-invalid @enderror"  name="p_category_id" id="p_category_id">
                                    <option></option>
                                    @if (old('p_category_id'))
                                        {!!$htmlOption->recursiveCategory(old('p_category_id'))!!}
                                    @else
                                        {!!$htmlOption->recursiveCategory($product->p_category_id)!!}
                                    @endif
                                </select>
                                @error('p_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end"><label for="p_brand_id">Thương Hiệu<span
                                        class=" text-danger">(<sup>*</sup>)</span>:</label></div>
                            <div class="col-9">
                                <select
                                    class="form-control w-75 select-brand "  name="p_brand_id" id="p_brand_id">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}" 
                                                @if (old('p_brand_id') )
                                                    {{(old('p_brand_id')==$brand->id) ? "selected" : ""}}
                                                @else
                                                    {{ ($brand->id == $product->p_brand_id) ? "selected" : ""}}
                                                @endif
                                                >{{$brand->name}}</option>
                                        @endforeach
                                </select>
                                <br>
                                @error('p_brand_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="p_price" class="mr-2">Giá <span class=" text-danger">(<sup>*</sup>)</span>:</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group w-50">
                                    <input type="text" value="{{old("p_price") ? old("p_price") : $product->p_price}}" class="form-control @error('p_price') is-invalid @enderror" id="p_price" name="p_price" placeholder="29.600.000" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">vnđ</span>
                                    </div>
                                </div>
                                @error('p_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="p_sale">Giảm giá:</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group w-50">
                                    <input type="text" value="{{old("p_sale") ? old("p_sale") : $product->p_sale}}" class="form-control" name="p_sale" id="p_sale" placeholder="30" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="p_number">Số Lượng <span class=" text-danger">(<sup>*</sup>)</span>:</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group w-50">
                                    <input type="number" value="{{old("p_number") ? old("p_number") : $product->p_number}}" class="form-control @error('p_number') is-invalid @enderror" name="p_number" id="p_number" placeholder="300">
                                </div>
                                @error('p_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-end">
                                <label for="select2_p_keyword_seo">Từ khóa:</label>
                            </div>
                            <div class="col-9">
                                <select class="form-control select2_p_keyword_seo w-100" multiple="multiple" name="p_keyword_seo[]" id="p_keyword_seo" >
                                    @if (old('p_keyword_seo'))
                                        @foreach (old('p_keyword_seo') as $key=>$value)
                                            <option value="{{$value}}" selected>{{$value}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($product->tags as $tag)
                                            <option value="{{$tag->tg_name}}" selected>{{$tag->tg_name}}</option>  
                                        @endforeach 
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-2"></div>
                            <div class="col-2 d-flex justify-content-center">
                                <label for="p_hot">Sản phẩm hot:</label>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-switch">
                                    <div class="col-9">
                                        <input type="checkbox" class="custom-control-input" id="p_hot" name="p_hot"  {{($product->p_hot == 1)? "checked": ""}}>
                                        <label class="custom-control-label" for="p_hot"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-center">
                                <label for="p_active">Trạng thái hiện:</label>
                            </div>
                            <div class="col-2">
                                <div class="custom-control custom-switch">
                                    <div class="col-9">
                                        <input type="checkbox" class="custom-control-input" name="p_active" id="p_active" {{($product->p_active == 1)? "checked": ""}}>
                                        <label class="custom-control-label" for="p_active"></label>
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
                                            <img class="card-img-top img-thumbnail" src="{{$product->p_avatar}}" style="width: 200px">
                                        </div>
                                        <div class="card-footer d-flex">
                                            <button class="btn btn-secondary ml-auto delete_avatar" data-image-id="" id="delete_avatar" type="button"><i class=" fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group w-100 d-none" id="add_avatar_new">
                                        <label for="p_avatar" class="">Thêm ảnh sp<span class=" text-danger">(<sup>*</sup>)</span>:</label><br>
                                            @error('p_avatar')
                                                <small class="text text-danger ml-2">{{ $message }}</small>
                                            @enderror
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="p_avatar_new" type="file" class="file" name="p_avatar_new">
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
                                                <img class="card-img-top" src="{{$image->path_image}}" alt="Card image cap" style="width:;">
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
                                <label for="p_image_detail_new" class="">Thêm ảnh chi tiết<span class=" text-danger">(<sup>*</sup>)</span>:</label>
                                <br>
                                @error('p_image_detail_new')
                                    <small class="text text-danger ml-2">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="p_image_detail_new" type="file" multiple  class="file" name="p_image_detail_new[]">
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
                                        <tbody id="main_p_technical">
                                            @if ($p_technicals==null)
                                                <tr>
                                                    <td style="width:30%"><input type="text" class="form-control " name="name_p_technical[]"  placeholder="Màn hình"></td>                                           
                                                    <td style="width:70%"><input type="text" class="form-control " name="value_p_technical[]"  placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                </tr>
                                            @else
                                                @for ($i =0 ; $i< count($p_technicals) ;$i++)
                                                    <tr>
                                                    <td style="width:30%"><input type="text" class="form-control " name="name_p_technical[]" value="{{$p_technicals[$i]['name']}}"  placeholder="Màn hình"></td>                                           
                                                    <td style="width:70%"><input type="text" class="form-control " name="value_p_technical[]" value="{{$p_technicals[$i]['value']}}"  placeholder="AMOLED, 6.4in, Full HD+"></td>
                                                    </tr>
                                                @endfor
                                            @endif 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="add_p_technical"> Thêm Thông Số &nbsp;<i
                                            class="fas fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="car card-green  w-100 mt-4">
                            <div class=" card-header">Khuyến mãi</div>
                            <div class=" card-body" id="main_p_promotion">
                                @if ($p_promotion==null)
                                        <input type="text" class="form-control mb-2" name="p_promotion[]" placeholder="Nộ dung khuyến mãi">
                                    @else 
                                        @for ($i =0 ; $i< count($p_promotion) ;$i++)
                                            <input type="text" class="form-control mb-2" name="p_promotion[]" value="{{$p_promotion[$i]['name']}}" placeholder="Nội dung khuyến mãi">
                                        @endfor
                                @endif 
                            </div>
                            <div class=" card-footer">
                                <button type="button" class="btn btn-primary" id="add_p_promotion"> Thêm Khuyến mãi&nbsp;<i
                                            class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
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
@endsection