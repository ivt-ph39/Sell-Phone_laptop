@extends('layouts.masterAdmin')
@section('title')
    {{ $titlePage }}
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="container p-3">
        @if (!isset($orders))
            <h4>No Data.</h4>
        @else
            @if (\Session::has('message'))
                <div class="alert alert-primary message" role="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <div class="row mb-3">
                <h4 class=" col-5">{{ $titlePage }}.</h4>
                <div class="col form-inline">
                    <form action="{{ route('admin.order.list') }}" method="get" class="form-inline mr-2">
                        <input type="date" class="form-control mr-2" name="created_at" placeholder="Tìm theo ngày tạo">
                        <select name="status" class="form-control">
                            <option value="0">Đang xử lý</option>
                            <option value="1">Đã xử lý</option>
                            <option value="2">Đang giao</option>
                            <option value="3">Hoàn thành</option>
                        </select>
                        <button title="Tìm kiếm comment" class="btn btn-outline-success" type="submit"><i
                                class="fas fa-search-plus"></i></button>
                    </form>
                </div>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tên khách hàng - Mã KH</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày hoàn thành</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name . ' - ' . $order->user_id }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->finished_at }}</td>
                                <td>
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button title="Ẩn or Hiện nội dung comment lên trang sản phẩm" type="submit"
                                            class="badge badge-info " {{ $order->status == 3 ? 'disabled' : '' }}>
                                            @if ($order->status == 0)
                                                Đang xử lý
                                            @elseif($order->status == 1)
                                                Đã xử lý
                                            @elseif($order->status == 2)
                                                Đang giao
                                            @elseif ($order->status == 3)
                                                Đã hoàn thành
                                            @else
                                                Hàng bị hủy
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                {{-- 0 dang xu li 1 đã xử lí 2 đang giao 3 hoan thanh
                                --}}
                                <td>{{ $order->note }}</td>
                                <td>
                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Xóa đơn hàng" class="btn btn-sm btn-danger"><i
                                                class="fas fa-minus-circle"></i></button>
                                    </form>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary modalShow" data-toggle="modal" data-url="{{ route('admin.order.productOrder', $order->id) }}"
                                        data-target="#exampleModal">
                                        <i class="fas fa-clipboard-list"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable w-100" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Các Sản Phẩm Đơn Hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                          <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Mã sản phẩm</th>
                                                            <th scope="col">Số Lượng</th>
                                                            <th scope="col">Số Tiền</th> 
                                                            <th scope="col">Ngày Tạo</th> 
                                                            <th scope="col">Mã Đơn Hàng</th> 
                                                          </tr>
                                                        </thead>
                                                        <tbody class="listBody">
                                                        </tbody>
                                                      </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <h2>Total : <h2 class="total"></h2>VND</h2>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="">
                {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $('.message').click(function() {
                let $this = $(this);
                setTimeout(function() {
                    $this.hide();
                }, 600);
            });
            $('.modalShow').click(function(){
                let url = $(this).attr('data-url');
                $.ajax({
                    type:'get',
                    url: url,
                    success: function(res){
                        $('.listBody').html(' ');
                        let total = 0;
                        $.each(res['products'], function(key, item){
                            $('.listBody').append(" <tr>"
                                + "<td>" + item.id + "</td>" 
                                + "<td>" + item.product_id + "</td>"
                                + "<td>" + item.quantity + "</td>" 
                                + "<td>" + item.amount + "</td>"
                                + "<td>" + item.created_at + "</td>"
                                + "<td>" + item.order_id + "</td>"
                                + "</tr> ");
                            total += item.quantity*item.amount;
                        });
                        $('.total').html(total);        
                    }
                });
            });
        });

    </script>
    

@endsection

