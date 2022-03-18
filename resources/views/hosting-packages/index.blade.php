@extends('layouts.master')

@section('title', 'Hosting Packages')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Hosting Packages',
'activePage' => 'Packages'
])
@endcomponent

<div class="d-flex justify-content-start">
    <a href="{{ route('hosting-packages.create') }}" class="btn btn-info mb-2">Add Package</a>
</div>

<div class="row">
    @forelse($hostingPackages as $hostingPackage)
    <div class="col-md-4 col-sm-12 mb-4" id="hostingPackageId-{{ $hostingPackage->id }}">
        <div class="card shadow mb-4">
            <a href="#collapseCHostingPackage-{{ $hostingPackage->id }}" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseHostingPackage-{{ $hostingPackage->id }}">
                <h6 class="m-0 font-weight-bold text-primary">{{ $hostingPackage->name }}</h6>
            </a>
            <div class="collapse" id="collapseCHostingPackage-{{ $hostingPackage->id }}">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            SSD Space <span class="badge badge-primary badge-pill">{{ $hostingPackage->space }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bandwidth <span class="badge badge-primary badge-pill">{{ $hostingPackage->bandwidth }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Database Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->db_qty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->emails_qty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sub Domain Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->subdomain_qty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            FTP Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->ftp_qty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Park Domain Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->park_domain_qty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Addon Domain Quantity <span class="badge badge-primary badge-pill">{{ $hostingPackage->addon_domain_qty }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="{{ route('hosting-packages.edit', $hostingPackage->id) }}" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Edit Package {{ $hostingPackage->name }}">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-circle deleteHostingPackage" data-id="{{ $hostingPackage->id }}" data-toggle="tooltip" data-placement="top" title="Delete Package {{ $hostingPackage->name }}">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    @empty
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5>No Hosting Package Created</h5>
            </div>
        </div>
    </div>
    @endforelse
</div>

@include('partials.modal_delete_confirm', [
'modal_title' => 'Delete Hosting Package',
'modal_body' => 'Are you Sure? You want to delete this Hosting Package.'
])

@include('partials.modal_delete_error')

@include('partials.modal_delete_success')
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let hostingPackageId;
        $(document).on('click', '.deleteHostingPackage', function() {
            hostingPackageId = $(this).attr('data-id');
            $('#deleteModal').modal('show');
        })

        $(document).on('click', '#deleteConfirm', function() {
            $.ajax({
                url: "{{ url('hosting-package-delete')}}",
                method: "POST",
                data: {
                    hostingPackageId: hostingPackageId,
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
                        $('#hostingPackageId-' + hostingPackageId).remove();
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