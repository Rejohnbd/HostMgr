<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Validator;

class ServiceTypeControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service-types.index')->with('serviceTypes', ServiceType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames['name'] = 'Service Type Name';
        $attributeNames['details'] = 'Service Type Details';

        $rules['name'] = 'required';
        $rules['details'] = 'required';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        ServiceType::create($request->all());
        session()->flash('success', 'Service Type Created Successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $serviceType)
    {
        return view('service-types.create', compact('serviceType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $attributeNames['name'] = 'Service Type Name';
        $attributeNames['details'] = 'Service Type Details';

        $rules['name'] = 'required';
        $rules['details'] = 'required';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $serviceType->update($request->all());
        session()->flash('success', 'Service Type Update');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $serviceTypeInfo = ServiceType::find($request->id);
        if ($serviceTypeInfo) :
            $serviceInfo = ServiceItem::where('service_type_id', $serviceTypeInfo->id)->first();
            if ($serviceInfo) :
                session()->flash('warning', 'This Service Type Used by System. You can not delete this.');
                return redirect()->back();
            else :
                ServiceType::where('id', $request->id)->delete();
                session()->flash('success', 'Service Type Delete Successfully');
                return redirect()->back();
            endif;
        else :
            session()->flash('warning', 'Something Happend Wrong. Try Again.');
            return redirect()->back();
        endif;
    }
}
