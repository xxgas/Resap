@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto p-6">
        
        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-5 py-3 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="bg-blue-600 rounded-2xl p-8 mb-8 text-white shadow-lg shadow-blue-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold mb-1">Dashboard Administrator</h2>
                <p class="text-blue-100 text-sm">Kelola semua pengaduan sarana dan prasarana sekolah</p>
            </div>
            <a href="{{ route('admin.tambah-siswa') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 transition-all active:scale-95 shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                <span>Buat Akun Siswa</span>
            </a>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border-l-4 border-blue-500 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1 uppercase">Total Pengaduan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $total }}</h3>
                </div>
                <div class="text-blue-500 bg-blue-50 p-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border-l-4 border-yellow-400 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1 uppercase">Menunggu</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $menunggu }}</h3>
                </div>
                <div class="text-yellow-500 bg-yellow-50 p-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border-l-4 border-blue-400 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1 uppercase">Diproses</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $proses }}</h3>
                </div>
                <div class="text-blue-400 bg-blue-50 p-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border-l-4 border-green-500 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-1 uppercase">Selesai</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $selesai }}</h3>
                </div>
                <div class="text-green-500 bg-green-50 p-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="bg-white p-6 rounded-xl shadow-sm mb-8">
            <div class="flex items-center gap-2 mb-4 text-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path></svg>
                <h4 class="font-bold">Filter Pengaduan</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                    <select name="status" class="w-full appearance-none bg-gray-50 border border-blue-400 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori</label>
                    <select name="id_kategori" class="w-full appearance-none bg-gray-50 border border-blue-400 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ request('id_kategori') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lokasi, siswa, atau deskripsi..." 
                        class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm">
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700">Cari</button>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-lg hover:bg-gray-200">Reset</a>
            </div>
        </form>

        {{-- List Aspirasi --}}
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-xl font-bold text-gray-800 underline decoration-blue-500 decoration-4 underline-offset-8">Semua Pengaduan</h4>
            <span class="text-xs text-gray-400">Menampilkan {{ $aspirasis->count() }} pengaduan</span>
        </div>

        <div class="space-y-4">
            @forelse($aspirasis as $asp)
                <a href="{{ route('admin.aspirasi.show', $asp->id) }}" class="block bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 text-blue-500 text-sm font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293zM8 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                <span>{{ $asp->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                            <h5 class="text-lg font-bold text-blue-900">{{ $asp->lokasi }}</h5>
                            <p class="text-gray-600 text-sm">{{ Str::limit($asp->deskripsi, 80) }}</p>
                            <div class="flex gap-4 mt-3 text-xs text-gray-400 font-medium">
                                <span>👤 {{ $asp->user->nama ?? '-' }} ({{ $asp->user->kelas ?? '-' }})</span>
                                <span>📅 {{ $asp->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                        @if($asp->status === 'menunggu')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Menunggu</span>
                        @elseif($asp->status === 'proses')
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Diproses</span>
                        @else
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Selesai</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="text-center py-16 bg-white rounded-xl border border-gray-100">
                    <p class="text-gray-400 font-medium">Tidak ada pengaduan ditemukan</p>
                </div>
            @endforelse
        </div>
    </main>
@endsection