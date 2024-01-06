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