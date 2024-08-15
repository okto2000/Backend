<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function getStats()
    {
        // Menghitung jumlah total member
        $totalCustomers = Customer::count();

        // Menghitung total transaksi
        $totalTransactions = Transaction::count();


        // Contoh perhitungan performance (misalnya, pertumbuhan transaksi dalam satu bulan)
        $performance = Transaction::where('created_at', '>=', now()->subMonth())->count();

        return response()->json([
            'total_customers' => $totalCustomers,
            'total_transactions' => $totalTransactions,
            'performance' => $performance,
            'total_customers_percent' => $this->calculateGrowthPercent($totalCustomers),
            'total_transactions_percent' => $this->calculateGrowthPercent($totalTransactions),
            'performance_percent' => 12, // Ganti dengan perhitungan yang sesuai
        ]);
    }
    private function calculateGrowthPercent($currentValue)
    {
        $lastMonthValue = 100;
        return (($currentValue - $lastMonthValue) / $lastMonthValue) * 100;
    }
}
