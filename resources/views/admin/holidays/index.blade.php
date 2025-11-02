<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Hari Libur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Tombol Tambah --}}
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">Daftar Hari Libur</h3>
                            <p class="text-sm text-gray-600">Kelola hari libur dan cuti bersama</p>
                        </div>
                        <a href="{{ route('holidays.create') }}" 
                           class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all">
                            Tambah Hari Libur
                        </a>
                    </div>
                    
                    {{-- 🎉 Success Message --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                            <div class="flex">
                                <span class="text-xl mr-2"></span>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Tabel Data --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Keterangan
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($holidays as $holiday)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-2xl mr-2"></span>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ \Carbon\Carbon::parse($holiday->date)->isoFormat('dddd, D MMMM Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($holiday->date)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $holiday->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('holidays.edit', $holiday) }}" 
                                               class="inline-flex items-center text-indigo-600 hover:text-indigo-900 mr-3 transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('holidays.destroy', $holiday) }}" 
                                                  method="POST" 
                                                  class="inline-block" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus hari libur ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center text-red-600 hover:text-red-900 transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center">
                                                <span class="text-6xl mb-3"></span>
                                                <p class="text-gray-500 text-lg">Belum ada data hari libur.</p>
                                                <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah" untuk mulai menambahkan!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- 📄 Pagination --}}
                    <div class="mt-4">
                        {{ $holidays->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>