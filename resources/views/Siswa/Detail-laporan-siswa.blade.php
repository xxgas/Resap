@extends('layouts.app')

@section('content')
    <main class="max-w-4xl mx-auto p-6">
        <a href="{{ route('dashboard-siswa') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 mb-6 transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="bg-emerald-500 p-6 text-white flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold">Detail Pengaduan</h2>
                    <p class="text-emerald-50 opacity-90">ID Pengaduan: #{{ $aspirasi->id }}</p>
                </div>
                @if($aspirasi->status === 'menunggu')
                    <span class="px-4 py-1.5 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-sm">Menunggu</span>
                @elseif($aspirasi->status === 'proses')
                    <span class="px-4 py-1.5 bg-blue-400 text-white text-xs font-bold rounded-full shadow-sm">Diproses</span>
                @else
                    <span class="px-4 py-1.5 bg-emerald-300 text-emerald-900 text-xs font-bold rounded-full shadow-sm">Selesai</span>
                @endif
            </div>

            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            Kategori
                        </label>
                        <p class="text-gray-800 font-bold">{{ $aspirasi->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Lokasi
                        </label>
                        <p class="text-gray-800 font-bold">{{ $aspirasi->lokasi }}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Deskripsi Masalah
                    </label>
                    <p class="text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                        {{ $aspirasi->deskripsi }}
                    </p>
                </div>

                @if($aspirasi->foto)
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Foto Bukti</label>
                        <img src="{{ asset('storage/' . $aspirasi->foto) }}" alt="Foto Pengaduan" class="rounded-xl max-h-64 object-cover border border-gray-100">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Tanggal Dibuat
                        </label>
                        <p class="text-gray-500 text-sm">{{ $aspirasi->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Terakhir Diupdate
                        </label>
                        <p class="text-gray-500 text-sm">{{ $aspirasi->updated_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                </div>

                {{-- Feedback dari Admin --}}
                <div class="pt-6 border-t border-gray-50">
                    <label class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                        Feedback dari Admin
                    </label>
                    @if($aspirasi->umpanBaliks->isNotEmpty())
                        <div class="space-y-3">
                            @foreach($aspirasi->umpanBaliks as $fb)
                                <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl">
                                    <p class="text-sm text-gray-700 italic">"{{ $fb->keterangan }}"</p>
                                    <p class="text-xs text-gray-400 mt-2">— {{ $fb->user->nama ?? 'Admin' }}, {{ $fb->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-100 p-4 rounded-xl">
                            <p class="text-sm text-gray-500 italic">Belum ada feedback dari admin</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Timeline Status --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h3 class="font-bold text-gray-800 mb-6">Timeline Status</h3>
            <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px before:h-full before:w-0.5 before:bg-gray-200">
                
                @php $status = $aspirasi->status; @endphp

                <div class="relative flex items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 z-10 {{ $status === 'selesai' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white' }}">
                        <svg class="w-5 h-5 {{ $status === 'selesai' ? 'text-emerald-500' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-6">
                        <h4 class="font-bold {{ $status === 'selesai' ? 'text-gray-800' : 'text-gray-400' }}">Selesai</h4>
                        <p class="text-xs {{ $status === 'selesai' ? 'text-emerald-600 font-medium' : 'text-gray-400' }}">{{ $status === 'selesai' ? 'Pengaduan telah diselesaikan' : 'Menunggu penyelesaian' }}</p>
                    </div>
                </div>

                <div class="relative flex items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 z-10 {{ in_array($status, ['proses', 'selesai']) ? 'border-blue-400 bg-blue-50' : 'border-gray-200 bg-white' }}">
                        <svg class="w-5 h-5 {{ in_array($status, ['proses', 'selesai']) ? 'text-blue-400' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="ml-6">
                        <h4 class="font-bold {{ in_array($status, ['proses', 'selesai']) ? 'text-gray-800' : 'text-gray-400' }}">Diproses</h4>
                        <p class="text-xs {{ $status === 'proses' ? 'text-blue-500 font-medium' : 'text-gray-400' }}">{{ $status === 'proses' ? 'Sedang ditangani' : ($status === 'selesai' ? 'Sudah diproses' : 'Belum masuk tahap proses') }}</p>
                    </div>
                </div>

                <div class="relative flex items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-emerald-500 bg-emerald-50 z-10 shadow-[0_0_0_4px_rgba(16,185,129,0.1)]">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full {{ $status === 'menunggu' ? 'animate-pulse' : '' }}"></div>
                    </div>
                    <div class="ml-6">
                        <h4 class="font-bold text-gray-800">Menunggu</h4>
                        <p class="text-xs text-emerald-600 font-medium">Pengaduan telah diterima</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection