<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Exports\TransactionExport;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportPdf()
    {
        $transactions = Transaction::all();

        $pdf = PDF::loadView('exports.pdf', compact('transactions'));

        // Get the current authenticated user's name
        $userName = auth()->user()->name;

        // Set the timezone to 'Europe/Amsterdam' (replace with your desired timezone)
        $formattedDate = now()->setTimezone('Europe/Amsterdam')->format('Y-m-d_His');

        // Generate a filename with the user's name and the current date
        $filename = "{$userName}_transactions_{$formattedDate}.pdf";

        return $pdf->download($filename);
    }

    public function exportExcel()
    {
        // Get the current authenticated user's name
        $userName = auth()->user()->name;

        // Set the timezone to 'Europe/Amsterdam' (replace with your desired timezone)
        $formattedDate = now()->setTimezone('Europe/Amsterdam')->format('Y-m-d_His');

        // Generate a filename with the user's name and the current date
        $filename = "{$userName}_transactions_{$formattedDate}.xlsx";

        return Excel::download(new TransactionExport, 'transactions.xlsx');
    }
}
