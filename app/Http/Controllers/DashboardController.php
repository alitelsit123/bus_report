<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Get current month stats
    $totalPendapatan = Report::where('type', 'pendapatan')
      ->whereMonth('report_date', $currentMonth)
      ->whereYear('report_date', $currentYear)
      ->sum('amount');

    $totalPengeluaran = Report::where('type', 'pengeluaran')
      ->whereMonth('report_date', $currentMonth)
      ->whereYear('report_date', $currentYear)
      ->sum('amount');

    $keuntunganBersih = $totalPendapatan - $totalPengeluaran;

    // Get recent reports
    $recentReports = Report::with('user')
      ->latest()
      ->take(5)
      ->get();

    return view('dashboard', compact(
      'totalPendapatan',
      'totalPengeluaran',
      'keuntunganBersih',
      'recentReports'
    ));
  }
}
