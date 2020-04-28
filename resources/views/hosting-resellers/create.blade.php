@extends('layouts.master')

@if(isset($hostingReseller))
@section('title', 'Hosting Reseller Update')
@else
@section('title', 'Hosting Reseller Create')
@endif

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => isset($hostingReseller) ? 'Hosting Reseller Update' : 'Hosting Reseller Create',
'itemOne' => 'Hosting Resellers',
'itemOneUrl' => 'hosting-resellers.index',
'activePage' => isset($hostingReseller) ? 'Update' : 'Create'
])
@endcomponent

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
                    <div class="form-group required">
                        <label for="hostingResellerName" class="col-form-label text-right text-gray-900">Reseller Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="hostingResellerName" placeholder="Reseller Name" value="{{ isset($hostingReseller) ? $hostingReseller->name : old('name')  }}" required>
                        @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group required">
                        <label for="hostingResellerEmail" class="col-form-label text-right text-gray-900">Reseller Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="hostingResellerEmail" placeholder="Reseller Email" value="{{ isset($hostingReseller) ? $hostingReseller->email : old('email') }}" required>
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group required">
                        <label for="hostingResellerWeb" class="col-form-label text-right text-gray-900">Reseller Website</label>
                        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" id="hostingResellerWeb" placeholder="Reseller Website" value="{{ isset($hostingReseller) ? $hostingReseller->website : old('website') }}" required>
                        @error('website')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group required">
                        <label for="hostingResellerDetails" class="col-form-label text-right text-gray-900">Reseller Details</label>
                        <textarea name="details" class="form-control @error('details') is-invalid @enderror" id="hostingResellerDetails" rows="3" placeholder="Reseller Details" required>{{ isset($hostingReseller) ? $hostingReseller->details : old('details') }}</textarea>
                        @error('details')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">{{ isset($hostingReseller) ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('hosting-resellers.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection