@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaction</h2>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Transaction Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $transaction->name }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <div class="input-group">
                <span class="input-group-text">€</span>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $transaction->amount }}" required>
            </div>
            @error('amount')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Transaction Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $transaction->date }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" disabled>Select category</option>

                @foreach($categories as $category)
                <option value="{{ $category }}" {{ $transaction->category === $category ? 'selected' : '' }}>
                    {{ ucfirst($category) }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="place" class="form-label">Place:</label>
            <input type="text" class="form-control" id="place" name="place" value="{{ $transaction->place }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $transaction->city }}" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes:</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ $transaction->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="expense" {{ $transaction->type === 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ $transaction->type === 'income' ? 'selected' : '' }}>Income</option>
            </select>
        </div>

        <!-- Add other fields as needed -->

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Transaction</button>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
</div>
@endsection