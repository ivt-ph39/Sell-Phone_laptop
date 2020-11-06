<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchProduct extends Controller
{
    public function searchTypeaheadJs(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->q . '%')->orderBy('id')->get();
        return response()->json($products);
    }
    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%');
        if (isset($request->category)) {
            $products->where('category_id', $this->getIdCategory($request->category));
        }
        if (isset($request->price)) {
            switch ($request->price) {
                case 'duoi-2-trieu':
                    $products->where('price', '<', 2000000);
                    break;
                case 'tu-2-4-trieu':
                    $products->whereBetween('price', [2000000, 4000000]);
                    break;
                case 'tu-4-7-trieu':
                    $products->whereBetween('price', [4000000, 7000000]);
                    break;
                case 'tu-7-13-trieu':
                    $products->whereBetween('price', [7000000, 13000000]);
                    break;
                case 'tren-13-trieu':
                    $products->where('price', '>', 13000000);
                    break;
            }
        }
        if (isset($request->orderBy)) {
            switch ($request->orderBy) {
                case 'price_min':
                    $products = $products->orderByRaw('price*(100 - sale)/100');
                    break;
                case 'price_max':
                    $products = $products->orderByRaw("(price*(100 - sale)/100) desc");
                    break;
                case 'top_sell':
                    break;
                case 'top_rating':
                    break;
                default:
                    break;
            }
        } else {
            $products = $products->orderByRaw('price*(100 - sale)/100');
        }
        $data = [
            'listCategory' => Product::with('category')
                ->select(DB::raw('count(category_id) as count, category_id'))
                ->where('name', 'like', '%' . $request->search . '%')
                ->groupBy('category_id')->get(),
            'products'     => $products->where('quantity', '>', 0)->paginate(12)
        ];

        return view('frontend.store', $data);
    }
    public function getIdCategory($slug)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            if (Str::slug($category->name) == $slug) return $category->id;
        }
    }
}