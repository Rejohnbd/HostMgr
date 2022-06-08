<?php

namespace App\Http\Controllers;

use App\Mail\TemplateEmail;
use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSendController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $emailTemplates = EmailTemplate::all();
        return view('email-send.index')
            ->with('customers', $customers)
            ->with('emailTemplates', $emailTemplates);
    }

    public function templateDetails(Request $request)
    {
        $templateInfo = EmailTemplate::select('email_subject', 'email_body')->where('id', $request->templateId)->first();
        $data = [
            'status'    => 200,
            'subject'   => $templateInfo->email_subject,
            'body'      => $templateInfo->email_body
        ];
        return response()->json($data);
    }

    public function sendEmail(Request $request)
    {
        $customerInfo = Customer::with('user')->where('id', $request->customer_id)->first();
        $serviceInfo = Service::with('hostingPackage')->where('id', $request->service_id)->first();

        $email_body = strip_tags($request->email_body);
        $seperate_string = explode('{service_info}', $email_body);

        $mailData['customer_email'] = $customerInfo->user->email;
        $mailData['domain_name']    = $serviceInfo->domain_name;
        $mailData['email_top']      = $seperate_string[0];
        $mailData['email_bottom']   = $seperate_string[1];
        if (!is_null($serviceInfo->hostingPackage)) :
            $mailData['hosting_package']    = $serviceInfo->hostingPackage->name;
        endif;
        $mailData['expire_date']    = $serviceInfo->service_expire_date;
        $mailData['email_subject']  = $request->email_subject;

        Mail::send(new TemplateEmail($mailData));

        session()->flash('success', 'Email Send Successfully');
        return redirect()->back();
    }
}
