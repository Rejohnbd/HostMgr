<div class="col-md-4 col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <a href="#collapseService-{{ $loop->iteration }}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseHostingPackage-1">
            <h6 class="m-0 font-weight-bold text-primary">Service {{ $loop->iteration }}</h6>
        </a>
        <div class="collapse show" id="collapseService-{{ $loop->iteration }}">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Service For </strong>
                        <span class="text-info">
                            @if($service->service_for === 1)
                            {{ 'Domain Hosting Both' }}
                            @elseif($service->service_for === 2)
                            {{ 'Only Hosting' }}
                            @else
                            {{ 'Only Domain' }}
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Domin Name </strong>
                        <span class="text-info">{{ $service->domain_name }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Hosting Tye </strong>
                        <span class="text-info">
                            @if($service->hosting_type)
                            {{ $service->hosting_type }}
                            @else
                            {{ 'Service Not Used' }}
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Start Date</strong>
                        <span class="text-info">{{ $service->service_start_date }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Expire Date</strong>
                        <span class="text-info">{{ $service->service_expire_date }}</span>
                    </li>
                </ul>
            </div>
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
</div>