<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		{{-- <base href="{{asset("")}}"> --}}
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset("frontend/css/bootstrap.min.css")}}"/>
		<!-- Owlcarousel -->
		<link rel="stylesheet" href="{{asset("owlcarousel/assets/owl.carousel.min.css")}}">
		<link rel="stylesheet" href="{{asset("owlcarousel/assets/owl.theme.default.min.css")}}">
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset("frontend/css/slick.css")}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset("frontend/css/slick-theme.css")}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{asset("frontend/css/nouislider.min.css")}}"/>

		<!-- Font Awesome Icon -->
  		<link rel="stylesheet" href="{{asset("adminlte/plugins/fontawesome-free/css/all.min.css")}}">
		<link rel="stylesheet" href="{{asset("frontend/css/font-awesome.min.css")}}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{asset("frontend/css/style.css")}}"/>
    </head>
    <body>
    	<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#" data-toggle="modal" data-target="#registerAccount"><i class="fa fa-user-o"></i> Đăng kí</a></li>
						<li><a href="#" data-toggle="modal" data-target="#loginAccount"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
						<li class="account"><a href="#" ><i class="fas fa-user-cog"></i> Tài Khoản</a>
								<ul id="account-info" >
									<li><i class="fas fa-sign-out-alt"></i><a href="">Đăng xuất</a></li>
									<li><i class="fas fa-user-cog"></i><a href="">Quản lí tài khoản</a></li>	
								</ul>
						</li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="{{asset("frontend/img/logo.png")}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<input class="form-control" placeholder="Tìm kiếm sản phẩm theo tên...">
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Cart -->
								<div class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="{{asset("frontend/img/product01.png")}}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="{{asset("frontend/img/product02.png")}}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
											</div>
										</div>
										<div class="cart-summary">
											<p>Đã mua (4) sản phẩm</p>
											<h5>Tổng Tiền: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">Xem chi tiết  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

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
		<!-- Modal Register-->
		<div class="modal fade" id="registerAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Đăng Kí Tài khoản</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form >
							<div class="form-group">
							  <input type="text"
								class="form-control" name="u-name" id="u-name" aria-describedby="helpId" placeholder="Họ và tên">
								<small class="error" id="err_name"></small>
							</div>
							<div class="form-group">
							  <input type="email"
								class="form-control" name="u-email" id="u-email" aria-describedby="helpId" placeholder="Email : abc@gmail.com">
								<small class="error" id="err_email"></small>

							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<input type="password" class="form-control" name="u-password" id="u-password" placeholder="Mật Khẩu">
									<small class="error" id="err_password"></small>
								</div>
								<div class="col-md-6 form-group">
									<input type="password" class="form-control" name="u-password-confirm" id="u-password-confirm" placeholder="Nhập lại mật khẩu">
									<small class="error" id="err_password_confirm"></small>
								</div>
							</div>
							<div class="form-group">
							  <input type="text"
								class="form-control" name="u-address" id="u-address" aria-describedby="helpId" placeholder="Địa chỉ">
								<small class="error" id="err_address"></small>

							</div>
							<div class="form-group">
							  <input type="text"
								class="form-control" name="u-phone" id="u-phone" aria-describedby="helpId" placeholder="Số điện thoại">
								<small class="error" id="err_phone"></small>

							</div>
						</form>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-primary" id="submit-register">Đăng kí</button>
					</div>
					</div>
			</div>
		</div>
		<!-- end Modal Register-->
		<!-- Modal Login-->
		<div class="modal fade" id="loginAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Đăng Nhập</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="post">
							<div class="form-group">
							  <input type="email"
								class="form-control" name="u-email" id="" aria-describedby="helpId" placeholder="Email">
							</div>
							<div class="form-group">
							  <input type="password"
								class="form-control" name="u-password" id="" aria-describedby="helpId" placeholder="Mật khẩu">
							</div>
						</form>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-primary">Đăng nhập</button>
					</div>
					</div>
				</div>
			</div>
			<!-- end Modal Login-->
    @yield('main')
    </body>
	<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
	<!-- jQuery Plugins -->
		<script src="{{asset("frontend/js/jquery.min.js")}}"></script>
        <script src="{{asset("frontend/js/bootstrap.min.js")}}"></script>
        <script src="{{asset("owlcarousel/owl.carousel.min.js")}}"></script>
		<script src="{{asset("frontend/js/slick.min.js")}}"></script>
		<script src="{{asset("frontend/js/nouislider.min.js")}}"></script>
		<script src="{{asset("frontend/js/jquery.zoom.min.js")}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{asset("frontend/js/main.js")}}"></script>
		@yield('js')
		<script>
			$(document).ready(function(){
				$('#submit-register').on('click',function(e){
					e.preventDefault();
					u_name = $('input#u-name').val();
					u_email = $('input#u-email').val();
					u_password = $('input#u-password').val();
					u_password_confirm = $('input#u-password-confirm').val();
					u_address = $('input#u-address').val();
					u_phone = $('input#u-phone').val();
					console.log(u_password, u_password_confirm);
					// validateErr = isRequired('input#u-name','Họ và tên') + isRequired('input#u-email','Email') + isEmail('input#u-email') + isRequired('input#u-password','Mật khẩu') + isRequired('input#u-address','Địa chỉ') +isRequired('input#u-phone','Số điện thoại');

					// if(validateErr == 0){
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						$.ajax({
							url  : "{{ route('user_login') }}",
							data : {
								'name'		: u_name,
								'email'		: u_email,
								'password'	: u_password,
								'password_confirm' : u_password_confirm,
								'address'	: u_address,
								'phone'		: u_phone
							},
							type: 'post',
							success: function(data){
								if(data.success == true){
									Swal.fire(
									'Xin chúc mừng!',
									'Bạn đã tạo tài khoảng thành công!'
									);
								}
								if(data.error == true){
									if(data.message.name){
										$('#err_name').text(data.message.name[0])
									}else{
										$('#err_name').text('')
									}
									if(data.message.email){
										$('#err_email').text(data.message.email[0])
									}else{
										$('#err_email').text('')
									}
									if(data.message.password){
										$('#err_password').text(data.message.password[0])
									}else{
										$('#err_password').text('')
									}
									if(data.message.password_confirm){
										$('#err_password_confirm').text(data.message.password_confirm[0])
									}else{
										$('#err_password_confirm').text('')
									}
									if(data.message.address){
										$('#err_address').text(data.message.address[0])
									}else{
										$('#err_address').text('')
									}
									if(data.message.phone){
										$('#err_phone').text(data.message.phone[0])
									}else{
										$('#err_phone').text('')
									}
								}
							}
						})
					// }
				})
				function isRequired(value,nameField){
					if($(value).val() == ''){
						$(value).siblings().text(nameField +' không được để trống');
						return 1;
					}else{
						$(value).siblings().text('');
						return 0;
					}
				}
				function isEmail(value) {
					if(isRequired(value,'Email') == 0){
						email = $(value).val();
						var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						if(!regex.test(email)) {
							$(value).siblings().text('Email không hợp lệ');
							return 1;
						}else{
							$(value).siblings().text('');
							return 0;
						}
					}return 0;
				}
			})
		</script>
</html>