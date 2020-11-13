<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Blog_tag;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index(){
        $blog_news = Blog::latest()->paginate(3);
        $blog_top  = Blog::orderBy('view_count', 'DESC')->take(3)->get();
        $blog_top1 = Blog::orderBy('view_count', 'DESC')->take(1)->first();
        $blog_tag  = Blog_tag::orderBy(DB::raw('RAND()'))->take(6)->get();
        $data = [
            'categories'      => Category::where('parent_id', 0)->get(),
            'blog_news'       => $blog_news,
            'blog_top'        => $blog_top,
            'blog_top1'       => $blog_top1,
            'blog_tag'        => $blog_tag

        ];
        return view('frontend.blog', $data); 
    } 

    public function blogContent($slug){ // show nội dung
        $blog = Blog::where('slug', $slug)->first();
        $blogKey = "blog_$blog->id";
        $blog_top  = Blog::orderBy('view_count', 'DESC')->take(3)->get();
        $blog_top1 = Blog::orderBy('view_count', 'DESC')->take(1)->first();
        $blog_tag = Blog_tag::orderBy(DB::raw('RAND()'))->take(6)->get();
        if (!Session::has($blogKey)) {
            Blog::where('id', $blog->id)->increment('view_count');
            Session::put($blogKey, 1);
        }

        $data = [
            'categories'      => Category::where('parent_id', 0)->get(),
            'blog_top'        => $blog_top,
            'blog_top1'       => $blog_top1,
            'blog'            => $blog,
            'blog_tag'        => $blog_tag
        ];
        return view('frontend.blogContent', $data); 
    }
}
