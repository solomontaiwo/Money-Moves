@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction List</h2>

    <div class="d-flex mb-3">
        <!-- Search Form -->
        <form class="me-3" action="{{ route('transactions.index') }}" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Filter Form -->
        
    </div>


    <div class="table-responsive">
        <table class="table table-hover">
            <!-- Table Headers -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Place</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Inserted</th>
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
                    <td>{{ $transaction->created_at->format('F j Y') }}</td>
                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

    <form action="{{ route('transactions.export') }}" method="get">
        <button type="submit" class="btn btn-primary">Export to CSV</button>
    </form>
</div>
@endsection