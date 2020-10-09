<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Category $category, Slider $slider, Product $product)
    {
        $data = [
            'categories'    => $category->where('parent_id', 0)->get(),
            'productNews'   => '',
            'sliders'    => $slider->all()
        ];
        return view('frontend.home', $data);
    }
}