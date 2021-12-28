<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function getMonthlyReport()
    {
        $data = DB::table('monthly_report')->get();
        return $data;
    }

    public function getAvgSupplies()
    {
        $data = DB::table('avg_supplies_per_supplier')->get();
        return $data;
    }
}
