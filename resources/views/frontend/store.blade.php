@extends('frontend.layouts.master')
@section('menu')
    @isset($categories)
        <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
					<li class="{{(!isset($page)? "active" : "")}}"><a href="{{route('home')}}">Trang chủ</a></li>
						<ul class="cate-nav main-nav nav navbar-nav">
							@foreach ($categories as $category)
							<li class="{{($category->hasChild($category->id) != false ) ? "hassub" : ""}} {{( isset($page) && Str::slug($category->name)== $page) ? "active" :""}}" ><a href="{{route('store',['page'=>Str::slug($category->name)])}}">{{$category->name}}</a>
									@if ($category->hasChild($category->id))
										<ul class="cate-child nav navbar-nav">
											@foreach ($category->hasChild($category->id) as $category)
												<li><a href="{{route('store',['page'=>Str::slug($category->name)])}}">{{$category->name}}</a></li>
											@endforeach
										</ul>
									@endif
								</li>
							@endforeach
						</ul>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
	    <!-- /NAVIGATION -->
    @endisset
@endsection
@section('main')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<!-- Filter -->
	<div class="filter">
		<div class="container">
        	@isset($brands)
            <div class="filter-brand">
				@foreach ($brands as $brand)
					<a href="{{url()->current().'?'.'brand='.Str::slug($brand->name)}}" class=" "><img src="{{asset($brand->avatar)}}"></a>
				@endforeach
			</div>
            @endisset
            @isset($listCategory)
            <div class="total_result">
                <p>Tìm thấy <strong>{{$products->total()}}</strong> kết quả</p>
                <div class="category_result">
                    @foreach ($listCategory as $category)
                <a href="{{url()->current().'?search='.request()->search.'&category='.Str::slug($category->category->name)}}" class="{{ (request()->category == Str::slug($category->category->name))? "category_active" : ""}}" >{{$category->category->name}} ({{$category->count}})</a>
                    @endforeach
                </div>
            </div> 
            @endisset
			        <div class="filter-price">
						<label>Chọn mức giá: </label>
							<a href="{{request()->fullUrlWithQuery(['price' => 'duoi-2-trieu'])}}"  class="{{(request()->price == 'duoi-2-trieu') ? 'price_active' : "" }} " >
							Dưới 2 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-2-4-trieu'])}}" class="{{(request()->price == 'tu-2-4-trieu') ? 'price_active' : "" }}  " >
							Từ 2 - 4 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-4-7-trieu'])}}" class="{{(request()->price == 'tu-4-7-trieu') ? 'price_active' : "" }}  " >
							Từ 4 - 7 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-7-13-trieu'])}}" class="{{(request()->price == 'tu-7-13-trieu') ? 'price_active' : "" }}  " >
							Từ 7 - 13 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tren-13-trieu'])}}" class="{{(request()->price == 'tren-13-trieu') ? 'price_active' : "" }}   " >
							Trên 13 triệu
						</a>
						<div class="store-sort">
                            <form action="{{request()->fullUrl()}}" method="get" id="orderBy">
                                    <label>Sắp Xếp:
                                    <select class="input-select" name="orderBy">
                                        <option  value="price_min" {{(request()->orderBy == 'price_min')? "selected" : ""}}>Giá từ thấp nhất</option>
                                        <option value="price_max" {{(request()->orderBy == 'price_max')? "selected" : ""}}>Giá từ cao nhất</option>
                                        <option value="top_sell" {{(request()->orderBy == 'top_sell')? "selected" : ""}}>Mua nhiều nhất </option>
                                        <option value="top_rating" {{(request()->orderBy == 'top_rating')? "selected" : ""}}>Đánh giá cao nhất</option>
                                    </select>
                                    @foreach (request()->except('orderBy') as $key =>$value)
                                        <input type="hidden" value="{{$value}}" name="{{$key}}">
                                    @endforeach
                                </label>
                            </form>
						</div>
                    </div>
		</div>
    </div>
<!-- /filter -->
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- STORE -->
            <div id="store" class="col-md-12">
                <!-- store top filter -->
                
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="product product-store">
                            <div class="product-img">
                                <a href="{{route('product',['productName'=> Str::slug($product->name) ])}}"><img src="{{asset($product->avatar)}}"></a>
                                <div class="product-label ">
                                    @if ($product->sale['base'] != 0)
                                    <span class="sale">{{$product->sale['format']}}</span>
                                    @endif
                                    @if ($product->hot['name']=='Nổi bật')
                                    <span class="new">HOT</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-body">
                                <h3 class="product-name"><a href="{{route('product',['productName'=> Str::slug($product->name) ])}}">{{$product->name}}</a></h3>
                                @if ($product->sale['base'] != 0)
                                <h4 class="product-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}<sup class="text text-danger">đ</sup><del
                                        class="product-old-price">{!!$product->price['format']!!}</del>
                                </h4>
                                @else
                                <h4 class="product-price">{!!$product->price['format']!!}</h4>
                                @endif
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <div class="product-promotion">
                                </div>
                            </div>
                            <div class="add-to-cart">
                                
                                <a href="{{route('product',[ 'productName'=> Str::slug($product->name) ])}}">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Mua Ngay</button></a>
                            </div>
                            <div class="promotion">
                                @if ($product->promotion)
                                <p><b>Quà: </b>
                                    @foreach (json_decode($product->promotion, true) as $content)
                                    {{ucfirst($content['name']) }},
                                    @endforeach
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- /store products -->
                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <span class="store-qty">Hiện <strong>{{$products->count()}}/ {{$products->total()}}</strong> sản phẩm</span>
                            <div class=" text-center">
                            @if ($products->lastPage() ==1)
                            <div class=" text-center">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">‹</span></li>
                                        <li class="page-item active" aria-disabled="true" aria-current="page"><span class="page-link">1</span></li>
                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">›</span></li>
                                    </ul>
                                </nav>
                            </div>
                            @endif
                            {{ $products->withQueryString()->links() }}
                            </div>
                    </div>
                    <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection
@section('js')
<script>
	$(document).ready(function(){
		$('.input-select').change(function(){
			$('form#orderBy').submit();
		})
	})
</script>
@endsection