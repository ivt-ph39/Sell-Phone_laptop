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
            ])->get(),
            'productTopSell'    => Category::with([
                'products' => function ($query) {
                    return $query->orderBy('id', 'desc')->take(8);
                }
            ])->get(),

            // 'productTopRating'  => Category::with([
            //     'products'  => function ($query) {
            //         return $query->orderBy(function ($query) {
            //             dd($query->rating);
            //             return $query->rating;
            //         }, 'desc')->get();
            //     }
            // ]),

            // 'product'   => Product::has('products.rating', '>=', 4)->get()
            // 'productTopRating'  => Product::with(['category', 'ratings'])->whereHas()orderByRaw('rating')->take(8),
        ];
        // dd($data['product']);
        // dd($data['product'][2]->rating);


        // $order     = Order::with(['products'])->find(16);
        $orders   = OrderProduct::with(['products', 'order'])->where('order_id', 16)->get();
        $dataOrder = [
            'order'  => [
                'id' => 16,
                'created_at' => $orders[0]->order->created_at,
                'status'     => $orders[0]->order->status,
            ],
            'orderAmount' => 0
        ];
        $orderDetail = [];
        foreach ($orders as $order) {
            $orderDetail[] =  [
                'productName' => $order->products->name,
                'productImage' => $order->products->avatar,
                'productQuantity' => $order->quantity,
                'productAmount' => number_format($order->amount, 0, ',', '.'),
            ];
            $dataOrder['orderAmount'] = $dataOrder['orderAmount'] + $order->amount;
        }
        $dataOrder['orderAmount'] = number_format($dataOrder['orderAmount'], 0, ',', '.');
        $dataOrder['orderDetail'] = $orderDetail;
        dd($dataOrder['order']['id']);
        return view('frontend.home', $data);
    }
}