@extends('frontend.layouts.master')
@section('css')
    <style>
        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
            background: -webkit-linear-gradient(45deg, #ff89e9 0%, #05abe0 100%);
            background: linear-gradient(45deg, #ff89e9 0%,#05abe0 100%);
          }
          
          .hovereffect .overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
            top: 0;
            left: 0;
            padding: 3em;
            text-align: left;
          }
          
          .hovereffect img {
            display: block;
            position: relative;
            max-width: none;
            width: calc(100% + 60px);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.45s;
            transition: opacity 0.35s, transform 0.45s;
            -webkit-transform: translate3d(-40px,0,0);
            transform: translate3d(-40px,0,0);
          }
          
          .hovereffect h2 {
            text-transform: uppercase;
            color: #fff;
            position: relative;
            font-size: 17px;
            background-color: transparent;
            padding: 15% 0 10px 0;
            text-align: left;
          }
          
          .hovereffect .overlay:before {
            position: absolute;
            top: 20px;
            right: 20px;
            bottom: 20px;
            left: 20px;
            border: 1px solid #fff;
            content: '';
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.45s;
            transition: opacity 0.35s, transform 0.45s;
            -webkit-transform: translate3d(-20px,0,0);
            transform: translate3d(-20px,0,0);
          }
          
          .hovereffect a, .hovereffect p {
            color: #FFF;
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.45s;
            transition: opacity 0.35s, transform 0.45s;
            -webkit-transform: translate3d(-10px,0,0);
            transform: translate3d(-10px,0,0);
          }
          
          .hovereffect:hover img {
            opacity: 0.6;
            filter: alpha(opacity=60);
            -webkit-transform: translate3d(0,0,0);
            transform: translate3d(0,0,0);
          }
          
          .hovereffect:hover .overlay:before,
          .hovereffect:hover a, .hovereffect:hover p {
            opacity: 1;
            filter: alpha(opacity=100);
            -webkit-transform: translate3d(0,0,0);
            transform: translate3d(0,0,0);
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
                    <li class="{{ !isset($page) ? 'active' : '' }}"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <ul class="cate-nav main-nav nav navbar-nav">
                        @foreach ($categories as $category)
                            <li
                                class="{{ $category->hasChild($category->id) != false ? 'hassub' : '' }} {{ isset($page) && Str::slug($category->name) == $page ? 'active' : '' }}">
                                <a
                                    href="{{ route('store', ['page' => Str::slug($category->name)]) }}">{{ $category->name }}</a>
                                @if ($category->hasChild($category->id))
                                    <ul class="cate-child nav navbar-nav">
                                        @foreach ($category->hasChild($category->id) as $category)
                                            <li><a
                                                    href="{{ route('store', ['page' => Str::slug($category->name)]) }}">{{ $category->name }}</a>
                                            </li>
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
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="hovereffect">
                    <img class="img-responsive" src="uploads/images/blogs/IMG_20180211_201958.jpg" alt="">
                    <div class="overlay">
                        <h2>Effect 13</h2>
                        <p>
                            <a href="#">LINK HERE</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            
        </div>
    </div>
@endsection
