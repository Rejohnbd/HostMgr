<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

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
}
