@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction List</h2>

    <div class="card mb-3">
        <div class="card-body row">
            <!-- Search Form -->
            <div class="col-md-12 mb-3">
                <form action="{{ route('transactions.index') }}" method="get" class="d-flex">
                    <label for="search" class="visually-hidden">Search:</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control" style="width: 100%;">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>
            </div>
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