@extends('layouts.app')


@section('content')
<main>

    <div class="max-w-5xl mx-auto px-6 mt-6 bg-white shadow p-4 rounded-lg p-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-blue-600 transition mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-sm font-medium">Kembali ke Dashboard</span>
        </a>

        <h2 class="text-2xl font-bold mb-4">Data User</h2>

        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">NO</th>
                    <th class="px-4 py-2 text-left">NAMA</th>
                    <th class="px-4 py-2 text-left">NISN</th>
                    <th class="px-4 py-2 text-left">KELAS</th>
                    <th class="px-4 py-2 text-left">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user )
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->nama }}</td>
                    <td class="px-4 py-2">{{ $user->nip_nis }}</td>
                    <td class="px-4 py-2">{{ $user->kelas }}</td>

                    <td>
                        <form action="{{ route('admin.user.destroy', $user->id)}}" method="POST" onsubmit="return confirm('yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        Data Tidak Di Temukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</main>

@endsection
