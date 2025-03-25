<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\Obat;


class DokterController extends Controller
{
    public function dashboard()
    {
        return view('dokter.dashboard');
    }


    public function periksa()
    {
        $periksas = Periksa::with('pasien')->get();
        return view('dokter.periksa', compact('periksas'));
    }
    public function obat(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_obat' => 'required',
                'kemasan' => 'required',
                'harga' => 'required|numeric',
            ]);

            Obat::create([
                'nama_obat' => $request->nama_obat,
                'kemasan' => $request->kemasan,
                'harga' => $request->harga,
            ]);

            return redirect()->route('dokter.obat')->with('success', 'Obat berhasil ditambahkan!');
        }

        $obats = Obat::all();
        return view('dokter.obat', compact('obats'));
    }

    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.edit-obat', compact('obat'));
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|numeric',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat')->with('success', 'Obat berhasil diperbarui!');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat')->with('success', 'Obat berhasil dihapus!');
    }
}
