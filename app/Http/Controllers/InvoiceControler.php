<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Service;
use App\Models\ServiceLog;
use App\User;
use Illuminate\Http\Request;
use Validator;
use PDF;

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
        $attributeNames['invoice_item_details']     = 'Payment Details';
        return $attributeNames;
    }

    public function rulesForAll()
    {
        $rules['invoice_year']              = 'required|string';
        $rules['invoice_item_for']          = 'required';
        $rules['invoice_item_details']      = 'required|string';
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
        $invoices = Invoice::orderBy('id', 'DESC')->get();

        return view('invoices.index', compact('invoices'));
    }

    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('invoices.create', compact('service'));
    }

    public function store(Request $request)
    {
        $userId = $request->userId;
        $serviceId = $request->serId;
        User::findOrFail($userId);
        Service::findOrFail($serviceId);
        $cusomerInfo = Customer::where('user_id', $userId)->first();

        if ($request->invoice_item_for == 1) {
            $serviceLogsInfo = ServiceLog::where('customer_id', $cusomerInfo->id)->where('service_id', $serviceId)->where('service_log_for', 'new')->latest()->first();
        } else if ($request->invoice_item_for == 2) {
            $serviceLogsInfo = ServiceLog::where('customer_id', $cusomerInfo->id)->where('service_id', $serviceId)->where('service_log_for', 'renewal')->latest()->first();
        } else {
            $serviceLogsInfo = NULL;
        }

        if (is_null($serviceLogsInfo)) {
            session()->flash('warning', 'You Select Wrong Invoice For');
            return redirect()->back();
        }

        $attributeNames = $this->attributesForAll();
        $rules = $this->rulesForAll();
        $this->checkValidity($request, $rules, $attributeNames);

        $invGrossTotal = 0;
        $invDiscount = 0;
        $invTotal = 0;
        for ($i = 0; $i < count($request->service_type_id); $i++) :
            if ($request->service_type_id[$i] === '1') :
                $attributeNames['domain_invoice_item_subtotal']    = 'Domain Fee';
                $attributeNames['domain_invoice_item_discount']    = 'Domain Discount';
                $attributeNames['domain_invoice_item_total']       = 'Net Amount';

                $rules['domain_invoice_item_subtotal']     = 'required|integer|gt:0';
                $rules['domain_invoice_item_discount']     = 'required|integer|gt:-1';
                $rules['domain_invoice_item_total']        = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->domain_invoice_item_subtotal <= $request->domain_invoice_item_discount) {
                        $validator->errors()->add('domain_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->domain_invoice_item_subtotal - $request->domain_invoice_item_discount) != $request->domain_invoice_item_total) {
                        $validator->errors()->add('domain_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->domain_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->domain_invoice_item_discount;
                $invTotal       = $invTotal + $request->domain_invoice_item_total;
            endif;
            if ($request->service_type_id[$i] === '2') :
                $attributeNames['hosting_invoice_item_subtotal']    = 'Hosting Fee';
                $attributeNames['hosting_invoice_item_discount']    = 'Hosting Discount';
                $attributeNames['hosting_invoice_item_total']       = 'Net Amount';

                $rules['hosting_invoice_item_subtotal']     = 'required|integer|gt:0';
                $rules['hosting_invoice_item_discount']     = 'required|integer|gt:-1';
                $rules['hosting_invoice_item_total']        = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->hosting_invoice_item_subtotal <= $request->hosting_invoice_item_discount) {
                        $validator->errors()->add('hosting_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->hosting_invoice_item_subtotal - $request->hosting_invoice_item_discount) != $request->hosting_invoice_item_total) {
                        $validator->errors()->add('hosting_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->hosting_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->hosting_invoice_item_discount;
                $invTotal       = $invTotal + $request->hosting_invoice_item_total;
            endif;
            if ($request->service_type_id[$i] === '3') :
                $attributeNames['other_invoice_item_subtotal']      = 'Others Fee';
                $attributeNames['other_invoice_item_discount']      = 'Others Discount';
                $attributeNames['other_invoice_item_total']         = 'Net Amount';

                $rules['other_invoice_item_subtotal']       = 'required|integer|gt:0';
                $rules['other_invoice_item_discount']       = 'required|integer|gt:-1';
                $rules['other_invoice_item_total']          = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->other_invoice_item_subtotal <= $request->other_invoice_item_discount) {
                        $validator->errors()->add('other_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->other_invoice_item_subtotal - $request->other_invoice_item_discount) != $request->other_invoice_item_total) {
                        $validator->errors()->add('other_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->other_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->other_invoice_item_discount;
                $invTotal       = $invTotal + $request->other_invoice_item_total;
            endif;
        endfor;

        $invoiceSerial = $this->invoiceSerial();
        $invoiceNumber = $this->invoiceNumber();

        $invoiceData['user_id']             = $userId;
        $invoiceData['service_id']          = $serviceId;
        $invoiceData['invoice_year']        = $request->invoice_year;
        $invoiceData['invoice_serial']      = $invoiceSerial;
        $invoiceData['invoice_number']      = $invoiceNumber;
        $invoiceData['invoice_gross_total'] = $invGrossTotal;
        $invoiceData['invoice_discount']    = $invDiscount;
        $invoiceData['invoice_total']       = $invTotal;

        $invoiceData['created_by']          = auth()->user()->id;

        $invoiceItemData['invoice_number']          = $invoiceNumber;
        $invoiceItemData['invoice_item_for']        = $request->invoice_item_for;
        $invoiceItemData['invoice_item_details']    = $request->invoice_item_details;

        $newInvoice = Invoice::create($invoiceData);
        $invoiceItemData['invoice_id'] = $newInvoice->id;

        for ($i = 0; $i < count($request->service_type_id); $i++) :
            if ($request->service_type_id[$i] === '1') :
                $invoiceItemData['service_type_id']  = 1;
                $invoiceItemData['invoice_item_subtotal']   = $request->domain_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->domain_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->domain_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
            if ($request->service_type_id[$i] === '2') :
                $invoiceItemData['service_type_id']  = 2;
                $invoiceItemData['invoice_item_subtotal']   = $request->hosting_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->hosting_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->hosting_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
            if ($request->service_type_id[$i] === '3') :
                $invoiceItemData['service_type_id']  = 3;
                $invoiceItemData['invoice_item_subtotal']   = $request->other_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->other_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->other_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
        endfor;

        Service::where('id', '=', $serviceId)->update(['invoice_status' => 1]);
        ServiceLog::where('id', $serviceLogsInfo->id)->update(['invoice_status' => 1, 'invoice_number' => $invoiceNumber]);

        session()->flash('success', 'Invoice Create Successfully');
        return redirect()->route('services.show', $serviceId);
    }

    public function renew($invoice_number)
    {
        $invoiceInfo = Invoice::where('invoice_number', $invoice_number)->first();
        $service = Service::where('id', $invoiceInfo->service_id)->first();
        return view('invoices.edit')
            ->with('service', $service)
            ->with('invoiceInfo', $invoiceInfo);
    }

    public function update(Request $request)
    {
        $userId = $request->userId;
        $serviceId = $request->serId;
        $invoiceNo = $request->invNo;

        User::findOrFail($userId);
        Service::findOrFail($serviceId);
        $cusomerInfo = Customer::where('user_id', $userId)->first();

        if ($request->invoice_item_for == 1) {
            $serviceLogsInfo = ServiceLog::where('customer_id', $cusomerInfo->id)->where('service_id', $serviceId)->where('service_log_for', 'new')->latest()->first();
        } else if ($request->invoice_item_for == 2) {
            $serviceLogsInfo = ServiceLog::where('customer_id', $cusomerInfo->id)->where('service_id', $serviceId)->where('service_log_for', 'renewal')->latest()->first();
        } else {
            $serviceLogsInfo = NULL;
        }

        if (is_null($serviceLogsInfo)) {
            session()->flash('warning', 'You Select Wrong Invoice For');
            return redirect()->back();
        }

        $attributeNames = $this->attributesForAll();
        $rules = $this->rulesForAll();
        $this->checkValidity($request, $rules, $attributeNames);

        $invGrossTotal = 0;
        $invDiscount = 0;
        $invTotal = 0;
        for ($i = 0; $i < count($request->service_type_id); $i++) :
            if ($request->service_type_id[$i] === '1') :
                $attributeNames['domain_invoice_item_subtotal']    = 'Domain Fee';
                $attributeNames['domain_invoice_item_discount']    = 'Domain Discount';
                $attributeNames['domain_invoice_item_total']       = 'Net Amount';

                $rules['domain_invoice_item_subtotal']     = 'required|integer|gt:0';
                $rules['domain_invoice_item_discount']     = 'required|integer|gt:-1';
                $rules['domain_invoice_item_total']        = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->domain_invoice_item_subtotal <= $request->domain_invoice_item_discount) {
                        $validator->errors()->add('domain_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->domain_invoice_item_subtotal - $request->domain_invoice_item_discount) != $request->domain_invoice_item_total) {
                        $validator->errors()->add('domain_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('domain_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->domain_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->domain_invoice_item_discount;
                $invTotal       = $invTotal + $request->domain_invoice_item_total;
            endif;
            if ($request->service_type_id[$i] === '2') :
                $attributeNames['hosting_invoice_item_subtotal']    = 'Hosting Fee';
                $attributeNames['hosting_invoice_item_discount']    = 'Hosting Discount';
                $attributeNames['hosting_invoice_item_total']       = 'Net Amount';

                $rules['hosting_invoice_item_subtotal']     = 'required|integer|gt:0';
                $rules['hosting_invoice_item_discount']     = 'required|integer|gt:-1';
                $rules['hosting_invoice_item_total']        = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->hosting_invoice_item_subtotal <= $request->hosting_invoice_item_discount) {
                        $validator->errors()->add('hosting_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->hosting_invoice_item_subtotal - $request->hosting_invoice_item_discount) != $request->hosting_invoice_item_total) {
                        $validator->errors()->add('hosting_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('hosting_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->hosting_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->hosting_invoice_item_discount;
                $invTotal       = $invTotal + $request->hosting_invoice_item_total;
            endif;
            if ($request->service_type_id[$i] === '3') :
                $attributeNames['other_invoice_item_subtotal']      = 'Others Fee';
                $attributeNames['other_invoice_item_discount']      = 'Others Discount';
                $attributeNames['other_invoice_item_total']         = 'Net Amount';

                $rules['other_invoice_item_subtotal']       = 'required|integer|gt:0';
                $rules['other_invoice_item_discount']       = 'required|integer|gt:-1';
                $rules['other_invoice_item_total']          = 'required|integer|gt:0';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->validate();

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attributeNames);
                $validator->after(function ($validator) use ($request) {
                    if ($request->other_invoice_item_subtotal <= $request->other_invoice_item_discount) {
                        $validator->errors()->add('other_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_discount', 'Insert Wrong Value');
                    }

                    if (($request->other_invoice_item_subtotal - $request->other_invoice_item_discount) != $request->other_invoice_item_total) {
                        $validator->errors()->add('other_invoice_item_subtotal', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_discount', 'Insert Wrong Value');
                        $validator->errors()->add('other_invoice_item_total', 'Insert Wrong Value');
                    }
                });
                $validator->validate();

                $invGrossTotal  = $invGrossTotal + $request->other_invoice_item_subtotal;
                $invDiscount    = $invDiscount + $request->other_invoice_item_discount;
                $invTotal       = $invTotal + $request->other_invoice_item_total;
            endif;
        endfor;

        $updateInvoice = Invoice::where('invoice_number', $invoiceNo)->first();

        $updateInvoice->user_id             = $userId;
        $updateInvoice->service_id          = $serviceId;
        $updateInvoice->invoice_year        = $request->invoice_year;
        $updateInvoice->invoice_number      = $invoiceNo;
        $updateInvoice->invoice_gross_total = $invGrossTotal;
        $updateInvoice->invoice_discount    = $invDiscount;
        $updateInvoice->invoice_total       = $invTotal;
        $updateInvoice->created_by          = auth()->user()->id;

        $updateInvoice->save();

        $invoiceItemData['invoice_number']          = $invoiceNo;
        $invoiceItemData['invoice_item_for']        = $request->invoice_item_for;
        $invoiceItemData['invoice_item_details']    = $request->invoice_item_details;
        $invoiceItemData['invoice_id']              = $updateInvoice->id;

        InvoiceItem::where('invoice_id', $updateInvoice->id)->delete();

        for ($i = 0; $i < count($request->service_type_id); $i++) :
            if ($request->service_type_id[$i] === '1') :
                $invoiceItemData['service_type_id']  = 1;
                $invoiceItemData['invoice_item_subtotal']   = $request->domain_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->domain_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->domain_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
            if ($request->service_type_id[$i] === '2') :
                $invoiceItemData['service_type_id']  = 2;
                $invoiceItemData['invoice_item_subtotal']   = $request->hosting_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->hosting_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->hosting_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
            if ($request->service_type_id[$i] === '3') :
                $invoiceItemData['service_type_id']  = 3;
                $invoiceItemData['invoice_item_subtotal']   = $request->other_invoice_item_subtotal;
                $invoiceItemData['invoice_item_discount']   = $request->other_invoice_item_discount;
                $invoiceItemData['invoice_item_total']      = $request->other_invoice_item_total;
                InvoiceItem::create($invoiceItemData);
            endif;
        endfor;

        // Service::where('id', '=', $serviceId)->update(['invoice_status' => 1]);
        // ServiceLog::where('id', $serviceLogsInfo->id)->update(['invoice_status' => 1, 'invoice_number' => $invoiceNumber]);

        session()->flash('success', 'Invoice Updated Successfully');
        return redirect()->route('invoices');
    }

    public function generateInvoicePdf($invoice_number)
    {
        $serviceLogInfo = ServiceLog::where('invoice_number', $invoice_number)->first();
        $service = Service::findOrFail($serviceLogInfo->service_id);
        $customer = Customer::where('id', '=', $service->customer_id)->first();
        $user = User::select('email', 'mobile')->where('id', '=', $customer->user_id)->first();
        $invoice = Invoice::where('invoice_number', '=', $invoice_number)->first();

        $invoiceItems = InvoiceItem::where('invoice_id', '=', $invoice->id)->get();
        // dd($invoiceItems);

        $pdf = PDF::loadView('invoices.invoice', [
            'service' => $service,
            'customer' => $customer,
            'user' => $user,
            'invoice' => $invoice,
            'invoiceItems' => $invoiceItems
        ]);
        $pdf->setPaper('A4');
        // return view('invoices.invoice');

        return $pdf->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');
    }
}
