<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanCalculatorController extends Controller
{
    public function index()
    {
        return view('loans.calculator');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'carPrice' => 'required|numeric|min:0',
            'downPayment' => 'required|numeric|min:0',
            'loanTerm' => 'required|integer|min:12|max:84',
            'interestRate' => 'required|numeric|min:0|max:30',
            'salesTax' => 'nullable|numeric|min:0|max:15',
        ]);

        $carPrice = $request->carPrice;
        $downPayment = $request->downPayment;
        $loanTerm = $request->loanTerm;
        $interestRate = $request->interestRate / 100 / 12; // Convert to monthly rate
        $salesTax = ($request->salesTax ?? 0) / 100;

        $salesTaxAmount = $carPrice * $salesTax;
        $totalPrice = $carPrice + $salesTaxAmount;
        $loanAmount = $totalPrice - $downPayment;
        
        // Calculate monthly payment
        $monthlyPayment = ($loanAmount * $interestRate * pow(1 + $interestRate, $loanTerm)) / 
                         (pow(1 + $interestRate, $loanTerm) - 1);

        // Calculate total interest
        $totalInterest = ($monthlyPayment * $loanTerm) - $loanAmount;

        return response()->json([
            'monthlyPayment' => $monthlyPayment,
            'totalInterest' => $totalInterest,
            'totalCost' => $totalPrice + $totalInterest,
            'loanAmount' => $loanAmount,
            'salesTaxAmount' => $salesTaxAmount
        ]);
    }
}
