<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'categories'        => Category::where('parent_id', 0)->get(),
            'sliders'           => Slider::where('active', '1')->get(),
            'productNews'       => Product::with('category')->orderBy('id')->take(8),
            'productTopSell'    => Product::with('category')->orderBy('id')->take(8),
            'productTopRating'  => Product::with('category')->orderBy('id')->take(8),
            // 'productTopRating'  => Product::with(['category', 'ratings'])->orderByRaw('rating')->take(8),
        ];
        return view('frontend.home', $data);
    }
}