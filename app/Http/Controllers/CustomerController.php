<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerContactPerson;
use App\Http\Requests\CustomerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::where('type', 'customer')->get();
        return view('customers.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        if (User::findOrFail($request->user_id)) :
            $customer = Customer::create([
                'user_id'               => $request->user_id,
                'customer_first_name'   => $request->customer_first_name,
                'customer_last_name'    => $request->customer_last_name,
                'customer_type'         => $request->customer_type,
                'customer_gender'       => $request->customer_gender,
                'company_name'          => $request->company_name,
                'company_website'       => $request->company_website,
                'company_details'       => $request->company_details,
                'customer_address'      => $request->customer_address,
                'customer_join_date'    => $request->customer_join_date,
                'customer_join_year'    => $request->customer_join_year,
                'customer_reference'    => $request->customer_reference,
                'created_by'            => auth()->user()->id,
            ]);

            CustomerContactPerson::create([
                'customer_id'       => $customer->id,
                'full_name'         => $request->full_name,
                'contact_email'     => $request->contact_email,
                'contact_mobile'    => $request->contact_mobile,
                'created_by'        => auth()->user()->id,
            ]);

            session()->flash('success', 'Customer Created.');

            return redirect()->back();
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
