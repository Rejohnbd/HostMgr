@extends('layouts.master')

@section('title', 'Customers')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Customer List',
'activePage' => 'Customers'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('customers.create') }}" class="btn btn-info mb-2">Add Customer</a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Customer Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Services</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        @if($customer->customer_type === 'individual')
                        <td>
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </td>
                        @endif
                        @if($customer->customer_type === 'company')
                        <td>
                            {{ $customer->company_name }}
                        </td>
                        @endif
                        <td>{{ $customer->user->email }}</td>
                        <td>{{ $customer->company_website }}</td>
                        <td>{{ $customer->customerServices->count() }}</td>
                        <td>{{ ucfirst($customer->customer_type) }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Customer Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection