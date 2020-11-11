<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Order;
use App\Model\Product;
use App\Model\Slider;
use App\Model\OrderProduct;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'categories'        => Category::where('parent_id', 0)->get(),
            'sliders'           => Slider::where('active', '1')->get(),
            'productNews'       => Category::with([
                'products' => function ($query) {
                    return $query->orderBy('id', 'desc')->take(8);
                }
            ])->where('parent_id', 0)->get(),
            'productHot'    => Category::with([
                'products' => function ($query) {
                    return $query->where('hot', 1)->orderBy('id', 'desc')->take(8);
                }
            ])->where('parent_id', 0)->get(),

            'productSell'  => Category::with([
                'products'  => function ($query) {
                    return $query->where('sale', '<>', 0)->orderBy('sale', 'desc')->take(8);
                }
            ])->where('parent_id', 0)->get(),

        ];
        return view('frontend.home', $data);
    }
}