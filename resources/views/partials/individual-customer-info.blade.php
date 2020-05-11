<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer Infromation</h6>
    </div>
    <div class="card-body px-0 pb-0">
        <table class="table table-striped text-gray-900 mb-0">
            <tbody>
                <tr>
                    <th scope="row">First Name</th>
                    <td>{{ $customer->customer_first_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Last Name </th>
                    <td>{{ $customer->customer_last_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>{{ $customer->user->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>{{ $customer->user->mobile }}</td>
                </tr>
                <tr>
                    <th scope="row">Customer Type </th>
                    <td>{{ ucfirst($customer->customer_type) }}</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>{{ ucfirst($customer->customer_gender) }}</td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>{{ $customer->customer_address }}</td>
                </tr>
                <tr>
                    <th scope="row">Join Date</th>
                    <td>{{ $customer->customer_join_date }}</td>
                </tr>
                <tr>
                    <th scope="row">Join Year</th>
                    <td>{{ $customer->customer_join_year }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="#" class="btn btn-info btn-circle">
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