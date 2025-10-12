<?php

namespace App\Http\Controllers;

use App\Models\pengajuanJamSidangs;
use App\Models\antreans;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class pengajuan_jam_sidangController extends Controller
{
    public function pengajuanJamSidang()
    {
        $data = pengajuanJamSidangs::latest()->get();
        return view('pengajuanJamSidang', compact('data'));
    }

    public function terimaPengajuanJam(pengajuanJamSidangs $pengajuanJamSidangs)
    {
        DB::transaction(function () use ($pengajuanJamSidangs) {
            $pengajuanJamSidangs->update([
                'status' => 'diterima'
            ]);
            
            $antrean = antreans::findOrFail($pengajuanJamSidangs->id_user);

            $antrean->update([
                'jam_perkiraan' => $pengajuanJamSidangs->jam_sidang
            ]);
        });

        return redirect('/pengajuanSidang');   
    }

    public function tolakPengajuanJam(pengajuanJamSidangs $pengajuanJamSidangs)
    {
        $pengajuanJamSidangs->update([
            'status' => 'ditolak'
        ]);

        return redirect('/pengajuanSidang');
    }
}
