<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Product;
use App\Model\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductDetail extends Controller
{
    public function index($page, $productName, Category $category, Product $product, Rating $rating, Comment $comment)
    {
        $product_id = $this->getProductId($this->getCategoryId($page), $productName);
        $product    = $product->with(['images', 'category', 'tags', 'ratings', 'comments'])->find($product_id);
        $total_star = $rating->where('product_id', $product_id)->count();
        $star_1 = $rating->where('product_id', $product_id)->where('star', 1)->count();
        $star_2 = $rating->where('product_id', $product_id)->where('star', 2)->count();
        $star_3 = $rating->where('product_id', $product_id)->where('star', 3)->count();
        $star_4 = $rating->where('product_id', $product_id)->where('star', 4)->count();
        $star_5 = $rating->where('product_id', $product_id)->where('star', 5)->count();



        $data = [
            'categories'      => $category->where('parent_id', 0)->get(),
            'page'            => $page,
            'product'         => $product,
            'ratings'         => $rating->where('product_id', $product_id)->orderBy('id')->paginate(4),
            'total_rating'    => $rating->where('product_id', $product_id)->count(),
            'comments'        => $comment->where('product_id', $product_id)->orderBy('id')->paginate(5),
            'total_comment'   => $comment->where('product_id', $product_id)->count(),
        ];

        if ($total_star == 0) {
            $data['star_product'] = [
                '1-star'  =>  [0, 0],
                '2-star'  =>  [0, 0],
                '3-star'  =>  [0, 0],
                '4-star'  =>  [0, 0],
                '5-star'  =>  [0, 0],
                'average' => 0,
            ];
        } else {
            $data['star_product'] = [
                '1-star'  =>  [$star_1, $star_1 * 100 / $total_star],
                '2-star'  =>  [$star_2, $star_2 * 100 / $total_star],
                '3-star'  =>  [$star_3, $star_3 * 100 / $total_star],
                '4-star'  =>  [$star_4, $star_4 * 100 / $total_star],
                '5-star'  =>  [$star_5, $star_5 * 100 / $total_star],
                'average' => round(($star_1 * 1 + $star_2 * 2 + $star_3 * 3 + $star_4 * 4 + $star_5 * 5) / $total_star, 2),
            ];
        }
        return view('frontend.product_detail', $data);
    }


    public function getProductId($category_id, $productName)
    {
        $products = Product::where('category_id', $category_id)->get();
        foreach ($products as $product) {
            if (Str::slug($product->name) == $productName) {
                return $product->id;
            }
        }
    }
    public function getCategoryId($cateName)
    {
        $categories = Category::all();
        foreach ($categories->all() as $category) {
            if (Str::slug($category->name) == $cateName) {
                return $category->id;
            }
        }
    }
}