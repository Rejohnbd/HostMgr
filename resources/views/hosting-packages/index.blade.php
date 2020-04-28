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
    <div class="col-md-4 col-sm-12 mb-4">
        <div class="card shadow mb-4">
            <a href="#collapseCHostingPackage-{{ $hostingPackage->id }}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseHostingPackage-{{ $hostingPackage->id }}">
                <h6 class="m-0 font-weight-bold text-primary">{{ $hostingPackage->name }}</h6>
            </a>
            <div class="collapse show" id="collapseCHostingPackage-{{ $hostingPackage->id }}">
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
                <a href="{{ route('hosting-packages.edit', $hostingPackage->id) }}" class="btn btn-info btn-circle">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="#" class="btn btn-success btn-circle ">
                    <i class="fas fa-thumbs-up"></i>
                </a>
                <a href="#" class="btn btn-danger btn-circle">
                    <i class="fas fa-trash"></i>
                </a>
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

@endsection