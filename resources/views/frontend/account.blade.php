@extends('frontend.layouts.master')
@section('css')
    <style>
        .section_account{
            margin: 30px 0 ;
        }
        .section_account form{
            margin: 20px 0; 
        }
        .section_account .change_submit{
            margin-top: 20px;
            width: 50%;
            padding: 10px 0;
            background: #fd6e1d;
            background: -webkit-gradient( linear, 0% 0%, 0% 100%, from(#fd6e1d), to(#f59000) );
            background: -webkit-linear-gradient(top, #f59000, #fd6e1d);
            border-radius: 4px;
            outline: none;
            display: block;
            font-size: 16px;
            line-height: normal;
            text-transform: uppercase;
            color: #fff;
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
                        <li class="{{(!isset($page)? "active" : "")}}"><a href="{{route('home')}}">Thông tin TK</a></li>
					    <li class=""><a href="">Đơn hàng</a></li>
					    <li class=""><a href="">Mật khẩu</a></li>
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
    <div class="row mt-5 section_account">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if ( isset($info_user))
            <div class="info-account">
                <h4>Thông tin tài khoảng.</h4>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Họ và tên</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" disabled placeholder="Họ và tên" value="{{$info_user->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" disabled placeholder="Email" value="{{$info_user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Địa chỉ</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="address" disabled placeholder="Địa chỉ" value="{{$info_user->address}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Số điện thoại</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" disabled placeholder="Số điện thoại" value="{{$info_user->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                           <button type="submit" class="btn change_submit">Thay đổi thông tin</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection
@section('js')
    
@endsection