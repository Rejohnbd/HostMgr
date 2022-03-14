@extends('layouts.master')

@section('title', 'Domain Resellers')

@section('content')

{{-- Breadcrumb Show --}}
@component('partials.breadcrumb',[
'title' => 'All Expenses',
'activePage' => 'All Expenses'
])
@endcomponent

<div class="col-lg-12">
    <div class="d-flex justify-content-start">
        <a href="{{ route('expenses.create') }}" class="btn btn-info mb-2">Add Expense</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Expenses Table</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr>
                        <td>{{ $expense->expenses_amount }}</td>
                        <td>{{ $expense->details }}</td>
                        <td>{{ date('d/m/Y' , strtotime($expense->created_at)) }}</td>
                        <td>

                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Expenses Edit">
                                <i class="far fa-edit"></i>
                            </a>
                            {{-- <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $reseller->id }}" data-toggle="tooltip" data-placement="top" title="Expenses Delete">
                            <i class="fas fa-trash"></i>
                            </button> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <form action="{{ route('hosting-resellers-destroy') }}" method="POST" id="deleteForm">
@csrf
<div class="modal fade" id="listDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Delete Hosting Resellers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <p class="text-center text-bold">
                    Are you Sure? You want to delete this Hosting Resellers.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
</form> --}}
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function() {
            var dataId = $(this).data("id");
            $('#listDeleteModal').modal('show');
            $('#id').val(dataId);
        })
    })
</script>
@endsection