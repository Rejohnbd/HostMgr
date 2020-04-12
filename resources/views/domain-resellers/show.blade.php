@extends('layouts.master')

@section('title', 'Domain Reseller List')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Domain Reseller View</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Domain Reseller View</li>
    </ol>
</div>
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Table</h6>
        </div>
        <div class="card-body px-0 pb-0">
            <table class="table table-striped text-gray-900 mb-0">
                <tbody>
                    <tr>
                        <th scope="row">Reseller Name</th>
                        <td>{{ $domainReseller->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Reseller Email</th>
                        <td>{{ $domainReseller->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Reseller Website</th>
                        <td>
                            <a href="{{ $domainReseller->website }}" target="_blank">
                                {{ $domainReseller->website }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Create Date</th>
                        <td>{{ $domainReseller->created_at }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Update Date</th>
                        <td>{{ $domainReseller->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection