<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = Expense::orderBy('id','desc')->get();
        return response()->json($expense);
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
            'details' => 'required|max:255',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);

        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        // $expense->expense_date = date('y-m-d'); if auto generate
        $expense->expense_date = $request->expense_date;
        $expense->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::where('id',$id)->first();
        // $expense = DB::table('expenses')->where('id',$id)->first();
        return response()->json($expense);
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
        
        $validateData = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);
        
        $expense = Expense::findOrFail($id);
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        // $expense->expense_date = date('y-m-d'); if auto generate
        $expense->expense_date = $request->expense_date;
        $expense->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::where('id',$id)->first();
        $expense->delete();
    }
}
