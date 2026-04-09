<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Resap</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">

        <div class="relative hidden w-1/2 lg:block">
            <div class="absolute inset-0 z-10 bg-[#001f4d]/80"></div>
            <img src="https://images.unsplash.com/photo-1541339907198-e08756ebafe3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                alt="Gedung Sekolah"
                class="absolute inset-0 object-cover w-full h-full">

            <div class="relative z-20 flex flex-col justify-center h-full px-20 text-white">
                <div class="flex items-center mb-6 gap-3">
                    <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold tracking-tight">Resap</h1>
                </div>
                <h2 class="text-2xl font-semibold mb-2">Report Sarana Prasarana Sekolah</h2>
                <p class="text-lg text-gray-200">Laporkan masalah fasilitas sekolah dengan mudah dan cepat</p>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full p-8 lg:w-1/2 bg-[#f8fafc]">

            <div class="w-full max-w-md p-10 bg-white shadow-2xl rounded-2xl">
                <h3 class="text-3xl font-bold text-gray-800">Selamat Datang</h3>
                <p class="mt-2 text-gray-500 border-b pb-6">Silakan login untuk melanjutkan</p>

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6 mt-8">
                    @csrf

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-3 text-sm text-red-600">
                            {{ $errors->first('nip_nis') ?? $errors->first() }}
                        </div>
                    @endif

                    <div>
                        <label class="block mb-2 text-sm font-bold text-[#001f4d]">NIS / NIP</label>
                        <input type="text" name="nip_nis" value="{{ old('nip_nis') }}" required
                            class="w-full px-4 py-3 border @error('nip_nis') border-red-400 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder:text-gray-300 shadow-sm"
                            placeholder="Masukkan NIS atau NIP Anda">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-[#001f4d]">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder:text-gray-300 shadow-sm"
                            placeholder="Masukkan password">
                    </div>

                    <button type="submit"
                        class="flex items-center justify-center w-full gap-2 py-3.5 text-white transition-all bg-[#001f4d] rounded-xl hover:bg-blue-900 active:scale-95 shadow-lg shadow-blue-900/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3 3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-bold uppercase tracking-wider text-sm">Masuk</span>
                    </button>
                </form>
            </div>

            <p class="mt-8 text-sm text-gray-500">
                Belum punya akun? <a href="#" class="font-semibold text-blue-600 hover:underline">Silakan hubungi administrator sekolah.</a>
            </p>
        </div>
    </div>
</body>

</html>