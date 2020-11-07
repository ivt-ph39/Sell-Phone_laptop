@extends('frontend.layouts.master')
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
    <div class="row">
        <div class="col-8">
            asdasdasd
        </div>
        <div class="col-4">
            asdadsa
        </div>
    </div>
@endsection
