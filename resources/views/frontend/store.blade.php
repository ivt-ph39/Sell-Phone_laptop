@extends('frontend.layouts.master')
@section('menu')
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
@endsection
@section('main')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        {{-- <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Categories</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li class="active">Headphones (227,490 Results)</li>
                </ul>
            </div>
        </div> --}}
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<!-- Filter -->
	<div class="filter">
		<div class="container">
        	<div class="filter-brand">
				@foreach ($brands as $brand)
					<a href="{{request()->fullUrlWithQuery(['brand'=>Str::slug($brand->name)])}}" class=" "><img src="{{asset($brand->avatar)}}"></a>
				@endforeach
			</div>
			<div class="filter-price">
						<label>Chọn mức giá: </label>
							<a href="{{request()->fullUrlWithQuery(['price' => 'duoi-2-trieu'])}}" class=" " >
							Dưới 2 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-2-4-trieu'])}}" class=" " >
							Từ 2 - 4 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-4-7-trieu'])}}" class=" " >
							Từ 4 - 7 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tu-7-13-trieu'])}}" class=" " >
							Từ 7 - 13 triệu
						</a>
							<a href="{{request()->fullUrlWithQuery(['price' => 'tren-13-trieu'])}}" class=" " >
							Trên 13 triệu
						</a>
						<div class="store-sort">
						<form action="" method="get" id="orderBy">
								<label>
								Sắp Xếp:
								<select class="input-select" name="orderBy">
									<option value="defaul">Giá từ thấp nhất</option>
									<option value="price_max">Giá từ cao nhất</option>
									<option value="top_sell">Mua nhiều nhất </option>
									<option value="top_rating">Đánh giá cao nhất</option>
								</select>
								@foreach ($_GET as $key =>$value)
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
                                <a href="{{route('product',['page'=>$page, 'productName'=> Str::slug($product->name) ])}}"><img src="{{asset($product->avatar)}}"></a>
                                {{-- <img src="{{asset($product->avatar)}}"> --}}
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
                                <h3 class="product-name"><a href="{{route('product',['page'=>$page, 'productName'=> Str::slug($product->name) ])}}">{{$product->name}}</a></h3>
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
                                
                                <a href="{{route('product',['page'=>$page, 'productName'=> Str::slug($product->name) ])}}">
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
                    <span class="store-qty">Hiện 12/ {{$count}} sản phẩm</span>
                    <div class=" text-center">
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