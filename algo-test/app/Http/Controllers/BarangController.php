<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function getMonthlyReport()
    {
        $data = DB::table('monthly_report')->get();
        return $data;
    }

    public function addSupplies(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'barang_id' => 'required',
            'user_id' => 'required',
            'jumlah' => 'required'
        ]);

        if ($validation->fails()) {
            return Response($validation->errors(), 400);
        }

        $supplier = Pengguna::find($request['user_id']);

        if ($supplier['role'] != 'supplier') {
            return Response('User is not a supplier. Forbidden Access', 403);
        }

        $transaksi = Status::create($request->all());
        return Response($transaksi, 200);
    }

    public function distributeSupplies(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'barang_id' => 'required',
            'user_id' => 'required',
            'jumlah' => 'required'
        ]);

        if ($validation->fails()) {
            return Response($validation->errors(), 400);
        }

        $supplier = Pengguna::find($request['user_id']);

        if ($supplier['role'] != 'distributor') {
            return Response('User is not a distributor. Forbidden Access', 403);
        }

        $transaksi = Status::create($request->all());
        return Response($transaksi, 200);
    }

    public function getAvgSupplies()
    {
        $data = DB::table('avg_supplies_per_supplier')->get();
        return $data;
    }
}
