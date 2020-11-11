<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index($page, Request $request)
    {
        $id = $this->getIdCategory($page);

        $products = Product::where('category_id', $id);
        if (isset($request->brand)) {
            $brand_id = $this->getIdBrand($request->brand);
            $products = $products->where('brand_id', $brand_id);
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
            }
        } else {
            $products = $products->orderByRaw('price*(100 - sale)/100');
        }
        $products = $products->where('quantity', '>', 0);
        $data = [
            'categories' => Category::where('parent_id', 0)->get(),
            'products'   => $products->paginate(12),
            'brands'     => Brand::where('category_id', $id)->get(),
            'page'       => $page
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
    public function getIdBrand($slug)
    {
        $brands = Brand::all();
        foreach ($brands as $brand) {
            if (Str::slug($brand->name) == $slug) return $brand->id;
        }
    }
}