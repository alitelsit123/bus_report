@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Laporan</h1>
                <p class="text-gray-600 mt-2">Perbarui informasi laporan.</p>
            </div>
            <a href="{{ route('reports.index') }}"
               class="text-gray-600 hover:text-gray-800 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="card rounded-2xl p-6">
        <form method="POST" action="{{ route('reports.update', $report) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $report->title) }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('title') border-red-500 @enderror"
                           placeholder="Masukkan judul laporan">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                    <select name="type"
                            id="type"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('type') border-red-500 @enderror">
                        <option value="">Pilih Tipe</option>
                        <option value="pendapatan" {{ old('type', $report->type) === 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                        <option value="pengeluaran" {{ old('type', $report->type) === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number"
                               name="amount"
                               id="amount"
                               value="{{ old('amount', $report->amount) }}"
                               required
                               min="0"
                               step="0.01"
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('amount') border-red-500 @enderror"
                               placeholder="0.00">
                    </div>
                    @error('amount')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Report Date -->
                <div>
                    <label for="report_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Laporan</label>
                    <input type="date"
                           name="report_date"
                           id="report_date"
                           value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('report_date') border-red-500 @enderror">
                    @error('report_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description"
                          id="description"
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('description') border-red-500 @enderror"
                          placeholder="Masukkan deskripsi laporan (opsional)">{{ old('description', $report->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6">
                <a href="{{ route('reports.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                    Perbarui Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
