@extends('layouts.master')

@section('title', 'Customer Details')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
    </ol>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <nav class="nav-fill">
                    <div class="nav nav-tabs justify-content-between align-items-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="client-info-tab" data-toggle="tab" href="#client-info" role="tab" aria-controls="client-info" aria-selected="true">Customer Information</a>
                        <a class="nav-item nav-link" id="client-billing-tab" data-toggle="tab" href="#client-billing" role="tab" aria-controls="client-billing" aria-selected="false">Billing Information</a>
                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="client-info" role="tabpanel" aria-labelledby="client-info-tab">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Customer Infromation</h6>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <table class="table table-striped text-gray-900 mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Customer First Name</th>
                                                    <td>{{ $customer->customer_first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Last Name </th>
                                                    <td>{{ $customer->customer_last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Email</th>
                                                    <td>{{ $customer->user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Register Phone</th>
                                                    <td>{{ $customer->user->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Type </th>
                                                    <td>{{ $customer->customer_type }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Gender</th>
                                                    <td>{{ $customer->customer_gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Name</th>
                                                    <td>{{ $customer->company_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Website</th>
                                                    <td>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item p-2">
                                                                <a class="btn btn-sm btn-info mr-2" href="#" data-toggle="tooltip" title="Show Domain Details">{{ $customer->company_website }}</a>
                                                                <a class="btn btn-sm btn-success mr-2" href="{{ $customer->company_website }}" target="tooltip" data-toggle="tooltip" title="Visit Online">Visit Site</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Details</th>
                                                    <td>{{ $customer->company_details }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Company Address</th>
                                                    <td>{{ $customer->customer_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Join Date</th>
                                                    <td>{{ $customer->customer_join_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Join Year</th>
                                                    <td>{{ $customer->customer_join_year }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Reference</th>
                                                    <td>{{ $customer->customer_reference }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="#" class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-success btn-circle ">
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Customer Contact Person</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped text-gray-900 mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Person Name</th>
                                                    <td>{{ $customer->customerContactPerson->full_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Person Email</th>
                                                    <td>{{ $customer->customerContactPerson->contact_email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Person Mobile</th>
                                                    <td>{{ $customer->customerContactPerson->contact_mobile }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="client-billing" role="tabpanel" aria-labelledby="client-billing-tab">
                        <h1>Work Here Later</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection