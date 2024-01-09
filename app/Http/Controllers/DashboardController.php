<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date', now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('end_date', now()->endOfMonth()));

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
