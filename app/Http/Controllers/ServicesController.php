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
use App\User;
use Carbon\Carbon;
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
        $rules['service_start_date']    = 'required|date_format:d-m-Y';
        $rules['service_expire_date']   = 'required|date_format:d-m-Y';
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.index')
            ->with('services', Service::all())
            ->with('customers', Customer::all());
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
        $data['service_start_date'] = date('Y-m-d', strtotime($request->service_start_date));
        $data['service_expire_date'] = date('Y-m-d', strtotime($request->service_expire_date));

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
                $attributeNames['cpanel_username']      = 'Cpanel Username';
                $attributeNames['cpanel_password']      = 'Cpanel Password';
                $rules['hosting_reseller_id']           = 'required';
                $rules['hosting_type']                  = 'required';
                $rules['cpanel_username']               = 'required';
                $rules['cpanel_password']               = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $data['hosting_reseller_id']    = $request->hosting_reseller_id;
                $data['hosting_type']           = $request->hosting_type;
                $data['cpanel_username']        = $request->cpanel_username;
                $data['cpanel_password']        = $request->cpanel_password;

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
                // $logData['service_type_id'] = $request->service_types[$i];
                // ServiceLog::create($logData);
                $serviceTypeIds[] = $request->service_types[$i];
            }
        endfor;

        $logData['service_type_ids'] = implode(',', $serviceTypeIds);
        ServiceLog::create($logData);
        session()->flash('success', 'Service Create Successfully.');
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
    public function edit(Service $service)
    {
        if ($service->invoice_status == 0) :
            $allServiceItems = $service->serviceItems->toArray();
            $serviceTypeIdArrayFormat = array();
            foreach ($allServiceItems as $key => $value) {
                $serviceTypeIdArrayFormat[$key] = $value['service_type_id'];
            }
            return view('services.edit')
                ->with('customers', Customer::all())
                ->with('serviceTypes', ServiceType::all())
                ->with('domainResellers', DomainReseller::all())
                ->with('hostingResslers', HostingReseller::all())
                ->with('hostingPackages', HostingPackage::all())
                ->with('serviceTypeIdArrayFormat', $serviceTypeIdArrayFormat)
                ->with('service', $service);
        else :
            session()->flash('warning', 'Something Happend Wroing. Try Again.');
            return redirect()->route('services.index');
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
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
        $data['service_start_date'] = date('Y-m-d', strtotime($request->service_start_date));
        $data['service_expire_date'] = date('Y-m-d', strtotime($request->service_expire_date));

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
                $attributeNames['cpanel_username']      = 'Cpanel Username';
                $attributeNames['cpanel_password']      = 'Cpanel Password';
                $rules['hosting_reseller_id']           = 'required';
                $rules['hosting_type']                  = 'required';
                $rules['cpanel_username']               = 'required';
                $rules['cpanel_password']               = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $data['hosting_reseller_id']    = $request->hosting_reseller_id;
                $data['hosting_type']           = $request->hosting_type;
                $data['cpanel_username']        = $request->cpanel_username;
                $data['cpanel_password']        = $request->cpanel_password;

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

        Service::where('id', $service->id)->update($data);

        $logData['customer_id']         = $data['customer_id'];
        $logData['service_id']          = $service->id;
        $logData['service_log_for']     = 'new';
        $logData['service_start_date']  = $data['service_start_date'];
        $logData['service_expire_date'] = $data['service_expire_date'];

        $dataItem['service_id'] = $service->id;
        ServiceItem::where('service_id', $service->id)->delete();
        for ($i = 1; $i <= count($request->service_types); $i++) :
            if ($request->service_types[$i] == 0) {
                continue;
            } else {
                $dataItem['service_type_id'] = $request->service_types[$i];
                ServiceItem::create($dataItem);
                $serviceTypeIds[] = $request->service_types[$i];
            }
        endfor;

        $logData['service_type_ids'] = implode(',', $serviceTypeIds);
        ServiceLog::where('service_id', $service->id)->delete();
        ServiceLog::create($logData);
        session()->flash('success', 'Service Update Successfully.');
        return redirect()->route('services.index');
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

    public function renewService(Service $service)
    {
        return view('services.renew')->with('service', $service)
            ->with('serviceTypes', ServiceType::all())
            ->with('domainResellers', DomainReseller::all())
            ->with('hostingResslers', HostingReseller::all())
            ->with('hostingPackages', HostingPackage::all());
    }

    public function renewalService(Request $request)
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

        // $user_id = $this->getUserId($data['customer_id']);
        // $data['user_id'] = $user_id;
        // Start here for update
        $serviceUpdate = Service::find($request->serId);

        // Check Initial Validity For all intial show form fields
        $attributeNames = $this->attributesForAll();
        $rules = $this->rulesForAll();
        $this->checkValidity($request, $rules, $attributeNames);

        // $data['domain_name'] = $request->domain_name;
        $serviceUpdate->domain_name         = $request->domain_name;
        $serviceStartDate                   = date('Y-m-d', strtotime($request->service_start_date));
        $serviceUpdate->service_start_date  = $serviceStartDate;
        $serviceExpireDate                  = date('Y-m-d', strtotime($request->service_expire_date));
        $serviceUpdate->service_expire_date = $serviceExpireDate;

        $dataItem = array();
        for ($i = 1; $i <= count($request->service_types); $i++) :

            if ($request->service_types[$i] == 1) :
                $attributeNames['domain_reseller_id'] = 'Domain Reseller Name';
                $rules['domain_reseller_id']          = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $serviceUpdate->domain_reseller_id = $request->domain_reseller_id;
            endif;
            if ($request->service_types[$i] == 2) :
                $attributeNames['hosting_reseller_id']  = 'Hosting Reseller Name';
                $attributeNames['hosting_type']         = 'Hosting Type';
                $rules['hosting_reseller_id']           = 'required';
                $rules['hosting_type']                  = 'required';
                $this->checkValidity($request, $rules, $attributeNames);

                $serviceUpdate->hosting_reseller_id    = $request->hosting_reseller_id;
                $serviceUpdate->hosting_type           = $request->hosting_type;

                if ($request->hosting_type == 'package') :
                    $attributeNames['hosting_package_id']     = 'Hosting Package';
                    $rules['hosting_package_id']              = 'required';
                    $this->checkValidity($request, $rules, $attributeNames);

                    $serviceUpdate->hosting_package_id   = $request->hosting_package_id;
                endif;

                if ($request->hosting_type == 'custom') :
                    $attributeNames = $this->attributesForCustomPackage();
                    $rules = $this->rulesForCustomPackage();
                    $this->checkValidity($request, $rules, $attributeNames);

                    $serviceUpdate->hosting_space              = $request->hosting_space;
                    $serviceUpdate->hosting_bandwidth          = $request->hosting_bandwidth;
                    $serviceUpdate->hosting_db_qty             = $request->hosting_db_qty;
                    $serviceUpdate->hosting_emails_qty         = $request->hosting_emails_qty;
                    $serviceUpdate->hosting_subdomain_qty      = $request->hosting_subdomain_qty;
                    $serviceUpdate->hosting_ftp_qty            = $request->hosting_ftp_qty;
                    $serviceUpdate->hosting_park_domain_qty    = $request->hosting_park_domain_qty;
                    $serviceUpdate->hosting_addon_domain_qty   = $request->hosting_addon_domain_qty;
                endif;

            endif;
            if ($request->service_types[$i] == 3) :
                $attributeNames['item_details'] = 'Item Details';
                $rules['item_details']          = 'required';
                $this->checkValidity($request, $rules, $attributeNames);
                $dataItem['item_details'] = $request->item_details;
            endif;

        endfor;
        $serviceUpdate->service_status  = 'active';
        $serviceUpdate->invoice_status  = 0;
        $serviceUpdate->payment_status  = 0;
        $serviceUpdate->created_by      = auth()->user()->id;

        $serviceUpdate->save();

        $logData['customer_id']         = $data['customer_id'];
        $logData['service_id']          = $request->serId;
        $logData['service_log_for']     = 'renewal';
        $logData['service_start_date']  = $serviceStartDate;
        $logData['service_expire_date'] = $serviceExpireDate;

        ServiceItem::where('service_id', $request->serId)->delete();

        $dataItem['service_id'] = $request->serId;
        for ($i = 1; $i <= count($request->service_types); $i++) :
            if ($request->service_types[$i] == 0) {
                continue;
            } else {
                $dataItem['service_type_id'] = $request->service_types[$i];
                ServiceItem::create($dataItem);
                // $logData['service_type_id'] = $request->service_types[$i];
                // ServiceLog::create($logData);
                $serviceTypeIds[] = $request->service_types[$i];
            }
        endfor;

        $logData['service_type_ids'] = implode(',', $serviceTypeIds);
        ServiceLog::create($logData);
        session()->flash('success', 'Service Update Successfully.');
        return redirect()->route('services.index');
    }

    public function expireSoonServices()
    {
        $todayDate = Carbon::today()->toDateString();
        $nextSencodMonthDate = Carbon::today()->addMonth(2)->toDateString();
        $services = Service::whereBetween('service_expire_date', [$todayDate, $nextSencodMonthDate])->get();
        return view('services.service-expire-soon', compact('services'));
    }

    public function expiredServices()
    {
        $todayDate = Carbon::today()->toDateString();
        $services = Service::where('service_expire_date', '<', $todayDate)->get();
        return view('services.service-expired', compact('services'));
    }

    public function filterServices(Request $request)
    {
        $selectCustomer = $request->selectCustomer;
        $expireDateFrom = date('Y-m-d', strtotime($request->expireDateFrom));
        $expireDateTo = date('Y-m-d', strtotime($request->expireDateTo));

        if ($selectCustomer == 'all') :
            $services = Service::whereBetween('service_expire_date', [$expireDateFrom, $expireDateTo])->get();
            return response()->view('services.service-report', compact('services'));
        else :
            $services = Service::join('customers', 'customers.id',  '=', 'services.customer_id')
                ->where('customers.id', '=', $selectCustomer)
                ->whereBetween('services.service_expire_date', [$expireDateFrom, $expireDateTo])
                ->get('services.*');
            return response()->view('services.service-report', compact('services'));
        endif;
    }

    public function servicesHostingInfo(Request $request)
    {
        $hostingInfo = Service::select('cpanel_username', 'cpanel_password')->where('id', $request->serviceId)->first();
        return response()->json(['status' => 200, 'data' => $hostingInfo]);
    }

    public function servicesHostingInfoUpdate(Request $request)
    {
        $updateHotingInfo = Service::where('id', $request->serviceId)->update([
            'cpanel_username'   => $request->cpanelUserName,
            'cpanel_password'   => $request->cpanelPassword,
        ]);

        if ($updateHotingInfo) {
            session()->flash('success', 'Hosting Info Update Successfully.');
            return response()->json(['status' => 200]);
        }
    }

    public function servicesByCustomerId(Request $request)
    {
        $services = Service::select('id', 'domain_name', 'domain_reseller_id', 'hosting_reseller_id')->where('customer_id', $request->customerId)->get();
        $data = [
            'status'    => 200,
            'datas'   => $services,
        ];
        return response()->json($data);
    }

    public function servicesFilterByCustomer(Request $request)
    {
        $selectCustomer = $request->selectCustomer;

        if ($selectCustomer == 'all' || $selectCustomer == 'Select Customer') :
            $services = Service::all();
            return response()->view('services.service-report', compact('services'));
        else :
            $services = Service::join('customers', 'customers.id',  '=', 'services.customer_id')
                ->where('customers.id', '=', $selectCustomer)
                ->get('services.*');
            return response()->view('services.service-report', compact('services'));
        endif;
    }
}
