@extends('layouts.masterAdmin')
@section('title')
    Admin Home
@endsection
@section('main')
    <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row mt-5">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$orderNew}}</h3>
                  <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.order.list')}}" class="small-box-footer mr-2">Xem chi tiết<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div><div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$orderHandle}}</h3>
                  <p>Đơn hàng đang gửi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.order.list',['status'=>2])}}" class="small-box-footer mr-2">Xem chi tiết<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div><div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$orderDone}}</h3>
                  <p>Đơn hàng đã hoàn thành</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.order.list',['status'=>3])}}" class="small-box-footer mr-2">Xem chi tiết<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary ">
                <div class="inner">
                    <h3>{{$commentNew}}</h3>
                    <p>Bình Luận mới</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('admin.comment.list')}}" class="small-box-footer mr-2">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection