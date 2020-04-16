<?php

namespace App\Http\Controllers;

use App\Models\HostingReseller;
use App\Http\Requests\HostingResellerRequest;
use Illuminate\Http\Request;

class HostingResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resellers = HostingReseller::all();
        return view('hosting-resellers.index', compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hosting-resellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostingResellerRequest $request)
    {
        HostingReseller::create($request->all());

        session()->flash('success', 'Hosting Reseller Created');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HostingReseller  $hostingReseller
     * @return \Illuminate\Http\Response
     */
    public function show(HostingReseller $hostingReseller)
    {
        return view('hosting-resellers.show', compact('hostingReseller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HostingReseller  $hostingReseller
     * @return \Illuminate\Http\Response
     */
    public function edit(HostingReseller $hostingReseller)
    {
        return view('hosting-resellers.create', compact('hostingReseller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HostingReseller  $hostingReseller
     * @return \Illuminate\Http\Response
     */
    public function update(HostingResellerRequest $request, HostingReseller $hostingReseller)
    {
        $hostingReseller->update($request->all());

        session()->flash('success', 'Hosting Reseller Update');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HostingReseller  $hostingReseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(HostingReseller $hostingReseller)
    {
        //
    }
}
