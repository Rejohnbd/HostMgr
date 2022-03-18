@extends('layouts.master')

@section('title', 'Customers')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Customer List',
'activePage' => 'Customers'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('customers.create') }}" class="btn btn-info mb-2">Add Customer</a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Customer Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        {{-- <th>Website</th> --}}
                        <th>Total Services</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr id="customerId-{{ $customer->id }}">
                        @if($customer->customer_type === 'individual')
                        <td>
                            {{ $customer->customer_first_name }} {{ $customer->customer_last_name }}
                        </td>
                        @endif
                        @if($customer->customer_type === 'company')
                        <td>
                            {{ $customer->company_name }}
                        </td>
                        @endif
                        <td>{{ $customer->user->email }}</td>
                        {{-- <td>{{ $customer->company_website }}</td> --}}
                        <td>{{ $customer->customerServices->count() }}</td>
                        <td>{{ ucfirst($customer->customer_type) }}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show @if($customer->customer_type === 'individual') {{ $customer->customer_first_name }}  {{ $customer->customer_last_name }} @elseif($customer->customer_type === 'company') {{ $customer->company_name }} @endif Details">
                                <i class="fas fa-search-plus"></i>
                            </a>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit @if($customer->customer_type === 'individual') {{ $customer->customer_first_name }}  {{ $customer->customer_last_name }} @elseif($customer->customer_type === 'company') {{ $customer->company_name }} @endif Info">
                                <i class="far fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm deleteCustomer" data-id="{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Delete @if($customer->customer_type === 'individual') {{ $customer->customer_first_name }}  {{ $customer->customer_last_name }} @elseif($customer->customer_type === 'company') {{ $customer->company_name }} @endif">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.modal_delete_confirm', [
'modal_title' => 'Delete Customer',
'modal_body' => 'Are you Sure? You want to delete this Customer.'
])

@include('partials.modal_delete_error')

@include('partials.modal_delete_success')
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let customerId;
        $(document).on('click', '.deleteCustomer', function() {
            customerId = $(this).attr('data-id');
            $('#deleteModal').modal('show');
        })

        $(document).on('click', '#deleteConfirm', function() {
            $.ajax({
                url: "{{ url('cusomter-delete')}}",
                method: "POST",
                data: {
                    customerId: customerId,
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
                        $('#customerId-' + customerId).remove();
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