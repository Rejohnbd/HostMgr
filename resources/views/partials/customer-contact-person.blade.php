@foreach($customer->customerContactPersons as $contactPerson)
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer Contact Person {{ $loop->iteration }}</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped text-gray-900 mb-0">
            <tbody>
                <tr>
                    <th scope="row">Contact Person Name</th>
                    <td>{{ $contactPerson->full_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Contact Person Email</th>
                    <td>{{ $contactPerson->contact_email }}</td>
                </tr>
                <tr>
                    <th scope="row">Contact Person Mobile</th>
                    <td>{{ $contactPerson->contact_mobile }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endforeach