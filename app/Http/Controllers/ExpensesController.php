<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expenses::all();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames['expenses_amount'] = 'Expenses Amount';
        $attributeNames['details'] = 'Expenses Details';

        $rules['expenses_amount'] = 'required|integer|gt:0';
        $rules['details'] = 'required|string';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $expInfo = Expenses::create($request->all());

        $lastTransaction = Transaction::latest()->first();
        if (is_null($lastTransaction)) {
            $initialBalance = $this->getInitialBalance();
            Transaction::create([
                'expense_id'        => $expInfo->id,
                'expenses'          => $request->expenses_amount,
                'previous_balance'  => $initialBalance,
                'present_balance'   => $initialBalance - $request->expenses_amount,
                'description'       => 'Expense Taka ' . $request->expenses_amount . ' for ' . $request->details
            ]);
        } else {
            Transaction::create([
                'expense_id'        => $expInfo->id,
                'expenses'          => $request->expenses_amount,
                'previous_balance'  => $lastTransaction->present_balance,
                'present_balance'   => $lastTransaction->present_balance - $request->expenses_amount,
                'description'       => 'Expense Taka ' . $request->expenses_amount . ' for ' . $request->details
            ]);
        }

        session()->flash('success', 'Expenses Created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenses = Expenses::findorFail($id);
        return view('expenses.create', compact('expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expenses)
    {
        dd($request->all(), $expenses);
        // Expenses::where('id', $request->)
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }

    public function getInitialBalance()
    {
        $initialBalance = DB::table('initial_balance')->select('initial_balance')->where('id', 1)->first();
        return $initialBalance->initial_balance;
    }
}
