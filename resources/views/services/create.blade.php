@extends('layouts.master')

@section('title', 'Service Create')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Create Services',
'itemOne' => 'Services',
'itemOneUrl' => 'services.index',
'activePage' => 'Create'
])
@endcomponent


<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Services</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <label for="customerEmail" class="col-form-label text-right text-gray-900">Customer Email</label>
                        <select name="customer_id" class="form-control col-12  @error('customer_id') is-invalid @enderror" id="customerEmail" required>
                            <option value="">Select Customer Email</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->user->email }}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="serviceFor" class="col-form-label text-right text-gray-900">Service For</label>
                            <select name="service_for" class="form-control  @error('service_for') is-invalid @enderror" id="serviceFor" required>
                                <option value="">Select Service For</option>
                                <option value="1">Domain Hosting Both</option>
                                <option value="2">Only Hosting</option>
                                <option value="3">Only Domain</option>
                            </select>
                            @error('service_for')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="domainName" class="col-form-label text-right text-gray-900">Service Domain name</label>
                            <input type="text" name="domain_name" class="form-control @error('domain_name') is-invalid @enderror" id="domainName" placeholder="Service Domain name" value="{{ old('domain_name') }}" required>
                            @error('domain_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group domain-reseller">
                        <label for="domainReseller" class="col-form-label text-right text-gray-900">Domain Reseller</label>
                        <select name="domain_reseller_id" class="form-control reseller" id="domainReseller">
                            <option value="">Select Domain Resseler</option>
                            @foreach($domainResellers as $domainReseller)
                            <option value="{{ $domainReseller->id }}">{{ $domainReseller->name }}</option>
                            @endforeach
                        </select>
                        @error('domain_reseller_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group hosting-reseller">
                        <label for="hostingReseller" class="col-form-label text-right text-gray-900">Hosting Reseller</label>
                        <select name="hosting_reseller_id" class="form-control reseller" id="hostingReseller">
                            <option value="">Select Hosting Resseler</option>
                            @foreach($hostingResslers as $hostingRessler)
                            <option value="{{ $hostingRessler->id}}">{{ $hostingRessler->name }}</option>
                            @endforeach
                        </select>
                        @error('hosting_reseller_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class=" form-group hosting-type">
                        <label for="hostingType" class="col-form-label text-right text-gray-900">Hosting Type</label>
                        <select name="hosting_type" class="form-control @error('hosting_type') is-invalid @enderror" id="hostingType">
                            <option value="">Select Hosting Type</option>
                            <option value="package">Package</option>
                            <option value="custom">Custom</option>
                        </select>
                        @error('hosting_type')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group hosting-package">
                        <label for="hostingReseller" class="col-form-label text-right text-gray-900">Hosting Package</label>
                        <select name="hosting_package_id" class="form-control reseller" id="hostingReseller">
                            <option value="">Select Hosting Package</option>
                            @foreach($hostingPackages as $hostingPackage)
                            <option value="{{ $hostingPackage->id}}">{{ $hostingPackage->name }}</option>
                            @endforeach
                        </select>
                        @error('hosting_package_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class=" form-row custom-package">
                        <div class="form-group col-md-6">
                            <label for="hostingSpace" class="col-form-label text-right text-gray-900">Hosting Space</label>
                            <input type="text" name="hosting_space" class="form-control" id="hostingSpace" placeholder="Hosting Space" value="{{ old('hosting_space') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hostingBandwidth" class="col-form-label text-right text-gray-900">Hosting Bandwidth</label>
                            <input type="text" name="hosting_bandwidth" class="form-control" id="hostingBandwidth" placeholder="Hosting Bandwidth" value="{{ old('hosting_bandwidth') }}">
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6">
                            <label for="hostingDbQty" class="col-form-label text-right text-gray-900">Hosting DB Quantity</label>
                            <input type="text" name="hosting_db_qty" class="form-control" id="hostingDbQty" placeholder="Hosting DB Quantity" value="{{ old('hosting_db_qty') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hostingEmailQty" class="col-form-label text-right text-gray-900">Hosting Email Quantity</label>
                            <input type="text" name="hosting_emails_qty" class="form-control" id="hostingEmailQty" placeholder="Hosting Email Quantity" value="{{ old('hosting_emails_qty') }}">
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6">
                            <label for="hostingSubDomQty" class="col-form-label text-right text-gray-900">Hosting Subdomain Quantity</label>
                            <input type="text" name="hosting_subdomain_qty" class="form-control" id="hostingSubDomQty" placeholder="Hosting Subdomain Quantity" value="{{ old('hosting_subdomain_qty') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hostingFtpQty" class="col-form-label text-right text-gray-900">Hosting FTP Quantity</label>
                            <input type="text" name="hosting_ftp_qty" class="form-control" id="hostingFtpQty" placeholder="Hosting FTP Quantity" value="{{ old('hosting_ftp_qty') }}">
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6">
                            <label for="hostingParkDomQty" class="col-form-label text-right text-gray-900">Hosting Park Domain Quantity</label>
                            <input type="text" name="hosting_park_domain_qty" class="form-control" id="hostingParkDomQty" placeholder="Hosting Park Domain Quantity" value="{{ old('hosting_park_domain_qty') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hostingAdQty" class="col-form-label text-right text-gray-900">Hosting Addon Domain Quantity</label>
                            <input type="text" name="hosting_addon_domain_qty" class="form-control" id="hostingAdQty" placeholder="Hosting Addon Domain Quantity" value="{{ old('hosting_addon_domain_qty') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="serviceStartDaty" class="col-form-label text-right text-gray-900">Service Start Date</label>
                            <input type="test" data-provide="datepicker" name="service_start_date" class="form-control @error('service_start_date') is-invalid @enderror" id="serviceStartDaty" placeholder="Service Start Date" value="{{ old('service_start_date') }}" required autocomplete="off">
                            @error('service_start_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="serviceExpireDate" class="col-form-label text-right text-gray-900">Service Expire Date</label>
                            <input type="text" data-provide="datepicker" name="service_expire_date" class="form-control @error('service_expire_date') is-invalid @enderror" id="serviceExpireDate" placeholder="Service Expire Date" value="{{ old('service_expire_date') }}" required autocomplete="off">
                            @error('service_expire_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Create Service</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('services.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if(old('service_for'))
<script>
    $('document').ready(function() {
        if ("{{old('service_for')}}" == 3) {
            $('#serviceFor').val("{{old('service_for')}}");
            $(".domain-reseller").show();
        }

        if ("{{old('service_for')}}" == 2) {
            $('#serviceFor').val("{{old('service_for')}}");
            $(".hosting-reseller").show();
            $(".hosting-type").show();
        }

        if ("{{old('service_for')}}" == 1) {
            $('#serviceFor').val("{{old('service_for')}}");
            $(".domain-reseller").show();
            $(".hosting-reseller").show();
            $(".hosting-type").show();
        }

        if ("{{old('hosting_type')}}" == 'package') {
            $('#hostingType').val("{{old('hosting_type')}}");
            $(".hosting-package").show();
        }

    });
</script>
@endif
@endsection