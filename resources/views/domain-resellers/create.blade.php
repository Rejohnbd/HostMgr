@extends('layouts.master')

@if(isset($domainReseller))
@section('title', 'Domain Reseller Update')
@else
@section('title', 'Domain Reseller Create')
@endif

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => isset($domainReseller) ? 'Domain Reseller Update' : 'Domain Reseller Create' ,
'itemOne' => 'Domain Resellers',
'itemOneUrl' => 'domain-resellers.index',
'activePage' => isset($domainReseller) ? 'Update' : 'Create'
])
@endcomponent

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
                    <div class="form-group required">
                        <label for="domainResellerName" class="col-form-label text-right text-gray-900">Reseller Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="domainResellerName" placeholder="Reseller Name" value="{{ isset($domainReseller) ? $domainReseller->name : old('name')  }}" required>
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="domainResellerEmail" class="col-form-label text-right text-gray-900">Reseller Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="domainResellerEmail" placeholder="Reseller Email" value="{{ isset($domainReseller) ? $domainReseller->email : old('email') }}" required>
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group required">
                        <label for="domainResellerWeb" class="col-form-label text-right text-gray-900">Reseller Website</label>
                        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="domainResellerWeb" placeholder="Reseller Website" value="{{ isset($domainReseller) ? $domainReseller->website : old('website') }}" required>
                        @error('website')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="domainResellerDetails" class="col-form-label text-right text-gray-900">Reseller Details</label>
                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="domainResellerDetails" rows="3" placeholder="Reseller Details" required>{{ isset($domainReseller) ? $domainReseller->details : old('details') }}</textarea>
                        @error('details')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">{{ isset($domainReseller) ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('domain-resellers.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection