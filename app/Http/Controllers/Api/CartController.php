<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::where('id',$id)->first();

        $checkItem = Pos::where('pro_id',$id)->first();
        if ($checkItem) {
            Pos::where('pro_id',$id)->increment('pro_quantity');
            $posItem = Pos::where('pro_id',$id)->first();

            $subTotal = $posItem->pro_quantity * $posItem->product_price;

            Pos::where('pro_id',$id)->update(['sub_total'=>$subTotal]);
        }else{
            $posdata = New Pos();
            $posdata->pro_id = $id;
            $posdata->pro_name = $product->product_name;
            $posdata->pro_quantity = 1;
            $posdata->product_price = $product->selling_price;
            $posdata->sub_total = $product->selling_price;
            $posdata->save();

        }

    }
    public function cartProduct()
    {
        $cartProduct = Pos::orderBy('id','desc')->get();
        return response()->json($cartProduct);
    }

    public function removeCart($id)
    {
        $removeItem = Pos::findOrFail($id);
        $removeItem->delete();
        
    }

    public function increment($id)
    {
        Pos::where('id',$id)->increment('pro_quantity');
        $posItem = Pos::where('id',$id)->first();

        $subTotal = $posItem->pro_quantity * $posItem->product_price;

        Pos::where('id',$id)->update(['sub_total'=>$subTotal]);
        return response('Done');
    }

    public function deccrement($id)
    {
        Pos::where('id',$id)->decrement('pro_quantity');
        $posItem = Pos::where('id',$id)->first();

        $subTotal = $posItem->pro_quantity * $posItem->product_price;

        Pos::where('id',$id)->update(['sub_total'=>$subTotal]);
        return response('Done');
    }
}
