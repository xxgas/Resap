@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto p-6 space-y-8">
        
        {{-- Flash message --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-5 py-3 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="bg-emerald-500 rounded-3xl p-8 text-white flex flex-col md:flex-row justify-between items-center shadow-lg shadow-emerald-100">
            <div>
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->nama }}!</h2>
                <p class="text-emerald-50 opacity-90 font-medium">{{ auth()->user()->nip_nis }} | Kelas: {{ auth()->user()->kelas ?? '-' }}</p>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('pengaduan.buat') }}" class="inline-flex items-center gap-2 bg-white text-emerald-600 px-6 py-3 rounded-xl font-bold hover:bg-emerald-50 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Ajukan Pengaduan
                </a>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500 flex justify-between items-center">
                <div><p class="text-sm font-medium text-gray-400 mb-1">Total Pengaduan</p><p class="text-3xl font-bold text-gray-800">{{ $total }}</p></div>
                <div class="text-blue-500"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-400 flex justify-between items-center">
                <div><p class="text-sm font-medium text-gray-400 mb-1">Menunggu</p><p class="text-3xl font-bold text-gray-800">{{ $menunggu }}</p></div>
                <div class="text-yellow-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-400 flex justify-between items-center">
                <div><p class="text-sm font-medium text-gray-400 mb-1">Proses</p><p class="text-3xl font-bold text-gray-800">{{ $proses }}</p></div>
                <div class="text-blue-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-emerald-500 flex justify-between items-center">
                <div><p class="text-sm font-medium text-gray-400 mb-1">Selesai</p><p class="text-3xl font-bold text-gray-800">{{ $selesai }}</p></div>
                <div class="text-emerald-500"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
            </div>
        </div>

        {{-- Daftar Pengaduan --}}
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Pengaduan Saya</h3>
                <span class="text-sm text-gray-400 font-medium">{{ $total }} pengaduan</span>
            </div>

            @forelse($aspirasis as $asp)
                <a href="{{ route('pengaduan.detail', $asp->id) }}" class="block bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-blue-500 font-semibold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                {{ $asp->kategori->nama_kategori ?? '-' }}
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">{{ $asp->lokasi }}</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($asp->deskripsi, 80) }}</p>
                            <div class="flex items-center gap-2 text-gray-400 text-xs pt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $asp->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        <div class="shrink-0">
                            @if($asp->status === 'menunggu')
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-500 border border-amber-100">Menunggu</span>
                            @elseif($asp->status === 'proses')
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-500 border border-blue-100">Diproses</span>
                            @else
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-500 border border-emerald-100">Selesai</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tampilkan feedback terbaru jika ada --}}
                    @if($asp->umpanBaliks->isNotEmpty())
                        <div class="mt-4 pt-4 border-t border-gray-50">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Feedback Admin:</p>
                            <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-xl italic">
                                "{{ $asp->umpanBaliks->last()->keterangan }}"
                            </p>
                        </div>
                    @endif
                </a>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-gray-400 font-medium">Belum ada pengaduan</p>
                    <a href="{{ route('pengaduan.buat') }}" class="mt-4 inline-block text-emerald-500 font-bold hover:underline">Buat Pengaduan Pertama</a>
                </div>
            @endforelse
        </div>
    </main>
@endsection