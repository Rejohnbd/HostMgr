@extends('layouts.master')

@if(isset($hostingReseller))
@section('title', 'Hosting Reseller Update')
@else
@section('title', 'Hosting Reseller Create')
@endif

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ isset($hostingReseller) ? 'Hosting Reseller Update' : 'Hosting Reseller Create' }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('hosting-resellers.index') }}">Hosting Resellers</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ isset($hostingReseller) ? 'Update' : 'Create' }}</li>
    </ol>
</div>
@if(session('success'))
@include('partials.success-alert')
@endif

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($hostingReseller) ? 'Update Reseller' : 'Create Reseller' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($hostingReseller) ? route('hosting-resellers.update', $hostingReseller->id) : route('hosting-resellers.store') }}" method="POST">
                    @csrf
                    @isset($hostingReseller)
                    @method('PUT')
                    @endisset
                    <div class="form-group row required">
                        <label for="hostingResellerName" class="col-md-3 col-form-label text-right text-gray-900">Reseller Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="hostingResellerName" placeholder="Reseller Name" value="{{ isset($hostingReseller) ? $hostingReseller->name : old('name')  }}" required>
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="hostingResellerEmail" class="col-md-3 col-form-label text-right text-gray-900">Reseller Email</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="hostingResellerEmail" placeholder="Reseller Email" value="{{ isset($hostingReseller) ? $hostingReseller->email : old('email') }}" required>
                            @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="hostingResellerWeb" class="col-md-3 col-form-label text-right text-gray-900">Reseller Website</label>
                        <div class="col-md-9">
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="hostingResellerWeb" placeholder="Reseller Website" value="{{ isset($hostingReseller) ? $hostingReseller->website : old('website') }}" required>
                            @error('website')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="hostingResellerDetails" class="col-md-3 col-form-label text-right text-gray-900">Reseller Details</label>
                        <div class="col-md-9">
                            <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="hostingResellerDetails" rows="3" placeholder="Reseller Details" required>{{ isset($hostingReseller) ? $hostingReseller->details : old('details') }}</textarea>
                            @error('details')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block btn-primary">{{ isset($hostingReseller) ? 'Update' : 'Save' }}</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('hosting-resellers.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
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