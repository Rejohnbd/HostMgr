<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $title }}</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $value }}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                        <a href="{{ $viewLink }}"><span>{{ $viewText }}</span></a>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="{{ $icon }} fa-2x {{ $iconColor }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>