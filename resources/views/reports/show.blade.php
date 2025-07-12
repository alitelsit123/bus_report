@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Laporan</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap laporan.</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('reports.edit', $report) }}"
                   class="btn-primary px-4 py-2 rounded-lg text-white text-sm font-medium">
                    Edit
                </a>
                <a href="{{ route('reports.index') }}"
                   class="text-gray-600 hover:text-gray-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Report Details -->
    <div class="card rounded-2xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Judul</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $report->title }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tipe</label>
                            <span class="mt-1 inline-flex px-3 py-1 text-sm font-medium rounded-full
                                {{ $report->type === 'pendapatan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($report->type) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah</label>
                            <p class="mt-1 text-2xl font-bold
                                {{ $report->type === 'pendapatan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $report->type === 'pendapatan' ? '+' : '-' }}Rp {{ number_format($report->amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tanggal & Waktu</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Laporan</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $report->report_date->format('d F Y') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dibuat</label>
                            <p class="mt-1 text-sm text-gray-600">{{ $report->created_at->format('d F Y, H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                            <p class="mt-1 text-sm text-gray-600">{{ $report->updated_at->format('d F Y, H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dibuat oleh</label>
                            <p class="mt-1 text-sm text-gray-600">{{ $report->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($report->description)
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Aksi</h3>
            <div class="flex items-center space-x-4">
                <a href="{{ route('reports.edit', $report) }}"
                   class="inline-flex items-center px-4 py-2 border border-yellow-300 rounded-lg text-yellow-700 hover:bg-yellow-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Laporan
                </a>

                <form method="POST" action="{{ route('reports.destroy', $report) }}"
                      class="inline"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
