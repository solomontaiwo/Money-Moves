@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Type:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="expense" value="expense" checked>
                        <label class="form-check-label" for="expense">
                            Expense
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="income" value="income">
                        <label class="form-check-label" for="income">
                            Income
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Transaction Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="{{ old('amount') }}" required>
                    </div>
                    @error('amount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="food">Food</option>
                        <option value="shopping">Shopping</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="other">Other</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="place" class="form-label">Place:</label>
            <input type="text" class="form-control" id="place" name="place" placeholder="Enter place" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes:</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Transaction</button>
    </form>

    <br>

    @if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
    @endif

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initial categories for expense
        var expenseCategories = ['Food', 'Shopping', 'Entertainment', 'Other'];
        var incomeCategories = ['Gift', 'Salary', 'Tip', 'Other'];

        // Function to update categories based on selected type
        function updateCategories() {
            var selectedType = $('input[name="type"]:checked').val();
            var categories = (selectedType === 'expense') ? expenseCategories : incomeCategories;

            // Clear current options
            $('#category').empty();

            // Add default option
            $('#category').append($('<option>', {
                value: '',
                text: 'Select category'
            }));

            // Add new options
            $.each(categories, function(index, value) {
                $('#category').append($('<option>', {
                    value: value,
                    text: value.charAt(0).toUpperCase() + value.slice(1) // Capitalize first letter
                }));
            });
        }

        // Call the function on page load
        updateCategories();

        // Attach event listener to type radio buttons
        $('input[name="type"]').change(function() {
            updateCategories();
        });
    });
</script>

@endsection