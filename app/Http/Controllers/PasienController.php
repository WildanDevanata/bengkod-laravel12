<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function dashboard()
    {
        return view('pasien.dashboard');
    }

    public function periksa()
    {
        // Option 1: Hardcoded doctors for now
        $dokters = [
            ['id' => 1, 'nama' => 'Dr. Arif Setiawan'],
            ['id' => 2, 'nama' => 'Dr. Dewi Sartika'],
            ['id' => 3, 'nama' => 'Dr. Budi Santoso']
        ];
        
        // Convert array to collection for consistency
        $dokters = collect($dokters);
        
        return view('pasien.periksa', compact('dokters'));
    }

    public function storePeriksa(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_dokter' => 'required',
            'catatan' => 'nullable|string'
        ]);

        // Create new periksa record
        $periksa = new Periksa();
        
        // Get the current user ID if logged in, otherwise find/create a user based on name
        if (Auth::check()) {
            $periksa->id_pasien = Auth::id();
        } else {
            // Find or create a user with the given name
            $user = User::firstOrCreate(
                ['nama' => $request->nama],
                [
                    'email' => strtolower(str_replace(' ', '', $request->nama)) . '@example.com',
                    'no_hp' => $request->no_hp,
                    'password' => bcrypt('password123') // Set a default password
                ]
            );
            $periksa->id_pasien = $user->id;
        }
        
        $periksa->id_dokter = $request->id_dokter;
        $periksa->tgl_periksa = now();
        $periksa->catatan = $request->catatan;
        $periksa->biaya_periksa = 150000; // Default price
        $periksa->save();

        return redirect()->route('pasien.riwayat')->with('success', 'Permintaan pemeriksaan berhasil dikirim');
    }

    public function riwayat()
    {
        // If user is logged in, show only their records
        if (Auth::check()) {
            $periksas = Periksa::with('pasien')
                ->where('id_pasien', Auth::id())
                ->orderBy('tgl_periksa', 'desc')
                ->get();
        } else {
            // Otherwise show all records (for testing purposes)
            $periksas = Periksa::with('pasien')
                ->orderBy('tgl_periksa', 'desc')
                ->get();
        }
        
        return view('pasien.riwayat', compact('periksas'));
    }

    public function editPeriksa($id)
    {
        $periksa = Periksa::with('pasien')->findOrFail($id);
        
        // Check if the user is authorized to edit this record
        if (Auth::check() && Auth::id() !== $periksa->id_pasien) {
            return redirect()->route('pasien.riwayat')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit data ini');
        }
        
        // Same doctor data as in periksa method
        $dokters = [
            ['id' => 1, 'nama' => 'Dr. Arif Setiawan'],
            ['id' => 2, 'nama' => 'Dr. Dewi Sartika'],
            ['id' => 3, 'nama' => 'Dr. Budi Santoso']
        ];
        
        $dokters = collect($dokters);
        
        // Change from 'pasien.edit-periksa' to 'pasien.edit' to match your views directory structure
        return view('pasien.edit', compact('periksa', 'dokters'));
    }

    public function updatePeriksa(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_dokter' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $periksa = Periksa::findOrFail($id);
        
        // Check if the user is authorized to update this record
        if (Auth::check() && Auth::id() !== $periksa->id_pasien) {
            return redirect()->route('pasien.riwayat')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit data ini');
        }
        
        // Update user data if changed
        $user = User::findOrFail($periksa->id_pasien);
        $user->nama = $request->nama;
        $user->no_hp = $request->no_hp;
        $user->save();
        
        // Update periksa data
        $periksa->id_dokter = $request->id_dokter;
        $periksa->catatan = $request->catatan;
        $periksa->save();

        return redirect()->route('pasien.riwayat')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    public function deletePeriksa($id)
    {
        $periksa = Periksa::findOrFail($id);
        
        // Check if the user is authorized to delete this record
        if (Auth::check() && Auth::id() !== $periksa->id_pasien) {
            return redirect()->route('pasien.riwayat')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus data ini');
        }
        
        $periksa->delete();
        
        return redirect()->route('pasien.riwayat')
            ->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}