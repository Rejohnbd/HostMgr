<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Service;
use App\Models\ServiceLog;
use App\User;
use Illuminate\Http\Request;
use Validator;

class InvoiceControler extends Controller
{
    public function invoiceSerial()
    {
        $val = Invoice::select('invoice_serial')->latest()->first();
        if ($val === null) :
            return 1;
        endif;
        return $val->invoice_serial + 1;
    }


    public function invoiceNumber()
    {
        $val = Invoice::select('invoice_number')->latest()->first();
        if ($val === null) :
            $getyear = substr(date('y'), -2);
            $getmonth = strval(date('m'));
            $getserial = str_pad(1, 5, '0', STR_PAD_LEFT);
            $serialStr = $getyear . $getmonth . $getserial;
            return (int) $serialStr;
        endif;
        $oldSerial = substr((string) $val->invoice_number, 4);
        $getyear = substr(date('y'), -2);
        $getmonth = strval(date('m'));
        $getserial = str_pad(((int) $oldSerial) + 1, 5, '0', STR_PAD_LEFT);
        $serialStr = $getyear . $getmonth . $getserial;
        return (int) $serialStr;
    }

    public function attributesForAll()
    {
        $attributeNames['invoice_year']             = 'Invoice Year';
        $attributeNames['invoice_item_for']         = 'Invoice For';
        $attributeNames['invoice_item_subtotal']    = 'Service Price';
        $attributeNames['invoice_item_discount']    = 'Service Discount';
        $attributeNames['invoice_item_total']       = 'Service Amount';
        $attributeNames['payment_method']           = 'Payment Type';
        $attributeNames['invoice_item_details']     = 'Payment Details';
        $attributeNames['payment_date']             = 'Payment Date';
        return $attributeNames;
    }

    public function rulesForAll()
    {
        $rules['invoice_year']              = 'required|string';
        $rules['invoice_item_for']          = 'required';
        $rules['invoice_item_subtotal']     = 'required|integer|gt:0';
        $rules['invoice_item_total']        = 'required|integer|gt:0';
        $rules['invoice_item_discount']     = 'required|integer|gt:-1';
        $rules['payment_method']            = 'required';
        $rules['invoice_item_details']      = 'required|string';
        $rules['payment_date']              = 'required|date';
        return $rules;
    }

    protected function checkValidity($request, $rules, $attributeNames)
    {
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();
    }

    public function index()
    {
        $invoice = Service::all();
        return view('invoices.index');
    }

    public function create($id)
    {
        $service = Service::findOrFail($id);
        // dd($service);
        return view('invoices.create', compact('service'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $userId = $request->userId;
        $serviceId = $request->serId;
        User::findOrFail($userId);
        Service::findOrFail($serviceId);

        /*
        SIR PLEASE CHECK THE VALIDATION
        if ($request->domain_fee || $request->domain_fee == null) :
            $attributeNames['domain_fee']   = 'Domain Fee';
            $rules['domain_fee']            = 'required|integer|gt:0';
            $this->checkValidity($request, $rules, $attributeNames);
        endif;

        if ($request->hosting_fee || $request->hosting_fee == null) :
            $attributeNames['hosting_fee']  = 'Hosting Fee';
            $rules['hosting_fee']           = 'required|integer|gt:0';
            $this->checkValidity($request, $rules, $attributeNames);
        endif;

        if ($request->other_fee || $request->others_fee == null) :
            $attributeNames['others_fee']   = 'Others Fee';
            $rules['others_fee']            = 'required|integer|gt:0';
            $this->checkValidity($request, $rules, $attributeNames);
        endif;*/

        $attributeNames = $this->attributesForAll();
        $rules = $this->rulesForAll();
        $this->checkValidity($request, $rules, $attributeNames);

        // dd($request->all());
        $invoiceSerial = $this->invoiceSerial();
        $invoiceNumber = $this->invoiceNumber();
        // dd($request->all());
        $invoiceData['user_id']             = $userId;
        $invoiceData['service_id']          = $serviceId;
        $invoiceData['invoice_year']        = $request->invoice_year;
        $invoiceData['invoice_serial']      = $invoiceSerial;
        $invoiceData['invoice_number']      = $invoiceNumber;
        $invoiceData['invoice_gross_total'] = $request->invoice_item_subtotal;
        $invoiceData['invoice_discount']    = $request->invoice_item_discount;
        $invoiceData['invoice_total']       = $request->invoice_item_total;
        $invoiceData['payment_method']      = $request->payment_method;
        $invoiceData['payment_date']        = $request->payment_date;
        $invoiceData['created_by']          = auth()->user()->id;

        $invoiceItemData['invoice_number']          = $invoiceNumber;
        $invoiceItemData['invoice_item_for']        = $request->invoice_item_for;
        $invoiceItemData['invoice_item_details']    = $request->invoice_item_details;
        $invoiceItemData['invoice_item_subtotal']   = $request->invoice_item_subtotal;
        $invoiceItemData['invoice_item_discount']   = $request->invoice_item_discount;
        $invoiceItemData['invoice_item_total']      = $request->invoice_item_total;


        if ($request->payment_method === 'cash') :
            $newInvoice = Invoice::create($invoiceData);
            $invoiceItemData['invoice_id'] = $newInvoice->id;

            for ($i = 0; $i < count($request->service_type_id); $i++) :
                if ($request->service_type_id[$i] === '1') :
                    $invoiceItemData['domain_fee']  = $request->domain_fee;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 1;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '2') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = $request->hosting_fee;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 2;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '3') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = $request->others_fee;
                    $invoiceItemData['service_type_id']  = 3;
                    InvoiceItem::create($invoiceItemData);
                endif;
            endfor;

            Service::where('id', '=', $serviceId)->update(['invoice_status' => 1]);
            session()->flash('success', 'Invoice Create Successfully');
            return redirect()->route('invoices');
        endif;

        if ($request->payment_method === 'bkash') :
            $attributeNames['bkash_mobile_number']     = 'bKash Mobile Number';
            $attributeNames['bkash_transaction_no']    = 'bKash Transaction Number';
            $rules['bkash_mobile_number']              = 'required|string';
            $rules['bkash_transaction_no']             = 'required|string';

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();

            $invoiceData['bkash_mobile_number']      = $request->bkash_mobile_number;
            $invoiceData['bkash_transaction_no']     = $request->bkash_transaction_no;

            $newInvoice = Invoice::create($invoiceData);
            $invoiceItemData['invoice_id'] = $newInvoice->id;

            for ($i = 0; $i < count($request->service_type_id); $i++) :
                if ($request->service_type_id[$i] === '1') :
                    $invoiceItemData['domain_fee']  = $request->domain_fee;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 1;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '2') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = $request->hosting_fee;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 2;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '3') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = $request->others_fee;
                    $invoiceItemData['service_type_id']  = 3;
                    InvoiceItem::create($invoiceItemData);
                endif;
            endfor;

            Service::where('id', '=', $serviceId)->update(['invoice_status' => 1]);
            session()->flash('success', 'Invoice Create Successfully');
            return redirect()->route('invoices');
        endif;

        if ($request->payment_method === 'bank') :
            $attributeNames['bank_name']            = 'Bank Name';
            $attributeNames['bank_account_number']  = 'Bank Account Number';
            $rules['bank_name']                     = 'required|string';
            $rules['bank_account_number']           = 'required|string';

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributeNames);
            $validator->validate();

            $bankAccData['bank_name']           = $request->bank_name;
            $bankAccData['bank_account_number'] = $request->bank_account_number;
            $bankAccData['created_by']          = auth()->user()->id;

            $bankId = BankAccount::create($bankAccData);
            $invoiceData['bank_account_id'] = $bankId->id;

            $newInvoice = Invoice::create($invoiceData);
            $invoiceItemData['invoice_id'] = $newInvoice->id;

            for ($i = 0; $i < count($request->service_type_id); $i++) :
                if ($request->service_type_id[$i] === '1') :
                    $invoiceItemData['domain_fee']  = $request->domain_fee;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 1;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '2') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = $request->hosting_fee;
                    $invoiceItemData['others_fee']  = 0;
                    $invoiceItemData['service_type_id']  = 2;
                    InvoiceItem::create($invoiceItemData);
                endif;
                if ($request->service_type_id[$i] === '3') :
                    $invoiceItemData['domain_fee']  = 0;
                    $invoiceItemData['hosting_fee'] = 0;
                    $invoiceItemData['others_fee']  = $request->others_fee;
                    $invoiceItemData['service_type_id']  = 3;
                    InvoiceItem::create($invoiceItemData);
                endif;
            endfor;

            Service::where('id', '=', $serviceId)->update(['invoice_status' => 1]);
            session()->flash('success', 'Invoice Create Successfully');
            return redirect()->route('invoices');

        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('invoices');
    }
}
