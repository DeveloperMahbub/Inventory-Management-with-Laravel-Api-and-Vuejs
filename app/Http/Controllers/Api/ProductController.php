<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('suppliers','products.supplier_id','suppliers.id')
                    ->select('categories.category_name','suppliers.supplier_name','products.*')
                    ->orderBy('products.id','DESC')->get();

        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'quantity' => 'required',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $image_name = time().".".$ext;
            $img = Image::make($request->image)->resize(540,500);
            $upload_path = 'backend/products/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);
             


            $product = new Product();
            $product->product_name = $request->product_name;
            $product->root = $request->root;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->quantity = $request->quantity;
            $product->image = $image_url;
            $product->save();
        }else{
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->root = $request->root;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->quantity = $request->quantity;
            $product->save();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
        // $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products,product_code,'.$product->id,
            'buying_price' => 'required',
            'selling_price' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'quantity' => 'required',
        ]);

        if ($request->newphoto) {
            @unlink(public_path($product->image));
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $image_name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(540,500);
            $upload_path = 'backend/products/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);
             


            
            $product->product_name = $request->product_name;
            $product->root = $request->root;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->quantity = $request->quantity;
            $product->image = $image_url;
            $product->save();
        }else{
            $product->product_name = $request->product_name;
            $product->root = $request->root;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->quantity = $request->quantity;
            $product->save();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first();
        $photo = $product->image;
        if($photo){
            unlink($photo);
            $product->delete();
        }else{
            $product->delete();
        }
    }

    public function stockUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'quantity' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->quantity = $request->quantity;
        $product->save();

        
    }
}
