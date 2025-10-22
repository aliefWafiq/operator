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
}
