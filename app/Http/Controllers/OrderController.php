<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 0 = Cart , 1 = Check out
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();

        return view('orders.index')->with('order', $order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = Products::find($request->product_id);
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
        // check that user already have a product in cast or not if not create a order
        if ($order) {
            $order_Detail = $order->order_details()->where('product_id', $product->id)->first();

            if ($order_Detail) {
                $newAmount = $order_Detail->amount + 1;
                $order_Detail->update([
                    'amount' => $newAmount
                ]);
            } else {
                $prepareCartDetail = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'amount' => 1,
                    'price' => $product->price,
                ];
                $order_Detail = OrderDetail::create($prepareCartDetail);
            }
        } else {
            $prepareCart = [
                'status' => 0,
                'user_name' => Auth::user()->name,
                'total' => 0,
                'user_id' => Auth::id()
            ];
            $order = Order::create($prepareCart);

            $prepareCartDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'amount' => 1,
                'price' => $product->price,
            ];
            $order_Detail = OrderDetail::create($prepareCartDetail);
        }

        $sum = 0;
        $total = $order->order_details->map(function ($order_Detail) use ($sum) {
            $sum += $order_Detail->amount * $order_Detail->price;
            return $sum;
        })->toArray();

        $order->update([
            'total' => array_sum($total)
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order_Detail = $order->order_details()->where('product_id', $request->product_id)->first();
        //Check out Order
        if ($request->value = "checkout") {
            $order->update([
                'status' => 1
            ]);
        } else {
            if ($order_Detail) {
                if ($request->value == "increase") {
                    $newAmount = $order_Detail->amount + 1;
                } else {
                    $newAmount = $order_Detail->amount - 1;
                }
                $order_Detail->update([
                    'amount' => $newAmount
                ]);
            }
            //update sum for price
            $sum = 0;
            $total = $order->order_details->map(function ($order_Detail) use ($sum) {
                $sum += $order_Detail->amount * $order_Detail->price;
                return $sum;
            })->toArray();

            $order->update([
                'total' => array_sum($total)
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showOrder()
    {
        return Order::all();
    }
}
