<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::first();

    $reports = [
      [
        'title' => 'Penjualan Tiket Jakarta-Bandung',
        'type' => 'pendapatan',
        'amount' => 2500000,
        'description' => 'Penjualan tiket rute Jakarta-Bandung untuk 50 penumpang',
        'report_date' => Carbon::now()->subDays(1),
        'user_id' => $user->id,
      ],
      [
        'title' => 'Pembelian BBM',
        'type' => 'pengeluaran',
        'amount' => 800000,
        'description' => 'Pembelian bahan bakar minyak untuk 3 unit bus',
        'report_date' => Carbon::now()->subDays(2),
        'user_id' => $user->id,
      ],
      [
        'title' => 'Penjualan Tiket Surabaya-Malang',
        'type' => 'pendapatan',
        'amount' => 1800000,
        'description' => 'Penjualan tiket rute Surabaya-Malang untuk 40 penumpang',
        'report_date' => Carbon::now()->subDays(3),
        'user_id' => $user->id,
      ],
      [
        'title' => 'Perawatan Bus Unit 01',
        'type' => 'pengeluaran',
        'amount' => 1200000,
        'description' => 'Service rutin dan penggantian oli mesin bus unit 01',
        'report_date' => Carbon::now()->subDays(4),
        'user_id' => $user->id,
      ],
      [
        'title' => 'Penjualan Tiket Yogyakarta-Solo',
        'type' => 'pendapatan',
        'amount' => 1500000,
        'description' => 'Penjualan tiket rute Yogyakarta-Solo untuk 35 penumpang',
        'report_date' => Carbon::now()->subDays(5),
        'user_id' => $user->id,
      ],
      [
        'title' => 'Gaji Supir dan Kernet',
        'type' => 'pengeluaran',
        'amount' => 3500000,
        'description' => 'Pembayaran gaji bulanan untuk 6 supir dan 6 kernet',
        'report_date' => Carbon::now()->subDays(6),
        'user_id' => $user->id,
      ],
    ];

    foreach ($reports as $report) {
      Report::create($report);
    }
  }
}
