<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Service;
use App\Models\ServiceLog;
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
            $getserial = str_pad(1 + 1, 5, '0', STR_PAD_LEFT);
            $serialStr = $getyear . $getmonth . $getserial;
            return (int) $serialStr;
        endif;
        $getyear = substr(date('y'), -2);
        $getmonth = strval(date('m'));
        $getserial = str_pad($val->invoice_number + 1, 5, '0', STR_PAD_LEFT);
        $serialStr = $getyear . $getmonth . $getserial;
        return (int) $serialStr;
    }

    public function index()
    {
        $uncomplteInvoices = ServiceLog::where('invoice_status', '=', 0)->get();
        return view('invoices.index', compact('uncomplteInvoices'));
    }

    public function create($id)
    {
        $service = ServiceLog::where('invoice_status', '=', 0)->findOrFail($id);
        // dd($service);
        return view('invoices.create', compact('service'));
    }

    public function store(Request $request)
    {
        $customerId = $request->custId;
        $serviceId = $request->serId;
        $logId = $request->logId;
        Customer::findOrFail($customerId);
        Service::findOrFail($serviceId);
        ServiceLog::findOrFail($logId);

        $attributeNames['invoice_year']             = 'Invoice Year';
        $attributeNames['invoice_item_for']         = 'Invoice For';
        $attributeNames['invoice_item_subtotal']    = 'Service Price';
        $attributeNames['invoice_item_discount']    = 'Service Discount';
        $attributeNames['invoice_item_total']       = 'Service Amount';
        $attributeNames['payment_method']           = 'Payment Type';
        $attributeNames['invoice_item_details']     = 'Payment Details';
        $attributeNames['payment_date']             = 'Payment Date';

        $rules['invoice_year']              = 'required|string';
        $rules['invoice_item_for']          = 'required';
        $rules['invoice_item_subtotal']     = 'required|integer|gt:0';
        $rules['invoice_item_total']        = 'required|integer|gt:0';
        $rules['invoice_item_discount']     = 'required|integer|gt:0';
        $rules['payment_method']            = 'required';
        $rules['invoice_item_details']      = 'required|string';
        $rules['payment_date']              = 'required|date';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        $invoiceSerial = $this->invoiceSerial();
        // dd($invoiceSerial);
        $invoiceNumber = $this->invoiceNumber();
        // dd($invoiceNumber);

        $invoiceData['customer_id']         = $customerId;
        $invoiceData['invoice_year']        = $request->invoice_year;
        $invoiceData['invoice_serial']      = $invoiceSerial;
        $invoiceData['invoice_number']      = $invoiceNumber;
        $invoiceData['invoice_gross_total'] = $request->invoice_item_subtotal;
        $invoiceData['invoice_discount']    = $request->invoice_item_discount;
        $invoiceData['invoice_total']       = $request->invoice_item_total;
        $invoiceData['payment_method']      = $request->payment_method;
        $invoiceData['payment_date']        = $request->payment_date;
        $invoiceData['created_by']          = auth()->user()->id;

        $invoiceItemData['service_id']              = $serviceId;
        $invoiceItemData['invoice_number']          = $invoiceNumber;
        $invoiceItemData['invoice_item_for']        = $request->invoice_item_for;
        $invoiceItemData['invoice_item_details']    = $request->invoice_item_details;
        $invoiceItemData['invoice_item_subtotal']   = $request->invoice_item_subtotal;
        $invoiceItemData['invoice_item_discount']   = $request->invoice_item_discount;
        $invoiceItemData['invoice_item_total']      = $request->invoice_item_total;


        if ($request->payment_method === 'cash') :
            // dd($invoiceData);
            $newInvoice = Invoice::create($invoiceData);

            $invoiceItemData['invoice_id'] = $newInvoice->id;
            // dd($invoiceItemData);
            InvoiceItem::create($invoiceItemData);
            ServiceLog::where('id', '=', $logId)->update(['invoice_status' => 1]);
            session()->flash('success', 'Invoice Create Successfully');
            return redirect()->route('invoices');
        endif;

        if ($request->payment_method === 'bkash') :
        endif;

        if ($request->payment_method === 'bank') :
        endif;

        session()->flash('warning', 'Something Happend Wrong');
        return redirect()->route('invoices');
    }
}
