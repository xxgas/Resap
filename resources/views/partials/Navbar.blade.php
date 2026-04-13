<nav class="bg-white border-b border-gray-200 px-6 py-3 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <div>
                    <h1 class="font-bold text-gray-800 text-lg leading-tight">Report Sarana Prasarana Sekolah</h1>
                    <p class="text-xs text-gray-400">Sistem Informasi Pengaduan</p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-700">{{auth()->user()->name}}</p>
                    <p class="text-xs text-gray-400">{{auth()->user()->role}}</p>
                </div>

               <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 text-red-500 bg-red-50 rounded-lg hover:bg-red-100 transition font-medium text-sm">
                    Keluar
                </button>
                </form>
            </div>
        </div>
    </nav>