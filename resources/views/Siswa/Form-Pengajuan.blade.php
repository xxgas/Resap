@extends('layouts.app')

@section('content')
    <main class="max-w-4xl mx-auto p-6 py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Pengaduan Baru</h2>
            <p class="text-gray-500">Laporkan masalah sarana dan prasarana sekolah dengan mengisi form di bawah ini</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 md:p-10">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                    <select name="id_kategori" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all appearance-none" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('id_kategori') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Kelas 10A, Lantai 2" 
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Masalah <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="5" placeholder="Jelaskan masalah yang Anda temukan dengan detail..." 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all resize-none" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Bukti <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="file" name="foto" accept="image/*"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:font-semibold hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Maksimal 2MB. Format: JPG, PNG, GIF</p>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3">
                    <svg class="w-6 h-6 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-blue-700 leading-relaxed">
                        <span class="font-bold">Tips:</span> Berikan informasi yang jelas dan detail agar tim sekolah dapat menindaklanjuti dengan cepat dan tepat.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('dashboard-siswa') }}" class="flex-1 text-center px-6 py-3 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection