@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan</h1>
                <p class="text-gray-600 mt-2">Kelola semua laporan pendapatan dan pengeluaran bus agency.</p>
            </div>
            <a href="{{ route('reports.create') }}"
               class="btn-primary inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Tambah Laporan
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card rounded-2xl p-6">
        <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Semua</option>
                    <option value="pendapatan" {{ request('type') === 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                    <option value="pengeluaran" {{ request('type') === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <div class="flex items-end">
                <button type="submit" class="btn-primary w-full px-4 py-2 rounded-lg text-white text-sm font-medium">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Reports Table -->
    <div class="table-container">
        @if($reports->count() > 0)
            <div class="w-full overflow-x-auto flex">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($reports as $report)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-2 text-sm text-gray-900">
                                    {{ $report->report_date->format('d/m/Y') }}
                                </td>
                                <td class="p-2 ">
                                    <div class="text-sm font-medium text-gray-900">{{ $report->title }}</div>
                                </td>
                                <td class="p-2 ">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $report->type === 'pendapatan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($report->type) }}
                                    </span>
                                </td>
                                <td class="p-2 text-sm font-medium
                                    {{ $report->type === 'pendapatan' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $report->type === 'pendapatan' ? '+' : '-' }}Rp {{ number_format($report->amount, 0, ',', '.') }}
                                </td>
                                <td class="p-2 text-sm text-gray-500 max-w-xs">
                                    {{ $report->description ? Str::limit($report->description, 50) : '-' }}
                                </td>
                                <td class="p-2 text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('reports.show', $report) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                            Lihat
                                        </a>
                                        <a href="{{ route('reports.edit', $report) }}"
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('reports.destroy', $report) }}"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $reports->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request()->hasAny(['type', 'date_from', 'date_to']))
                        Tidak ada laporan yang sesuai dengan filter Anda.
                    @else
                        Mulai dengan membuat laporan pertama Anda.
                    @endif
                </p>
                <div class="mt-6">
                    <a href="{{ route('reports.create') }}"
                       class="btn-primary inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Tambah Laporan
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
