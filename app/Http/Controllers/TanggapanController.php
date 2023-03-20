<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('pengaduan')->where('id', $request->pengaduan_id)->update([
            'status'=> $request->status,
            'tanggapan'=> $request->tanggapan,
        ]);

        $petugas_id = Auth::user()->id;

        $data = $request->all();

        $data['pengaduan_id'] = $request->pengaduan_id;
        $data['petugas_id']=$petugas_id;

        Alert::success('Berhasil', 'Pengaduan berhasil ditanggapi');
        Tanggapan::create($data);
        return redirect('admin/pengaduans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = Pengaduan::with([
        //     'details', 'user'
        // ])->findOrFail($id);

        $item =Pengaduan::all()->findOrFail($id);

        return view('pages.admin.tanggapan.add',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'tanggapan' => 'required',
        ]);
        // dd($request);


        $menu= Pengaduan::findOrFail($id);

        // dd($menu);

        $petugas_id = Auth::user()->id;


        // dd($menu);

        $tanggapan = Tanggapan::where('pengaduan_id', $id)->first();

        if ($tanggapan) {
            $data = $tanggapan->update([
                    'tanggapan' => $request->tanggapan,
                    'pengaduan_id'  =>$id,
                    'petugas_id'  =>$petugas_id,

                ]);
        }else{
            $data = Tanggapan::create([
                    'tanggapan' => $request->tanggapan,
                    'pengaduan_id'  =>$id,
                    'petugas_id'  =>$petugas_id,

                ]);
        }


        // Tanggapan::updateOrInsert([
        //     'tanggapan' => $request->tanggapan,
        //     'pengaduan_id'  =>$id,
        //     'petugas_id'  =>$petugas_id,

        // ]);

        $menu->update([
            'status'=> $request->status,
        ]);

        Alert::success('Berhasil', 'Pengaduan berhasil ditanggapi');
        return redirect('admin/pengaduans');



        // DB::table('pengaduan')->where('id', $request->pengaduan_id)->update([
        //     'status'=> $request->status,
        // ]);

        // $petugas_id = Auth::user()->id;

        // $data = $request->all();
        // dd($data);
        // $data['pengaduan_id'] = $request->pengaduan_id;
        // $data['petugas_id']=$petugas_id;

        // Alert::success('Berhasil', 'Pengaduan berhasil ditanggapi');
        // Tanggapan::create($data);
        // return redirect('admin/pengaduans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
