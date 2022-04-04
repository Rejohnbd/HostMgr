<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

if (!function_exists('calculate_month_differents')) {
    /**
     * Parameter format must be YYYY-mm-dd
     * return number of different month
     */
    function calculate_month_differents($fromDate, $toDate)
    {
        // dd($fromDate, $toDate);
        $from_date_str = strtotime($fromDate);
        $to_date_str = strtotime($toDate);

        $from_date_year = date('Y', $from_date_str);
        $to_date_year = date('Y', $to_date_str);

        $from_date_month = date('m', $from_date_str);
        $to_date_month = date('m', $to_date_str);

        $diff = (($to_date_year - $from_date_year) * 12) + ($to_date_month - $from_date_month);
        return $diff;
    }
}

if (!function_exists('check_current_balance')) {
    function check_current_balance()
    {
        $presentBlance = Transaction::select('present_balance')->orderBy('id', 'DESC')->first();
        if (is_null($presentBlance)) :
            $initialBalance = DB::table('initial_balance')->where('id', 1)->select('initial_balance')->first();
            return $initialBalance->initial_balance;
        else :
            return $presentBlance->present_balance;
        endif;
    }
}
