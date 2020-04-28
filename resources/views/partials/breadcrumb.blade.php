<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
        @if(isset($itemOne) && isset($itemOneUrl))
        <li class="breadcrumb-item"><a href="{{ route($itemOneUrl) }}">{{ $itemOne }}</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $activePage }}</li>
    </ol>
</div>