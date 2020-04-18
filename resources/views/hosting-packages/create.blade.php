@extends('layouts.master')

@if(isset($hostingPackage))
@section('title', 'Package Update')
@else
@section('title', 'Package Create')
@endif

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ isset($hostingPackage) ? 'Package Update' : 'Package Create' }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('hosting-packages.index') }}">Packages</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($hostingPackage) ? 'Update' : 'Create' }}</li>
    </ol>
</div>
@if(session('success'))
@include('partials.success-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($hostingPackage) ? 'Update Package' : 'Create Package' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($hostingPackage) ? route('hosting-packages.update', $hostingPackage->id) : route('hosting-packages.store') }}" method="POST">
                    @csrf
                    @isset($hostingPackage)
                    @method('PUT')
                    @endisset
                    <div class="form-group row required">
                        <label for="hostingPackageName" class="col-md-3 col-form-label text-right text-gray-900">Package Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="hostingPackageName" placeholder="Package Name" value="{{ isset($hostingPackage) ? $hostingPackage->name : old('name')  }}" required>
                            @error('name')
                            <small class="form-text text-danger">Hosting Package Name is Required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="hostingPackageSpace" class="col-md-3 col-form-label text-right text-gray-900">Package Space</label>
                        <div class="col-md-9">
                            <input type="text" name="space" class="form-control @error('space') is-invalid @enderror" id="hostingPackageSpace" placeholder="Package Space" value="{{ isset($hostingPackage) ? $hostingPackage->space : old('space') }}" required>
                            @error('space')
                            <small class="form-text text-danger">Hosting Package Space is Required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="hostingPackageBandwidth" class="col-md-3 col-form-label text-right text-gray-900">Package Bandwidth</label>
                        <div class="col-md-9">
                            <input type="text" name="bandwidth" class="form-control @error('bandwidth') is-invalid @enderror" id="hostingPackageBandwidth" placeholder="Package Bandwidth" value="{{ isset($hostingPackage) ? $hostingPackage->bandwidth : old('bandwidth') }}" required>
                            @error('bandwidth')
                            <small class="form-text text-danger">Hosting Package Bandwidth is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackageDb" class="col-md-3 col-form-label text-right text-gray-900">Package Database Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="db_qty" class="form-control @error('db_qty') is-invalid @enderror" id="hostingPackageDb" placeholder="Package Database Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->db_qty : old('db_qty') }}" required>
                            @error('db_qty')
                            <small class="form-text text-danger">Hosting Package Database Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackageEmailQty" class="col-md-3 col-form-label text-right text-gray-900">Package Emails Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="emails_qty" class="form-control @error('emails_qty') is-invalid @enderror" id="hostingPackageEmailQty" placeholder="Package Emails Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->emails_qty : old('emails_qty') }}" required>
                            @error('emails_qty')
                            <small class="form-text text-danger">Hosting Package Emails Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackageSubDomain" class="col-md-3 col-form-label text-right text-gray-900">Package Sub Domain Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="subdomain_qty" class="form-control @error('subdomain_qty') is-invalid @enderror" id="hostingPackageSubDomain" placeholder="Package Sub Domain Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->subdomain_qty : old('subdomain_qty') }}" required>
                            @error('subdomain_qty')
                            <small class="form-text text-danger">Hosting Package Sub Domain Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackageFtpQty" class="col-md-3 col-form-label text-right text-gray-900">Package FTP Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="ftp_qty" class="form-control @error('ftp_qty') is-invalid @enderror" id="hostingPackageFtpQty" placeholder="Package FTP Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->ftp_qty : old('ftp_qty') }}" required>
                            @error('ftp_qty')
                            <small class="form-text text-danger">Hosting Package FTP Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackagePDQ" class="col-md-3 col-form-label text-right text-gray-900">Package Park Domain Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="park_domain_qty" class="form-control @error('park_domain_qty') is-invalid @enderror" id="hostingPackagePDQ" placeholder="Package Park Domain Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->park_domain_qty : old('park_domain_qty') }}" required>
                            @error('park_domain_qty')
                            <small class="form-text text-danger">Hosting Package Park Domain Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="hostingPackageADQ" class="col-md-3 col-form-label text-right text-gray-900">Package Addon Domain Quantity</label>
                        <div class="col-md-9">
                            <input type="text" name="addon_domain_qty" class="form-control @error('addon_domain_qty') is-invalid @enderror" id="hostingPackageADQ" placeholder="Package Addon Domain Quantity" value="{{ isset($hostingPackage) ? $hostingPackage->addon_domain_qty : old('addon_domain_qty') }}" required>
                            @error('addon_domain_qty')
                            <small class="form-text text-danger">Hosting Package Addon Domain Quantity is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block btn-primary">{{ isset($hostingPackage) ? 'Update' : 'Save' }}</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('hosting-packages.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection