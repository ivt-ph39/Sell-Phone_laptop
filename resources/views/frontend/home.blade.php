@extends('frontend.layouts.master')
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
									<li class="{{($category->id == 1 ? "active" : "")}}" data-cate="{{$category->id}}"><a href="">{{$category->name}}</a></li>
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
				<div class="row product-new {{($key !='phones')? "none" : ""}}"  id={{$category[1]}}>
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								<!-- product -->
								@foreach ($category[0] as $product)
									<div class="owl-item">
										<div class="product">
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
													<h4 class="product-price">{!!$product->price['format']!!}<del class="product-old-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}</del></h4>
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
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
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

		<!-- SECTION TOP SELL-->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Bán Chạy Nhất</h3>
							<div class="section-nav top-sell">
								<ul class="section-tab-nav tab-nav tab-link">
									@foreach ($categories as $category)
									<li class="{{($category->id == 1 ? "active" : "")}}" data-cate="{{$category->id}}"><a href="">{{$category->name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
				</div>
				<!-- /row -->
				@foreach ($productTopSell as $key => $category)
				<!-- row -->
				<div class="row pro-top-sell {{($key !='phones')? "none" : ""}}"  id={{$category[1]}}>
					<div class="owl-carousel owl-theme owl-loaded">
						<div class="owl-stage-outer">
							<div class="owl-stage">
								<!-- product -->
								@foreach ($category[0] as $product)
									<div class="owl-item">
										<div class="product">
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
													<h4 class="product-price">{!!$product->price['format']!!}<del class="product-old-price">{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}</del></h4>
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
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product07.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product08.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product09.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product01.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product02.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product03.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product04.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product05.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product06.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product07.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product08.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product09.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product01.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product02.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product03.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>

							<div>
								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product04.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product05.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- /product widget -->

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img">
										<img src="frontend//img/product06.png" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">product name goes here</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
								<!-- product widget -->
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		{{-- <div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div> --}}
		<!-- /NEWSLETTER -->
@endsection
@section('js')
	<script src="frontend/home/home.js"></script>
@endsection
