@extends('layouts.master')

@section('title', 'Domain Resellers Renew')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Domain Reseller Renew',
'itemOne' => 'Domain Resellers',
'itemOneUrl' => 'domain-resellers.index',
'activePage' => 'Renew'
])
@endcomponent

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Domain Reseller Renew</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('domain-resellers.renew-store', ['domain_reseller_id' => $id])}}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <label for="resellerRenewDate" class="col-form-label text-right text-gray-900">Reseller Renew Date</label>
                        <input type="text" name="domain_reseller_renew_date" data-provide="datepicker" class="form-control @error('domain_reseller_renew_date') is-invalid @enderror" id="resellerRenewDate" placeholder="Reseller Renew Date" value="{{ old('domain_reseller_renew_date') }}" required autocomplete="off" required>
                        @error('domain_reseller_renew_date')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="domainResellerEmail" class="col-form-label text-right text-gray-900">Reseller Renew Month</label>
                        <input type="number" name="domain_reseller_renew_for" class="form-control @error('domain_reseller_renew_for') is-invalid @enderror" id="domainResellerEmail" placeholder="Reseller Renew Month" min="0" max="12" value="{{ old('domain_reseller_renew_for') }}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                        @error('domain_reseller_renew_for')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="domainResellerEmail" class="col-form-label text-right text-gray-900">Reseller Renew Amount</label>
                        <input type="number" name="domain_reseller_renew_amount" class="form-control @error('domain_reseller_renew_amount') is-invalid @enderror" id="domainResellerEmail" placeholder="Reseller Renew Amount" min="0" value="{{ old('domain_reseller_renew_amount') }}" required>
                        @error('domain_reseller_renew_amount')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
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