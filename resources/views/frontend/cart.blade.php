@extends('frontend.layouts.master')

@extends('frontend.layouts.menu')

@section('main')
        <!-- SECTION -->
		<div class="section-cart">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Order Details -->
					<div class="col-md-12 order-details">
						<div class="section-title text-center">
							<h3 class="title">Giỏ hàng của bạn</h3>
                        </div>
                        <div class="order_summary">
                            <table class="table">
                            <thead>
                                <tr>
                                <th style="width: 5%">Stt</th>
                                <th style="width: 30%">Tên sản phẩm</th>
                                <th style="width: 10%">Ảnh</th>
                                <th style="width: 20%">Giá </th>
                                <th style="width: 15%">Số lượng</th>
                                <th style="width: 15%">Thành tiền</th>
                                <th style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody class="items_cart">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="total" id="total_amount">Tổng số tiền: <span class="price"></span></th>
                                </tr>
                            </tfoot>
                            </table>
                            
                        </div>
                        <div >
                            <a href="" class="primary-btn order-submit" id="create_order" data-user-id="{{(Auth::check()) ? Auth::id() : ''}}" data-toggle="modal" >Đặt hàng</a>
                        </div>
                        <div class="modal fade" id="info_user_no_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Thông tin khách hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                    <input type="text"
                                        class="form-control"  id="user_name" aria-describedby="helpId" placeholder="Họ và tên">
                                        <small class="error" id="err_name"></small>
                                    </div>
                                    <div class="form-group">
                                    <input type="email"
                                        class="form-control"  id="user_email" aria-describedby="helpId" placeholder="Email (Shop sẽ gửi thông tin đơn hàng về email của bạn)">
                                        <small class="error" id="err_email"></small>
                                    </div>
                                    <div class="form-group">
                                    <input type="text"
                                        class="form-control"  id="user_address" aria-describedby="helpId" placeholder="Địa chỉ nhận hàng" >
                                        <small class="error" id="err_address"></small>
                                    </div>
                                    <div class="form-group">
                                    <input type="text"
                                        class="form-control" id="user_phone" aria-describedby="helpId" placeholder="Số điện thoại">
                                        <small class="error" id="err_phone"></small>
                                    </div>
                                    <div class="form-group">
                                        <textarea 
                                            class="form-control"  id="user_status" aria-describedby="helpId" placeholder="Yêu cầu khác của bạn (không bắt buộc)" ></textarea>
                                        <small class="error" id="err_status"></small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary submit-data-no">Lưu</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::check())
                            <div class="modal fade" id="info_user_has_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Thông tin khách hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="user_name">Tên người nhận:</label>
                                            <input type="text" class="form-control"  id="user_name" aria-describedby="helpId" placeholder="Họ và tên"  value="{{ucwords(Auth::user()->name)}}">
                                                <small class="error" id="err_name"></small>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="user_email">Email người nhận:</label>
                                                <input type="email" class="form-control"  id="user_email" aria-describedby="helpId" placeholder="Email : abc@gmail.com"  value="{{Auth::user()->email}}">
                                                <small class="error" id="err_email"></small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="user_phone">SĐT người nhận:</label>
                                                <input type="text" class="form-control"  id="user_phone" aria-describedby="helpId" placeholder="Số điện thoại"  value="{{Auth::user()->phone}}">
                                                <small class="error" id="err_phone"></small></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="user_address">Địa chỉ nhận hàng:</label>
                                            <input type="text" class="form-control"  id="user_address" aria-describedby="helpId" placeholder="Địa chỉ nhận hàng" value="{{Auth::user()->address}}">
                                                <small class="error" id="err_address"></small>
                                        </div>                                        
                                        <div class="form-group">
                                            <label for="user_status">Ghi chú</label>
                                            <textarea  class="form-control"  id="user_status" aria-describedby="helpId" placeholder="Yêu cầu khác của bạn (không bắt buộc)" ></textarea>
                                                <small class="error" id="err_status"></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary submit-data-has">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
					</div>
					<!-- /Order Details -->
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
            $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
            $('#create_order').on('click',function(e){
                e.preventDefault();
                user_id = $(this).attr('data-user-id');
                if(user_id){
                    $('#info_user_has_account').modal('show');
                    $('#info_user_has_account .submit-data-has').on('click',function(e){
                        var status = $('#info_user_has_account #user_status').val();
                        var name = $('#info_user_has_account #user_name').val();
                        var email = $('#info_user_has_account #user_email').val();
                        var phone = $('#info_user_has_account #user_phone').val();
                        var address = $('#info_user_has_account #user_address').val();
                        var note = $('#info_user_has_account #user_status').val();
                        console.log(note);
                        e.preventDefault();
                        $.ajax({
                            url: "{{route('order_store')}}",
                            type:'post',
                            data: {
                                'user_id' : user_id,    
                                'orders'  : JSON.parse(localStorage.getItem('cart')),
                                'name'  : name,
                                'email' : email,
                                'phone' : phone,
                                'address' : address,
                                'note' : note
                            },
                            success: function(data) {
                                if(data.error == true){
									if(data.message.address){
										$('#info_user_has_account #err_address').text(data.message.address[0])
									}else{
										$('#info_user_has_account #err_address').text('')
									}
                                }else{
                                    $('#info_user_has_account #err_address').text('');
                                }
                                if(data.success == true){
                                    $('#info_user_has_account').modal('hide');
                                    localStorage.setItem('cart', JSON.stringify([]));
                                    Swal.fire({
                                        icon:'success',
									    title: 'Thank You!',
									    text:'Bạn đã đặt hàng thành công!',
                                        confirmButtonText: 'Xem đơn hàng của bạn?'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location="{{route('user_account')}}";
                                        }else{
                                            location.reload();
                                        }
                                    });
                                }
                            }
                        });
                    })
                }else{
                    $('#info_user_no_account').modal('show');
                    $('#info_user_no_account .submit-data-no').on('click',function(e){
                        var name = $('#info_user_no_account #user_name').val();
                        var email = $('#info_user_no_account #user_email').val();
                        var phone = $('#info_user_no_account #user_phone').val();
                        var address = $('#info_user_no_account #user_address').val();
                        var note = $('#info_user_no_account #user_status').val();
                        $.ajax({
                            url: "{{route('order_store')}}",
                            type:'post',
                            data: {
                                'orders'  : JSON.parse(localStorage.getItem('cart')),
                                'name'    : name,
                                'email'   : email,
                                'phone'   : phone,
                                'address' : address,
                                'note'    : note
                            },
                            success: function(data) {
                                if(data.error == true){
                                    if(data.message.name){
										$('#info_user_no_account #err_name').text(data.message.name[0])
									}else{
										$('#info_user_no_account #err_name').text('')
									}
									if(data.message.email){
										$('#info_user_no_account #err_email').text(data.message.email[0])
									}else{
										$('#info_user_no_account #err_email').text('')
									}
									
									if(data.message.address){
										$('#info_user_no_account #err_address').text(data.message.address[0])
									}else{
										$('#info_user_no_account #err_address').text('')
									}
									if(data.message.phone){
										$('#info_user_no_account #err_phone').text(data.message.phone[0])
									}else{
										$('#info_user_no_account #err_phone').text('')
									}
                                }else{
                                    $('#info_user_no_account #err_name').text('');
                                    $('#info_user_no_account #err_email').text('');
                                    $('#info_user_no_account #err_address').text('');
                                    $('#info_user_no_account #err_phone').text('')
                                }
                                if(data.success == true){
                                    $('#info_user_no_account').modal('hide');
                                    localStorage.setItem('cart', JSON.stringify([]));
                                    Swal.fire({
                                        icon:'success',
									    title: 'Bạn đã đặt hàng thành công!',
									    text:'Kiểm tra email để nhận những thông báo về đơn hàng!',
                                   }).then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    })
                }
            })
        });
    </script>
@endsection