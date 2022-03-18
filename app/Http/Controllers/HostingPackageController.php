<?php

namespace App\Http\Controllers;

use App\Models\HostingPackage;
use App\Http\Requests\HostingPackageRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

class HostingPackageController extends Controller
{
    /**
     * Package Attributes Defined Here
     * @return AttributesNames
     */
    private function packageAttributes()
    {
        $attributeNames['name']             = 'Package Name';
        $attributeNames['space']            = 'Package Space';
        $attributeNames['bandwidth']        = 'Package Bandwidth';
        $attributeNames['db_qty']           = 'Package Database Quantity';
        $attributeNames['emails_qty']       = 'Package Emails Quantity';
        $attributeNames['subdomain_qty']    = 'Package Subdomain Quantity';
        $attributeNames['ftp_qty']          = 'Package FTP Quantity';
        $attributeNames['park_domain_qty']  = 'Package Park Domain Quantity';
        $attributeNames['addon_domain_qty'] = 'Package Addon Domain Quantity';

        return $attributeNames;
    }

    /**
     * Package Validation Rules Defined Here
     * @return Rules
     */
    private function packageValidationRules()
    {
        $rules['name']              = 'required|string';
        $rules['space']             = 'required|string';
        $rules['bandwidth']         = 'required|string';
        $rules['db_qty']            = 'required|string';
        $rules['emails_qty']        = 'required|string';
        $rules['subdomain_qty']     = 'required|string';
        $rules['ftp_qty']           = 'required|string';
        $rules['park_domain_qty']   = 'required|string';
        $rules['addon_domain_qty']  = 'required|string';

        return $rules;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostingPackages = HostingPackage::all();
        return view('hosting-packages.index', compact('hostingPackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hosting-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames = $this->packageAttributes();
        $rules = $this->packageValidationRules();

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        HostingPackage::create($request->all());
        session()->flash('success', 'Hosting Package Added.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function show(HostingPackage $hostingPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(HostingPackage $hostingPackage)
    {
        return view('hosting-packages.create', compact('hostingPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HostingPackage $hostingPackage)
    {
        $attributeNames = $this->packageAttributes();
        $rules = $this->packageValidationRules();

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $hostingPackage->update($request->all());
        session()->flash('success', 'Hosting Package Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hostingPackage = HostingPackage::find($request->hostingPackageId);
        if ($hostingPackage) :
            $checkServiceExist = Service::where('hosting_package_id', $hostingPackage->id)->exists();
            if (!$checkServiceExist) :
                $hostingPackage->delete();
                $data = [
                    'status'    => 200,
                    'title'     => "Customer Deleted.",
                    'message'   => "Customer Deleted Successfully."
                ];
                return response()->json($data);
            else :
                $data = [
                    'status'    => 400,
                    'title'     => "You Can't delete this Hosting Package.",
                    'message'   => "This Hosting Package Used in Service. Please Contact With Author."
                ];
                return response()->json($data);
            endif;
        else :
            $data = [
                'status'    => 404,
                'title'     => "No Hosting Package Found",
                'message'   => "Something Happend Wrong. Try Again"
            ];
            return response()->json($data);
        endif;
    }
}
