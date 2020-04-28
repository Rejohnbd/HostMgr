@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'Dashboard',
'activePage' => 'Dashboard'
])
@endcomponent

<div class="row mb-3">
    {{-- Admin Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Admin Users',
    'value' => $admins,
    'viewLink' => '',
    'viewText' => 'View Users',
    'icon' => 'fas fa-users-cog',
    'iconColor' => 'text-success'
    ])
    @endcomponent

    {{-- Executive Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Executive Users',
    'value' => $executives,
    'viewLink' => '',
    'viewText' => 'View Executive',
    'icon' => 'fas fa-user-cog',
    'iconColor' => 'text-warning'
    ])
    @endcomponent

    {{-- Registered Customers --}}
    @component('partials.dashboard-item', [
    'title' => 'Registered Customers',
    'value' => $customerRegistered,
    'viewLink' => '',
    'viewText' => 'View Customers',
    'icon' => 'fas fa-user-plus',
    'iconColor' => 'text-muted'
    ])
    @endcomponent

    {{-- Customers Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Active Customers',
    'value' => $customers,
    'viewLink' => route('customers.index'),
    'viewText' => 'View Customers',
    'icon' => 'fas fa-users',
    'iconColor' => 'text-info'
    ])
    @endcomponent
</div>

<div class="row mb-3">
    {{-- Customers Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Total Services',
    'value' => $services,
    'viewLink' => route('services.index'),
    'viewText' => 'View Services',
    'icon' => 'fas fa-archive',
    'iconColor' => 'text-success'
    ])
    @endcomponent

    {{-- Hosting Packages Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Hosting Packages',
    'value' => $hostingPackages,
    'viewLink' => route('hosting-packages.index'),
    'viewText' => 'View Packages',
    'icon' => 'fas fa-box',
    'iconColor' => 'text-success'
    ])
    @endcomponent

    {{-- Domain Resellers Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Domain Reseller',
    'value' => $domainResellers,
    'viewLink' => route('domain-resellers.index'),
    'viewText' => 'View Domain Reseller',
    'icon' => 'fab fa-hornbill',
    'iconColor' => 'text-success'
    ])
    @endcomponent

    {{-- Hosting Resellers Show --}}
    @component('partials.dashboard-item', [
    'title' => 'Hosting Reseller',
    'value' => $hostingResellers,
    'viewLink' => route('hosting-resellers.index'),
    'viewText' => 'View Hosting Reseller',
    'icon' => 'fas fa-hdd',
    'iconColor' => 'text-success'
    ])
    @endcomponent
</div>

@endsection