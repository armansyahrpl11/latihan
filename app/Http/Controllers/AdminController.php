<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;

use Barryvdh\DomPDF\Facade as PDF;

// use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tanggapan;

class AdminController extends Controller
{
    public function __invoke()
    {

    }

    public function index($id) {

        $item = Pengaduan::with([
            'details', 'user'
        ])->findOrFail($id);

        return view('pages.admin.pengaduan.detail',[
        'item' => $item
        ]);
    }

    public function masyarakat() {

        $data = DB::table('users')->where('roles','=', 'USER')->get();

        return view('pages.admin.masyarakat', [
            'data' => $data
        ]);
    }

    public function laporan(Request $request) {

        $pengaduan = Pengaduan::all();
        return view('pages.admin.laporan',[
            'pengaduan' => $pengaduan,

        ]);
    }

    public function cetak() {

        $pengaduan = Pengaduan::all();

        $pdf = PDF::loadview('pages.admin.pengaduan',[
            'pengaduan' => $pengaduan
        ]);
        return $pdf->download('laporan.pdf');
    }

    public function getLaporan(Request $request, )
    {
        // dd($request);

        $from = $request->from . ' ' ;
        $to = $request->to . ' ' ;

        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();
        // dd($pengaduan);

        $nik = User::get();
        $data = Pengaduan::all();

        return view('pages.admin.laporan', [
            'pengaduan' => $pengaduan,
            'from' => $from,
            'to' => $to,
            'data'    => $data,
            'nik'    => $nik

        ]);
    }
    public function cetakLaporan($from, $to)
    {
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();
        $penga = Tanggapan::all();


        $pdf = PDF::loadView('pages.admin.pengaduan.cetak', [
            'pengaduan' => $pengaduan,
            'penga' => $penga,

            ])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-pengaduan.pdf');
    }

    public function pdf($id) {

        $pengaduan = Pengaduan::find($id);

        $pdf = PDF::loadview('pages.admin.pengaduan.cetak', compact('pengaduan'))->setPaper('a4');
        return $pdf->download('laporan-pengaduan.pdf');
    }
}
