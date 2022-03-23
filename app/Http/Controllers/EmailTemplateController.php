<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Validator;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('email-template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('email-template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeNames['template_name']    = 'Email Template Name';
        $attributeNames['email_subject']    = 'Email Template Subject';
        $attributeNames['email_body']       = 'Email Template Body';

        $rules['template_name']             = 'required|string';
        $rules['email_subject']             = 'required|string';
        $rules['email_body']                = 'required|string';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();

        EmailTemplate::create($request->all());

        session()->flash('success', 'Email Template Created');

        return redirect()->route('email-templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return view('email-template.create', compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $attributeNames['template_name']    = 'Email Template Name';
        $attributeNames['email_subject']    = 'Email Template Subject';
        $attributeNames['email_body']       = 'Email Template Body';

        $rules['template_name']             = 'required|string';
        $rules['email_subject']             = 'required|string';
        $rules['email_body']                = 'required|string';

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);
        $validator->validate();


        $emailTemplate->update($request->all());
        session()->flash('success', 'Email Template Updated Successfully');
        return redirect()->route('email-templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hostingPackage = EmailTemplate::find($request->emailTemplateId);
        if ($hostingPackage) :
            EmailTemplate::where('id', $request->emailTemplateId)->delete();

            $hostingPackage->delete();
            $data = [
                'status'    => 200,
                'title'     => "Email Template Deleted.",
                'message'   => "Email Template Deleted Successfully."
            ];
            return response()->json($data);

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
