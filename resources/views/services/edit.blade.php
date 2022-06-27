@extends('layouts.master')

@section('title', 'Service Create')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Edit Services',
'itemOne' => 'Services',
'itemOneUrl' => 'services.index',
'activePage' => 'Edit'
])
@endcomponent


<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Services</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group required">
                        <label for="customerType" class="col-form-label text-right text-gray-900">Customer Type</label>
                        <select name="customer_type" class="form-control @error('customer_type') is-invalid @enderror" id="customerType" required>
                            <option value="">Select Customer Type</option>
                            <option value="1" @if($service->customer->customer_type == 'individual') selected @endif>Individual Customer</option>
                            <option value="2" @if($service->customer->customer_type == 'company') selected @endif>Company Customer</option>
                        </select>
                        @error('customer_type')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required individual-customer">
                        <label for="individualEmail" class="col-form-label text-right text-gray-900">Individual Customers</label>
                        <select name="individual_customer" class="form-control col-12  @error('individual_customer') is-invalid @enderror" id="individualEmail">
                            <option value="">Select Customer Email</option>
                            @foreach($customers as $customer)
                            @if($customer->customer_type === 'individual')
                            <option value="{{ $customer->id }}" @if($service->customer_id == $customer->id ) selected @endif @if(old('individual_customer')) @if(old('individual_customer')==$customer->id ) {{ 'selected' }} @endif @endif>{{ $customer->customer_first_name }} {{ $customer->customer_last_name }} ({{ $customer->user->email }})</option>
                            @endif
                            @endforeach
                        </select>
                        @error('individual_customer')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required company-customer">
                        <label for="companyEmail" class="col-form-label text-right text-gray-900">Company Customers</label>
                        <select name="company_customer" class="form-control col-12  @error('company_customer') is-invalid @enderror" id="companyEmail">
                            <option value="">Select Customer Email</option>
                            @foreach($customers as $customer)
                            @if($customer->customer_type === 'company')
                            <option value="{{ $customer->id }}" @if($service->customer_id == $customer->id ) selected @endif @if(old('company_customer')) @if(old('company_customer')==$customer->id ) {{ 'selected' }} @endif @endif>{{ $customer->company_name }} ({{ $customer->user->email }})</option>
                            @endif
                            @endforeach
                        </select>
                        @error('company_customer')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="serviceFor" class="col-form-label text-right text-gray-900">Service For</label>
                            <div class="row ml-2">
                                @foreach($serviceTypes as $serviceType)
                                <div class="col-md-6 custom-control custom-checkbox">
                                    {{-- <input type="checkbox" name="service_for" class="serviceCheckbox custom-control-input @error('service_for') is-invalid @enderror" id="{{$serviceType->id}}" value="{{ $serviceType->id }}" @if(old('service_types')) @foreach(old('service_types') as $types) @if($types==$serviceType->id) checked @endif @endforeach @endif> --}}
                                    <input type="checkbox" name="service_for" class="serviceCheckbox custom-control-input @error('service_for') is-invalid @enderror" id="{{$serviceType->id}}" value="{{ $serviceType->id }}" @if(in_array($serviceType->id, $serviceTypeIdArrayFormat)) checked @endif>
                                    <label class="custom-control-label" for="{{ $serviceType->id }}">{{ $serviceType->name }} </label>
                                    <input type="hidden" id="hidden_st_{{$serviceType->id}}" name="service_types[{{$serviceType->id}}]" value="@if(in_array($serviceType->id, $serviceTypeIdArrayFormat)){{$serviceType->id}}@else{{0}}@endif" />
                                </div>
                                @endforeach
                            </div>
                            @if($errors->has('service_for'))
                            @foreach ($errors->get('service_for') as $error)
                            <small class="form-text text-danger">{{ $error }}</small>
                            @endforeach
                            @endif
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="domainName" class="col-form-label text-right text-gray-900">Service Domain name</label>
                            <input type="text" name="domain_name" class="form-control @error('domain_name') is-invalid @enderror" id="domainName" placeholder="Service Domain name" value="{{ old('domain_name', $service->domain_name) }}" required>
                            @error('domain_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group domain-reseller required">
                        <label for="domainReseller" class="col-form-label text-right text-gray-900">Domain Reseller</label>
                        <select name="domain_reseller_id" class="form-control reseller" id="domainReseller">
                            <option value="">Select Domain Resseler</option>
                            @foreach($domainResellers as $domainReseller)
                            <option value="{{ $domainReseller->id }}" @if($service->domain_reseller_id == $domainReseller->id) selected @endif @if(old('domain_reseller_id')) @if(old('domain_reseller_id')==$domainReseller->id ) {{ 'selected' }} @endif @endif>{{ $domainReseller->name }}</option>
                            @endforeach
                        </select>
                        @error('domain_reseller_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group hosting-reseller required">
                        <label for="hostingReseller" class="col-form-label text-right text-gray-900">Hosting Reseller</label>
                        <select name="hosting_reseller_id" class="form-control reseller" id="hostingReseller">
                            <option value="">Select Hosting Resseler</option>
                            @foreach($hostingResslers as $hostingRessler)
                            <option value="{{ $hostingRessler->id }}" @if($service->hosting_reseller_id == $hostingRessler->id) selected @endif @if(old('hosting_reseller_id')) @if(old('hosting_reseller_id')==$hostingRessler->id ) {{ 'selected' }} @endif @endif>{{ $hostingRessler->name }}</option>
                            @endforeach
                        </select>
                        @error('hosting_reseller_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class=" form-group hosting-type required">
                        <label for="hostingType" class="col-form-label text-right text-gray-900">Hosting Type</label>
                        <select name="hosting_type" class="form-control @error('hosting_type') is-invalid @enderror" id="hostingType">
                            <option value="">Select Hosting Type</option>
                            <option value="package" @if($service->hosting_type == 'package') selected @endif @if(old('hosting_type')) @if(old('hosting_type')=='package' ) {{ 'selected' }} @endif @endif>Package</option>
                            <option value="custom" @if($service->hosting_type == 'custom') selected @endif @if(old('hosting_type')) @if(old('hosting_type')=='custom' ) {{ 'selected' }} @endif @endif>Custom</option>
                        </select>
                        @error('hosting_type')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group hosting-package required">
                        <label for="hostingReseller" class="col-form-label text-right text-gray-900">Hosting Package</label>
                        <select name="hosting_package_id" class="form-control reseller" id="hostingReseller">
                            <option value="">Select Hosting Package</option>
                            @foreach($hostingPackages as $hostingPackage)
                            <option value="{{ $hostingPackage->id }}" @if($service->hosting_package_id == $hostingPackage->id) selected @endif @if(old('hosting_package_id')) @if(old('hosting_package_id')==$hostingPackage->id ) {{ 'selected' }} @endif @endif>{{ $hostingPackage->name }}</option>
                            @endforeach
                        </select>
                        @error('hosting_package_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class=" form-row custom-package ">
                        <div class="form-group col-md-6 required">
                            <label for="hostingSpace" class="col-form-label text-right text-gray-900">Hosting Space</label>
                            <input type="text" name="hosting_space" class="form-control" id="hostingSpace" placeholder="Hosting Space" value="{{ old('hosting_space', $service->hosting_space) }}">
                            @error('hosting_space')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="hostingBandwidth" class="col-form-label text-right text-gray-900">Hosting Bandwidth</label>
                            <input type="text" name="hosting_bandwidth" class="form-control" id="hostingBandwidth" placeholder="Hosting Bandwidth" value="{{ old('hosting_bandwidth', $service->hosting_bandwidth) }}">
                            @error('hosting_bandwidth')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6 required">
                            <label for="hostingDbQty" class="col-form-label text-right text-gray-900">Hosting DB Quantity</label>
                            <input type="text" name="hosting_db_qty" class="form-control" id="hostingDbQty" placeholder="Hosting DB Quantity" value="{{ old('hosting_db_qty', $service->hosting_db_qty) }}">
                            @error('hosting_db_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="hostingEmailQty" class="col-form-label text-right text-gray-900">Hosting Email Quantity</label>
                            <input type="text" name="hosting_emails_qty" class="form-control" id="hostingEmailQty" placeholder="Hosting Email Quantity" value="{{ old('hosting_emails_qty', $service->hosting_emails_qty) }}">
                            @error('hosting_emails_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6 required">
                            <label for="hostingSubDomQty" class="col-form-label text-right text-gray-900">Hosting Subdomain Quantity</label>
                            <input type="text" name="hosting_subdomain_qty" class="form-control" id="hostingSubDomQty" placeholder="Hosting Subdomain Quantity" value="{{ old('hosting_subdomain_qty', $service->hosting_subdomain_qty) }}">
                            @error('hosting_subdomain_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="hostingFtpQty" class="col-form-label text-right text-gray-900">Hosting FTP Quantity</label>
                            <input type="text" name="hosting_ftp_qty" class="form-control" id="hostingFtpQty" placeholder="Hosting FTP Quantity" value="{{ old('hosting_ftp_qty', $service->hosting_park_domain_qty) }}">
                            @error('hosting_ftp_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row custom-package">
                        <div class="form-group col-md-6 required">
                            <label for="hostingParkDomQty" class="col-form-label text-right text-gray-900">Hosting Park Domain Quantity</label>
                            <input type="text" name="hosting_park_domain_qty" class="form-control" id="hostingParkDomQty" placeholder="Hosting Park Domain Quantity" value="{{ old('hosting_park_domain_qty', $service->hosting_park_domain_qty) }}">
                            @error('hosting_park_domain_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="hostingAdQty" class="col-form-label text-right text-gray-900">Hosting Addon Domain Quantity</label>
                            <input type="text" name="hosting_addon_domain_qty" class="form-control" id="hostingAdQty" placeholder="Hosting Addon Domain Quantity" value="{{ old('hosting_addon_domain_qty', $service->hosting_addon_domain_qty) }}">
                            @error('hosting_addon_domain_qty')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row hosting-reseller">
                        <div class="form-group col-md-6 required">
                            <label for="cpanelUsername" class="col-form-label text-right text-gray-900">Cpanel Username</label>
                            <input type="text" name="cpanel_username" class="form-control" id="cpanelUsername" placeholder="Cpanel Username" value="{{ old('cpanel_username', $service->cpanel_username) }}">
                            @error('cpanel_username')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="cpanelPassword" class="col-form-label text-right text-gray-900">Cpanel Password</label>
                            <input type="text" name="cpanel_password" class="form-control" id="cpanelPassword" placeholder="Cpanel Password" value="{{ old('cpanel_password', $service->cpanel_password) }}">
                            @error('cpanel_password')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class=" form-group required other-details">
                        <label for="itemDetails" class="col-form-label text-right text-gray-900">Item Details</label>
                        <textarea name="item_details" class="form-control @error('item_details') is-invalid @enderror" id="itemDetails" rows="3" placeholder="Others Details">{{ old('item_details') }}</textarea>
                        @error('item_details')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="serviceStartDaty" class="col-form-label text-right text-gray-900">Service Start Date</label>
                            <input type="text" data-provide="datepicker" name="service_start_date" class="form-control @error('service_start_date') is-invalid @enderror" id="serviceStartDaty" placeholder="Service Start Date" value="{{ old('service_start_date', date('d-m-Y', strtotime($service->service_start_date))) }}" required autocomplete="off">
                            @error('service_start_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="serviceExpireDate" class="col-form-label text-right text-gray-900">Service Expire Date</label>
                            <input type="text" data-provide="datepicker" name="service_expire_date" class="form-control @error('service_expire_date') is-invalid @enderror" id="serviceExpireDate" placeholder="Service Expire Date" value="{{ old('service_expire_date', date('d-m-Y', strtotime($service->service_expire_date))) }}" required autocomplete="off">
                            @error('service_expire_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Update Service</button>
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

<script>
    $(document).ready(function() {
        $("#individualEmail").select2();
        $("#companyEmail").select2();
        $("#domainReseller").select2();
        $("#hostingReseller").select2();
        $("#serviceStartDaty").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });
        $("#serviceExpireDate").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
        });

        $(".serviceCheckbox").on("click", function() {
            var id = $(this).val();
            if ($(this).is(":checked")) {
                $("#hidden_st_" + id).val(id);
            } else {
                $("#hidden_st_" + id).val(0);
            }
        });
        $(".individual-customer").hide();
        $(".company-customer").hide();

        if ("{{$service->customer->customer_type}}" == 'individual') {
            $(".individual-customer").show();
        }

        if ("{{$service->customer->customer_type}}" == 'company') {
            $(".company-customer").show();
        }

        $("#customerType").on("change", function() {
            var customerType = $(this).children(":selected").val();
            if (customerType === "1") {
                $(".individual-customer").show();
                $(".company-customer").hide();
            } else if (customerType === "2") {
                $(".individual-customer").hide();
                $(".company-customer").show();
            } else {
                $(".individual-customer").hide();
                $(".company-customer").hide();
            }
        });

        $(".domain-reseller").hide();
        $(".hosting-reseller").hide();
        $(".hosting-type").hide();
        $(".hosting-package").hide();
        $(".other-details").hide();
        $(".custom-package").hide();
        $(".hosting-package").hide();

        $(":checkbox:checked").each(function(i) {
            checked = $(this).val();
            if (checked === "1") {
                $(".domain-reseller").show();
            }

            if (checked === "2") {
                $(".hosting-reseller").show();
                $(".hosting-type").show();
            }

            if (checked === "3") {
                $(".other-details").show();
            }
        });

        $("input:checkbox").change(function() {
            $(":checkbox:checked").each(function(i) {
                checked = $(this).val();
                if (checked === "1") {
                    $(".domain-reseller").show();
                }

                if (checked === "2") {
                    $(".hosting-reseller").show();
                    $(".hosting-type").show();
                }

                if (checked === "3") {
                    $(".other-details").show();
                }
            });
            $(":checkbox:not(:checked)").each(function(i) {
                unchecked = $(this).val();
                if (unchecked === "1") {
                    $(".domain-reseller").hide();
                }

                if (unchecked === "2") {
                    $(".hosting-reseller").hide();
                    $(".hosting-type").hide();
                    $(".hosting-package").hide();
                    $(".custom-package").hide();
                }

                if (unchecked === "3") {
                    $(".other-details").hide();
                }
            });
        });

        let pre_package = "{{$service->hosting_type}}";
        if (pre_package === "custom") {
            $(".custom-package").show();
            $(".hosting-package").hide();
        } else if (pre_package === "package") {
            $(".hosting-package").show();
            $(".custom-package").hide();
        } else {
            $(".custom-package").hide();
            $(".hosting-package").hide();
        }


        $("#hostingType").on("change", function() {
            var package = $(this).children(":selected").val();
            if (package === "custom") {
                $(".custom-package").show();
                $(".hosting-package").hide();
            } else if (package === "package") {
                $(".hosting-package").show();
                $(".custom-package").hide();
            } else {
                $(".custom-package").hide();
                $(".hosting-package").hide();
            }
        });
    });
</script>

@if($errors->has('individual_customer') || $errors->has('company_customer'))
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
    });
</script>
@endif

@if($errors->has('service_for') || $errors->has('domain_name') || $errors->has('service_start_date') || $errors->has('service_expire_date'))
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
    });
</script>
@endif


@if($errors->has('domain_reseller_id') || old('domain_reseller_id'))
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        // $("#1").prop("checked", true);
        $(".domain-reseller").show();

    });
</script>
@endif

@if($errors->has('hosting_reseller_id') || old('hosting_reseller_id') || $errors->has('hosting_type') || old('hosting_type'))
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        $(".hosting-reseller").show();
        $(".hosting-type").show();
    });
</script>
@endif

@if($errors->has('hosting_reseller_id'))
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        $(".hosting-reseller").show();
        $(".hosting-type").show();
    });
</script>
@endif

@if(old('hosting_type')=='package')
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        $(".hosting-reseller").show();
        $(".hosting-type").show();
        $(".hosting-package").show();
    });
</script>
@endif

@if(old('hosting_type')=='custom')
<script>
    $(document).ready(function() {
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        $(".hosting-reseller").show();
        $(".hosting-type").show();
        $(".hosting-package").hide();
        $(".custom-package").show();
    });
</script>
@endif

@if($errors->has('item_details') || old('item_details'))
<script>
    $(document).ready(function() {
        console.log('ok')
        if ("{{old('customer_type')}}" == 1) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".individual-customer").show();
        }

        if ("{{old('customer_type')}}" == 2) {
            $('#customerType').val("{{old('customer_type')}}");
            $(".company-customer").show();
        }
        // $("#3").prop("checked", true);
        $(".other-details").show();
    });
</script>
@endif
@endsection