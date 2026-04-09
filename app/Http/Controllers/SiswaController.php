<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Dashboard siswa - menampilkan semua aspirasi milik user yang login.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $aspirasis = Aspirasi::with('kategori')
            ->where('id_user', $user->id)
            ->latest()
            ->get();

        $total    = $aspirasis->count();
        $menunggu = $aspirasis->where('status', 'menunggu')->count();
        $proses   = $aspirasis->where('status', 'proses')->count();
        $selesai  = $aspirasis->where('status', 'selesai')->count();

        return view('Siswa.Dashboard-siswa', compact(
            'aspirasis', 'total', 'menunggu', 'proses', 'selesai'
        ));
    }

    /**
     * Tampilkan form pengajuan aspirasi.
     */
    public function createPengaduan()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('Siswa.Form-Pengajuan', compact('kategoris'));
    }

    /**
     * Simpan aspirasi baru ke database.
     */
    public function storePengaduan(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id',
            'lokasi'      => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aspirasi', 'public');
        }

        Aspirasi::create([
            'id_user'     => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'deskripsi'   => $request->deskripsi,
            'status'      => 'menunggu',
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('dashboard-siswa')->with('success', 'Pengaduan berhasil dikirim!');
    }

    /**
     * Detail aspirasi milik siswa yang sedang login.
     */
    public function showPengaduan($id)
    {
        $aspirasi = Aspirasi::with(['kategori', 'umpanBaliks.user'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('Siswa.Detail-laporan-siswa', compact('aspirasi'));
    }
}
