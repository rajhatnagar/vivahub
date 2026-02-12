<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-{{ $invoice->invoice_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            margin: 0;
            padding: 40px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
        }

        .status-badge {
            background-color: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-unpaid {
            background-color: #fef9c3;
            color: #854d0e;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .col {
            flex: 1;
        }

        .col-right {
            text-align: right;
        }

        h3 {
            font-size: 14px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 8px;
            letter-spacing: 0.05em;
        }

        p {
            margin: 0;
            font-size: 15px;
            color: #374151;
            line-height: 1.5;
        }

        .table-container {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 0;
            border-bottom: 2px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }

        td {
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
        }

        .total-box {
            width: 300px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            color: #6b7280;
        }

        .row.final {
            font-size: 18px;
            font-weight: 800;
            color: #111827;
            border-top: 2px solid #e5e7eb;
            margin-top: 8px;
            padding-top: 16px;
        }

        .footer {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: transform 0.2s;
        }

        .print-btn:hover {
            transform: translateY(-2px);
        }

        @media print {
            body { 
                background: white; 
                padding: 0; 
            }
            .invoice-container { 
                box-shadow: none; 
                max-width: 100%; 
                margin: 0; 
                padding: 20px; 
            }
            .print-btn { 
                display: none; 
            }
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="header">
            <div class="logo">VivaHub</div>
            <div>
                <span class="status-badge {{ $invoice->status !== 'Paid' ? 'status-unpaid' : '' }}">
                    {{ $invoice->status }}
                </span>
            </div>
        </div>

        <div class="invoice-details">
            <div class="col">
                <h3>Billed To</h3>
                <p><strong>{{ $partner->agency_name ?? $user->name }}</strong></p>
                <p>{{ $user->email }}</p>
                @if($partner->gst_number)
                <p>GST: {{ $partner->gst_number }}</p>
                @endif
                @if($partner->billing_address)
                <p>{!! nl2br(e($partner->billing_address)) !!}</p>
                @endif
            </div>
            <div class="col col-right">
                <h3>Invoice Details</h3>
                <p><strong>Invoice #:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Date:</strong> {{ $invoice->date->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60%">Description</th>
                        <th style="text-align: right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ $invoice->description }}</strong>
                            <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">Premium Credits Purchase</p>
                        </td>
                        <td style="text-align: right">₹{{ number_format($invoice->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-box">
                <div class="row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($invoice->amount, 2) }}</span>
                </div>
                <div class="row">
                    <span>Tax (0%)</span>
                    <span>₹0.00</span>
                </div>
                <div class="row final">
                    <span>Total</span>
                    <span>₹{{ number_format($invoice->amount, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>VivaHub Inc. • 123 Wedding Lane, Tech City • support@vivahub.in</p>
        </div>
    </div>

    <button onclick="window.print()" class="print-btn">Download / Print PDF</button>

    <script>
        // Auto-print on load if query param set, or just let user click
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
