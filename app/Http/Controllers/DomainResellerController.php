<?php

namespace App\Http\Controllers;

use App\DomainReseller;
use App\Http\Requests\StoreDomainResellerRequest;
use Illuminate\Http\Request;

class DomainResellerController extends Controller
{
    /**
     * Display a listing of the Domain Reseller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('domain-resellers.index');
    }

    /**
     * Show the form for creating a new Domain Reseller.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain-resellers.create');
    }

    /**
     * Store a newly created Domain Reseller in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainResellerRequest $request)
    {
        DomainReseller::create($request->all());

        session()->flash('success', 'Domain Reseller Created');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function show(DomainReseller $domainReseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainReseller $domainReseller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DomainReseller $domainReseller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainReseller $domainReseller)
    {
        //
    }
}
