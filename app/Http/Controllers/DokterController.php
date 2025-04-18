<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = User::where('id', Auth::user()->id)->first();
        $namaDokter = $dokter->nama;

        // Hitung jumlah pasien yang perlu diperiksa oleh dokter ini
        $jumlahPasienPeriksa = Periksa::where('id_dokter', Auth::id())->count();

        // Hitung jumlah obat yang tersedia
        $jumlahObat = Obat::count();

        return view('dokter.dashboard', compact('namaDokter', 'jumlahPasienPeriksa', 'jumlahObat'));
    }

    public function periksa()
{
    $dokter = User::where('id', Auth::user()->id)->first();
    $namaDokter = $dokter->nama;

    // Load periksa data with all necessary relationships
    $periksas = Periksa::with(['pasien', 'detailPeriksas.obat'])
        ->where('id_dokter', Auth::id())
        ->orderBy('tgl_periksa', 'desc')
        ->get();

    return view('dokter.periksa', compact('periksas', 'namaDokter'));
}

public function editPeriksa($id)
{
    $dokter = User::where('id', Auth::user()->id)->first();
    $namaDokter = $dokter->nama;
    
    // Load periksa data with all necessary relationships
    $periksa = Periksa::with(['pasien', 'detailPeriksas.obat'])->findOrFail($id);
    $obats = Obat::all();

    return view('dokter.edit', compact('periksa', 'namaDokter', 'obats'));
}

public function updatePeriksa(Request $request, $id)
{
    $request->validate([
        'catatan' => 'required',
        'biaya_periksa' => 'required|numeric',
        'id_obat' => 'nullable|exists:obats,id',
    ]);

    $periksa = Periksa::findOrFail($id);
    
    // Update the periksa record (without id_obat)
    $periksa->update([
        'catatan' => $request->catatan,
        'biaya_periksa' => $request->biaya_periksa,
    ]);

    // Handle the obat relationship through DetailPeriksa
    if ($request->id_obat) {
        // Check if a DetailPeriksa record already exists
        $detailPeriksa = $periksa->detailPeriksas()->first();
        
        if ($detailPeriksa) {
            // Update existing record
            $detailPeriksa->update(['id_obat' => $request->id_obat]);
        } else {
            // Create new record
            $periksa->detailPeriksas()->create(['id_obat' => $request->id_obat]);
        }
    }

    return redirect()->route('dokter.periksa')->with('success', 'Data periksa berhasil diperbarui.');
}


    public function deletePeriksa($id)
    {
        $periksa = Periksa::findOrFail($id);
        $periksa->delete();

        return redirect()->route('dokter.periksa')->with('success', 'Data periksa berhasil dihapus!');
    }

    public function obat(Request $request)
    {
        $namaDokter = Auth::user()->nama;

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
        return view('dokter.obat', compact('obats', 'namaDokter'));
    }

    public function editObat($id)
    {
        $namaDokter = Auth::user()->nama;
        $obat = Obat::findOrFail($id);

        return view('dokter.edit-obat', compact('obat', 'namaDokter'));
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
