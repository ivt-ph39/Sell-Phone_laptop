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
            'productNews'   => [
                'phones'        => [$product->with('category')->where('category_id', 1)->take(5)->get(), 1],
                'laptops'       => [$product->with('category')->where('category_id', 2)->take(5)->get(), 2],
                'accessories'   => [$product->with('category')->where('category_id', 4)->take(5)->get(), 4],
                'tablets'       => [$product->with('category')->where('category_id', 3)->take(5)->get(), 3],
                'clocks'        => [$product->with('category')->where('category_id', 5)->take(5)->get(), 5],
            ],
            'productTopSell'   => [
                'phones'        => [$product->with('category')->where('category_id', 1)->take(5)->get(), 1],
                'laptops'       => [$product->with('category')->where('category_id', 2)->take(5)->get(), 2],
                'accessories'   => [$product->with('category')->where('category_id', 4)->take(5)->get(), 4],
                'tablets'       => [$product->with('category')->where('category_id', 3)->take(5)->get(), 3],
                'clocks'        => [$product->with('category')->where('category_id', 5)->take(5)->get(), 5],
            ],
            'sliders'    => $slider->all()
        ];
        return view('frontend.home', $data);
    }
}