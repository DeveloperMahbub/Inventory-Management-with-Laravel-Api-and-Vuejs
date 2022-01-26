<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function getProduct($id)
    {
        $product = Product::where('category_id',$id)->get();
        return response()->json($product);
    }

    public function orderDone(Request $request)
    {
        // return response('Everything all done');

        $validateData = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
            'pay' => 'required',
            'due' => 'required',
        ]);

        $data = new Order();
        $data->customer_id = $request->customer_id;
        $data->qty = $request->qty;
        $data->sub_total = $request->subTotal;
        $data->vat = $request->vat;
        $data->total = $request->total;
        $data->pay = $request->pay;
        $data->due = $request->due;
        $data->payby = $request->payby;
        $data->order_date = date('d/m/Y');
        $data->order_month = date('F');
        $data->order_year = date('Y');
        $data->save();
        
        $order_id = Order::where('id',$data->id)->first();
        $contents = Pos::all();
        // $orderData = new OrderDetail();
        $orderData = array();
        foreach ($contents as $content) {

            $orderData['order_id'] = $order_id->id;
            $orderData['product_id'] = $content->pro_id;
            $orderData['pro_quantity'] = $content->pro_quantity;
            $orderData['product_price'] = $content->product_price;
            $orderData['sub_total'] = $content->sub_total;
            $orderData['created_at'] =  date('Y-m-d H:i:s');
            $orderData['updated_at'] = date('Y-m-d H:i:s');
            DB::table('order_details')->insert($orderData);

            // $orderData->order_id = $order_id->id;
            // $orderData->product_id= $content->pro_id;
            // $orderData->pro_quantity= $content->pro_quantity;
            // $orderData->product_price= $content->product_price;
            // $orderData->sub_total= $content->sub_total;
            // $orderData->save();

            Product::where('id',$content->pro_id)->update(['quantity' => DB::raw('quantity -'.$content->pro_quantity)]);
        }
        
        DB::table('pos')->delete();
        return response('Done');

    }
}
