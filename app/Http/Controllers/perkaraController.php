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
        $data = perkara::get();
        return view('listPerkara', compact('data'));
    }

    public function createperkara(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'namaPihak' => 'required',
                'tampilkan_nama' => 'required',
                'tanggal_sidang' => 'required',
                'noPerkara' => 'required',
                'jenisPerkara' => 'required',
                'sidang_Keliling' => 'required',
                'ruangan_sidang' => 'required',
                'agenda' => 'required',
            ]);

            perkara::create($validatedData);

            return redirect('/listPerkara');
        } catch (\Throwable $th) {
            return redirect('/tambahPerkara')->with('error', 'Terjadi kesalahan saat menambahkan perkara, Silakan coba lagi.');
        }
    }

    public function editPerkara($id_perkara){
        $perkara = perkara::where('id', $id_perkara)->first();

        return view('formEditPerkara', compact('perkara'));
    }

    public function deletePerkara($id_perkara){
        $perkara = perkara::where('id', $id_perkara)->delete();

        return redirect('/listPerkara');
    }

    public function updatePerkara(Request $request, $id_perkara){
        $request->validate([
            'namaPihak' => 'required',
            'tampilkan_nama' => 'required',
            'tanggal_sidang' => 'required',
            'noPerkara' => 'required',
            'jenisPerkara' => 'required',
            'sidang_Keliling' => 'required',
            'ruangan_sidang' => 'required',
            'agenda' => 'required',
        ]);
        
        $perkara = perkara::where('id', $id_perkara)->first();

        $perkara->update($request->all());

        return redirect('/listPerkara');
    }
}
