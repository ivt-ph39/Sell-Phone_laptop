@extends('frontend.layouts.master')
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
                                    <th colspan="6" class="total">Tổng số tiền: <span class="price"></span></th>
                                </tr>
                            </tfoot>
                            </table>
                            
                        </div>
                        <div >
                            <a href="" class="primary-btn order-submit">Đặt hàng</a>
                        </div>
						
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection
