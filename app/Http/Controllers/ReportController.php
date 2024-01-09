<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

class ReportController extends Controller
{
    public function generatePdf(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        $data = [
            'transactions' => $transactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        $pdf = PDF::loadView('reports.pdf', $data);

        return $pdf->download('transaction_report.pdf');
    }

    public function generateExcel(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        return Excel::download(new TransactionsExport($transactions), 'transaction_report.xlsx');
    }

    public function generateCsv(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        return Excel::download(new TransactionsExport($transactions), 'transaction_report.csv');
    }
}
