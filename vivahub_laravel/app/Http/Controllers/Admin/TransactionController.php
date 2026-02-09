<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Get transactions with user details
        $transactions = Transaction::with(['user', 'plan'])->latest()->paginate(20);
        
        // Payment Statistics
        $stats = [
            'total_payments' => Transaction::count(),
            'total_amount' => Transaction::sum('amount'),
            'successful' => [
                'count' => Transaction::whereIn('status', ['paid', 'success'])->count(),
                'amount' => Transaction::whereIn('status', ['paid', 'success'])->sum('amount'),
            ],
            'pending' => [
                'count' => Transaction::where('status', 'pending')->count(),
                'amount' => Transaction::where('status', 'pending')->sum('amount'),
            ],
            'failed' => [
                'count' => Transaction::whereIn('status', ['failed', 'cancelled'])->count(),
                'amount' => Transaction::whereIn('status', ['failed', 'cancelled'])->sum('amount'),
            ],

            'today' => [
                'count' => Transaction::whereDate('created_at', today())->count(),
                'amount' => Transaction::whereDate('created_at', today())->sum('amount'),
            ],
            'this_month' => [
                'count' => Transaction::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
                'amount' => Transaction::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount'),
            ],
        ];
        
        return view('admin.transactions.index', compact('transactions', 'stats'));
    }
}
