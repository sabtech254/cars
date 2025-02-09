@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Car Loan Calculator</h2>
                </div>
                <div class="card-body">
                    <form id="loanCalculatorForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="carPrice" class="form-label">Car Price ($)</label>
                                <input type="number" class="form-control" id="carPrice" name="carPrice" min="0" step="100" required>
                            </div>
                            <div class="col-md-6">
                                <label for="downPayment" class="form-label">Down Payment ($)</label>
                                <input type="number" class="form-control" id="downPayment" name="downPayment" min="0" step="100" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="loanTerm" class="form-label">Loan Term (months)</label>
                                <select class="form-select" id="loanTerm" name="loanTerm" required>
                                    <option value="12">12 months</option>
                                    <option value="24">24 months</option>
                                    <option value="36">36 months</option>
                                    <option value="48">48 months</option>
                                    <option value="60" selected>60 months</option>
                                    <option value="72">72 months</option>
                                    <option value="84">84 months</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="interestRate" class="form-label">Interest Rate (%)</label>
                                <input type="number" class="form-control" id="interestRate" name="interestRate" min="0" max="30" step="0.1" required>
                            </div>
                            <div class="col-md-4">
                                <label for="salesTax" class="form-label">Sales Tax (%)</label>
                                <input type="number" class="form-control" id="salesTax" name="salesTax" min="0" max="15" step="0.1" value="0">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Calculate Payment</button>
                        </div>
                    </form>

                    <div id="results" class="mt-4" style="display: none;">
                        <h3>Loan Summary</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Vehicle Price:</th>
                                        <td id="summaryVehiclePrice">$0</td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax:</th>
                                        <td id="summarySalesTax">$0</td>
                                    </tr>
                                    <tr>
                                        <th>Down Payment:</th>
                                        <td id="summaryDownPayment">$0</td>
                                    </tr>
                                    <tr>
                                        <th>Loan Amount:</th>
                                        <td id="summaryLoanAmount">$0</td>
                                    </tr>
                                    <tr class="table-primary">
                                        <th>Monthly Payment:</th>
                                        <td id="summaryMonthlyPayment">$0</td>
                                    </tr>
                                    <tr>
                                        <th>Total Interest:</th>
                                        <td id="summaryTotalInterest">$0</td>
                                    </tr>
                                    <tr>
                                        <th>Total Cost:</th>
                                        <td id="summaryTotalCost">$0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h4>Amortization Schedule</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Payment #</th>
                                            <th>Payment</th>
                                            <th>Principal</th>
                                            <th>Interest</th>
                                            <th>Remaining Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="amortizationSchedule">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('loanCalculatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const carPrice = parseFloat(document.getElementById('carPrice').value);
    const downPayment = parseFloat(document.getElementById('downPayment').value);
    const loanTerm = parseInt(document.getElementById('loanTerm').value);
    const interestRate = parseFloat(document.getElementById('interestRate').value) / 100 / 12; // Monthly interest rate
    const salesTax = parseFloat(document.getElementById('salesTax').value) / 100;

    // Calculate loan details
    const salesTaxAmount = carPrice * salesTax;
    const totalPrice = carPrice + salesTaxAmount;
    const loanAmount = totalPrice - downPayment;
    
    // Calculate monthly payment using the loan payment formula
    const monthlyPayment = (loanAmount * interestRate * Math.pow(1 + interestRate, loanTerm)) / 
                          (Math.pow(1 + interestRate, loanTerm) - 1);

    // Calculate total interest
    const totalInterest = (monthlyPayment * loanTerm) - loanAmount;

    // Update summary
    document.getElementById('summaryVehiclePrice').textContent = formatCurrency(carPrice);
    document.getElementById('summarySalesTax').textContent = formatCurrency(salesTaxAmount);
    document.getElementById('summaryDownPayment').textContent = formatCurrency(downPayment);
    document.getElementById('summaryLoanAmount').textContent = formatCurrency(loanAmount);
    document.getElementById('summaryMonthlyPayment').textContent = formatCurrency(monthlyPayment);
    document.getElementById('summaryTotalInterest').textContent = formatCurrency(totalInterest);
    document.getElementById('summaryTotalCost').textContent = formatCurrency(totalPrice + totalInterest);

    // Generate amortization schedule
    let balance = loanAmount;
    const schedule = document.getElementById('amortizationSchedule');
    schedule.innerHTML = '';

    for (let month = 1; month <= loanTerm; month++) {
        const interestPayment = balance * interestRate;
        const principalPayment = monthlyPayment - interestPayment;
        balance -= principalPayment;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${month}</td>
            <td>${formatCurrency(monthlyPayment)}</td>
            <td>${formatCurrency(principalPayment)}</td>
            <td>${formatCurrency(interestPayment)}</td>
            <td>${formatCurrency(Math.max(0, balance))}</td>
        `;
        schedule.appendChild(row);
    }

    // Show results
    document.getElementById('results').style.display = 'block';
});

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}
</script>
@endpush
