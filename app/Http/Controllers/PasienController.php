<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;

class PasienController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with('pasien')->get();
        return view('pasien.dashboard', compact('periksas'));
    }
}
