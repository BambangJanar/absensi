<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Hari Libur Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    
                    {{-- 📝 Info Box --}}
                    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <span class="text-2xl"></span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    <strong>Tips:</strong> Tambahkan semua hari libur nasional dan cuti bersama 
                                    agar sistem tidak menandai karyawan sebagai "Alpa" pada hari tersebut.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- 📋 Form --}}
                    <form method="POST" action="{{ route('holidays.store') }}" class="space-y-6">
                        @csrf
                        
                        {{-- Input Tanggal --}}
                        <div>
                            <label for="date" class="block font-medium text-sm text-gray-700 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input id="date" 
                                   type="date" 
                                   name="date" 
                                   value="{{ old('date') }}"
                                   class="block w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('date') border-red-500 @enderror" 
                                   required>
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Keterangan --}}
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700 mb-2">
                                Keterangan <span class="text-red-500">*</span>
                            </label>
                            <input id="description" 
                                   type="text" 
                                   name="description" 
                                   value="{{ old('description') }}"
                                   placeholder="Contoh: Hari Kemerdekaan RI"
                                   class="block w-full rounded-lg shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror" 
                                   required>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                            <a href="{{ route('holidays.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                                ← Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-md transition-all">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>