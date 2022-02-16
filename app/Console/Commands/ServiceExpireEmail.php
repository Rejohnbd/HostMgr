<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Notifications\EmailNearestExpireDateServices;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ServiceExpireEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:expire-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service Expire Date Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $services = Service::all();

        foreach ($services as $service) :
            $expireDate = Carbon::createFromFormat('Y-m-d', $service->service_expire_date);
            $todayData = Carbon::createFromFormat('Y-m-d', date('Y-m-d', time()));

            if ($expireDate->diffInMonths($todayData) === 0) {
                $user = User::where('id', '=', $service->user_id)->first();
                $user->notify(new EmailNearestExpireDateServices);
            }
        endforeach;
    }
}
