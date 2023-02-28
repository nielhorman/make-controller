<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use App\Models\tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class petugasController extends Controller
{
    public function index()
    {
        $data=DB::table('pengaduans')
            ->leftJoin('users','users.id','=','pengaduans.id_masyarakat')
            ->select('pengaduans.*','users.nik','users.nama')
            ->latest()
            ->get();
        return Inertia::render('petugas/home',[
            'datas'=>$data
        ]);
    }
    public function tanggapanProses(Request $request){
        $sekarang=Carbon::now()->format('Y-m-d');
        if($request->id_pengaduan){
            $update=pengaduan::find($request->id_pengaduan);
            $update->update([
                'status'=> 'proses'
            ]);
        }
        tanggapan::create([
            'id_pengaduan'=>$request->id_pengaduan,
            'tanggapan'=>$request->tanggapan,
            'id_petugas'=>Auth()->user()->id,
            'tgl_tanggapan'=>$sekarang
        ]);
        return redirect()->back();
    }
    public function tanggapanSelesai(Request $request)
    {
            if($request->id_pengaduan){
                $update=pengaduan::find($request->id_pengaduan);
                $update->update([
                    'status'=> 'selesai'
                ]);
        }
        $data=tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();
        if($data->id){
            $data=tanggapan::find($data->id);
            $data->update([
                'tanggapan' => $request->tanggapan
            ]);
        }
    }
}
