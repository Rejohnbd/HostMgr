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

        $shortcode = $this->get_string_between($request->email_body, '{', '}');

        switch ($shortcode):
            case 'service_info':
                $email_body = strip_tags($request->email_body);
                $seperate_string = explode('{' . $shortcode . '}', $email_body);
                $mailData['service_info'] = true;
                if (!is_null($serviceInfo->hostingPackage)) :
                    $mailData['hosting_package']    = $serviceInfo->hostingPackage->name;
                endif;
                break;
            case 'service_cpanel_info':
                $email_body = strip_tags($request->email_body);
                $seperate_string = explode('{' . $shortcode . '}', $email_body);
                $mailData['service_cpanel_info'] = true;

                if (!is_null($serviceInfo->cpanel_username)) :
                    $mailData['cpanel_username'] = $serviceInfo->cpanel_username;
                else :
                    $mailData['cpanel_username'] = ' ';
                endif;

                if (!is_null($serviceInfo->cpanel_password)) :
                    $mailData['cpanel_password'] = $serviceInfo->cpanel_password;
                else :
                    $mailData['cpanel_password'] = ' ';
                endif;
                break;
            default:
                session()->flash('warning', 'Something happed worng in email shortcode. Try Again.');
                return redirect()->back();
                break;
        endswitch;

        $mailData['customer_email'] = $customerInfo->user->email;
        $mailData['domain_name']    = $serviceInfo->domain_name;
        $mailData['email_top']      = $seperate_string[0];
        $mailData['email_bottom']   = $seperate_string[1];
        $mailData['expire_date']    = $serviceInfo->service_expire_date;
        $mailData['email_subject']  = $request->email_subject;

        Mail::send(new TemplateEmail($mailData));

        session()->flash('success', 'Email Send Successfully');
        return redirect()->back();
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
