<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SendOrder;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Rating;
use App\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function infoUser($value)
    {
        return Auth::user()->$value;
    }

    public function index(Request $request)
    {
        if (isset($request->created_at)) {
            $created_at = date($request->created_at);
        } else {
            $created_at = '';
        }
        if (isset($request->status)) {
            $status = $request->status;
        } else {
            $status = '';
        }

        if (!empty($created_at) || !empty($status)) {
            $orders = Order::whereDate('created_at', '=', $created_at)
                ->orwhere('status', '=', $status)
                ->latest()->paginate(3);
        } else {
            $orders = Order::latest()->paginate(3);
        }
        $data = [
            'titlePage'   => 'Danh sách đơn hàng',
            'nameAdmin'   => ucwords($this->infoUser('name')),
            'orders' => $orders
        ];
        return view('admin.order.list', $data);
    }

    public function productOrder($id)
    {
        $products = DB::table('order_product')->where('order_id', '=', $id)->get();
        if (!empty($products)) {
            return response()->json([
                'products' => $products
            ], 200);
        }
    }

    public function store(Request $request)
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
                'note' => $request->note
            ];
            if ($request->user_id) {
                $data['user_id'] = $request->user_id;
            }
            try {
                DB::beginTransaction();
                $order = Order::create($data);
                foreach ($request->orders as $orderProduct) {
                    $dataCreate = [
                        'quantity'   => $orderProduct['quantity'],
                        'amount'     => $orderProduct['price_new'] * $orderProduct['quantity'],
                        'product_id' => $orderProduct['id']
                    ];
                    $this->updateQuantityProduct($orderProduct['id'], $orderProduct['quantity']);
                    $dataInstance[] = $dataCreate;
                }
                $orderProduct = $order->products()->attach($dataInstance);

                DB::commit();
                // dd($orderProduct);
                if ($request->user_id) {
                    return response()->json([
                        'success' => true
                    ], 200);
                } else {
                    if ($this->sendOrder($request->email, $order->id)) {
                        return response()->json([
                            'success' => true,
                            'sendMail' => true
                        ], 200);
                    }
                }
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ], 200);
            }
        }
    }
    public function updateQuantityProduct($id, $minusQuantity)
    {
        $product   = Product::find($id);
        $quantityPro    = $product->quantity;
        $update    = $product->update(['quantity' => $quantityPro - $minusQuantity]);
        return $update;
    }
    public function show(Request $request)
    {
        $id_order = $request->id_order;
        $order = OrderProduct::with('products')->where('order_id', $id_order)->get();
        if ($order) {
            return response()->json([
                'success' => true,
                'order'  => $order
            ], 200);
        } else {
            return response()->json([
                'error' => true
            ], 200);
        }
    }
    public function sendOrder($email, $order_id)
    {
        $orders   = OrderProduct::with(['products', 'order'])->where('order_id', $order_id)->get();
        $dataOrder = [
            'order'  => [
                'id' => 16,
                'created_at'  => $orders[0]->order->created_at,
                'status'      => $orders[0]->order->status,
                'finished_at' => $orders[0]->order->finished_at
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
        $sendOrder = Mail::to($email)->send(new SendOrder($dataOrder));
        return true;
    }

    public function update(Order $order)
    {

        $emailOrder = $order->email;
        $order_id   = $order->id;
        if ($order->status == "Đang chờ xử lý") {
            $rs = $order->update(['status' => 1]);
        } elseif ($order->status == "Đang xử lý") {
            $rs = $order->update(['status' => 2]);
        } elseif ($order->status == "Đang giao") {
            $rs = $order->update(['status' => 3, 'finished_at' => now()]);
            if ($rs) {
                $sendOrder = $this->sendOrder($emailOrder, $order_id);
                if ($sendOrder) {
                    return redirect()->back()->with('message', 'Đã thay đổi trạng thái đơn hàng Và đã gửi mail đến khách hàng');
                }
            }
        } else {
            $rs = $order->update(['finished_at' => now()]);
        }
        if (!empty($rs)) {
            return redirect()->back()->with('message', 'Đã thay đổi trạng thái đơn hàng');
        }
        return redirect()->back()->with('message', 'Không thể thay đổi trạng thái đơn hàng');
    }

    public function destroy($id)
    {

        $order = Order::find($id);
        if ($order->status != 'Hoàn thành') {
            return redirect()->back()->with('message', 'Đơn hàng chưa hoàn thành không thể xóa đơn hàng');
        }
        $rs = $order->delete();
        if ($rs) {
            return redirect()->back()->with('message', 'Đã xóa đơn hàng thành công');
        }
        return redirect()->back()->with('message', 'Xóa đơn hàng không thành công');
    }
    public function cancelOrder(Request $request)
    {
        $id = $request->id;
        $order = Order::with(['order_product', 'products'])->find($id);
        foreach ($order->products()->get() as $key => $product) {
            $quantityOld = $product->quantity + $order->order_product()->get()[$key]->quantity;
            $product->update(['quantity' => $quantityOld]);
        }

        if ($order->status === 'Đang chờ xử lý' || $order->status === 'Đang xử lý') {
            $order->delete();
            return response()->json(
                [
                    'success' => true,
                    'id'      => $id,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                ],
                200
            );
        }
    }
    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        // dd($order->status);
        if ($order->status == 'Hoàn thành') {
            $order->delete();
            return response()->json(
                [
                    'success' => true,
                    'id'      => $id
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                ],
                200
            );
        }
    }
}