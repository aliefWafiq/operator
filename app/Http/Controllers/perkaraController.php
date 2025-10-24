<?php

namespace App\Http\Controllers;

use App\Models\perkara;
use Illuminate\Http\Request;

class perkaraController extends Controller
{
    public function tambahPerkara()
    {
        return view('createPerkara');
    }

    public function listPerkara()
    {
        $data = perkara::latest()->get();
        return view('listPerkara', compact('data'));
    }

    public function createperkara(Request $request)
    {
        $validatedData = $request->validate([
            'namaPihak' => 'required',
            'tanggal_sidang' => 'required',
            'noPerkara' => 'required',
            'jenisPerkara' => 'required',
            'sidang_Keliling' => 'required',
            'ruangan_sidang' => 'required',
            'agenda' => 'required',
        ]);

        perkara::create($validatedData);

        return redirect('/listPerkara');
    }
}
