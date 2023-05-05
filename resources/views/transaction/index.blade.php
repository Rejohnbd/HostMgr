@extends('layouts.master')

@section('title', 'Transactions')

@section('content')

@component('partials.breadcrumb',[
'title' => 'Transaction List',
'activePage' => 'Transactions'
])
@endcomponent

<div class="col-lg-12">
    <div class="card mb-4 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Invoices Table</h6>
        </div>

        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Domain Name</th>
                        <th>Expense</th>
                        <th>Income</th>
                        <th>Previous Balance</th>
                        <th>Present Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td> @if(isset($transaction->payment_id)){{ $transaction->findDomainNameByPaymentId($transaction->payment_id) }} @endif</td>
                        <td>{{ $transaction->expenses }}</td>
                        <td>{{ $transaction->income }}</td>
                        <td>{{ $transaction->previous_balance }}</td>
                        <td>{{ $transaction->present_balance }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Transaction Create Yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection