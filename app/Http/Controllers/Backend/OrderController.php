<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Product;
use App\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request, User $user, Order $order)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required'
        ];
        $message = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống'
        ];
        $validator = Validator::make($request->except('orders', 'status'), $rules, $message);
        if ($validator->fails()) {
            return response()->json([
                'error'     => true,
                'message'   => $validator->errors()
            ], 200);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'status' => $request->status
            ];
            if ($request->user_id) {
                $data['user_id'] = $request->user_id;
            }
            try {
                DB::beginTransaction();
                $order = $order->create($data);
                // dd($request->orders);
                foreach ($request->orders as $orderProduct) {
                    $dataCreate = [
                        'quantity'   => $orderProduct['quantity'],
                        'amount'     => $orderProduct['price_new'] * $orderProduct['quantity'],
                        'product_id' => $orderProduct['id']
                    ];
                    $dataInstance[] = $dataCreate;
                }
                $order->products()->attach($dataInstance);
                DB::commit();
                return response()->json([
                    'success' => true
                ], 200);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ], 200);
            }
        }
    }
}