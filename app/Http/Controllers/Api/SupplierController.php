<?php

namespace App\Http\Controllers\Api;

use App\Models\supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = supplier::orderBy('id','desc')->get();
        return response()->json($supplier);
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
            'supplier_name' => 'required|max:255',
            'email' => 'required|unique:suppliers|max:255',
            'phone' => 'required|unique:suppliers|min:10',
            'shopname' => 'required|unique:suppliers',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $image_name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);
             


            $supplier = new supplier();
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->photo = $image_url;
            $supplier->save();
        }else{
            $supplier = new supplier();
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->save();

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
        $supplier = supplier::where('id',$id)->first();
        // $supplier = DB::table('employees')->where('id',$id)->first();
        return response()->json($supplier);
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
        $supplier = supplier::findOrFail($id);
        $validateData = $request->validate([
            'supplier_name' => 'required|max:255',
            'email' => 'required|max:255|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required|min:10|unique:suppliers,phone,'.$supplier->id,
            'shopname' => 'required|unique:suppliers,shopname,'.$supplier->id,
        ]);

        if ($request->newphoto) {
            @unlink(public_path($supplier->photo));
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $image_name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);
             


            
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->photo = $image_url;
            $supplier->save();
        }else{
            $supplier->supplier_name = $request->supplier_name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->save();

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
        $supplier = supplier::where('id',$id)->first();
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
            $supplier->delete();
        }else{
            $supplier->delete();
        }
    }
}
