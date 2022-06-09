@extends('layouts.master')

@section('title', 'Email Send')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Email Send',
'activePage' => 'Email Send'
])
@endcomponent

{{-- Show Success Alert --}}
@if(session('success'))
@include('partials.success-alert')
@endif

@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Email Send</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('email-send') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <label for="selectCustomer" class="col-form-label text-right text-gray-900">Select Customer Email</label>
                        <select class="form-control" id="selectCustomer" name="customer_id">
                            <option selected>Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">
                                @if($customer->customer_type === 'individual')
                                {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                                @endif
                                @if($customer->customer_type === 'company')
                                {{ $customer->company_name }}
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="selectCustomerSericeContainer">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="domainCheckbox" value="domain">
                            <label class="form-check-label" for="domainCheckbox">Domain</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="hostingCheckbox" value="hosting">
                            <label class="form-check-label" for="hostingCheckbox">Hosing</label>
                        </div>

                        <div class="form-group required">
                            <label for="selectCustomerSerice" class="col-form-label text-right text-gray-900">Select Customer Service</label>
                            <select class="form-control" id="selectCustomerSerice" name="service_id"></select>
                        </div>

                        <div class="form-group required">
                            <label for="selectEmailTemplate" class="col-form-label text-right text-gray-900">Select Email Template</label>
                            <select class="form-control" id="selectEmailTemplate">
                                <option selected value="0">Select Email Template</option>
                                @foreach($emailTemplates as $template)
                                <option value="{{ $template->id }}">
                                    {{ $template->template_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="emailSubjectBodyContainer">
                        <div class="form-group required">
                            <label for="emailSubject" class="col-form-label text-right text-gray-900">Email Subject</label>
                            <textarea name="email_subject" class="form-control @error('email_subject') is-invalid @enderror" id="emailSubject" rows="3" placeholder="Email Subject" required></textarea>
                            @error('email_subject')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group required">
                            <label for="emailBody" class="col-form-label text-right text-gray-900">Email Body</label>
                            <textarea name="email_body" class="form-control @error('email_body') is-invalid @enderror" id="emailBody" placeholder="Email Body"></textarea>
                            @error('email_body')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary" disabled="true">Send Email</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('dashboard') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('resources/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    $('#emailSubjectBodyContainer').hide();
    $('#selectCustomerSericeContainer').hide();
    $("#selectCustomer").select2();
    tinymce.init({
        selector: '#emailBody',
    });

    let serviceInfoObj = {};

    let btnDisabled = {
        'customerInfo': false,
        'emailInfo': false
    };

    $('#selectCustomer').on('change', function() {
        $('#selectCustomerSerice').empty();
        $('#domainCheckbox').prop('disabled', true);
        $('#hostingCheckbox').prop('disabled', true);
        let customerId = $(this).val();
        if (customerId === 'Select Customer') {
            $('#selectCustomerSericeContainer').hide();
            $('#emailSubjectBodyContainer').hide();
            btnDisabled.customerInfo = false;
            btn_enable();
        } else {
            $.ajax({
                url: "{{ route('services-by-customer-id')}}",
                method: "POST",
                data: {
                    customerId: customerId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 200) {
                        serviceInfoObj = {};
                        $.each(response.datas, function(i, value) {
                            if (value.domain_reseller_id > 0) {
                                $('#domainCheckbox').prop('disabled', false);
                                $('#domainCheckbox').prop('checked', true);
                            }
                            if (value.hosting_reseller_id > 0) {
                                $('#hostingCheckbox').prop('disabled', false);
                                $('#hostingCheckbox').prop('checked', true);
                            }
                            serviceInfoObj[i] = {
                                id: value.id,
                                domain_name: value.domain_name,
                                domain: value.domain_reseller_id,
                                hosting: value.hosting_reseller_id,
                            };
                        });
                        render_services_option(true, true);
                        btnDisabled.customerInfo = true;
                        btn_enable();
                        $('#selectCustomerSericeContainer').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#deleteModal').modal('hide');
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            });
        }
    });

    $('#selectEmailTemplate').on('change', function() {
        let templateId = $(this).val();
        if (templateId == 0) {
            $('#emailSubjectBodyContainer').hide();
            btnDisabled.emailInfo = false;
            btn_enable();
        } else {
            $.ajax({
                url: "{{ route('email-template-details')}}",
                method: "POST",
                data: {
                    templateId: templateId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 200) {
                        btnDisabled.emailInfo = true;
                        $('#emailSubjectBodyContainer').show();
                        $('#emailSubject').text(response.subject);
                        tinyMCE.activeEditor.setContent(response.body);
                        $('#emailBody').text(response.body);
                        btn_enable();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#deleteModal').modal('hide');
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            });
        }
    });

    function btn_enable() {
        if (btnDisabled.customerInfo && btnDisabled.emailInfo) {
            let domainStatus = $("#domainCheckbox").is(':checked');
            let hostingStatus = $("#hostingCheckbox").is(':checked');
            if (!domainStatus && !hostingStatus) {
                $('.btn-primary').prop('disabled', true)
            } else {
                $('.btn-primary').prop('disabled', false)
            }
        } else {
            $('.btn-primary').prop('disabled', true)
        }
    }

    $('#domainCheckbox').on('click', function() {
        let domainStatus = $("#domainCheckbox").is(':checked');
        let hostingStatus = $("#hostingCheckbox").is(':checked');
        $('#selectCustomerSerice').empty();
        render_services_option(domainStatus, hostingStatus);
        btn_enable();
    });

    $('#hostingCheckbox').on('click', function() {
        let domainStatus = $("#domainCheckbox").is(':checked');
        let hostingStatus = $("#hostingCheckbox").is(':checked');
        $('#selectCustomerSerice').empty();
        render_services_option(domainStatus, hostingStatus);
        btn_enable();
    });

    function render_services_option(dom, hos) {
        let toAppend = '';
        $.each(serviceInfoObj, function(i, value) {
            if (dom && hos) {
                toAppend += '<option value="' + value.id + '">' + value.domain_name + '</option>';
            } else if (!dom && hos) {
                if (value.hosting > 0) {
                    toAppend += '<option value="' + value.id + '">' + value.domain_name + '</option>';
                }
            } else if (dom && !hos) {
                if (value.domain > 0) {
                    toAppend += '<option value="' + value.id + '">' + value.domain_name + '</option>';
                }
            } else {
                if (value.hosting > 0) {
                    toAppend += '';
                }
            }
        });
        $('#selectCustomerSerice').append(toAppend);
    }
</script>
@endsection