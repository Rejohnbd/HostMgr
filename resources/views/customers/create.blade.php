@extends('layouts.master')

@section('title', 'Customer Create')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Create</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</div>

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
                <h6 class="m-0 font-weight-bold text-primary">Create Customer</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="customerType" class="col-form-label text-right text-gray-900">Customer Type</label>
                            <div class="d-flex" id="customerType">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="companyRadio" name="customer_type" value="company" class="custom-control-input" @if(old('customer_type')==='company' ) checked @endif required>
                                    <label class="custom-control-label" for="companyRadio">Company</label>
                                </div>
                                <div class="custom-control custom-radio ml-2">
                                    <input type="radio" id="individualRadio" name="customer_type" value="individual" class="custom-control-input" @if(old('customer_type') !='company' ) checked @endif>
                                    <label class="custom-control-label" for="individualRadio">Individual</label>
                                </div>
                            </div>
                            @error('customer_type')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="customerGender" class="col-form-label text-right text-gray-900">Customer Gender</label>
                            <div class="d-flex">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="maleRadio" name="customer_gender" value="male" class="custom-control-input" @if(old('customer_gender')==='male' ) checked @endif required>
                                    <label class="custom-control-label" for="maleRadio">Male</label>
                                </div>
                                <div class="custom-control custom-radio ml-2">
                                    <input type="radio" id="femaleRadio" name="customer_gender" value="female" class="custom-control-input" @if(old('customer_gender')==='female' ) checked @endif>
                                    <label class="custom-control-label" for="femaleRadio">Female</label>
                                </div>
                            </div>
                            @error('customer_gender')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                            <label for="customerFirstName" class="col-form-label text-right text-gray-900">Customer First Name</label>
                            <input type="text" name="customer_first_name" class="form-control" id="customerFirstName" placeholder="Customer First Name" value="{{ old('customer_first_name')  }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="customerLastName" class="col-form-label text-right text-gray-900">Customer Last Name</label>
                            <input type="text" name="customer_last_name" class="form-control" id="customerLastName" placeholder="Customer Last Name" value="{{ old('customer_last_name') }}">
                        </div>
                    </div>

                    <div class="company-form">
                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="companyName" class="col-form-label text-right text-gray-900">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="companyName" placeholder="Company Name" value="{{ old('company_name') }}">
                            </div>

                            <div class="form-group col-md-6 required">
                                <label for="companyWebsite" class="col-form-label text-right text-gray-900">Company Website</label>
                                <input type="url" name="company_website" class="form-control @error('company_website') is-invalid @enderror" id="companyWebsite" placeholder="Company Website" value="{{ old('company_website') }}">
                                @error('company_website')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="companyDetails" class=" col-form-label text-right text-gray-900">Company Details</label>
                            <textarea name="company_details" class="form-control" id="companyDetails" rows="3" placeholder="Company Details">{{ old('company_details') }}</textarea>
                        </div>

                        <div class="add-contact-form bg-info"></div>

                        <div class="contact-person-form multiple-form-group">
                            <div class="form-group required">
                                <label for="contactPerson" class=" col-form-label text-right text-gray-900">Contact Person Name</label>
                                <div class="d-flex">
                                    <input type="text" name="full_name[]" class="form-control @error('full_name') is-invalid @enderror" id="contactPerson" placeholder="Contact Person Name" value="{{ old('full_name[]')  }}">
                                    <span class="input-group-btn">
                                        <button type="button" id="contactPersonBtn" class="btn btn-add btn-success" style="padding: 8px" data-toggle="tooltip" data-placement="top" title="Add Contact Person">+</button>
                                    </span>
                                </div>
                                @error('full_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 ">
                                    <label for="contactPersonEmail" class=" col-form-label text-right text-gray-900">Contact Person Email</label>
                                    <input type="email" name="contact_email[]" class="form-control" id="contactPersonEmail" placeholder="Contact Person Email" value="{{ old('contact_email[]')  }}">
                                </div>

                                <div class="form-group col-md-6 required">
                                    <label for="contactPersonMobile" class=" col-form-label text-right text-gray-900">Contact Person Mobile</label>
                                    <input type="text" name="contact_mobile[]" class="form-control @error('contact_mobile') is-invalid @enderror" id="contactPersonMobile" placeholder="Contact Person Mobile" value="{{ old('contact_mobile[]')  }}">
                                    @error('contact_mobile')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 ">
                            <label for="customerReference" class=" col-form-label text-right text-gray-900">Customer Reference</label>
                            <input type="text" name="customer_reference" class="form-control" id="customerReference" placeholder="Customer Reference" value="{{ old('customer_reference')  }}">
                        </div>
                        <div class="form-group col-md-6 required">
                            <label for="customerAddress" class="col-form-label text-right text-gray-900">Customer Address</label>
                            <textarea name="customer_address" class="form-control @error('customer_address') is-invalid @enderror" id="customerAddress" rows="3" placeholder="Customer Address" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group required">
                        <label for="customerEmail" class="col-form-label text-right text-gray-900">Customer Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="customerEmail" placeholder="Customer Email" value="{{ old('email')  }}" required>
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="customerPassword" class="col-form-label text-right text-gray-900">Customer Default Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="customerPassword" placeholder="Customer Default Password" value="{{ old('password') }}" required>
                        @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label for="joinDate" class=" col-form-label text-right text-gray-900">Customer Create Date</label>
                            <input id="custJoinDate" data-provide="datepicker" type="text" name="customer_join_date" class="form-control @error('customer_join_date') is-invalid @enderror" id="joinDate" placeholder="Customer Create Date" value="{{ old('customer_join_date')  }}" required autocomplete="off">
                            @error('customer_join_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 required">
                            <label for="joinYear" class=" col-form-label text-right text-gray-900">Customer Create Year</label>
                            <input data-provide="datepicker" type="text" name="customer_join_year" class="form-control @error('customer_join_year') is-invalid @enderror" id="joinYear" placeholder="Customer Create Year" value="{{ old('customer_join_year')  }}" required autocomplete="off">
                            @error('customer_join_year')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('customers.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.company-form').hide();
        $('#customerType input').on('change', function() {
            var customerType = $('input[name=customer_type]:checked').val();
            if (customerType === 'company') {
                $('.company-form').show();
            } else {
                $('.company-form').hide();
            }
        });

        @if(old('customer_type') === 'company')
        $('.company-form').show();
        @endif

    })
</script>

@endsection