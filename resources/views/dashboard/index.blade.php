@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cashflow Dashboard</h2>

    <p>Period: {{ $startDate->format('F j, Y') }} - {{ $endDate->format('F j, Y') }}</p>

    <div>
        <strong>Total Expenses:</strong> € {{ number_format($cashflow['expenses'], 2) }}
    </div>

    <div>
        <strong>Total Incomes:</strong> € {{ number_format($cashflow['incomes'], 2) }}
    </div>

    <div>
        <strong>Net Cashflow:</strong> € {{ number_format($cashflow['incomes'] - $cashflow['expenses'], 2) }}
    </div>
</div>
@endsection