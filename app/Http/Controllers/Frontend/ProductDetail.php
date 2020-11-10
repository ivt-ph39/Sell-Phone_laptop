<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Product;
use App\Model\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductDetail extends Controller
{
    public function index($productName)
    {
        $product_id = $this->getProductId($productName);
        $product    = Product::with(['images', 'category', 'tags', 'ratings', 'comments'])->find($product_id);
        $data = [
            'categories'      => Category::where('parent_id', 0)->get(),
            'product'         => $product,
            'ratings'         => $product->ratings->sortByDesc('id'),
            'comments'        => Comment::where('product_id', $product_id)->where('active', 1)->orderBy('id', 'desc'),
            'star_product'    => $this->getStarProduct($product_id),
            'product_related' => Product::where('category_id', $product->category_id)->orderBy('id', 'desc')->take(4)->get()
        ];
        // dd($data['product_related'], $product->category_id);
        return view('frontend.product_detail', $data);
    }
    public function getRatings(Request $request)
    {
        $id   = $request->id;
        $page = $request->page;
        $product    = Product::with(['ratings'])->find($id);
        $ratings    = $product->ratings->sortByDesc('id')->skip(4 * ($page - 1))->take(4);
        // dd($ratings[14]->user->name);
        $dataRating = [];
        foreach ($ratings as $rating) {
            $dataRating[] = [
                'name' => $rating->user->name,
                'created_at' =>  date_format($rating->created_at, "Y-m-d H:i"),
                'star'       => $rating->star,
                'content'    => $rating->content,
            ];
        }
        return response()->json([
            'success'    => true,
            'ratings'    => $dataRating,
            'page'       => $page
        ], 200);
    }
    public function getComments(Request $request)
    {
        $id   = $request->id;
        $page = $request->page;
        $comments   = Comment::where('product_id', $id)->where('active', 1)->where('parent_id', 0)->orderBy('id', 'desc')->skip(5 * ($page - 1))->take(5)->get();

        $dataComments = [];
        foreach ($comments as $comment) {
            $data = [
                'id'     => $comment->id,
                'name'   => $comment->name,
                'avatar' => $comment->getCharFirstLastName($comment->name),
                'content' => $comment->content,
                'time'   => date_format($comment->created_at, "Y-m-d H:i"),
            ];
            if ($comment->hasChild($comment->id)) {
                $data['child'] = [
                    'contentChild' => $comment->hasChild($comment->id)[0]->content,
                    'timeChild'    => date_format($comment->hasChild($comment->id)[0]->created_at, "Y-m-d H:i")
                ];
            }
            $dataComments[] = $data;
        }
        return response()->json([
            'success'   => true,
            'comments'  => $dataComments,
            'page'      => $page
        ], 200);
    }
    public function getStarProduct($product_id)
    {
        // $star = Rating::select(DB::raw('star, count(star)'))->where('product_id', $product_id)->groupBy('star')->orderBy('star')->get();
        $total_star = Rating::where('product_id', $product_id)->count();
        $star_1     = Rating::where('product_id', $product_id)->where('star', 1)->count();
        $star_2     = Rating::where('product_id', $product_id)->where('star', 2)->count();
        $star_3     = Rating::where('product_id', $product_id)->where('star', 3)->count();
        $star_4     = Rating::where('product_id', $product_id)->where('star', 4)->count();
        $star_5     = Rating::where('product_id', $product_id)->where('star', 5)->count();
        if ($total_star == 0) {
            $star = [
                '1-star'  =>  [0, 0],
                '2-star'  =>  [0, 0],
                '3-star'  =>  [0, 0],
                '4-star'  =>  [0, 0],
                '5-star'  =>  [0, 0],
                'average' => 0,
            ];
        } else {
            $star = [
                '1-star'  =>  [$star_1, $star_1 * 100 / $total_star],
                '2-star'  =>  [$star_2, $star_2 * 100 / $total_star],
                '3-star'  =>  [$star_3, $star_3 * 100 / $total_star],
                '4-star'  =>  [$star_4, $star_4 * 100 / $total_star],
                '5-star'  =>  [$star_5, $star_5 * 100 / $total_star],
                'average' => round(($star_1 * 1 + $star_2 * 2 + $star_3 * 3 + $star_4 * 4 + $star_5 * 5) / $total_star, 1),
            ];
        }
        return $star;
    }
    public function getProductId($productName)
    {
        $products = Product::all();
        foreach ($products as $product) {
            if (Str::slug($product->name) == $productName) {
                return $product->id;
            }
        }
    }
}