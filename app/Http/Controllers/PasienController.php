<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index()
    {
        // Mengambil data pengguna yang login
        $pasien = Auth::user();
        return view('pasien.dashboard', ['namaPasien' => $pasien->nama]);
    }

    public function dashboard()
{
    $user = Auth::user();

    // Ambil jumlah riwayat periksa dari pasien yang login
    $jumlahPeriksa = Periksa::where('id_pasien', $user->id)->count();

    return view('pasien.dashboard', [
        'namaPasien' => $user->nama,
        'jumlahPeriksa' => $jumlahPeriksa
    ]);
}


    public function periksa()
    {
        // Mendapatkan data dokter yang tersedia
        $dokters = User::where('role', 'dokter')->get();
        // Mengambil data pengguna yang login
        $user = Auth::user();
        $namaPasien = $user->nama;

        // Menampilkan halaman form pemeriksaan
        return view('pasien.periksa', compact('dokters', 'user', 'namaPasien'));
    }

    public function storePeriksa(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_dokter' => 'required|integer|exists:users,id',
            'catatan' => 'nullable|string',
            'tgl_periksa' => 'required|date', // Validasi untuk tanggal periksa
        ]);

        // Mengambil data pasien yang login
        $user = Auth::user();

        // Biaya pemeriksaan berdasarkan dokter
        $dokterBiaya = [
            1 => 200000,
            2 => 180000,
            3 => 150000,
        ];

        // Menyimpan data pemeriksaan ke dalam database
        $periksa = Periksa::create([
            'id_pasien' => $user->id,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => Carbon::parse($request->tgl_periksa), // Menyimpan tanggal pemeriksaan
            'catatan' => $request->catatan,
            'biaya_periksa' => $dokterBiaya[$request->id_dokter] ?? 150000,
        ]);

        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('pasien.riwayat')->with('success', 'Permintaan pemeriksaan berhasil dikirim');
    }

    public function riwayat()
    {
        // Mengambil data pasien yang login
        $user = Auth::user();

        // Mengambil data pemeriksaan yang terkait dengan pasien yang login
        $periksas = Periksa::with(['pasien', 'dokter'])
            ->where('id_pasien', $user->id)
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        // Menformat tanggal periksa dengan Carbon
        foreach ($periksas as $periksa) {
            // Pastikan tgl_periksa adalah objek Carbon
            $periksa->tgl_periksa = Carbon::parse($periksa->tgl_periksa)->format('d-m-Y');
        }

        // Menampilkan riwayat pemeriksaan pasien
        return view('pasien.riwayat', [
            'periksas' => $periksas,
            'namaPasien' => $user->nama
        ]);
    }

    public function editPeriksa($id)
    {
        // Mengambil data pemeriksaan berdasarkan ID
        $periksa = Periksa::with('pasien')->findOrFail($id);

        // Mengecek apakah pasien yang login adalah pemilik pemeriksaan ini
        if (Auth::id() !== $periksa->id_pasien) {
            return redirect()->route('pasien.riwayat')->with('error', 'Anda tidak memiliki izin untuk mengedit data ini');
        }

        // Mengambil data dokter yang tersedia
        $dokters = User::where('role', 'dokter')->get();
        $namaPasien = Auth::user()->nama;

        // Menampilkan form edit pemeriksaan
        return view('pasien.edit', compact('periksa', 'dokters', 'namaPasien'));
    }

    public function updatePeriksa(Request $request, $id)
{
    // Validasi input form
    $request->validate([
        'nama' => 'required|string|max:255',
        'id_dokter' => 'required|integer|exists:users,id',
        'catatan' => 'nullable|string',
        'tgl_periksa' => 'required|date',
    ]);

    // Ambil data periksa berdasarkan ID
    $periksa = Periksa::findOrFail($id);

    // Cek apakah pasien yang login adalah pemilik data
    if (Auth::id() !== $periksa->id_pasien) {
        return redirect()->route('pasien.riwayat')->with('error', 'Anda tidak memiliki izin untuk mengedit data ini');
    }

    // Update nama pasien (di model User)
    $pasien = $periksa->pasien;
    $pasien->nama = $request->nama;
    $pasien->save();

    // Update data pemeriksaan
    $periksa->id_dokter = $request->id_dokter;
    $periksa->catatan = $request->catatan;
    $periksa->tgl_periksa = \Carbon\Carbon::parse($request->tgl_periksa);
    $periksa->save();

    return redirect()->route('pasien.riwayat')->with('success', 'Data pemeriksaan berhasil diperbarui');
}


    public function deletePeriksa($id)
    {
        // Mengambil data pemeriksaan berdasarkan ID
        $periksa = Periksa::findOrFail($id);

        // Mengecek apakah pasien yang login adalah pemilik pemeriksaan ini
        if (Auth::id() !== $periksa->id_pasien) {
            return redirect()->route('pasien.riwayat')->with('error', 'Anda tidak memiliki izin untuk menghapus data ini');
        }

        // Menghapus data pemeriksaan
        $periksa->delete();

        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('pasien.riwayat')->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}
