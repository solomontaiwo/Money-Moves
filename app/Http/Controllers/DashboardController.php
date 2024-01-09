<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $cashflow = $this->getCashflow($startDate, $endDate);

        return view('dashboard.index', compact('cashflow', 'startDate', 'endDate'));
    }

    private function getCashflow($startDate, $endDate)
    {
        $expenses = Transaction::where('type', 'Expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $incomes = Transaction::where('type', 'Income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        return compact('expenses', 'incomes');
    }
}
