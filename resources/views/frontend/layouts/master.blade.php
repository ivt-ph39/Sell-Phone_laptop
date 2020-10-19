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
		@yield('css')
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
						@if (Auth::check())
							<li><a href="#" data-toggle="modal" data-target="#loginAccount"><b>Hi</b> {{  Auth::user()->getLastName()}}</a></li>
						@else
							<li><a href="#" data-toggle="modal" data-target="#registerAccount"><i class="fa fa-user-o"></i> Đăng kí</a></li>
							<li><a href="#" data-toggle="modal" data-target="#loginAccount"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
						@endif
						<li class="account"><a href="#" ><i class="fas fa-user-cog"></i> Tài Khoản</a>
							<ul id="account-info" >
								<li><i class="fas fa-sign-out-alt"></i><a href="" id="logoutAccount">Đăng xuất</a></li>
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
										{{-- <div class="qty"></div> --}}
									</a>
									<div class="cart-dropdown">
										{{-- <div class="cart-list">
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
										</div> --}}
										<img src="{{asset('frontend/img/117-1170538_404-your-cart-is-empty.png')}}" width="100%" alt="">
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
						<form id="form-register">
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
						<form action="" method="post" id="form-login">
							<div class="form-group">
							  <input type="email"
								class="form-control" name="u-email" id="u-email" aria-describedby="helpId" placeholder="Email">
							</div>
							<div class="form-group">
							  <input type="password"
								class="form-control" name="u-password" id="u-password" aria-describedby="helpId" placeholder="Mật khẩu">
							</div>
						</form>
					</div>
					<div class="modal-footer ">
						<button type="button" id="submit-login" class="btn btn-primary">Đăng nhập</button>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="{{asset("frontend/js/jquery.min.js")}}"></script>
        <script src="{{asset("frontend/js/bootstrap.min.js")}}"></script>
        <script src="{{asset("owlcarousel/owl.carousel.min.js")}}"></script>
		<script src="{{asset("frontend/js/slick.min.js")}}"></script>
		<script src="{{asset("frontend/js/nouislider.min.js")}}"></script>
		<script src="{{asset("frontend/js/jquery.zoom.min.js")}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{asset("frontend/js/main.js")}}"></script>
		
		<script>
			$(document).ready(function(){
				showCart();
				$(document).on('click','.add',function(e){
					e.preventDefault();
					var quantityCurrent = $(this).prev().val();

					$(this).prev().val( ++quantityCurrent) ;

					var quantity = $(this).prev().val();
					var product_id = $(this).prev().attr('data-id');

					cart = JSON.parse(localStorage.getItem('cart'));

					cartNew = updateProductQuantity(cart,product_id, quantity);

					localStorage.setItem('cart', JSON.stringify(cartNew));
					showCart();
					showCartMini();

				})
				$(document).on('click','.minus',function(e){
					e.preventDefault();
					var quantityCurrent = $(this).next().val();
					if(quantityCurrent <= 1){
						Swal.fire(
						'Sorry !',
						'Số lượng sản phẩm không nhỏ hơn 1?',
						'warning'
						)
					}else{
						$(this).next().val( --quantityCurrent) ;

						var quantity = $(this).next().val()

						var product_id = $(this).next().attr('data-id');

						cart = JSON.parse(localStorage.getItem('cart'));

						cartNew = updateProductQuantity(cart,product_id, quantity);

						localStorage.setItem('cart', JSON.stringify(cartNew));
						showCartMini();
						showCart();
					}
				
				})
				$(document).on('change','#quantity',function(e){
					product_id = $(this).attr('data-id');
					cart = JSON.parse(localStorage.getItem('cart'));

					quantity_old = getQuantityOld(product_id,cart);

					quantity = $(this).val();
					console.log("type"+ typeof(quantity));
					if(quantity < 1){
						Swal.fire(
						'Sorry !',
						'Số lượng sản phẩm không nhỏ hơn 1 !',
						'warning'
						);
						quantity = quantity_old;
					}else if(typeof(quantity) != 'number'){
						Swal.fire(
						'Sorry !',
						'Số lượng sản phẩm phải là 1 số  nguyên!',
						'warning'
						);
						quantity = quantity_old;
					}

					cartNew = updateProductQuantity(cart,product_id,quantity);
					localStorage.setItem('cart', JSON.stringify(cartNew));
					showCart();
					showCartMini();

				})
				$(document).on('click','#delete-item',function(e){
					e.preventDefault();
					Swal.fire({
						title: 'Xóa ?',
						text: "Bạn muốn xóa sản phẩm khỏi giỏ hàng ?",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Xóa',
						cancelButtonText: 'Không',
						}).then((result) => {
						if (result.isConfirmed) {
							Swal.fire(
							'Đã xóa!',
							'Sản phẩm đã được xóa khỏi giỏ hàng.',
							'success'
							)
						}
					})
					product_id = $(this).attr('data-id');
					cart = JSON.parse(localStorage.getItem('cart'));
					cartNew = deleteItem(cart, product_id);
					localStorage.setItem('cart', JSON.stringify(cartNew));
					showCart();
					showCartMini();
				})
			})
			$(document).ready(function(){
				showCartMini();
				$('#submit-register').on('click',function(e){
					e.preventDefault();
					u_name = $('input#u-name').val();
					u_email = $('input#u-email').val();
					u_password = $('input#u-password').val();
					u_password_confirm = $('input#u-password-confirm').val();
					u_address = $('input#u-address').val();
					u_phone = $('input#u-phone').val();
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						$.ajax({
							url  : "{{ route('user_register') }}",
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
									$("#form-register").trigger("reset");
									$('#registerAccount').modal('hide');
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
				})
				$("#submit-login").on('click',function(e){
					e.preventDefault();
					u_email = $('#loginAccount input#u-email').val();
					u_password = $('#loginAccount input#u-password').val();
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					// console.log(u_email, u_password)
					$.ajax({
						url: "{{route('user_login')}}",
						data : {
							'email'		: u_email,
							'password'	: u_password,
						},
						type: 'post',
						success: function(data) {
							if(data.success == true){
								Swal.fire(
								'Xin chúc mừng!',
								'Bạn đã đăng nhập thành công!'
								);
								$("#form-login").trigger("reset");
								$('#loginAccount').modal('hide');
								location.reload();
							};
							if(data.error == true){
								Swal.fire({
								icon: 'error',
								title: 'Đăng nhập thất bại',
								text: 'Email hoặc Password không chính xác !',
								})
							}
							if(data.success){
								console.log(data.user);
							}
						}
					})
				})
				$("#logoutAccount").on('click',function(e){
					e.preventDefault();
					Swal.fire({
					title: 'Bạn muốn đăng xuất ?',
					// text: "You won't be able to revert this!",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Đăng xuất!'
					}).then((result) => {
					if (result.isConfirmed) {

						$.ajax({
							url : "{{route('user_logout')}}",
							type:'get',
							success :function(data){
								console.log(data.success);
							}
						})
						Swal.fire(
						'Thành công',
						'Tài khoảng của bạn đã được đăng xuất.',
						'success'
						)
						location.reload();
					}
					})
				})
			})
				//show sabr phẩm đã chọn trên head
				function showCartMini(){
					dataCart = JSON.parse(localStorage.getItem('cart'));
					htmlCartList = '<div class="cart-list">';
					 if(dataCart == null){
					 	return null;
					 }
					if(dataCart.length != 0){
						total_amount = 0;
						total_item   = 0;
						$.each(dataCart,function(key,item){
							total_amount += item.price_old*item.quantity ;
							total_item   += parseInt(item.quantity);
							

							htmlCartList += '<div class="product-widget">'
												+'<div class="product-img">'
													+'<img src="'+item.image+'" alt="">'
												+'</div>'
												+'<div class="product-body">'
													+'<h3 class="product-name"><a href="#">'+item.name+'</a></h3>'
													+'<h4 class="product-price"><span class="qty">'+item.quantity+' x</span>'+ formatCurrency(item.price_old*item.quantity) +'</h4>'
												+'</div>'
											+'</div>';
						});
						htmlCartList += '</div>';
						
						htmlCart = htmlCartList
								+'<div class="cart-summary">'
									+'<p>Đã mua ('+total_item+') sản phẩm</p>'
									+'<h5>Tổng Tiền: '+formatCurrency(total_amount)+'</h5>'
								+'</div>'
								+'<div class="cart-btns">'
									+'<a href="{{route("cart")}}"> Xem chi tiết  <i class="fa fa-arrow-circle-right"></i></a>'
								+'</div>';
						$('.cart-dropdown').html('');
						$('.cart-dropdown').html(htmlCart);
						$('.dropdown a').append('<div class="qty">'+total_item+'</div>');
					}
				}
				// show sản phẩm ở trang Cart
				function showCart(){
					dataCart = JSON.parse(localStorage.getItem('cart'));

					htmlCart = '';
					console.log(dataCart);
					if(dataCart!= null){
						total_amount = 0;
						$.each(dataCart,function(key,item){
							total_amount += item.price_old*item.quantity ;
							htmlCart +=
								'<tr>'
									+'<th scope="row">'+ ++key +'</th>'
									+'<td><strong>'+ item.name +'</strong></td>'
									+'<td><img class="img-thumbnail" src="'+ item.image +'" style="width: 100px" ></td>'
									+'<td class="price">'+ formatCurrency(item.price_old) +'<sup>đ</sup></td>'
									+'<td>'
										+'<div class="quantity">'
										+'<button class="btn minus"><i class="fas fa-minus"></i></button>'
										+'<input id="quantity"  min="0" value="'+ item.quantity+'" data-id="'+item.id+'" type="number">'
										+'<button class="btn add"><i class="fas fa-plus"></i></button>'
										+'</div>'
									+'</td>'
									+'<td class="price">'+ formatCurrency(item.price_old*item.quantity) +'<sup>đ</sup></td>'
									+'<td class="delete-item" id ="delete-item" data-id="'+item.id+'"><i class="fas fa-trash-alt"></i></td>'
								+'</tr>';
						})
					}else{
						htmlCart = '<tr>'
									+'<td colspan="6" ><h4 class="text text-danger"> Giỏ hàng của bạn đang rỗng</h4>'
										+'<a href = "{{route("home")}}"  class="btn btn-primary">'
											+'Quay về trang chủ'
										+'</a>';
									+'</td></tr>'
						total_amount = 0;
					} 

					$(".total .price").html('');
					$(".total .price").prepend(formatCurrency(total_amount)+'<sup>đ</sup>');

					$('.items_cart').html('');
					$('tbody').prepend(htmlCart);
				}
				//kiểm tra spham đã được add vào giỏ hàng chưa
				
				// format tiền tệ
				function formatCurrency(number){
							number = number.toString();
							var n   = number.split('').reverse().join("");
							var n2  = n.replace(/\d\d\d(?!$)/g, "$&.");    
							var n3  = n2.split('').reverse().join('');
							return  n3;
				}
				// update số lượng sản phẩm
				function updateProductQuantity(cart,product_id,quantity){
					quantity = parseInt(quantity);
					
					var index = checkProductExist(cart,product_id);
					console.log(index,cart,product_id);
					cart[index]['quantity'] = quantity;
					return cart;
				}
				function checkProductExist(cart,product_id){
					console.log(cart,product_id);
					
					for (var i = 0; i < cart.length; i++) {
						if (cart[i]['id'] == product_id){
							return i;
						} else {
							continue;
						}
					};
					return false;
				}
				// xóa sản phẩm ra khỏi giỏ hàng
				function deleteItem(cart, product_id){
					var index = checkProductExist(cart,product_id);
					cart.splice(index,1)
					return cart;
				}
				// lấy số lương sản phẩm trước khi thay đổi
				function getQuantityOld(product_id,cart){
					for (var i = 0; i < cart.length; i++) {
						if (cart[i]['id'] == product_id){
							return cart[i]['quantity'];
						} else {
							continue;
						}
					};
					return false;
				}
				// add spham vào giỏ hàng
				function addToCart(cart,product){
					var index = checkProductExist(cart,product);
					if (index === false){
						cart.push(product);
					} else {
						cart[index]['quantity']++;
					}
					return cart;
				}
		</script>
		@yield('js')

</html>