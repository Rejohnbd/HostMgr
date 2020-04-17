<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DomainReseller;
use App\Models\HostingPackage;
use App\Models\HostingReseller;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboards.index')
            ->with('admins', User::where('type', 'admin')->count())
            ->with('executives', User::where('type', 'executive')->count())
            ->with('customerRegistered', User::where('type', 'customer')->count())
            ->with('customers', Customer::count())
            ->with('services', Service::count())
            ->with('hostingPackages', HostingPackage::count())
            ->with('domainResellers', DomainReseller::count())
            ->with('hostingResellers', HostingReseller::count());
    }
}
