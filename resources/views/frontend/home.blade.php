@extends('frontend.layouts.master')
@extends('frontend.layouts.menu')
@section('main')
		<!-- SECTION SLIDER  and Bender-->
		<div class="section">
			<!-- container -->
			<div class=" container">
				<!-- row -->
				<div class="row slider">
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								@foreach ($sliders as $slider)
									<div class="owl-item d-flex justify-content-center"><img src="{{$slider->path}}" alt=""></div>
								@endforeach
							</div>
						</div>
						<div class="owl-nav">
							<div class="owl-prev"><i class="fas fa-chevron-left "></i></div>
							<div class="owl-next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION SLIDER-->

		<!-- SECTION PRODUCT NEW -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Mới</h3>
							<div class=" section-nav prd-news">
								<ul class="section-tab-nav tab-nav tab-link">
									@foreach ($categories as $category)
										@if ($category->hasChild($category->id))
										@else
											<li class="{{($category->id == 1 ? "active" : "")}}" data-cate="{{$category->id}}"><a href="">{{$category->name}}</a></li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
				</div>
				<!-- /row -->
				@foreach ($productNews as $key => $category)
				<!-- row -->
				<div class="row product-new {{($category->id !=1)? "none" : ""}}"  id={{$category->id}}>
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								<!-- product -->
								@foreach ($category->products as $product)
									<div class="owl-item">
										<div class="product product-store">
											<div class="product-img">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><img src="{{$product->avatar}}" ></a>
												
												<div class="product-label ">
													<span class="new">NEW</span>
													{{-- @if ($product->sale['base'] != 0)
														<span class="sale">{{$product->sale['format']}}</span>
													@endif
													@if ($product->hot['name']=='Nổi bật')
														<span class="new">HOT</span>
													@endif --}}
												</div>
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}">{{$product->name}}</a></h3>
												@if ($product->sale['base'] != 0)
													<h4 class="product-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}<del class="product-old-price">{!!$product->price['format']!!}</del></h4>
												@else
													<h4 class="product-price">{!!$product->price['format']!!}</h4>
												@endif
												<div class="product-rating">
													@php
														for ($i=1; $i <= $product->rating ; $i++) { 
															echo('<i class="fas fa-star"></i>');
														}
														for ($i=1; $i <= (5-(floor(5 - $product->rating) + floor($product->rating))) ; $i++) { 
															echo('<i class="fas fa-star-half-alt"></i>');
														}
														for ($i=1; $i <= floor(5 - $product->rating) ; $i++) { 
															echo('<i class="far fa-star"></i>');
														}    
													@endphp
												</div>
												<div class="product-promotion">
												</div>
											</div>
											<div class="add-to-cart">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
												
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
								<!-- /product -->
							</div>
						</div>
						<div class="owl-nav">
							<div class="owl-prev"><i class="fas fa-chevron-left "></i></div>
							<div class="owl-next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>
				</div>
				<!-- /row -->
				@endforeach
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION TOP HOT-->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Hot Nhất</h3>
							<div class="section-nav top-sell">
								<ul class="section-tab-nav tab-nav tab-link">
									@foreach ($categories as $category)
										@if ($category->hasChild($category->id))
										@else
											<li class="{{($category->id == 1 ? "active" : "")}}" data-cate="{{$category->id}}"><a href="">{{$category->name}}</a></li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
				</div>
				<!-- /row -->
				@foreach ($productHot as $key => $category)
				<!-- row -->
				<div class="row pro-top-sell {{($category->id !=1)? "none" : ""}}"  id={{$category->id}}>
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								<!-- product -->
								@foreach ($category->products as $product)
									<div class="owl-item">
										<div class="product product-store">
											<div class="product-img">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><img src="{{$product->avatar}}" ></a>
												
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
												<h3 class="product-name"><a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}">{{$product->name}}</a></h3>
												@if ($product->sale['base'] != 0)
													<h4 class="product-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}<del class="product-old-price">{!!$product->price['format']!!}</del></h4>
												@else
													<h4 class="product-price">{!!$product->price['format']!!}</h4>
												@endif
												<div class="product-rating">
													@php
														for ($i=1; $i <= $product->rating ; $i++) { 
															echo('<i class="fas fa-star"></i>');
														}
														for ($i=1; $i <= (5-(floor(5 - $product->rating) + floor($product->rating))) ; $i++) { 
															echo('<i class="fas fa-star-half-alt"></i>');
														}
														for ($i=1; $i <= floor(5 - $product->rating) ; $i++) { 
															echo('<i class="far fa-star"></i>');
														}    
													@endphp
												</div>
												<div class="product-promotion">
												</div>
											</div>
											<div class="add-to-cart">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
												
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
								<!-- /product -->
							</div>
						</div>
						<div class="owl-nav">
							<div class="owl-prev"><i class="fas fa-chevron-left "></i></div>
							<div class="owl-next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>
				</div>
				<!-- /row -->
				@endforeach
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION TOP RATING-->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Được Giảm Giá Nhiều Nhât</h3>
							<div class="section-nav top-rating">
								<ul class="section-tab-nav tab-nav tab-link">
									@foreach ($categories as $category)
										@if ($category->hasChild($category->id))
										@else
											<li class="{{($category->id == 1 ? "active" : "")}}" data-cate="{{$category->id}}"><a href="">{{$category->name}}</a></li>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
				</div>
				<!-- /row -->
				@foreach ($productSell as $key => $category)
				<!-- row -->
				<div class="row pro-top-rating {{($category->id !=1)? "none" : ""}}"  id={{$category->id}}>
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								<!-- product -->
								@php
									$a = $key
								@endphp
								@foreach ($category->products as $product)
									<div class="owl-item">
										<div class="product product-store">
											<div class="product-img">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><img src="{{$product->avatar}}" ></a>
												
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
												<h3 class="product-name"><a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}">{{$product->name}}</a></h3>
												@if ($product->sale['base'] != 0)
													<h4 class="product-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}<del class="product-old-price">{!!$product->price['format']!!}</del></h4>
												@else
													<h4 class="product-price">{!!$product->price['format']!!}</h4>
												@endif
												<div class="product-rating">
													@php
														for ($i=1; $i <= $product->rating ; $i++) { 
															echo('<i class="fas fa-star"></i>');
														}
														for ($i=1; $i <= (5-(floor(5 - $product->rating) + floor($product->rating))) ; $i++) { 
															echo('<i class="fas fa-star-half-alt"></i>');
														}
														for ($i=1; $i <= floor(5 - $product->rating) ; $i++) { 
															echo('<i class="far fa-star"></i>');
														}    
													@endphp
												</div>
												<div class="product-promotion">
												</div>
											</div>
											<div class="add-to-cart">
												<a href="{{route('product',['page'=>Str::slug($product->category->name),'productName'=>Str::slug($product->name)])}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
												
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
								<!-- /product -->
							</div>
						</div>
						<div class="owl-nav">
							<div class="owl-prev"><i class="fas fa-chevron-left "></i></div>
							<div class="owl-next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>
				</div>
				<!-- /row -->
				@endforeach
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection
@section('js')
	<script src="frontend/home/home.js"></script>
@endsection
