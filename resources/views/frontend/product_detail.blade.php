@extends('frontend.layouts.master')
@section('main')
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{asset("frontend/img/product01.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product03.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product06.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product08.png")}}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="{{asset("frontend/img/product01.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product03.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product06.png")}}" alt="">
							</div>

							<div class="product-preview">
								<img src="{{asset("frontend/img/product08.png")}}" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						{{-- <div class="product-details">
							<h2 class="product-name">product name goes here</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Headphones</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div> --}}
						<div class="product-detail">
							<h4 class="">Điện thoại Samsung Galaxy Note 10+</h4>
							<div class="review">
								<div class="product-rating ">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s)</a>
								<div class="clearfix"></div>
							</div>
							<div class="product-price ">
								<strong>16.490.000<sup>₫</sup></strong><del>17.990.000<sup>₫</sup></del><span>-8%</span>
							</div>
							<div class="product-promotion">
								<strong class="promotion-header">
									Khuyến Mãi
								</strong>
								<div class="promotion-body">
									<span>
										<i class="fas fa-check-circle"></i>Trả góp 0% thẻ tín dụng
									</span>
									<span>
										<i class="fas fa-check-circle"></i>Trả góp 0% thẻ tín dụng
									</span>
									<span>
										<i class="fas fa-check-circle"></i>Trả góp 0% thẻ tín dụng
									</span>
									<span>
										<i class="fas fa-check-circle"></i>Trả góp 0% thẻ tín dụng
									</span>
									<span>
										<i class="fas fa-check-circle"></i>Trả góp 0% thẻ tín dụng
									</span>
								</div>
								
							</div>
							<div class="product-buy">
								<a href="" class=""> Mua Ngay</a>
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
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
								<li>
									<span>Màn hình:</span>
									<div>Dynamic AMOLED, 6.8", Quad HD+ (2K+)</div>
								</li>
							</ul>
							<button type="button" class="view-full-technical"> Xem thêm cấu hình chi tiết</button>
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
									<div class="row add-review ">
										<!-- Review Form -->
										<form class="">
											<h4>Thêm đánh giá của bạn:</h4>
												<div class="col-md-7">
												<div id="review-form">
													<textarea class="input" placeholder="Nhập đánh giá về sản phẩm"></textarea>
												</div>
												</div>
												<div class="col-md-5 review-form">
													<div class="input-rating">
														<span>Đánh giá: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="submit-rating btn" type="button">Gửi</button>
												</div>
										</form>
										<!-- /Review Form -->
									</div>
									<div class="row">
										<!-- Rating -->
											<div class="col-md-3">
												<div id="rating">
													<div class="rating-avg">
														<span>4.5</span>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
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
																<div style="width: 80%;"></div>
															</div>
															<span class="sum">3</span>
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
																<div style="width: 60%;"></div>
															</div>
															<span class="sum">2</span>
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
																<div></div>
															</div>
															<span class="sum">0</span>
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
																<div></div>
															</div>
															<span class="sum">0</span>
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
																<div></div>
															</div>
															<span class="sum">0</span>
														</li>
													</ul>
												</div>
											</div>
										<!-- /Rating -->
										<!-- Reviews -->
											<div class="col-md-9">
												<div id="reviews">
													<ul class="reviews">
														<li>
															<div class="review-heading">
																<h5 class="name">John</h5>
																<p class="date">27 DEC 2018, 8:0 PM</p>
																<div class="review-rating">
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																</div>
															</div>
															<div class="review-body">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
															</div>
														</li>
														<li>
															<div class="review-heading">
																<h5 class="name">John</h5>
																<p class="date">27 DEC 2018, 8:0 PM</p>
																<div class="review-rating">
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																</div>
															</div>
															<div class="review-body">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
															</div>
														</li>
														<li>
															<div class="review-heading">
																<h5 class="name">John</h5>
																<p class="date">27 DEC 2018, 8:0 PM</p>
																<div class="review-rating">
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star-o empty"></i>
																</div>
															</div>
															<div class="review-body">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
															</div>
														</li>
													</ul>
													<ul class="reviews-pagination">
														<li class="active">1</li>
														<li><a href="#">2</a></li>
														<li><a href="#">3</a></li>
														<li><a href="#">4</a></li>
														<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
													</ul>
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
					<div class="col-md-12">
						<div>
							<form action="" method="post">
								<div class="row">
									<div class="col-md-8">
										<h4>Thêm bình luận:</h4>
										<textarea class="user-comment" name="" id=""  rows="5" placeholder="Hãy nhập bình luận của bạn"></textarea>
									</div>
									<div class="col-md-4 info-user ">
										<h4>Thông tin người gửi:</h4>
										<input type="text"  class="form-control" 	name="user_name" 	id="name"  placeholder="Họ và tên (bắt buộc)">
										<input type="email" class="form-control" 	name="user_email" 	id="email"  placeholder="Email">
										<input type="text"  class="form-control" 	name="user_phone" 	id="phone"  placeholder="Số điện thoại">
										<input type="submit" class="btn btn-primary btn-submit " value="Gửi">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-12">
						<span class="total-comment">Có 6.255 bình luận </span>
						<ul class="list-comment">
						<li class="comment_ask" id="">
							<div class="row_user">
								<span>A</span>
								<strong>Lê Hải Anh</strong>
							</div>
							<div class="question">
								Giữa s20+ với note 10+ thì nên chọn sản phẩm nào ạ
							</div>
						</li>
						<li class="comment_ask" id="">
							<div class="row_user">
								<span>A</span>
								<strong>Lê Hải Anh</strong>
							</div>
							<div class="question">
								Giữa s20+ với note 10+ thì nên chọn sản phẩm nào ạ
							</div>
						</li><li class="comment_ask" id="">
							<div class="row_user">
								<span>A</span>
								<strong>Lê Hải Anh</strong>
							</div>
							<div class="question">
								Giữa s20+ với note 10+ thì nên chọn sản phẩm nào ạ
							</div>
						</li>
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
@endsection
@section('js')
    
@endsection