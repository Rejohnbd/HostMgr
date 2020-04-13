<?php

namespace App\Http\Controllers;

use App\HostingPackage;
use App\Http\Requests\HostingPackageRequest;
use Illuminate\Http\Request;

class HostingPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostingPackages = HostingPackage::all();
        return view('hosting-packages.index', compact('hostingPackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hosting-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostingPackageRequest $request)
    {
        HostingPackage::create($request->all());

        session()->flash('success', 'Hosting Package Added.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function show(HostingPackage $hostingPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(HostingPackage $hostingPackage)
    {
        return view('hosting-packages.create', compact('hostingPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function update(HostingPackageRequest $request, HostingPackage $hostingPackage)
    {
        $hostingPackage->update($request->all());

        session()->flash('success', 'Hosting Package Updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HostingPackage  $hostingPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(HostingPackage $hostingPackage)
    {
        //
    }
}
