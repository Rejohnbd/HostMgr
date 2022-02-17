<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DomainReseller;
use App\Models\HostingPackage;
use App\Models\HostingReseller;
use App\Models\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Service::
        $todayDate = Carbon::today()->toDateString();
        $nextSencodMonthDate = Carbon::today()->addMonth(2)->toDateString();
        // $expireSoonServices =  Service::whereBetween('service_expire_date', [$today, $nextSencodMonth])->count();
        // dd($today, $nextSencodMonth, $expireSoonServices);
        return view('dashboards.index')
            ->with('admins', User::where('type', 'admin')->count())
            ->with('executives', User::where('type', 'executive')->count())
            ->with('customerRegistered', User::where('type', 'customer')->count())
            ->with('customers', Customer::count())
            ->with('services', Service::count())
            ->with('hostingPackages', HostingPackage::count())
            ->with('domainResellers', DomainReseller::count())
            ->with('hostingResellers', HostingReseller::count())
            ->with('expireSoonServices', Service::whereBetween('service_expire_date', [$todayDate, $nextSencodMonthDate])->count());
    }
}
