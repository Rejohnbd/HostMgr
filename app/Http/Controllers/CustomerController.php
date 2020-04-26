<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContactPerson;
use App\Http\Requests\CustomerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    protected function createUser($request)
    {
        return User::create([
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
    }

    protected function createIndividualCustomer($user, $request)
    {
        return Customer::create([
            'user_id'               => $user->id,
            'customer_first_name'   => $request->customer_first_name,
            'customer_last_name'    => $request->customer_last_name,
            'customer_type'         => $request->customer_type,
            'customer_gender'       => $request->customer_gender,
            'customer_address'      => $request->customer_address,
            'customer_join_date'    => $request->customer_join_date,
            'customer_join_year'    => $request->customer_join_year,
            'customer_reference'    => $request->customer_reference,
            'created_by'            => auth()->user()->id,
        ]);
    }

    protected function validationForCompany($request)
    {
        $request->validate([
            'company_website'   => 'required|url',
            'full_name'         => 'required',
            'contact_mobile'    => 'required',
        ]);
    }

    protected function createCompanyCustomer($user, $request)
    {
        return Customer::create([
            'user_id'               => $user->id,
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customers = User::where('type', 'customer')->get();
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        // Check the Customer Existance
        $userCheck = User::where('email', $request->email)->first();
        if ($userCheck !==  null) :
            session()->flash('warning', 'Customer Already Exist.');
            return redirect()->back();
        endif;

        // Value Save Individual Customer
        if ($request->customer_type === 'individual') :
            $user = $this->createUser($request);
            $this->createIndividualCustomer($user, $request);
            session()->flash('success', 'Customer Created.');
            return redirect()->back();

        // Value Save Company Customer
        elseif ($request->customer_type === 'company') :
            $this->validationForCompany($request);
            $user = $this->createUser($request);
            $customer = $this->createCompanyCustomer($user, $request);
            // Loop for Contact Person value save
            for ($i = 0; $i < count($request->contact_mobile); $i++) :
                if (isset($request->full_name[$i]) && isset($request->contact_mobile[$i])) :
                    CustomerContactPerson::create([
                        'customer_id'       => $customer->id,
                        'full_name'         => $request->full_name[$i],
                        'contact_email'     => $request->contact_email[$i],
                        'contact_mobile'    => $request->contact_mobile[$i],
                        'created_by'        => auth()->user()->id,
                    ]);
                endif;
            endfor;
            session()->flash('success', 'Customer Created.');
            return redirect()->back();
        else :
            session()->flash('warning', 'Something Happend Wrong.');
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
        // dd($customer->customerContactPersons->pluck(2));
        return view('customers.show', compact('customer'));
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
