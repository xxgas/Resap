@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto p-6">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition mb-6 group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        <span class="text-sm font-medium">Kembali ke Dashboard</span>
    </a>

    {{-- Flash success --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-5 py-3 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Detail Aspirasi --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-blue-600 p-6 text-white">
                    <h2 class="text-xl font-bold">Detail Pengaduan</h2>
                    <p class="text-blue-100 text-xs mt-1">ID Pengaduan: #{{ $aspirasi->id }}</p>
                </div>

                <div class="p-8 space-y-8">
                    {{-- Info Pelapor --}}
                    <div class="bg-blue-50/50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-center gap-2 text-blue-600 mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <h3 class="font-bold text-sm uppercase tracking-wide">Informasi Pelapor</h3>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Nama</p>
                                <p class="font-bold text-gray-800">{{ $aspirasi->user->nama ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">NIS/NIP</p>
                                <p class="font-bold text-gray-800">{{ $aspirasi->user->nip_nis ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Kelas</p>
                                <p class="font-bold text-gray-800">{{ $aspirasi->user->kelas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kategori & Lokasi --}}
                    <div class="grid grid-cols-2 gap-8">
                        <div class="flex gap-4">
                            <div class="text-gray-400 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Kategori</p>
                                <p class="font-bold text-gray-800 text-lg">{{ $aspirasi->kategori->nama_kategori ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-gray-400 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Lokasi</p>
                                <p class="font-bold text-gray-800 text-lg">{{ $aspirasi->lokasi }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex gap-4">
                        <div class="text-gray-400 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-400 mb-1">Deskripsi Masalah</p>
                            <p class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl">{{ $aspirasi->deskripsi }}</p>
                        </div>
                    </div>

                    {{-- Foto --}}
                    @if($aspirasi->foto)
                        <div>
                            <p class="text-xs text-gray-400 mb-2">Foto Bukti</p>
                            <img src="{{ asset('storage/' . $aspirasi->foto) }}" alt="Foto Pengaduan" class="rounded-xl max-h-64 object-cover border border-gray-100">
                        </div>
                    @endif

                    <hr class="border-gray-100">

                    {{-- Tanggal --}}
                    <div class="grid grid-cols-2 gap-8">
                        <div class="flex gap-4">
                            <div class="text-gray-400 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Tanggal Dibuat</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $aspirasi->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-gray-400 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Terakhir Diupdate</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $aspirasi->updated_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Umpan Balik --}}
            @if($aspirasi->umpanBaliks->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Riwayat Umpan Balik</h3>
                    <div class="space-y-4">
                        @foreach($aspirasi->umpanBaliks as $fb)
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-700">"{{ $fb->keterangan }}"</p>
                                <p class="text-xs text-gray-400 mt-2">— {{ $fb->user->nama ?? 'Admin' }}, {{ $fb->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Form Update Status + Feedback --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Update Pengaduan</h3>
                
                <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-500 mb-2 ml-1">Status Pengaduan</label>
                        <select id="status" name="status" 
                            class="w-full appearance-none bg-gray-50 border border-blue-400 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all cursor-pointer shadow-sm">
                            <option value="menunggu" {{ $aspirasi->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ $aspirasi->status === 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $aspirasi->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <div class="mt-2">
                            @if($aspirasi->status === 'menunggu')
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Menunggu</span>
                            @elseif($aspirasi->status === 'proses')
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Diproses</span>
                            @else
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Selesai</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="keterangan" class="block text-xs font-semibold text-gray-500 mb-2 ml-1">Umpan Balik untuk Siswa</label>
                        <textarea id="keterangan" name="keterangan" rows="5" 
                            placeholder="Berikan umpan balik atau informasi tambahan untuk siswa..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none shadow-sm placeholder:text-gray-300"></textarea>
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin menambah umpan balik baru</p>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection