<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $data = [
            'categories'      => Category::where('parent_id', 0)->get(),
        ];
        return view('frontend.blog', $data); 
    } 
}
