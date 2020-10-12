<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class ProductDetail extends Controller
{
    public function index($page, $productName, Category $category)
    {
        $data = [
            'categories' => $category->where('parent_id', 0)->get(),
            'page'       => $page
        ];
        return view('frontend.product_detail', $data);
    }
}