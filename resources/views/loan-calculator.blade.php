@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Car Loan Calculator</h4>
                </div>
                <div class="card-body">
                    <form id="loanForm" action="{{ route('loan.calculate') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="carPrice" class="form-label">Car Price ($)</label>
                            <input type="number" class="form-control" id="carPrice" name="carPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="downPayment" class="form-label">Down Payment ($)</label>
                            <input type="number" class="form-control" id="downPayment" name="downPayment" required>
                        </div>
                        <div class="mb-3">
                            <label for="loanTerm" class="form-label">Loan Term (months)</label>
                            <select class="form-select" id="loanTerm" name="loanTerm" required>
                                <option value="12">12 months</option>
                                <option value="24">24 months</option>
                                <option value="36">36 months</option>
                                <option value="48">48 months</option>
                                <option value="60">60 months</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="interestRate" class="form-label">Annual Interest Rate (%)</label>
                            <input type="number" step="0.1" class="form-control" id="interestRate" name="interestRate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calculate</button>
                    </form>

                    <div id="results" class="mt-4" style="display: none;">
                        <h5>Loan Summary</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Monthly Payment</th>
                                    <td id="monthlyPayment"></td>
                                </tr>
                                <tr>
                                    <th>Total Interest</th>
                                    <td id="totalInterest"></td>
                                </tr>
                                <tr>
                                    <th>Total Payment</th>
                                    <td id="totalPayment"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('loanForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('monthlyPayment').textContent = '$' + data.monthlyPayment;
        document.getElementById('totalInterest').textContent = '$' + data.totalInterest;
        document.getElementById('totalPayment').textContent = '$' + data.totalPayment;
        document.getElementById('results').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endpush
