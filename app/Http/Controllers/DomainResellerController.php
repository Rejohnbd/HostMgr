<?php

namespace App\Http\Controllers;

use App\Models\DomainReseller;
use App\Http\Requests\DomainResellerRequest;
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
        $resellers = DomainReseller::all();
        return view('domain-resellers.index', compact('resellers'));
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
    public function store(DomainResellerRequest $request)
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
        return view('domain-resellers.show', compact('domainReseller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainReseller $domainReseller)
    {
        return view('domain-resellers.create', compact('domainReseller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DomainReseller  $domainReseller
     * @return \Illuminate\Http\Response
     */
    public function update(DomainResellerRequest $request, DomainReseller $domainReseller)
    {
        $domainReseller->update($request->all());

        session()->flash('success', 'Domain Reseller Update');

        return redirect()->back();
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
