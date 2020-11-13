@extends('frontend.layouts.master')
@section('css')
    <style>
        body * {
            box-sizing: border-box;
        }

        .thumb {
            width: 100%;
            height: 150px;
            background-color: #3e3e3e;
            background-image: none;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            border-radius: 5px;
        }

        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
            background: -webkit-linear-gradient(45deg, #ff89e9 0%, #05abe0 100%);
            background: linear-gradient(45deg, #ff89e9 0%, #05abe0 100%);
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
            -webkit-transform: translate3d(-40px, 0, 0);
            transform: translate3d(-40px, 0, 0);
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
            -webkit-transform: translate3d(-20px, 0, 0);
            transform: translate3d(-20px, 0, 0);
        }

        .hovereffect a,
        .hovereffect p {
            color: #FFF;
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.45s;
            transition: opacity 0.35s, transform 0.45s;
            -webkit-transform: translate3d(-10px, 0, 0);
            transform: translate3d(-10px, 0, 0);
        }

        .hovereffect:hover img {
            opacity: 0.6;
            filter: alpha(opacity=60);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .hovereffect:hover .overlay:before,
        .hovereffect:hover a,
        .hovereffect:hover p {
            opacity: 1;
            filter: alpha(opacity=100);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

    </style>
    
@endsection
@section('menu')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=2607589752622324&autoLogAppEvents=1"
        nonce="xUScWZ8R"></script>
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
        <br>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="hovereffect">
                    <img class="img-responsive" style="max-height: 300px;" src="{{ asset('uploads/images/blogs/'.$blog_top1->thumbnail) }}" alt="">
                    <div class="overlay">
                        <h2>{{ $blog_top1->title }}</h2>
                        <p>
                            <a href="{{ route('blog.content', $blog_top1->slug) }}">LINK HERE</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="content_blog col-sm-9">
                <hr>
                <div class="col-sm-12">
                    <h1>{{ $blog->title }}</h1>
                    <p>Lượt xem: <i>{{ $blog->view_count }}</i></p>
                    <p>Tác giả: <i>{{ $blog->author }}</i></p>
                    <div class="fb-like" data-href="{{ route('blog.content', $blog->slug) }}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                </div>
                <br>
                <div class="col-sm-12" style="border: 1px solid rgb(228, 228, 228); ">
                    {!! $blog->content !!}
                </div>
                <div class="col-sm-12">
                    <div class="fb-comments" data-href="{{ route('blog.content', $blog->slug) }}" data-numposts="5" data-width=""></div>
                </div>
            </div>



            <div class="col-sm-3" style="margin-bottom:20px;">
                {{-- search --}}
                <div>
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Search title blog"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </form>
                </div>
                {{-- end search --}}

                {{-- blog top --}}
                @if (!empty($blog_top))
                    @foreach ($blog_top as $blog)
                        <div class="card" style="max-width: 540px; margin-top: 3%;">
                            <div class="row no-gutters">
                                <div class="col-ms-5 " style="margin: 0; padding: 0">
                                    <img src="{{ asset('uploads/images/blogs/' . $blog->thumbnail) }}"
                                        class="card-img thumb" alt="...">
                                </div>
                                <div class="col-ms-7">
                                    <div class="card-body">
                                        <h3 class="card-title"><strong><a
                                                    href="{{ route('blog.content', $blog->slug) }}">{{ $blog->title }}</a></strong>
                                        </h3>
                                        <p class="card-text pre_post">{!! $blog->content !!}</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                @else
                    <div>
                        <p>No Data</p>
                    </div>
                @endif
                {{-- end blog top --}}
                <div class="col-sm-12">
                    <h3>Tags</h3>
                    @foreach ($blog_tag as $tag)
                        <a href="{{ route('blog.content', $tag->blog->slug) }}"><span class="badge badge-info">{{ $tag->tag }}</span></a>
                    @endforeach
                </div>

            </div>
            
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".pre_post").each(function() {
            var text = $(this).html();
            if(text.length > 30){
            text = text.substring(0,30);
            $(this).html(text);
            }
            });
            })
    </script>
@endsection

