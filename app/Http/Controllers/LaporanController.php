<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use App\Models\Ulasan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    function index(Request $request) {
        if ($request->ajax()) {
            $sessionnya = session()->get('users');
            if ($sessionnya['level']=='taruni') {
                $data = Pengajuan::where('user_id', $sessionnya->id)->where('status', 'approved')->orWhere('status', 'arrived')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="'.route('laporan.unduh', $row->id).'" class="edit btn btn-info btn-sm">Unduh</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                $data = Pengajuan::where('status', 'approved')->orWhere('status', 'arrived')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="'.route('laporan.unduh', $row->id).'" class="edit btn btn-info btn-sm">Unduh</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }

        return view('pages.laporan.index', []);
    }

    public function download($id=null) {

        $dataPengajuan = Pengajuan::select('pengajuan.*', 'users.nama', 'users.email', 'users.alamat', 'users.nama', 'users.no_identitas', 'users.no_telp', 'users.level', 'taruni.nim', 'taruni.angkatan', 'kamar.nama_kamar')->leftJoin('users', 'pengajuan.user_id', '=', 'users.id')->leftJoin('taruni', 'users.id', '=', 'taruni.user_id')->leftJoin('kamar', 'kamar.id', '=', 'taruni.kamar_id')->where('pengajuan.id',  $id)->orderBy('pengajuan.created_at', 'desc')->first();
        $dataDetailPengajuan = DetailPengajuan::leftJoin('barang', 'detail_pengajuan.barang_id', '=', 'barang.id')->where('detail_pengajuan.pengajuan_id', $id)->get();

        $dataAssign = User::where('id', $dataPengajuan->assign_by)->first();

        $dataUlasan = Ulasan::where('pengajuan_id', $id)->get();

        $pdf = Pdf::loadView('pages.laporan.pdf',  [
            'dataPengajuan' => $dataPengajuan,
            'detailPengajuan' => $dataDetailPengajuan,
            'dataAssign' => $dataAssign,
            'dataUlasan' => $dataUlasan
        ]);

        return $pdf->download();
    }
}
