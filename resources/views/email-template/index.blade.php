@extends('layouts.master')

@section('title', 'Email Templates')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Email Templates',
'activePage' => 'Email Templates'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('email-templates.create') }}" class="btn btn-info mb-2">Add Template</a>
    </div>
</div>

{{-- Show Success Alert --}}
@if(session('success'))
@include('partials.success-alert')
@endif

{{-- Show Warning Alert --}}
@if(session('warning'))
@include('partials.warning-alert')
@endif

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Email Template Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Template Name</th>
                        <th>Email Subject</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($templates as $template)
                    <tr id="emailTemplateId-{{ $template->id }}">
                        <td>{{ $template->template_name }}</td>
                        <td>{{ $template->email_subject }}</td>
                        <td>
                            {{-- <a href="{{ route('email-templates.show', $template->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Details">
                            <i class="fas fa-search-plus"></i>
                            </a> --}}
                            <a href="{{ route('email-templates.edit', $template->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Reseller Edit">
                                <i class="far fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm deleteEmailTemplate" data-id="{{ $template->id }}" data-toggle="tooltip" data-placement="top" title="Reseller Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.modal_delete_confirm', [
'modal_title' => 'Delete Email Template',
'modal_body' => 'Are you Sure? You want to delete this Email Template.'
])

@include('partials.modal_delete_error')

@include('partials.modal_delete_success')
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let emailTemplateId;
        $(document).on('click', '.deleteEmailTemplate', function() {
            emailTemplateId = $(this).attr('data-id');
            $('#deleteModal').modal('show');
        })

        $(document).on('click', '#deleteConfirm', function() {
            $.ajax({
                url: "{{ route('email-template-delete')}}",
                method: "POST",
                data: {
                    emailTemplateId: emailTemplateId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    if (response.status == 404 || response.status == 400) {
                        $('#errorModalTitle').text(response.title);
                        $('#errorModalMessage').text(response.message);
                        $('#errorModal').modal('show');
                    }

                    if (response.status == 200) {
                        $("#dataTable").DataTable().rows($("#emailTemplateId-" + emailTemplateId)).remove();
                        $("#dataTable").DataTable().draw();
                        $('#successModalTitle').text(response.title);
                        $('#successModalMessage').text(response.message);
                        $('#successModal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#deleteModal').modal('hide');
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            });
        });
    });
</script>
@endsection