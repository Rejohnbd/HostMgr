@extends('layouts.master')

@if(isset($emailTemplate))
@section('title', 'Domain Reseller Update')
@else
@section('title', 'Email Template Create')
@endif

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => isset($emailTemplate) ? 'Domain Reseller Update' : 'Email Template Create' ,
'itemOne' => 'Email Templates',
'itemOneUrl' => 'email-templates.index',
'activePage' => isset($emailTemplate) ? 'Update' : 'Create'
])
@endcomponent

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ isset($emailTemplate) ? 'Update Email Template' : 'Create Email Template' }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($emailTemplate) ? route('email-templates.update', $emailTemplate->id) : route('email-templates.store') }}" method="POST">
                    @csrf
                    @isset($emailTemplate)
                    @method('PUT')
                    @endisset
                    <div class="form-group required">
                        <label for="emailTemplateName" class="col-form-label text-right text-gray-900">Email Template Name</label>
                        <input type="text" name="template_name" class="form-control @error('template_name') is-invalid @enderror" id="emailTemplateName" placeholder="Email Template Name" value="{{ isset($emailTemplate) ? $emailTemplate->template_name : old('template_name')  }}" required>
                        @error('template_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="emailSubject" class="col-form-label text-right text-gray-900">Email Subject</label>
                        <textarea name="email_subject" class="form-control @error('email_subject') is-invalid @enderror" id="emailSubject" rows="3" placeholder="Email Subject" required>{{ isset($emailTemplate) ? $emailTemplate->email_subject : old('email_subject') }}</textarea>
                        @error('email_subject')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group required">
                        <label for="emailBody" class="col-form-label text-right text-gray-900">Email Body</label>
                        <textarea name="email_body" class="form-control @error('email_body') is-invalid @enderror" id="emailBody" placeholder="Email Body">{{ isset($emailTemplate) ? $emailTemplate->email_body : old('email_body') }}</textarea>
                        @error('email_body')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-primary">{{ isset($emailTemplate) ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('email-templates.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('resources/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#emailBody',
    });
</script>
@endsection