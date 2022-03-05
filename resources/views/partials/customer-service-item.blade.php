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
                        @foreach($service->serviceLogs as $serviceLog)
                        <span class="badge badge-primary p-2">
                            @if($serviceLog->service_type_id === 1)
                            {{ 'Domain' }}
                            @endif
                            @if($serviceLog->service_type_id === 2)
                            {{ 'Hosting' }}
                            @endif
                            @if($serviceLog->service_type_id === 3)
                            {{ 'Others' }}
                            @endif
                        </span>
                        @endforeach
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Domin Name </strong>
                        <span class="text-info">{{ $service->domain_name }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Hosting Type </strong>
                        <span class="text-info">
                            @if($service->hosting_type)
                            {{ ucfirst($service->hosting_type) }}
                            @else
                            {{ 'Not Used' }}
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Start Date</strong>
                        <span class="text-info">{{ date('d/m/Y', strtotime($service->service_start_date)) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Expire Date</strong>
                        <span class="text-info">{{ date('d/m/Y', strtotime($service->service_expire_date)) }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('services.show', $service->id) }}" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Service Details">
                <i class="fas fa-eye"></i>
            </a>
            {{-- <a href="#" class="btn btn-success btn-circle ">
                <i class="fas fa-thumbs-up"></i>
            </a>
            <a href="#" class="btn btn-danger btn-circle">
                <i class="fas fa-trash"></i>
            </a> --}}
        </div>
    </div>
</div>