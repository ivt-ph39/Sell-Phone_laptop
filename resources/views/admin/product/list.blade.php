@extends('layouts.masterAdmin')
@section('title')
{{$titlePage}}
@endsection
@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="adminlte/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="admins/product/list/css/app.css">
@endsection
@section('main')
<div class=" container-fluid ">
    @if (!isset($products)||empty($products))
    <h4>Không có dữ liệu.</h4>
    <a href="{{route('admin.product.create')}}" class="btn btn-primary">Thêm Sản Phẩm</a>
    @else
    <div class="row pt-4 mb-4">
        <form class=" mr-auto form-inline" method="get" action="{{route('admin.product.list')}}">
            <div class="input-group pl-2 pr-2" style="width: 370px">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category" >Danh Mục</label>
                </div>
                <select class="form-control select-category custom-select " id="category" name="category">
                    <option></option>
                    {!!$htmlOption!!}
                </select>
            </div>
            <div class="input-group input-group">
                <input class="form-control form-control-navbar" type="search" name="p_name" placeholder="Tên sản phẩm"
                    aria-label="Search" value='{{($request->p_name != null)?"$request->p_name":""}}'>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="{{route('admin.product.create')}}" class="btn btn-primary  ml-auto mr-2">Thêm Sản Phẩm<i class="fas fa-plus-circle ml-1"></i></a>
    </div>
    <h4 class=" text-danger mb-3">{{$titlePage}}:</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead >
                <tr >
                    <th>TT</th>
                    <th style="">Tên Sản Phẩm</th>
                    <th>Danh mục</th>
                    <th>Ảnh</th>
                    <th>SL còn lại</th>
                    <th>Hot</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                <tr>
                    <th>{{$key+1}}</th>
                    <td style="width: 25%"><b>{{$product->p_name}}</b></>
                        <ul class="mb-0">
                            <li><b>ID: </b>{{$product->id}}</li>
                            <li><b>Giá: </b>{{$product->formatPrice($product->p_price)}}</li>
                            <li><b>Sale: </b>{{$product->formatSale($product->p_sale)}}</li>
                        </ul>
                    </td>
                    <td>
                        {{$product->category->c_name}}
                    </td>
                    <td>
                        <img src="{{$product->p_avatar}}" alt="" style="height: 100px">
                    </td>
                    <td>{{$product->p_number}}</td>
                    <td><a href=""
                            class="badge {{$product->getHot($product->p_hot)['class']}}">{{$product->getHot($product->p_hot)['name']}}</a>
                    </td>
                    <td><a href=""
                            class="badge {{$product->getActive($product->p_active)['class']}}">{{$product->getActive($product->p_active)['name']}}</a>
                    </td>
                    <td>
                        <a href="{{route('admin.product.edit',['id'=>$product->id])}}"
                            class="badge badge-primary mr-1 ml-1">Edit</a>
                        <a href="{{route('admin.product.delete',['id'=>$product->id])}}"
                            class="badge badge-danger mr-1 ml-1">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="d-flex justify-content-center">{!!$products->appends(['category'=>$request->category,'p_name'=>$request->p_name])->links()!!}</div>
</div>
@endsection
@section('js')
    <!-- Select2 -->
    <script src="adminlte/plugins/select2/js/select2.min.js"></script>
    <script src="admins/product/list/js/app.js"></script>
@endsection