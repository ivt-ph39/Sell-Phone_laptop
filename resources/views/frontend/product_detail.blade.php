@extends('frontend.layouts.master')
@section('css')
	<style>
		.sub_comment{
			margin-left: 7%;
		}
	</style>
@endsection
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
	@if (isset($product))
    <!-- SECTION -->
		<div class="section" id="product_id" data-product-id="{{$product->id}}">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-7">
						<div class="product-image">
							<div class="owl-carousel owl-theme owl-loaded">
								<div class="owl-stage-outer">
									<div class="owl-stage">
											<div class="owl-item item-image">
												<img   src="{{asset("$product->avatar")}}" alt=""  >
											</div>
										@foreach ($product->images as $image)
											<div class="owl-item item-image">
												<img   src="{{asset("$image->path")}}" alt=""  >
											</div>
										@endforeach
									</div>
								</div>
								<div class="owl-dots">
										<div class="owl-dot active">
											<img src="{{asset("$product->avatar")}}" alt="">
										</div>
									@foreach ($product->images as $image)
										<div class="owl-dot">
											<img src="{{asset("$image->path")}}" alt="">
										</div>
									@endforeach
								</div>
							</div>
						</div>
					<!-- /Product thumb imgs -->
					</div>
					<!-- /Product main img -->
					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-detail">
							<h4 class="">{{$product->name}}</h4>
							<div class="review">
								<div class="product-rating ">
									@if ($star_product['average'] !=0 )
										@for ($i = 1; $i < $star_product['average']; $i++)
											<i class="fas fa-star"></i>
										@endfor
										@if ((5 - $star_product['average']) > 0)
											<i class="fas fa-star-half-alt"></i>
										@else
											<i class="far fa-star"></i>
										@endif
									@else
										<i class="far fa-star"></i>
										<i class="far fa-star"></i>
										<i class="far fa-star"></i>
										<i class="far fa-star"></i>
										<i class="far fa-star"></i>
									@endif
									
								</div>
								<a class="review-link" href="#"> {{$total_rating}} (Đánh giá)</a>
								<div class="clearfix"></div>
							</div>
							<div class="product-price ">
								@if ($product->sale['base']== 0)
									<strong>{!!$product->price['format']!!}</strong>
								@else
									<strong>{{number_format($product->price['base']*(100-$product->sale['base'])/100, 0, '.', ',')}}<sup>đ</sup></strong><del>{!!$product->price['format']!!}</del><span> -{{$product->sale['format']}}</span>
								@endif
							</div>
							<div class="product-promotion">
								<strong class="promotion-header">
									Khuyến Mãi
								</strong>
								<div class="promotion-body">
									@foreach (json_decode($product->promotion) as $promotion)
										<span>
											<i class="fas fa-check-circle"></i> {{$promotion->name}}
										</span>
									@endforeach
								</div>
							</div>
							<div class="product-buy">
								<a href="" id="addToCart" data-id="{{$product->id}}" data-name="{{$product->name}}"  data-price-old="{{$product->price['base']}}" data-sale="{{$product->sale['base']}}"  data-price-new="{{$product->price['base']*(100-$product->sale['base'])/100}}" data-image="{{$product->avatar}}" data-quantity={{$product->quantity}}> Mua Ngay</a>
							</div>
						</div>
					</div>
					<!-- /Product details -->
				</div>
				<hr>
				<div class="row">
					<div class="col-md-7">
						<div class="desciption">
							<p>Đặc điểm nổi bật của</p>
							<div class="content"></div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="technical">
							<p>Thông số kĩ thuật</p>
							<ul class="technical-detail">
								@foreach (json_decode($product->technical) as $technical)
									<li>
										<span>{{$technical->name}}:</span>
										<div>{{$technical->value}}</div>
									</li>
								@endforeach
							</ul>
							{{-- <button type="button" class="view-full-technical"> Xem thêm cấu hình chi tiết</button> --}}
						</div>
					</div>
				</div>
				<hr>
				<!-- /row -->
				<div class="row">
					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab content -->
							<div class="tab-content">
								@if (Auth::check())
								<div class="row add-review ">
									<!-- AddReview Form -->
									<form class="rating">
										<h4>Thêm đánh giá của bạn:</h4>
											<div class="col-md-7">
											<div id="review-form">
												<textarea class="input" id="content_rating" placeholder="Nhập đánh giá về sản phẩm"></textarea>
												<small class="error" id="error_content_rating"></small>
											</div>
											</div>
											<div class="col-md-5 review-form">
												<div class="input-rating">
													<span>Đánh giá: </span>
													<div class="stars" id="stars">
														<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
													</div>
													<small class="error" id="error_start_rating"></small>
												</div>
												<button class="submit-rating btn" id="submit_rating" data-id="{{(Auth::check()) ? Auth::user()->id : '' }}" type="button">Gửi</button>
											</div>
									</form>
									<!-- AddReview Form -->
								</div>	
								@endif
									<div class="row">
										<!-- Rating -->
											<div class="col-md-3">
												<div id="rating">
													<div class="rating-avg">
														@if ($star_product['average'] != 0 )
															<span>{{$star_product['average']}}</span>
															<div class="rating-stars">
																@for ($i = 1; $i < $star_product['average']; $i++)
																	<i class="fas fa-star"></i>
																@endfor
																@if ((5 - $star_product['average']) > 0)
																	<i class="fas fa-star-half-alt"></i>
																@else
																	<i class="far fa-star"></i>
																@endif
															</div>
														@else
															<span>0</span>
															<div class="rating-stars">
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
															</div>
														@endif
														
													</div>
													<ul class="rating">
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{$star_product['5-star'][1]}}%;"></div>
															</div>
															<span class="sum">{{$star_product['5-star'][0]}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{$star_product['4-star'][1]}}%;"></div>
															</div>
															<span class="sum">{{$star_product['4-star'][0]}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{$star_product['3-star'][1]}}%;"></div>
															</div>
															<span class="sum">{{$star_product['3-star'][0]}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{$star_product['2-star'][1]}}%;"></div>
															</div>
															<span class="sum">{{$star_product['2-star'][0]}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{$star_product['1-star'][1]}}%;"></div>
															</div>
															<span class="sum">{{$star_product['1-star'][0]}}</span>
														</li>
													</ul>
												</div>
											</div>
										<!-- /Rating -->
										<!-- Reviews -->
											<div class="col-md-9">
												<div id="reviews">
													@if ($total_rating > 0)
														<ul class="reviews">
															@foreach ($ratings as $rating)
																<li>
																	<div class="review-heading">
																		<h5 class="name">{{$rating->user->name}} </h5>
																		<p class="date">{{$rating->created_at}} </p>
																		<div class="review-rating">
																			@for ($i = 0; $i < $rating->star; $i++)
																				<i class="fa fa-star"></i>
																			@endfor
																			@for ($i = 0; $i < (5-$rating->star); $i++)
																				<i class="fa fa-star-o empty"></i>
																			@endfor
																		</div>
																	</div>
																	<div class="review-body">
																		<p>{{$rating->content}}</p>
																	</div>
																</li>
															@endforeach
														</ul>
													@else
														<p> Sản phẩm chưa có đánh giá nào.</p>
													@endif
													
												</div>
											</div>
										<!-- /Reviews -->
									</div>
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
					
				</div>
				<hr>
				<div class="row comment">
					<div class="col-md-12 ">
							<div class="row add-comment">
								<div class="col-md-10 textarea_comment">
									<h4>Thêm bình luận:</h4>
									<textarea class="user-comment" name="" id="textarea"  rows="5" placeholder="Hãy nhập bình luận của bạn"></textarea>
									<small class="error_comment">Vui lòng nhập nội dung</small>
									<input type="button" class="btn btn-primary btn-submit"  data-checkLogin="{{(Auth::check()) ? 1 :0 }}" data-id="{{(Auth::check()) ? Auth::user()->id : '' }}" value="Gửi">
								</div>
								<!-- Modal -->
								<div class="modal fade" id="userComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h4>Thông tin người gửi:</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form id="form-info-comment">
												<div class="form-group">
													<input type="text"  class="form-control" 	name="user_name" 	id="user_name"   placeholder="Họ và tên (bắt buộc)">
													<small class="error" id="error_name"></small>
												</div>
												<div class="form-group">
													<input type="email" class="form-control" 	name="user_email" 	id="user_email"  placeholder="Email">
													<small class="error" id="error_email"></small>
												</div>
												<div class="form-group">
													<input type="text"  class="form-control" 	name="user_phone" 	id="user_phone"  placeholder="Số điện thoại">
													<small class="error" id="error_phone"></small>
												</div>
											</form>
											<p class="error" id="vaildate_form"></p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" id="submit_comment_no_acc">Gửi</button>
										</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-12">
						<span class="total-comment">Có {{$total_comment}} bình luận </span>
						<ul class="list-comment">
							@foreach ($comments as $comment)
								<li class="comment_ask" id="">
									<div class="row_user">
										<span>{{$comment->getCharFirstLastName($comment->name)}}</span>
										<strong>{{$comment->name}}</strong>
									</div>
									<div class="question">
										{{$comment->content}}
									</div>
									<div class="reply">
										<a  href="" class="respondent">Trả lời</a>
										<a  class="time"> 1 ngay</a>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
					
				</div>
			</div>
			<!-- /container -->
		</div>
    <!-- /SECTION -->
	<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<hr>
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản Phẩm Liên Quan</h3>
						</div>
					</div>

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product product-store">
							<div class="product-img">
                                <a href="">
								    <img src="{{asset("https://didongviet.vn/pub/media/catalog/product/i/p/iphone-11-128gb-chinh-hang_1.jpg")}}" alt="">
                                </a>
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product product-store">
							<div class="product-img">
                                <a href="">
								<img src="{{asset("frontend/img/product02.png")}}" alt="">

                                </a>
								<div class="product-label">
									<span class="new">NEW</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product product-store">
							<div class="product-img">
                                <a href="">
								<img src="{{asset("frontend/img/product03.png")}}" alt="">

                                </a>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product product-store">
							<div class="product-img">
                                <a href="">
								<img src="{{asset("frontend/img/product04.png")}}" alt="">
                                </a>
                            </div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
							</div>
						</div>
					</div>
					<!-- /product -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
	<!-- /Section -->
	@else
	
	@endif
@endsection
@section('js')
    <script>
		$(document).ready(function(){
			let product_id = $("#product_id").attr('data-product-id') ;
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			// submit comment
			$(".textarea_comment #textarea").focus(function(){
				$(".textarea_comment input").css('display','block');
				$(".textarea_comment input").on('click',function(e){
					if($(".textarea_comment #textarea").val() == ''){
						$(".textarea_comment small").show();
					}else{
						$(".textarea_comment small").hide();
						let contentComment = $(".textarea_comment #textarea").val();
						
						if($(this).attr('data-checkLogin') == 1 ){
						 	let	user_id = $(this).attr('data-id');
							$.ajax({
								url : "{{route('comment_store')}}",
								data: {
									'id' : user_id,
									'content' : contentComment,
									'product_id': product_id,
									},
								type: 'post',
								success: function(data){
									name 	= data.dataComment['name'];
									content = data.dataComment['content'];
									id 		= data.dataComment['id'];
									htmlComment = 	'<li class="comment_ask" id="" data-id="'+id+'">'
											+'<div class="row_user">'
													+'<span>'+name.split("")[0].toUpperCase()+'</span>'
														+'<strong>'+name+'</strong>'
														+'</div>'
														+'<div class="question">'
															+content
														+'</div>'
													+'</li>';
									$(".list-comment").prepend(htmlComment);
									$(".textarea_comment #textarea").val('');
								}	
							})

						}else{
							$('#userComment').modal('show');
							$('#submit_comment_no_acc').on('click',function(){
								let	user_name  = $('#user_name').val();
								let	user_email = $('#user_email').val();
								let	user_phone = $('#user_phone').val();
								if(user_name == "" || user_email == "" || user_phone == ""){
									$("#vaildate_form").text('Các trường phía trên cần được nhập đầy đủ') 
								}else if(!isEmail(user_email)){
									$("#vaildate_form").text('Trường Email bạn nhập không đúng định dạng') 
								}else{
									$("#vaildate_form").text(''); 
									$.ajax({
										url : "{{route('comment_store')}}",
										data: {
											'name' : user_name,
											'email' : user_email,
											'phone' : user_phone,
											'content' : contentComment,
											'product_id': product_id,
										},
										type: 'post',
										success: function(data){
											name 	= data.dataComment['name'];
											content = data.dataComment['content'];
											id 		= data.dataComment['id'];
											htmlComment = 	'<li class="comment_ask" id="" data-id="'+id+'">'
																+'<div class="row_user">'
																	+'<span>'+name.split("")[0].toUpperCase()+'</span>'
																	+'<strong>'+name+'</strong>'
																+'</div>'
																+'<div class="question">'
																	+content
																+'</div>'
															+'</li>';
											$(".list-comment").prepend(htmlComment);
											$("form#form-info-comment").trigger("reset");
											$(".textarea_comment #textarea").val('');
											$('#userComment').modal('hide');
										}	
									})
								}
							})
							
						}
					}

				})
			});
			let star ;
			$(".input-rating .stars input").on('click',function(){
				star  = $(this).val();
			})
			// submit rating
			$("#submit_rating").on('click',function(e){
				e.preventDefault();
				let content = $("#content_rating").val();
				let user_id = $(this).attr('data-id');
				if(content == '' ){
					$("#error_content_rating").text('Vui lòng nhập nội dung');
				}else if(star == undefined ){
					$("#error_start_rating").text('Vui lòng đánh giá số sao');
				}else{
					$("#error_content_rating").text('');
					$("#error_start_rating").text('');
					
					$.ajax({
						url: "{{route('rating_store')}}",
						data: {
							'user_id' 	 : user_id,
							'product_id' : product_id,
							'star' 		 : star,
							'content' 	 : content,
						},
						type: 'post',
						success : function(data){

							htmlStar = '' ;
							for(i=0;i<data.rating['star']; i++){
								htmlStar += '<i class="fa fa-star"></i>'
							}
							if((5 - data.rating['star']) > 0){
								for(i=0;i < (5 - data.rating['star']); i++){
								htmlStar += '<i class="fa fa-star-o empty"></i>'
							}
							htmlContentRating = 
							'<li>'
								+'<div class="review-heading">'
									+'<h5 class="name">'+ data.rating['name_user'] +'</h5>'
									+'<p class="date">'+data.rating['date']+'</p>'
									+'<div class="review-rating">'
										+htmlStar
									+'</div>'
								+'</div>'
								+'<div class="review-body">'
									+'<p>'+data.rating['content']+'</p>'
								+'</div>'
							+'</li>';
							$(".reviews").prepend(htmlContentRating);
						}
					}
					});
				}
			})	
			function isEmail(email) {
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return regex.test(email);
			}
			// show avatar and images product
			$('.product-image .owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				autoplay: false,
				autoplayHoverPause: true,
				dots:false,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 1
					},
					1000: {
						items: 1
					}
			}
			})
			owl = $('.product-image .owl-carousel')
			$('.product-image .owl-carousel .owl-dots .owl-dot').click(function () {
				owl.trigger('to.owl.carousel', [$(this).index(), 300]);
				$('.product-image .owl-carousel .owl-dots .owl-dot').removeClass('active')
				$(this).addClass('active')
			})
			// ADD TO CART
			if(JSON.parse(localStorage.getItem('cart'))) {
				cart= JSON.parse(localStorage.getItem('cart'));
			} else {
				var cart=[];
			};
			//add sự kiện add cart
			$('#addToCart').click(function(e){
				e.preventDefault();
				var product = {id: $(this).attr('data-id'),
							name: $(this).attr('data-name'), 
							price_old: $(this).attr('data-price-old'),
							price_new: $(this).attr('data-price-new'),
							sale: $(this).attr('data-sale'),
							image:$(this).attr('data-image'), 
							remain_quantity : $(this).attr('data-quantity'), 
							quantity: 1};

				if(cart.length){ // giỏ hàng có spham
					//add sp vào giỏ hàng
					cart = addToCart(cart,product['id']);
					localStorage.setItem('cart', JSON.stringify(cart));
				} else { // giỏ hàng chưa có spham
					cart.push(product) ; // add spham vào giỏ hàng
					//lưu giỏ hàng vào localstorage
					localStorage.setItem('cart', JSON.stringify(cart));
				}
				window.location="{{route('cart')}}";
			});
		})
				
	</script>

@endsection