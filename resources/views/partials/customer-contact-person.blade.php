<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer Contact Person</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped text-gray-900 mb-0">
            <tbody>
                <tr>
                    <th scope="row">Person Name</th>
                    <td>{{ $customer->customerContactPerson->full_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Person Email</th>
                    <td>{{ $customer->customerContactPerson->contact_email }}</td>
                </tr>
                <tr>
                    <th scope="row">Person Mobile</th>
                    <td>{{ $customer->customerContactPerson->contact_mobile }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>