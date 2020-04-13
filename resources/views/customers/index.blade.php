@extends('layouts.master')

@section('title', 'Customer List')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer List</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Customer List</li>
    </ol>
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
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}</td>
                        <td>{{ $customer->user->email }}</td>
                        <td>{{ $customer->company_website }}</td>
                        <td>{{ $customer->customer_type }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Edit">
                                <i class="far fa-edit"></i>
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