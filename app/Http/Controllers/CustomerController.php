<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContactPerson;
use App\Http\Requests\CustomerRequest;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class CustomerController extends Controller
{
    protected function createUser($request)
    {
        return User::create([
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
    }

    protected function updateUser($email, $password, $customer)
    {
        $user = User::find($customer->user_id);
        $user->email    = $email;
        $user->password = Hash::make($password);
        $user->save();
        return $user;
    }

    protected function updateUserWithouPassword($email, $customer)
    {
        $user = User::find($customer->user_id);
        $user->email    = $email;
        $user->save();
        return $user;
    }

    /**
     * Attributes Name for Customer Types Individual
     * @return attributesNames 
     */
    protected function attributesForIndividualCustomer()
    {
        $attributeNames['customer_type']        = 'Customer Type';
        $attributeNames['customer_gender']      = 'Customer Gender';
        $attributeNames['customer_first_name']  = 'Customer First Name';
        $attributeNames['customer_last_name']   = 'Customer Last Name';
        $attributeNames['customer_mobile']      = 'Customer Mobile Number';
        $attributeNames['customer_address']     = 'Customer Address';
        $attributeNames['email']                = 'Customer Email';
        $attributeNames['password']             = 'Customer Password';
        $attributeNames['customer_join_date']   = 'Customer Join Date';
        $attributeNames['customer_join_year']   = 'Customer Join Year';

        return $attributeNames;
    }

    /**
     * Validation Rules for Customer Types Individual
     * @return rules 
     */
    protected function rulesForIndividualCustomer()
    {
        $rules['customer_type']         = 'required|string';
        $rules['customer_gender']       = 'required|string';
        $rules['customer_first_name']   = 'required|string';
        $rules['customer_last_name']    = 'required|string';
        $rules['customer_mobile']       = 'required|numeric|digits:11';
        $rules['customer_address']      = 'required|string';
        $rules['email']                 = 'required|email|unique:users';
        $rules['password']              = 'required';
        $rules['customer_join_date']    = 'required|date_format:d-m-Y';
        $rules['customer_join_year']    = 'required|integer';

        return $rules;
    }

    protected function createIndividualCustomer($user, $request)
    {
        return Customer::create([
            'user_id'               => $user->id,
            'customer_first_name'   => $request->customer_first_name,
            'customer_last_name'    => $request->customer_last_name,
            'customer_mobile'       => $request->customer_mobile,
            'customer_type'         => $request->customer_type,
            'customer_gender'       => $request->customer_gender,
            'customer_address'      => $request->customer_address,
            'customer_join_date'    => date('Y-m-d', strtotime($request->customer_join_date)),
            'customer_join_year'    => $request->customer_join_year,
            'customer_reference'    => $request->customer_reference,
            'created_by'            => auth()->user()->id,
        ]);
    }

    /**
     * Store Individual Customer
     */

    protected function attributesForIndividualCustomerUpdate()
    {
        $attributeNames['customer_type']        = 'Customer Type';
        $attributeNames['customer_gender']      = 'Customer Gender';
        $attributeNames['customer_first_name']  = 'Customer First Name';
        $attributeNames['customer_last_name']   = 'Customer Last Name';
        $attributeNames['customer_mobile']      = 'Customer Mobile Number';
        $attributeNames['customer_address']     = 'Customer Address';
        $attributeNames['email']                = 'Customer Email';
        $attributeNames['customer_join_date']   = 'Customer Join Date';
        $attributeNames['customer_join_year']   = 'Customer Join Year';

        return $attributeNames;
    }

    protected function rulesForIndividualCustomerUpdate($user)
    {
        $rules['customer_type']         = 'required|string';
        $rules['customer_gender']       = 'required|string';
        $rules['customer_first_name']   = 'required|string';
        $rules['customer_last_name']    = 'required|string';
        $rules['customer_mobile']       = 'required|numeric|digits:11';
        $rules['customer_address']      = 'required|string';
        $rules['email']                 = 'required|email|unique:users,email,' . $user->id;
        $rules['customer_join_date']    = 'required|date_format:d-m-Y';
        $rules['customer_join_year']    = 'required|integer';

        return $rules;
    }

    protected function updateIndividualCustomer($request, $customer)
    {
        $customer = Customer::find($customer->id);

        $customer->customer_first_name  = $request->customer_first_name;
        $customer->customer_last_name   = $request->customer_last_name;
        $customer->customer_mobile      = $request->customer_mobile;
        $customer->customer_type        = $request->customer_type;
        $customer->customer_gender      = $request->customer_gender;
        $customer->customer_address     = $request->customer_address;
        $customer->customer_join_date   = date('Y-m-d', strtotime($request->customer_join_date));
        $customer->customer_join_year   = $request->customer_join_year;
        $customer->customer_reference   = $request->customer_reference;
        $customer->created_by           = auth()->user()->id;

        $customer->save();
        return $customer;
    }

    protected function deleteOldContactPerson($customerId)
    {
        CustomerContactPerson::where('customer_id', $customerId)->delete();
    }

    /**
     * Attributes Name for Customer Types Individual
     * @return attributesNames 
     */
    protected function attributesForCompanyCustomer()
    {
        $attributeNames['customer_type']        = 'Customer Type';
        $attributeNames['customer_address']     = 'Customer Address';
        $attributeNames['company_name']         = 'Company Name';
        $attributeNames['email']                = 'Customer Email';
        $attributeNames['password']             = 'Customer Password';
        $attributeNames['company_website']      = 'Company Website';
        $attributeNames['full_name']            = 'Contact Person Name';
        $attributeNames['contact_mobile']       = 'Contact Person Mobile';
        $attributeNames['customer_join_date']   = 'Customer Join Date';
        $attributeNames['customer_join_year']   = 'Customer Join Year';

        return $attributeNames;
    }

    /**
     * Validation Rules for Customer Types Company
     * @return rules 
     */
    protected function rulesForCompanyCustomer()
    {
        $rules['customer_type']         = 'required|string';
        $rules['customer_address']      = 'required|string';
        $rules['company_name']          = 'required|string';
        $rules['email']                 = 'required|email|unique:users';
        $rules['password']              = 'required';
        $rules['customer_join_date']    = 'required|date_format:d-m-Y';
        $rules['customer_join_year']    = 'required|integer';
        $rules['company_website']       = 'required|url';
        $rules['full_name']             = 'required';
        $rules['contact_mobile']        = 'required';
        /*foreach ($request->get('full_name') as $key) {
            $rules['full_name[' . $key . ']']         = 'required';
            $rules['contact_mobile[' . $key . ']']    = 'required';
        }*/
        // dd($rules);
        return $rules;
    }

    protected function rulesForCompanyCustomerUpdate()
    {
        $rules['customer_type']         = 'required|string';
        $rules['customer_address']      = 'required|string';
        $rules['company_name']          = 'required|string';
        $rules['email']                 = 'required|email';
        // $rules['password']              = 'required';
        $rules['customer_join_date']    = 'required|date_format:d-m-Y';
        $rules['customer_join_year']    = 'required|integer';
        $rules['company_website']       = 'required|url';
        $rules['full_name']             = 'required';
        $rules['contact_mobile']        = 'required';
        return $rules;
    }

    /**
     * Store Company Customer
     */
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
            'customer_join_date'    => date('Y-m-d', strtotime($request->customer_join_date)),
            'customer_join_year'    => $request->customer_join_year,
            'customer_reference'    => $request->customer_reference,
            'created_by'            => auth()->user()->id,
        ]);
    }

    protected  function UpdateCompanyCustomer($request, $customer)
    {
        $customer = Customer::find($customer->id);

        $customer->customer_first_name  = $request->customer_first_name;
        $customer->customer_last_name   = $request->customer_last_name;
        $customer->customer_type        = $request->customer_type;
        $customer->customer_gender      = $request->customer_gender;
        $customer->company_name         = $request->company_name;
        $customer->company_website      = $request->company_website;
        $customer->company_details      = $request->company_details;
        $customer->customer_address     = $request->customer_address;
        $customer->customer_join_date   =  date('Y-m-d', strtotime($request->customer_join_date));
        $customer->customer_join_year   = $request->customer_join_year;
        $customer->customer_reference   = $request->customer_reference;
        $customer->created_by           = auth()->user()->id;

        $customer->save();
        return $customer;
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
    public function store(Request $request)
    {
        // Value Save Individual Customer
        if ($request->customer_type === 'individual') :
            $attributeNames = $this->attributesForIndividualCustomer();
            $rules = $this->rulesForIndividualCustomer();

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();

            $user = $this->createUser($request);
            $this->createIndividualCustomer($user, $request);
            session()->flash('success', 'Customer Created Successfully.');
            return redirect()->route('customers.index');

        // Value Save Company Customer
        elseif ($request->customer_type === 'company') :
            // $this->validationForCompany($request);
            $attributeNames = $this->attributesForCompanyCustomer();
            $rules = $this->rulesForCompanyCustomer();

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();

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
            session()->flash('success', 'Customer Created Successfully.');
            return redirect()->route('customers.index');
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
        return view('customers.edit', compact('customer'));
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
        $user = User::find($request->usrId);
        // Value Save Individual Customer
        if ($request->customer_type === 'individual') :
            $attributeNames = $this->attributesForIndividualCustomerUpdate();
            $rules = $this->rulesForIndividualCustomerUpdate($user);

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();
            if ($request->has('password') && !is_null($request->password)) {
                $passwordAttrName['password']   = 'Password';
                $passwordAttrRules['password']  = 'required';

                $validator = Validator::make($request->all(), $passwordAttrRules);
                $validator->setAttributeNames($passwordAttrName);
                $validator->validate();

                $this->updateUser($request->email, $request->password, $customer);
            } else {
                $this->updateUserWithouPassword($request->email, $customer);
            }

            $this->updateIndividualCustomer($request, $customer);

            session()->flash('success', 'Customer Update Successfully.');
            return redirect()->route('customers.index');

        // Value Save Company Customer
        elseif ($request->customer_type === 'company') :
            // $this->validationForCompany($request);
            $attributeNames = $this->attributesForCompanyCustomer();
            $rules = $this->rulesForCompanyCustomerUpdate();

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();
            if ($request->has('password') && !is_null($request->password)) {
                $passwordAttrName['password']   = 'Password';
                $passwordAttrRules['password']  = 'required';

                $validator = Validator::make($request->all(), $passwordAttrRules);
                $validator->setAttributeNames($passwordAttrName);
                $validator->validate();
                $this->updateUser($request->email, $request->password, $customer);
            } else {
                $this->updateUserWithouPassword($request->email, $customer);
            }

            $customer = $this->UpdateCompanyCustomer($request, $customer);
            $this->deleteOldContactPerson($customer->id);
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
            session()->flash('success', 'Customer Created Successfully.');
            return redirect()->route('customers.index');
        else :
            session()->flash('warning', 'Something Happend Wrong.');
            return redirect()->back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customer = Customer::find($request->customerId);
        if ($customer) :
            $checkServiceExist = Service::where('customer_id', $customer->id)->exists();
            if (!$checkServiceExist) :
                if ($customer->customer_type == 'company') :
                    $this->deleteCustomerContactPersonById($customer->id);
                    $this->deleteCustomerById($customer->id);
                    $this->deleteUserById($customer->user_id);
                else :
                    $this->deleteCustomerById($customer->id);
                    $this->deleteUserById($customer->user_id);
                endif;

                $data = [
                    'status'    => 200,
                    'title'     => "Customer Deleted.",
                    'message'   => "Customer Deleted Successfully."
                ];
                return response()->json($data);
            else :
                $data = [
                    'status'    => 400,
                    'title'     => "You Can't delete this customer.",
                    'message'   => "This Customer Service Already Exist. Please Contact With Author."
                ];
                return response()->json($data);
            endif;
        else :
            $data = [
                'status'    => 404,
                'title'     => "No Customer Found",
                'message'   => "Something Happend Wrong. Try Again"
            ];
            return response()->json($data);
        endif;
    }

    public function deleteCustomerById($customer_id)
    {
        Customer::where('id', $customer_id)->delete();
    }

    public function deleteCustomerContactPersonById($customer_id)
    {
        CustomerContactPerson::where('customer_id', $customer_id)->delete();
    }

    public function deleteUserById($user_id)
    {
        User::where('id', $user_id)->delete();
    }
}
