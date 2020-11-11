<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro</title>
		<base href="{{asset('')}}">

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
						@isset($contacts)
							@foreach ($contacts as $contact)
								<li><a href="#"><i class="{{$contact->icon}}"></i> {{$contact->content}}</a></li>
							@endforeach
						@endisset
						{{-- <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li> --}}
					</ul>
					<ul class="header-links pull-right">
						@if (Auth::check())
							<li><a href="#" data-toggle="modal" data-target="#loginAccount"><b style="color: #d10024">Hi </b> {{  Auth::user()->getLastName()}}</a></li>
							<li class="account"><a href="#" ><i class="fas fa-user-cog"></i> Tài Khoản</a>
							<ul id="account-info" >
								<li><i class="fas fa-sign-out-alt"></i><a href="" id="logoutAccount">Đăng xuất</a></li>
								<li><i class="fas fa-user-cog"></i><a href="{{route('user_account')}}">Quản lí tài khoản</a></li>	
							</ul>
						</li>
						@else
							<li><a href="#" data-toggle="modal" data-target="#registerAccount"><i class="fa fa-user-o"></i> Đăng kí</a></li>
							<li><a href="#" data-toggle="modal" data-target="#loginAccount"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
						@endif
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
								<a href="{{route('home')}}" class="logo">
									<img src="{{asset("frontend/img/logo.png")}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
 							<div class="header-search">
							 	<form method="get" action="{{route('search_product_list')}}" id="formSearch">
									<div class="input-group form-search">
									<input class="typeahead form-control search-input" name="search" placeholder="Tìm kiếm sản phẩm theo tên..." value="{{ app('request')->input('search') }}">
										<div class="input-group-addon" id="submit_search"><i class="fas fa-search"></i></div>
									</div>
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
									</a>
									<div class="cart-dropdown">
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

	@yield('menu')
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
		<script src="{{asset("frontend/js/main.js")}}"></script>
		@yield('js')
		<script>
			$(document).ready(function(){
				
				showCart();
				$(document).on('click','.add',function(e){
					e.preventDefault();
					var quantityCurrent = $(this).prev().val();
					var product_id = $(this).prev().attr('data-id');
					var remain_quantity = $(this).prev().attr('data-remain');
					if(quantityCurrent > (remain_quantity-1)){
						Swal.fire(
						'Sorry !',
						'Sản phẩm này của cửa hàng không đủ '+ (parseInt(quantityCurrent) +1) +' sản phẩm',
						'warning'
						)
					}else{
						$(this).prev().val(++quantityCurrent) ;
						var quantity = $(this).prev().val();
						cart = JSON.parse(localStorage.getItem('cart'));

						cartNew = updateProductQuantity(cart,product_id, quantity);

						localStorage.setItem('cart', JSON.stringify(cartNew));
					}
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
					var remain_quantity = $(this).attr('data-remain');
					console.log(remain_quantity);
					quantity_old = getQuantityOld(product_id,cart);

					quantity = $(this).val();
					if(quantity < 1){
						Swal.fire(
						'Sorry !',
						'Số lượng sản phẩm không nhỏ hơn 1 !',
						'warning'
						);
						quantity = quantity_old;
					}else if(parseInt(quantity) == NaN){
						Swal.fire(
						'Sorry !',
						'Số lượng sản phẩm phải là 1 số  nguyên!',
						'warning'
						);
						quantity = quantity_old;
					}else if(quantity > remain_quantity){
						Swal.fire(
						'Sorry !',
						'Sản phẩm này của cửa hàng chỉ còn lại '+ (parseInt(remain_quantity)) +' sản phẩm',
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
						}
					})
				})
				$("#logoutAccount").on('click',function(e){
					e.preventDefault();
					Swal.fire({
					title: 'Bạn muốn đăng xuất ?',
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
						window.location="{{route('home')}}";
					}
					})
				})
			})
			$(document).ready(function(){
				$('#submit_search').click(function(e){
					e.preventDefault();
					if($('form#formSearch .tt-input').val()!= ''){
						$('form#formSearch').submit();	
					}else{
						 window.location="http://127.0.0.1:8000/";
					}
				})
				var engine = new Bloodhound({
					remote: {
						url: 'http://127.0.0.1:8000/search/name?q=%QUERY%',
						wildcard: '%QUERY%'
					},
					datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
					queryTokenizer: Bloodhound.tokenizers.whitespace
				});

				$(".search-input").typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				}, {
					source: engine.ttAdapter(),
					name: 'usersList',
					limit: 5,
					display: 'q',
					templates: {
						empty: [
							'<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
						],
						header: [
							'<div class="list-group search-results-dropdown">'
						],
						suggestion: function (data) {
							return '<a href="product/' + convertToSlug(data.name) + '" class="list-group-item"><img src="'+data.avatar+'" style=" height: 50px;margin-right: 20px;"> ' + data.name + '</a>';
				}
					}
				});
			})
				//show sabr phẩm đã chọn trên head
				function showCartMini(){
					if(JSON.parse(localStorage.getItem('cart'))) {
						dataCart= JSON.parse(localStorage.getItem('cart'));
					} else {
						var dataCart=[];
					};
					htmlCartList = '<div class="cart-list">';
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
						if(total_item != 0){
							$('.dropdown a').append('<div class="qty">'+total_item+'</div>');
						}
					}
					else{
						$('.cart-dropdown').html('');
						htmlImage = "<img src='{{asset('frontend/img/117-1170538_404-your-cart-is-empty.png')}}'' width='100%'>";
						$('.qty').remove();
						$('.cart-dropdown').html(htmlImage);
					}
				}
				// show sản phẩm ở trang Cart
				function showCart(){
					if(JSON.parse(localStorage.getItem('cart'))) {
						dataCart= JSON.parse(localStorage.getItem('cart'));
					} else {
						var dataCart=[];
					};
					htmlCart = '';
					if(dataCart.length != 0){
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
										+'<input id="quantity"  min="0" value="'+ item.quantity+'" data-id="'+item.id+'" data-remain='+item.remain_quantity+' type="number">'
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
						$('#create_order').addClass('none');
						$('#total_amount').addClass('none')
					} 
					console.log(dataCart);
					$(".total .price").html('');
					$(".total .price").prepend(formatCurrency(total_amount)+'<sup>đ</sup>');

					$('.items_cart').html('');
					$('.items_cart').prepend(htmlCart);
				}
				//kiểm tra spham đã được add vào giỏ hàng chưa
				
				// format tiền tệ
				function formatCurrency(number){
					// console.log(typeof(number));
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
					cart[index]['quantity'] = quantity;
					return cart;
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
				function checkProductExist(cart,product_id){
					for (var i = 0; i < cart.length; i++) {
						if (cart[i]['id'] == product_id){
							return i;
						} else {
							continue;
						}
					};
					return false;
				}
				function convertToSlug(str)
				{
					str = str.replace(/^\s+|\s+$/g, ''); // trim
					str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
					str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
					str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
					str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
					str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
					str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
					str = str.replace(/đ/g, "d");
					str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
					str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
					str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
					str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
					str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
					str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
					str = str.replace(/Đ/g, "D");

					str = str.toLowerCase();
					str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
						.replace(/\s+/g, '-') // collapse whitespace and replace by -
						.replace(/-+/g, '-'); // collapse dashes
					return str;
				}
		</script>

</html>