@forelse($services as $service)
<tr>
    <td>
        @if($service->customer->customer_type === 'individual')
        {{ $service->customer->customer_first_name }} {{ $service->customer->customer_last_name }}
        @endif
        @if($service->customer->customer_type === 'company')
        {{ $service->customer->company_name }}
        @endif
    </td>
    <td>{{ $service->customer->user->email }}</td>
    <td>
        @foreach($service->serviceItems as $serviceItem)
        @if($serviceItem->service_type_id === 1)
        {{ ' Domain ' }}
        @endif
        @if($serviceItem->service_type_id === 2)
        {{ ' Hosting ' }}
        @endif
        @if($serviceItem->service_type_id === 3)
        {{ ' Others ' }}
        @endif
        @endforeach
    </td>
    <td>{{ $service->domain_name }} </td>
    <td class="@if(strtotime($service->service_expire_date) <= strtotime(date('Y-m-d'))) bg-danger @elseif(strtotime($service->service_expire_date) > strtotime(date('Y-m-d')))@php $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date); if($monthDifferece <= 2){echo'bg-warning';}@endphp@endif">
        {{ date('d/m/Y', strtotime($service->service_start_date)) }}
    </td>
    <td class="@if(strtotime($service->service_expire_date) <= strtotime(date('Y-m-d'))) bg-danger @elseif(strtotime($service->service_expire_date) > strtotime(date('Y-m-d')))@php $monthDifferece = calculate_month_differents(date('Y-m-d'), $service->service_expire_date); if($monthDifferece <= 2){echo'bg-warning';}@endphp@endif">
        {{ date('d/m/Y', strtotime($service->service_expire_date)) }}
    </td>
    <td>
        <button class="btn btn-sm @if($service->invoice_status)btn-success @else btn-danger @endif">@if($service->invoice_status) Ready @else Not Ready @endif</button>
        <button class="btn btn-sm @if($service->payment_status == 1) btn-success @elseif($service->payment_status == 2) btn-warning @else btn-danger @endif">@if($service->payment_status == 1) Paid @elseif($service->payment_status == 2) Partial Paid @else Not Paid @endif</button>
    </td>
    <td>
        <a href=" {{ route('services.show', $service->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Service Details">
            <i class="fas fa-search-plus"></i>
        </a>
    </td>
</tr>
@empty
<tr>
    <td class="text-center" colspan="7">No Data Found</td>
</tr>
@endforelse