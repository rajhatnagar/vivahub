<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaction['id'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #525659; }
        .invoice-container { background: white; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 15mm; }
        @media print {
            body { background: white; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="py-10">

    <div class="fixed top-4 right-4 z-50 no-print flex gap-4">
        <a href="{{ route('billing') }}" class="bg-gray-800 text-white px-4 py-2 rounded shadow font-bold text-sm">Back</a>
        <button onclick="downloadPDF()" class="bg-blue-600 text-white px-4 py-2 rounded shadow font-bold text-sm">Download PDF</button>
    </div>

    <div id="invoice" class="invoice-container shadow-2xl relative">
        <!-- Header -->
        <div class="flex justify-between items-start mb-12">
            <div>
                <img src="{{ asset('assets/logo.png') }}" alt="VivaHub" class="h-10 mb-4" onerror="this.style.display='none';this.parentElement.innerHTML='<h1 class=\'text-3xl font-bold text-red-600\'>VivaHub</h1>'">
                <h1 class="text-3xl font-bold text-primary hidden">VivaHub</h1>
            </div>
            <div class="text-right">
                <h2 class="text-4xl font-bold text-gray-200">INVOICE</h2>
                <p class="text-gray-500 font-mono mt-2">#{{ $transaction['id'] }}</p>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-2 gap-12 mb-12">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Billed To</p>
                <div class="text-sm font-medium text-gray-800">
                    <p class="font-bold text-lg text-gray-900 mb-1">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <p>India</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Invoice Details</p>
                <div class="text-sm font-medium text-gray-800">
                    <div class="flex justify-end gap-4 mb-1">
                        <span class="text-gray-500">Date Issued:</span>
                        <span>{{ $transaction['date'] }}</span>
                    </div>
                    <div class="flex justify-end gap-4 mb-1">
                        <span class="text-gray-500">Status:</span>
                        <span class="text-green-600 font-bold bg-green-50 px-2 rounded">{{ $transaction['status'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Items -->
        <div class="mb-12">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="py-3 text-xs font-bold text-gray-400 uppercase tracking-wider w-1/2">Description</th>
                        <th class="py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Qty</th>
                        <th class="py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Unit Price</th>
                        <th class="py-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr>
                        <td class="py-4">
                            <p class="font-bold text-gray-900">{{ $transaction['plan'] }} Subscription</p>
                            <p class="text-sm text-gray-500">Premium Wedding Invitation Features</p>
                        </td>
                        <td class="py-4 text-right font-medium text-gray-900">1</td>
                        <td class="py-4 text-right font-medium text-gray-900">{{ $transaction['amount'] }}</td>
                        <td class="py-4 text-right font-bold text-gray-900">{{ $transaction['amount'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="flex justify-end mb-20">
            <div class="w-1/3">
                <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-medium">{{ $transaction['amount'] }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                    <span class="text-gray-500">Tax (0%)</span>
                    <span class="font-medium">₹0</span>
                </div>
                <div class="flex justify-between py-4 text-lg font-bold text-gray-900">
                    <span>Total</span>
                    <span>{{ $transaction['amount'] }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-15 left-15 right-15 border-t border-gray-100 pt-8 text-center text-sm text-gray-400">
            <p class="mb-2">Thank you for choosing VivaHub!</p>
            <p>If you have any questions about this invoice, please contact support@vivahub.in</p>
        </div>
    </div>

    <script>
        function downloadPDF() {
            const element = document.getElementById('invoice');
            const opt = {
                margin:       0,
                filename:     'Invoice_{{ $transaction["id"] }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Use html2pdf to generate and save
            html2pdf().set(opt).from(element).save();
        }

        // Auto-download only if parameter present, else just show
        // User workflow: Click Download -> Opens this page -> User sees it -> Can manual download or auto?
        // Let's auto-trigger after a short delay for smooth UX? 
        // Better: Wait for user to click button in header, or trigger logic
        
        window.onload = function() {
             // Optional: Uncomment to auto-download
             // setTimeout(downloadPDF, 1000);
        }
    </script>
</body>
</html>
