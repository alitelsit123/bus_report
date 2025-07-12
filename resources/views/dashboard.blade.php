@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="card rounded-2xl p-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ auth()->user()->name }}! Berikut adalah ringkasan laporan bus agency Anda.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Pendapatan -->
        <div class="stats-card income-card rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Pendapatan</p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    <p class="text-sm opacity-75 mt-1">Bulan ini</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <img src="{{url('money-in.png')}}" alt="" srcset="" class="size-8">
                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="stats-card expense-card rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total Pengeluaran</p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    <p class="text-sm opacity-75 mt-1">Bulan ini</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <img src="{{url('money-out.png')}}" alt="" srcset="" class="size-8">
                </div>
            </div>
        </div>

        <!-- Keuntungan Bersih -->
        <div class="stats-card rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Keuntungan Bersih</p>
                    <p class="text-3xl font-bold">Rp {{ number_format($keuntunganBersih, 0, ',', '.') }}</p>
                    <p class="text-sm opacity-75 mt-1">Bulan ini</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <img src="{{url('money-in2.png')}}" alt="" srcset="" class="w-8 h-8">
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Laporan Terbaru</h2>
            <a href="{{ route('reports.index') }}"
               class="btn-primary px-4 py-2 rounded-lg text-white text-sm font-medium hover:opacity-90 transition-opacity">
                Lihat Semua
            </a>
        </div>

        @if($recentReports->count() > 0)
            <div class="overflow-x-auto w-full flex">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentReports as $report)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-2 text-sm text-gray-900">
                                    {{ $report->report_date->format('d/m/Y') }}
                                </td>
                                <td class="p-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $report->title }}</div>
                                    @if($report->description)
                                        <div class="text-sm text-gray-500">{{ Str::limit($report->description, 50) }}</div>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $report->type === 'pendapatan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($report->type) }}
                                    </span>
                                </td>
                                <td class="p-2 text-sm font-medium
                                    {{ $report->type === 'pendapatan' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $report->type === 'pendapatan' ? '+' : '-' }}Rp {{ number_format($report->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan pertama Anda.</p>
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
