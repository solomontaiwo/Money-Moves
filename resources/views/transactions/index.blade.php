@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Transaction List</h2>

    <div class="card mb-4">
        <div class="card-body">
            <!-- Search Form -->
            <form action="{{ route('transactions.index') }}" method="get" class="d-flex">
                <label for="search" class="visually-hidden">Search:</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control me-2" style="flex: 1;" placeholder="Search transactions">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <!-- Table Headers -->
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Place</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->name }}</td>
                    <td>€ {{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->place }}</td>
                    <td>{{ $transaction->notes }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                    <!-- Action buttons -->
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection