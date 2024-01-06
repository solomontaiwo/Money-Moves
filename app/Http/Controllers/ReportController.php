<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get start and end dates from the request or use default values
        $startDate = Carbon::parse($request->input('start_date', now()->startOfWeek()));
        $endDate = Carbon::parse($request->input('end_date', now()->endOfWeek()));

        // Fetch data for the report
        $data = $this->getReportData($startDate, $endDate);

        return view('reports.index', compact('data', 'startDate', 'endDate'));
    }

    private function getReportData($startDate, $endDate)
    {
        // Fetch expenses and incomes data from the database
        $expenses = Transaction::where('type', 'Expense')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $incomes = Transaction::where('type', 'Income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        return compact('expenses', 'incomes');
    }
}
