@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reports</h2>

    <!-- Form for date selection -->
    <form action="{{ route('reports.index') }}" method="get">
        <div class="mb-3">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <!-- Display the chart -->
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <!-- Include the charting library and your script to generate the chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Expenses', 'Incomes'],
                    datasets: [{
                        label: 'Amount',
                        data: [{
                            {
                                $data['expenses']
                            }
                        }, {
                            {
                                $data['incomes']
                            }
                        }],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection