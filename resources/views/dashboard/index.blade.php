@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cashflow Dashboard</h1>

    <form action="{{ route('dashboard.index') }}" method="get" class="row g-3">
        <div class="col-md-3 mb-3" style="width: 50%">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="form-control">
        </div>

        <div class="col-md-3 mb-3" style="width: 50%">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="form-control">
        </div>

        <div class="col-md-3 mb-3" style="width: 100%">
            <button type="submit" class="btn btn-primary" style="width: 100%">Update Dashboard</button>
        </div>
    </form>

    <p class="mt-3">Period: {{ $startDate->format('F j Y') }} - {{ $endDate->format('F j Y') }}</p>

    <!-- Stylish card for data presentation -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <strong class="text-danger">Total Expenses:</strong> € {{ number_format($cashflow['expenses'], 2) }}
            </div>

            <div class="mb-3">
                <strong class="text-success">Total Incomes:</strong> € {{ number_format($cashflow['incomes'], 2) }}
            </div>

            <div class="mb-3">
                <strong class="text-primary">Net Cashflow:</strong> € {{ number_format($cashflow['incomes'] - $cashflow['expenses'], 2) }}
            </div>
        </div>
    </div>
</div>
@endsection