@extends('frontend.layouts.master')
@section('css')
<style>
    .tabcontent {
        margin: 30px 0;
        min-height: 50vh;
    }

    .tabcontent form {
        margin: 20px 0;
    }

    .tabcontent .btn_submit {
        margin-top: 20px;
        width: 30%;
        padding: 10px 0;
        background: #fd6e1d;
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fd6e1d), to(#f59000));
        background: -webkit-linear-gradient(top, #f59000, #fd6e1d);
        border-radius: 4px;
        outline: none;
        display: block;
        font-size: 16px;
        line-height: normal;
        text-transform: uppercase;
        color: #fff;
        font-weight: 500;
        margin: auto
    }

    .show {
        display: block;
    }

    .tabcontent {
        display: none;
    }

    .tabcontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }
    .modal-footer h4 span{
        color: red;
    }
    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .tabcontent>th,
    .tabcontent>td {
        text-align: center;
        
    }

    .detail_order {
        cursor: pointer;
    }
    @media (min-width: 992px){
        .modal-lg {
         width: 1200px;
        }
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
                <li class="active tablinks" data-tab="order_history"><a href="#">Lịch sử đơn hàng</a></li>
                <li class="tablinks" data-tab="info_account"><a href="#">Thông tin TK</a></li>
                <li class="tablinks" data-tab="reset_password"><a href="#">Mật khẩu</a></li>
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
<div class="row mt-5 ">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if (isset($info_user))
        <div class="tabcontent show" id="order_history">
            <h4>Lịch sử đơn hàng</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">TT</th>
                        <th scope="col">Thời gian tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian hoàn thành</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @isset($list_order)
                    @foreach ($list_order as $key => $order)
                    <tr>
                        <th>{{$key+1}}</th>
                        <td>{{$order->created_at}}</td>
                        {{-- <td>Đang xử lý</td> --}}
                        <td>{{$order->status}}</td>
                        <td>{{$order->finished_at}}</td>
                        <td>
                            <a href="" title="Xem chi tiết" data-id="{{$order->id}}" class="action_order detail_order"><i class="far fa-eye"></i></a> 
                            @if ($order->status != "Đang giao" && $order->status != "Hoàn thành")
                                <a href="" title="Hủy đơn" data-id="{{$order->id}}" class="action_order cancel_order" ><i class="far fa-calendar-times"></i></a>    
                            @endif
                            @if ($order->status == "Hoàn thành")
                                <a href="" title="Xóa" data-id="{{$order->id}}" class="action_order delete_order" ><i class="far fa-trash-alt"></i></a>    
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
        <div class="tabcontent none" id="info_account">
            <h4>Thông tin tài khoảng</h4>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Họ và tên :</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" disabled placeholder="Họ và tên" value="{{$info_user->name}}">
                        <small class="error" id="error_pass_old"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email :</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" disabled placeholder="Email" value="{{$info_user->email}}">
                        <small class="error" id="error_pass_old"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Địa chỉ :</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="address" disabled placeholder="Địa chỉ" value="{{$info_user->address}}">
                        <small class="error" id="error_pass_old"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Số điện thoại :</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="phone" disabled placeholder="Số điện thoại" value="{{$info_user->phone}}">
                        <small class="error" id="error_pass_old"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn_submit">Thay đổi thông tin</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabcontent none" id="reset_password">
            <h4>Thay đổi mật khẩu</h4>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="password_old" class="col-sm-4 control-label">Mật khẩu cũ :</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password_old" placeholder="*********">
                        <small class="error" id="error_pass_old"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_new" class="col-sm-4 control-label">Mật khẩu mới :</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password_new" placeholder="*********">
                        <small class="error" id="error_pass_new"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_new_confirm" class="col-sm-4 control-label">Nhập lại mật khẩu :</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password_new_confirm" placeholder="*********">
                        <small class="error" id="error_pass_confirm"></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <button type="submit" class="btn btn_submit">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
        @endif
        <div class="modal fade detailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Số tiền</th>
                                </tr>
                            </thead>
                            <tbody class="order_body">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <h4>Tổng số tiền:<span></span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.tablinks').on('click', function(e) {
            e.preventDefault();
            var tab = $(this).attr('data-tab');
            console.log("tab"+ tab);
            openTab(tab, e);
        });
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $('.detail_order').on('click', function(e) {
            e.preventDefault();
            id_order = $(this).attr('data-id');
            $(".detailModal").modal('show');
            $.ajax({
                url: "{{route('order_show')}}",
                data: {
                    'id_order' :id_order
                },
                type:'post',
                success:function(result){
                    console.log(result.order);
                    htmlBody = '';
                    totalAmount = 0;
                    if(result.success){
                        $.each(result.order,function(key,item){
                            totalAmount += item.amount;
                            htmlBody += 
                                '<tr>'
                                    +'<th scope="col">'+ ++key +'</th>'
                                    +'<th scope="col">'+ item.products.name+'</th>'
                                    +'<th scope="col"><img src="'+item.products.avatar+'" class="thumbnail" style="height:80px;"></th>'
                                    +'<th scope="col">'+item.quantity+'</th>'
                                    +'<th scope="col">'+formatCurrency(item.amount)+'<sup>đ</sup></th>'
                                +'</tr>';
                        })
                        $('.order_body').html('');
                        $('.order_body').prepend(htmlBody);
                        $('.modal-footer h4 span').html('');
                        $('.modal-footer h4 span').append(' '+formatCurrency(totalAmount)+'<sup>đ</sup>')
                    }
                }
            })
        })
        $('.delete_order').on('click', function(e) {
            e.preventDefault();
            id_order = $(this).attr('data-id');
            $.ajax({
                url:"{{route('admin.order.deleteOrder')}}",
                data: {
                    id: id_order
                },
                type:'post',
                success:function(data){
                    console.log(data);
                    if(data.success==true){
                        Swal.fire({
                        icon: 'success',
                        title: 'Lỗi...',
                        text: 'Bạn đã xóa đơn hàng thành công !',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                               location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Lỗi...',
                        text: 'Không thể xóa đơn hàng !',
                        })
                    }
                }
            
            })
            // console.log('id ',id_order)
        })
        $('.cancel_order').on('click', function(e) {
            e.preventDefault();
             id_order = $(this).attr('data-id');
             $.ajax({
                url:"{{route('admin.order.cancelOrder')}}",
                data: {
                    id: id_order
                },
                type:'post',
                success:function(data){
                    if(data.success==true){
                        Swal.fire({
                        icon: 'success',
                        title: 'Lỗi...',
                        text: 'Bạn đã hủy đơn hàng thành công !',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                               location.reload();
                            }
                        });
                    }else{
                         Swal.fire({
                        icon: 'error',
                        title: 'Lỗi...',
                        text: 'Không thể hủy đơn hàng !',

                        })
                    }
                }

            })
        })
    })

    function openTab(tab, e) {
        $(".tablinks").each(function() {
            $(this).removeClass('active');
        });
        $(".tabcontent").each(function() {
            $(this).removeClass('show');
            $(this).addClass('none');
        });
        $(e.currentTarget).addClass('active');
        $("#" + tab).removeClass('none');
        $("#" + tab).addClass('show');
    }
</script>
@endsection