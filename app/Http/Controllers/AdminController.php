<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\UmpanBalik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard (Request $request)
    {
        $query = Aspirasi::with(['user', 'kategori'])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($qu) use ($search) {
                      $qu->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $aspirasis  = $query->get();
        $kategoris  = Kategori::orderBy('nama_kategori')->get();

        $total    = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'menunggu')->count();
        $proses   = Aspirasi::where('status', 'proses')->count();
        $selesai  = Aspirasi::where('status', 'selesai')->count();

        return view('admin.Dashboard-admin', compact(
            'aspirasis', 'kategoris', 'total', 'menunggu', 'proses', 'selesai'
        ));
    }

     public function show($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori', 'umpanBaliks.user'])->findOrFail($id);
        return view('admin.Feedback-form', compact('aspirasi'));
    }

    public function update(Request $request, $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        $request->validate([
            'status'    => 'required|in:menunggu,proses,selesai',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        // Update status aspirasi
        $aspirasi->update(['status' => $request->status]);

        // Simpan umpan balik jika ada keterangan
        if ($request->filled('keterangan')) {
            UmpanBalik::create([
                'id_aspirasi' => $aspirasi->id,
                'id_user'     => Auth::id(),
                'keterangan'  => $request->keterangan,
            ]);
        }
         return redirect()->route('admin.aspirasi.show', $id)
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }
}
