<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        if ($request->query('export') === 'csv') {
            $query = Transaction::with(['user', 'plan'])->latest();
            if ($status) {
                $query->where('status', $status);
            }
            $transactions = $query->get();

            $filename = "transactions_export_" . date('Y-m-d') . ".csv";
            $headers = [
                "Content-Type" => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename=\"$filename\"",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $columns = ['ID', 'User Name', 'User Email', 'Plan', 'Amount', 'Payment ID', 'Gateway', 'Status', 'Date'];

            $callback = function() use($transactions, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, "\xEF\xBB\xBF");
                fputcsv($file, $columns);

                foreach ($transactions as $t) {
                    fputcsv($file, [
                        $t->id,
                        $t->user->name ?? 'Unknown',
                        $t->user->email ?? '-',
                        $t->plan->name ?? 'N/A',
                        $t->amount,
                        $t->transaction_id ?? '-',
                        $t->gateway,
                        ucfirst($t->status),
                        $t->created_at->format('Y-m-d H:i:s')
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Get transactions with user details
        $query = Transaction::with(['user', 'plan'])->latest();
        if ($status) {
            $query->where('status', $status);
        }
        $transactions = $query->paginate(20);
        
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
