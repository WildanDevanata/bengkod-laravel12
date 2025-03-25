<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;

class PasienController extends Controller
{
    public function dashboard()
    {
        return view('pasien.dashboard');
    }

    public function periksa()
    {
        return view('pasien.periksa');
    }

    public function riwayat()
    {
        $periksas = Periksa::with('pasien')->get();
        return view('pasien.riwayat', compact('periksas'));
    }
}
