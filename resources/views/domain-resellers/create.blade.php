@extends('layouts.master')

@if(isset($domainReseller))
@section('title', 'Domain Reseller Update')
@else
@section('title', 'Domain Reseller Create')
@endif

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ isset($domainReseller) ? 'Domain Reseller Update' : 'Domain Reseller Create' }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('domain-resellers.index') }}">Domain Resellers</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($domainReseller) ? 'Update' : 'Create' }}</li>
    </ol>
</div>
@if(session('success'))
@include('partials.success-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($domainReseller) ? 'Update Reseller' : 'Create Reseller' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($domainReseller) ? route('domain-resellers.update', $domainReseller->id) : route('domain-resellers.store') }}" method="POST">
                    @csrf
                    @isset($domainReseller)
                    @method('PUT')
                    @endisset
                    <div class="form-group row required">
                        <label for="domainResellerName" class="col-md-3 col-form-label text-right text-gray-900">Reseller Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="domainResellerName" placeholder="Reseller Name" value="{{ isset($domainReseller) ? $domainReseller->name : old('name')  }}" required>
                            @error('name')
                            <small class="form-text text-danger">Domain Reseller Name is Required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="domainResellerEmail" class="col-md-3 col-form-label text-right text-gray-900">Reseller Email</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="domainResellerEmail" placeholder="Reseller Email" value="{{ isset($domainReseller) ? $domainReseller->email : old('email') }}" required>
                            @error('email')
                            <small class="form-text text-danger">Domain Reseller Email is Required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="domainResellerWeb" class="col-md-3 col-form-label text-right text-gray-900">Reseller Website</label>
                        <div class="col-md-9">
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="domainResellerWeb" placeholder="Reseller Website" value="{{ isset($domainReseller) ? $domainReseller->website : old('website') }}" required>
                            @error('website')
                            <small class="form-text text-danger">Domain Reseller Website is Required.</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="domainResellerDetails" class="col-md-3 col-form-label text-right text-gray-900">Reseller Details</label>
                        <div class="col-md-9">
                            <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="domainResellerDetails" rows="3" placeholder="Reseller Details" required>{{ isset($domainReseller) ? $domainReseller->details : old('details') }}</textarea>
                            @error('details')
                            <small class="form-text text-danger">Domain Reseller Details is Required.</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block btn-primary">{{ isset($domainReseller) ? 'Update' : 'Save' }}</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('domain-resellers.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
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