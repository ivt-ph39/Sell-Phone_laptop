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
                <div class="col">
                    <form action="{{ route('admin.order.list') }}" method="get" class="form-inline">
                        <div class="input-group ">
                            <input type="date" class="form-control" name="created_at" placeholder="Search created_at">
                            <div class="input-group-append">
                                <button title="Tìm kiếm đơn hàng theo ngày tạo" class="btn btn-outline-success" type="submit"><i
                                        class="fas fa-search-plus"></i></button>
                            </div>
                        </div>
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
                                <td>{{ $order->name. ' - '. $order->user_id }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->finished_at }}</td>
                                <td>
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button title="Ẩn or Hiện nội dung comment lên trang sản phẩm" type="submit"
                                            class="badge badge-info " {{ ($order->status == 3) ? 'disabled' : '' }}>
                                            @if ($order->status == 0)
                                                Đang xử lí
                                            @elseif($order->status == 1)
                                                Đã xử lí
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
                                {{--  0 dang xu li 1 đã xử lí 2 đang giao 3 hoan thanh  --}}
                                <td>{{ $order->note }}</td>
                                <td>
                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Xóa đơn hàng" class="btn btn-sm btn-danger"><i class="fas fa-minus-circle"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->appends(request()->query())->links() }}
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

        });
    </script>
    
@endsection
