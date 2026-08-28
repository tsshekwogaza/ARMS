<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Receipt;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        // 1. Total Rent Revenue Collected (sum of amount_paid where status is completed/Issued)
        $totalCollected = Receipt::where('user_id', $userId)
            ->where('status', 'Issued')
            ->sum('amount_paid');

        // 2. Receipts Dispatched (total issued receipts)
        $receiptsDispatched = Receipt::where('user_id', $userId)->count();

        // 3. Properties and Units Summary
        $totalUnits = Property::where('user_id', $userId)->count('unit') ?? 0;
        $totalTenants = Tenant::where('user_id', $userId)->count();

        // 4. Monthly Collections Breakdown for Chart (Current Year)
        $monthlyCollections = Receipt::where('user_id', $userId)
            ->where('status', 'Issued')
            ->whereYear('payment_date', date('Y'))
            ->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Map months 1..12 ensuring non-empty array for ApexCharts
        $chartData = array_map(fn($month) => (float) ($monthlyCollections[$month] ?? 0), range(1, 12));

        // 5. Recent Receipts List (eager loads tenant and their assigned property)
        $recentReceipts = Receipt::where('user_id', $userId)
            ->with(['tenant.property'])
            ->latest('payment_date')
            ->take(5)
            ->get();

        // Dynamic time-of-day greeting
        $hour = date('H');
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

        return view('users.dashboard', compact(
            'greeting',
            'user',
            'totalCollected',
            'receiptsDispatched',
            'totalUnits',
            'totalTenants',
            'chartData',
            'recentReceipts'
        ));
    }
}