<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreateRequest;
use Validator;
use App\Models\Customer;
use App\Models\DomainReseller;
use App\Models\HostingPackage;
use App\Models\HostingReseller;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServiceLog;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use DB;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['CheckCustomersCount', 'CheckServiceType', 'CheckHostingPackageCount'])->only(['create', 'store']);
    }

    public function attributesForAll()
    {
        $attributeNames['service_for']  = 'Service For';
        $attributeNames['domain_name']  = 'Domain Name';
        $attributeNames['service_start_date']   = 'Service Start Date';
        $attributeNames['service_expire_date']  = 'Service Expire Date';
        return $attributeNames;
    }

    public function rulesForAll()
    {
        $rules['service_for']           = 'required';
        $rules['domain_name']           = 'required|string';
        $rules['service_start_date']    = 'required|date';
        $rules['service_expire_date']   = 'required|date';
        return $rules;
    }

    public function attributesForCustomPackage()
    {
        $attributeNames['hosting_space']            = 'Hosting Space';
        $attributeNames['hosting_bandwidth']        = 'Hosting Bandwidth';
        $attributeNames['hosting_db_qty']           = 'Hosting DB Quantity';
        $attributeNames['hosting_emails_qty']       = 'Hosting Emails Quantity';
        $attributeNames['hosting_subdomain_qty']    = 'Hosting Subdomain Quantity';
        $attributeNames['hosting_ftp_qty']          = 'Hosting FTP Quantity';
        $attributeNames['hosting_park_domain_qty']  = 'Hosting Park Domain Quantity';
        $attributeNames['hosting_addon_domain_qty'] = 'Hosting Addon Domain Quantity';
        return $attributeNames;
    }

    public function rulesForCustomPackage()
    {
        $rules['hosting_space']                     = 'required';
        $rules['hosting_bandwidth']                 = 'required';
        $rules['hosting_db_qty']                    = 'required';
        $rules['hosting_emails_qty']                = 'required';
        $rules['hosting_subdomain_qty']             = 'required';
        $rules['hosting_ftp_qty']                   = 'required';
        $rules['hosting_park_domain_qty']           = 'required';
        $rules['hosting_addon_domain_qty']          = 'required';
        return $rules;
    }

    protected function checkValidity($request, $rules, $attributeNames)
    {
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();
    }

    protected function getUserId($customerId)
    {
        $userId = DB::table('customers')->where('id', '=', $customerId)->pluck('user_id')->first();
        return $userId;
    }

    /*
     
    protected function attributesForOnlyDomain()
    {
        $attributeNames['service_for']          = 'Service For';
        $attributeNames['domain_name']          = 'Domain Name';
        $attributeNames['domain_reseller_id']   = 'Domain Reseller Name';
        $attributeNames['service_start_date']   = 'Service Start Date';
        $attributeNames['service_expire_date']  = 'Service Expire Date';
        return $attributeNames;
    }

    protected function rulesForOnlyDomain()
    {
        $rules['service_for']           = 'required|integer';
        $rules['domain_name']           = 'required|string';
        $rules['domain_reseller_id']    = 'required';
        $rules['service_start_date']    = 'required|date';
        $rules['service_expire_date']   = 'required|date';
        return $rules;
    }

    protected function attributesForOnlyHosting()
    {
        $attributeNames['service_for']          = 'Service For';
        $attributeNames['domain_name']          = 'Domain Name';
        $attributeNames['hosting_reseller_id']  = 'Hosting Reseller Name';
        $attributeNames['hosting_type']         = 'Hosting Type';
        $attributeNames['service_start_date']   = 'Service Start Date';
        $attributeNames['service_expire_date']  = 'Service Expire Date';
        return $attributeNames;
    }

    protected function rulesForOnlyHosting()
    {
        $rules['service_for']           = 'required|integer';
        $rules['domain_name']           = 'required|string';
        $rules['hosting_reseller_id']   = 'required';
        $rules['hosting_type']          = 'required';
        $rules['service_start_date']    = 'required|date';
        $rules['service_expire_date']   = 'required|date';
        return $rules;
    }

    protected function attributesForPackageHosting()
    {
        $attributeNames['hosting_package_id']   = 'Hosting Package';
        return $attributeNames;
    }

    protected function rulesForPackageHosting()
    {
        $rules['hosting_package_id'] = 'required';
        return $rules;
    }

    protected function attributesForDomainHosting()
    {
        $attributeNames['service_for']          = 'Service For';
        $attributeNames['domain_name']          = 'Domain Name';
        $attributeNames['domain_reseller_id']   = 'Domain Reseller Name';
        $attributeNames['hosting_reseller_id']  = 'Hosting Reseller Name';
        $attributeNames['hosting_type']         = 'Hosting Type';
        $attributeNames['service_start_date']   = 'Service Start Date';
        $attributeNames['service_expire_date']  = 'Service Expire Date';
        return $attributeNames;
    }

    protected function rulesForDomainHosting()
    {
        $rules['service_for']           = 'required|integer';
        $rules['domain_name']           = 'required|string';
        $rules['domain_reseller_id']    = 'required';
        $rules['hosting_reseller_id']   = 'required';
        $rules['hosting_type']          = 'required';
        $rules['service_start_date']    = 'required|date';
        $rules['service_expire_date']   = 'required|date';
        return $rules;
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            ->with('serviceTypes', ServiceType::all())
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
    public function store(Request $request)
    {

        $attributeNames['customer_type']  = 'Customer Types';
        $rules['customer_type'] = 'required|integer|min:1|max:2';
        $this->checkValidity($request, $rules, $attributeNames);
        // Check Customer Type Validity
        if ($request->customer_type == 1) :
            $attributeNames['individual_customer']  = 'Individual Customer';
            $rules['individual_customer'] = 'required|integer';
            $this->checkValidity($request, $rules, $attributeNames);
            $data['customer_id'] = $request->individual_customer;
        endif;
        // Check Customer Type Validity
        if ($request->customer_type == 2) :
            $attributeNames['company_customer']  = 'Company Customer';
            $rules['company_customer'] = 'required|integer';
            $this->checkValidity($request, $rules, $attributeNames);
            $data['customer_id'] = $request->company_customer;
        endif;

        $user_id = $this->getUserId($data['customer_id']);
        $data['user_id'] = $user_id;

        // Check Initial Validity For all intial show form fields
        $attributeNames = $this->attributesForAll();
        $rules = $this->rulesForAll();
        $this->checkValidity($request, $rules, $attributeNames);

        $data['domain_name'] = $request->domain_name;
        $data['service_start_date'] = $request->service_start_date;
        $data['service_expire_date'] = $request->service_expire_date;

        $dataItem = array();
        for ($i = 1; $i <= count($request->service_types); $i++) :

            if ($request->service_types[$i] == 1) :
                $attributeNames['domain_reseller_id'] = 'Domain Reseller Name';
                $rules['domain_reseller_id']          = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $data['domain_reseller_id'] = $request->domain_reseller_id;
            endif;
            if ($request->service_types[$i] == 2) :
                $attributeNames['hosting_reseller_id']  = 'Hosting Reseller Name';
                $attributeNames['hosting_type']         = 'Hosting Type';
                $rules['hosting_reseller_id']           = 'required';
                $rules['hosting_type']                  = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $data['hosting_reseller_id']    = $request->hosting_reseller_id;
                $data['hosting_type']           = $request->hosting_type;

                if ($request->hosting_type == 'package') :
                    $attributeNames['hosting_package_id']     = 'Hosting Package';
                    $rules['hosting_package_id']              = 'required';
                    $this->checkValidity($request, $rules, $attributeNames);

                    $data['hosting_package_id']   = $request->hosting_package_id;
                endif;

                if ($request->hosting_type == 'custom') :
                    $attributeNames = $this->attributesForCustomPackage();
                    $rules = $this->rulesForCustomPackage();
                    $this->checkValidity($request, $rules, $attributeNames);

                    $data['hosting_space']              = $request->hosting_space;
                    $data['hosting_bandwidth']          = $request->hosting_bandwidth;
                    $data['hosting_db_qty']             = $request->hosting_db_qty;
                    $data['hosting_emails_qty']         = $request->hosting_emails_qty;
                    $data['hosting_subdomain_qty']      = $request->hosting_subdomain_qty;
                    $data['hosting_ftp_qty']            = $request->hosting_ftp_qty;
                    $data['hosting_park_domain_qty']    = $request->hosting_park_domain_qty;
                    $data['hosting_addon_domain_qty']   = $request->hosting_addon_domain_qty;
                endif;

            endif;
            if ($request->service_types[$i] == 3) :
                $attributeNames['item_details'] = 'Item Details';
                $rules['item_details']          = 'required';
                $this->checkValidity($request, $rules, $attributeNames);
                $dataItem['item_details'] = $request->item_details;
            endif;

        endfor;
        $data['service_status'] = 'active';
        $data['created_by'] = auth()->user()->id;

        $service = Service::create($data);
        $logData['customer_id']         = $data['customer_id'];
        $logData['service_id']          = $service->id;
        $logData['service_log_for']     = 'new';
        $logData['service_start_date']  = $data['service_start_date'];
        $logData['service_expire_date'] = $data['service_expire_date'];


        $dataItem['service_id'] = $service->id;
        for ($i = 1; $i <= count($request->service_types); $i++) :
            if ($request->service_types[$i] == 0) {
                continue;
            } else {
                $dataItem['service_type_id'] = $request->service_types[$i];
                ServiceItem::create($dataItem);
                $logData['service_type_id'] = $request->service_types[$i];
                ServiceLog::create($logData);
            }

        endfor;

        session()->flash('success', 'Service Create Successfully.');
        return redirect()->route('services.index');
        /*
        if ($request->service_for == 3) :
            $attributeNames = $this->attributesForOnlyDomain();
            $rules = $this->rulesForOnlyDomain();
            $this->checkValidity($request, $rules, $attributeNames);

            $data['service_for'] = $request->service_for;
            $data['domain_name'] = $request->domain_name;
            $data['domain_reseller_id'] = $request->domain_reseller_id;
            $data['service_start_date'] = $request->service_start_date;
            $data['service_expire_date'] = $request->service_expire_date;
            $data['created_by'] = auth()->user()->id;
            $service = Service::create($data);

            $logData['customer_id']         = $data['customer_id'];
            $logData['service_id']          = $service->id;
            $logData['service_type']        = 'new';
            $logData['service_start_date']  = $data['service_start_date'];
            $logData['service_expire_date'] = $data['service_expire_date'];
            ServiceLog::create($logData);

            session()->flash('success', 'Customer Service Created Succeffully');
            return redirect()->back();
        endif;

        if ($request->service_for == 2) :
            $attributeNames = $this->attributesForOnlyHosting();
            $rules = $this->rulesForOnlyHosting();
            $this->checkValidity($request, $rules, $attributeNames);

            $data['service_for']            = $request->service_for;
            $data['domain_name']            = $request->domain_name;
            $data['domain_reseller_id']     = $request->domain_reseller_id;
            $data['hosting_reseller_id']    = $request->hosting_reseller_id;
            $data['hosting_type']           = $request->hosting_type;
            $data['service_start_date']     = $request->service_start_date;
            $data['service_expire_date']    = $request->service_expire_date;

            if ($request->hosting_type == 'package') :
                $attributeNames = $this->attributesForPackageHosting();
                $rules = $this->rulesForPackageHosting();
                $this->checkValidity($request, $rules, $attributeNames);

                $data['hosting_package_id']   = $request->hosting_package_id;
                $data['created_by'] = auth()->user()->id;
                $service = Service::create($data);

                $logData['customer_id']         = $data['customer_id'];
                $logData['service_id']          = $service->id;
                $logData['service_type']        = 'new';
                $logData['service_start_date']  = $data['service_start_date'];
                $logData['service_expire_date'] = $data['service_expire_date'];
                ServiceLog::create($logData);

                session()->flash('success', 'Customer Service Created Succeffully');
                return redirect()->back();
            endif;

            if ($request->hosting_type == 'custom') :

                $data['hosting_space']              = $request->hosting_space;
                $data['hosting_bandwidth']          = $request->hosting_bandwidth;
                $data['hosting_db_qty']             = $request->hosting_db_qty;
                $data['hosting_emails_qty']         = $request->hosting_emails_qty;
                $data['hosting_subdomain_qty']      = $request->hosting_subdomain_qty;
                $data['hosting_ftp_qty']            = $request->hosting_ftp_qty;
                $data['hosting_park_domain_qty']    = $request->hosting_park_domain_qty;
                $data['hosting_addon_domain_qty']   = $request->hosting_addon_domain_qty;
                $data['created_by'] = auth()->user()->id;
                $service = Service::create($data);

                $logData['customer_id']         = $data['customer_id'];
                $logData['service_id']          = $service->id;
                $logData['service_type']        = 'new';
                $logData['service_start_date']  = $data['service_start_date'];
                $logData['service_expire_date'] = $data['service_expire_date'];
                ServiceLog::create($logData);

                session()->flash('success', 'Customer Service Created Succeffully');
                return redirect()->back();
            endif;
        endif;

        if ($request->service_for == 1) :
            $attributeNames = $this->attributesForDomainHosting();
            $rules = $this->rulesForDomainHosting();
            $this->checkValidity($request, $rules, $attributeNames);

            $data['service_for']            = $request->service_for;
            $data['domain_name']            = $request->domain_name;
            $data['domain_reseller_id']     = $request->domain_reseller_id;
            $data['hosting_reseller_id']    = $request->hosting_reseller_id;
            $data['hosting_type']           = $request->hosting_type;
            $data['service_start_date']     = $request->service_start_date;
            $data['service_expire_date']    = $request->service_expire_date;

            if ($request->hosting_type == 'package') :
                $attributeNames = $this->attributesForPackageHosting();
                $rules = $this->rulesForPackageHosting();
                $this->checkValidity($request, $rules, $attributeNames);

                $data['hosting_package_id']   = $request->hosting_package_id;
                $data['created_by'] = auth()->user()->id;
                $service = Service::create($data);

                $logData['customer_id']         = $data['customer_id'];
                $logData['service_id']          = $service->id;
                $logData['service_type']        = 'new';
                $logData['service_start_date']  = $data['service_start_date'];
                $logData['service_expire_date'] = $data['service_expire_date'];
                ServiceLog::create($logData);

                session()->flash('success', 'Customer Service Created Succeffully');
                return redirect()->back();
            endif;

            if ($request->hosting_type == 'custom') :
                $data['hosting_space']              = $request->hosting_space;
                $data['hosting_bandwidth']          = $request->hosting_bandwidth;
                $data['hosting_db_qty']             = $request->hosting_db_qty;
                $data['hosting_emails_qty']         = $request->hosting_emails_qty;
                $data['hosting_subdomain_qty']      = $request->hosting_subdomain_qty;
                $data['hosting_ftp_qty']            = $request->hosting_ftp_qty;
                $data['hosting_park_domain_qty']    = $request->hosting_park_domain_qty;
                $data['hosting_addon_domain_qty']   = $request->hosting_addon_domain_qty;
                $data['created_by']                 = auth()->user()->id;
                $service = Service::create($data);

                $logData['customer_id']         = $data['customer_id'];
                $logData['service_id']          = $service->id;
                $logData['service_type']        = 'new';
                $logData['service_start_date']  = $data['service_start_date'];
                $logData['service_expire_date'] = $data['service_expire_date'];
                ServiceLog::create($logData);

                session()->flash('success', 'Customer Service Created Succeffully');
                return redirect()->back();
            endif;
        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('services.index');
        */
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
