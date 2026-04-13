@extends('layouts.app')

@section('content')
    <main class="max-w-2xl mx-auto p-6 py-12">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 transition mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-sm font-medium">Kembali ke Dashboard</span>
        </a>

        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Siswa</h2>
            <p class="text-gray-500">Tambahkan akun siswa agar bisa mengakses sistem pengaduan</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-5 py-3 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8">
            <form action="{{ route('admin.tambah-siswa.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Ahmad Fauzi"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">NIS (Nomor Induk Siswa) <span class="text-red-500">*</span></label>
                    <input type="text" name="nip_nis" value="{{ old('nip_nis') }}" placeholder="Contoh: 2024001"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all appearance-none" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
                        <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                        <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex-1 text-center px-6 py-3 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        Buat Akun Siswa
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
