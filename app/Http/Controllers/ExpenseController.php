<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $expense = Expense::where("user_id", $user_id)->get();

        return response()->json([
            "status" => 1,
            "data"=>$expense
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "description" => "required",
            "expense_date" => "required",
            "amount" => "required",
            "payment_method" => "required"
        ]);

        $user_id = auth()->user()->id;

        $expense = new Expense();
        $expense->user_id = $user_id;
        $expense->description = $request->description;
        $expense->expense_date = $request->expense_date;
        $expense->amount = $request->amount;
        $expense->payment_method = $request->payment_method;

        $expense->save();

        return response()->json([
            "status" => 1,
            "msg" => "Expense created succesfully!",
            "expense"=>$expense
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Expense $expense)
    {
        $user_id = auth()->user()->id;
        $id = $expense->id;
        if(Expense::where(["user_id"=>$user_id, "id"=>$id])->exists() ) {
            $expense = Expense::find($id);

            $expense->description = $request->description;
            $expense->expense_date = $request->expense_date;
            $expense->amount = $request->amount;
            $expense->payment_method = $request->payment_method;

            $expense->save();
            return response()->json([
                "status" => 1,
                "msg" => "Expense updated successfully!",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Expense not found.",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'message' =>'expense removed'
        ]);
    }
}
