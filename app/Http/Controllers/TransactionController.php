<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();

        // Date Range Filtering
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->input('start_date')));
        }

        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->input('end_date')));
        }

        // Search Filtering
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('category', 'like', "%$searchTerm%")
                ->orWhere('place', 'like', "%$searchTerm%")
                ->orWhere('notes', 'like', "%$searchTerm%");
        }

        // Get paginated expenses
        $transactions = $query->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = ['Food', 'Shopping', 'Entertainment', 'Other'];
        $type = 'Expense'; // Default to 'expense'

        return view('transactions.create', compact('categories', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:expense,income',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|between:0,999999.99',
            'category' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction = new Transaction();
        $transaction->type = $request->input('type');
        $transaction->name = $request->input('name');
        $transaction->date = $request->input('date');
        $transaction->amount = $request->input('amount');
        $transaction->category = $request->input('category');
        $transaction->place = $request->input('place');
        $transaction->city = $request->input('city');
        $transaction->notes = $request->input('notes', '');

        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        $categories = $this->getCategoriesBasedOnType($transaction->type);

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    private function getCategoriesBasedOnType($type)
    {
        if ($type === 'Income') {
            return ['Gift', 'Salary', 'Tip', 'Other']; // Income categories
        } else {
            return ['Food', 'Shopping', 'Entertainment', 'Other']; // Expense categories
        }
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|between:0,999999.99',
            'category' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $transaction->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'type' => $request->input('type'),
            'amount' => $request->input('amount'),
            'category' => $request->input('category'),
            'place' => $request->input('place'),
            'city' => $request->input('city'),
            'notes' => $request->input('notes', ''),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
