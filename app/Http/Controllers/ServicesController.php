<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreateRequest;
use Validator;
use App\Models\Customer;
use App\Models\DomainReseller;
use App\Models\HostingPackage;
use App\Models\HostingReseller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Service::all());
        return view('services.index')->with('services', Service::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customer = Customer::find(1);
        // echo $customer->user->email;
        return view('services.create')
            ->with('customers', Customer::all())
            ->with('domainResellers', DomainReseller::all())
            ->with('hostingResslers', HostingReseller::all())
            ->with('hostingPackages', HostingPackage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceCreateRequest $request)
    {

        /*$attributeNames['customer_id']          = 'Customer Email';
        $attributeNames['service_for']          = 'Service For';
        $attributeNames['domain_name']          = 'Domain Name';
        $attributeNames['service_start_date']   = 'Service Start Date';
        $attributeNames['service_expire_date']  = 'Service Expire Date';

        $rules['customer_id']           = 'required|integer';
        $rules['service_for']           = 'required|integer';
        $rules['domain_name']           = 'required|string';
        $rules['service_start_date']    = 'required|date';
        $rules['service_expire_date']   = 'required|date';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();*/

        // if ($request->service_for == 3) {
        //     $data = $request->all();
        //     $data['created_by'] = auth()->user()->id;
        //     Service::create($data);
        //     session()->flash('success', 'Customer Service Created Succeffully');
        //     return redirect()->route('services.index');
        // }
        // dd($request->all(), 'Error');
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        Service::create($data);
        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
