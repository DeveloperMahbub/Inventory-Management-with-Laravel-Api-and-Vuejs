<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderController extends Controller
{
    public function todayOrder()
    {
        $date = date('d/m/Y');
        $orderData = DB::table('orders')
                ->join('customers','orders.customer_id','customers.id')
                ->where('order_date',$date)
                ->select('customers.name','orders.*')
                ->orderBy('orders.id','DESC')->get();

        return response()->json($orderData);
    }
    public function orderCustomerDetails($id)
    {
        $order = DB::table('orders')
                ->join('customers','orders.customer_id','customers.id')
                ->where('orders.id',$id)
                ->select('customers.name','customers.phone','customers.address','orders.*')->first();

                return response()->json($order);

    }
    public function allOrderDetails($id)
    {
        $details = DB::table('order_details')
                ->join('products','order_details.product_id','products.id')
                ->where('order_details.order_id',$id)
                ->select('products.product_name','products.product_code','products.image','order_details.*')->get();

                return response()->json($details);

    }
    public function searchOrderByDate(Request $request)
    {
        $orderDate = $request->date;
        $newDate = new DateTime($orderDate);
        $date = $newDate->format('d/m/Y');
        $order = DB::table('orders')
                ->join('customers','orders.customer_id','customers.id')
                ->select('customers.name','orders.*')
                ->where('orders.order_date',$date)->get();
        return response()->json($order);
    }
    
}
