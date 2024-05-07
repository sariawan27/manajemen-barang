<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = [];
        $sessionnya = session()->get('users');
        if ($sessionnya['level']=='taruni') {
            for ($i=1; $i <= 12; $i++) {
                $data = Pengajuan::where('user_id', $sessionnya->id)->whereMonth('created_at', $i)->count();
                array_push($arr, $data);
            }
        } else {
            for ($i=1; $i <= 12; $i++) {
                $data = Pengajuan::whereMonth('created_at', $i)->count();
                array_push($arr, $data);
            }
        }
        return view("pages.dashboard.index", [
            "pengajuanGraf" => json_encode($arr)
        ]);
    }
}
