<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Category $category)
    {
        $data = [
            'categories'      => $category->where('parent_id', 0)->get(),
        ];
        return view('frontend.cart', $data);
    }
}