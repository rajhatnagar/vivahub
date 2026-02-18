<?php
$partner = App\Models\PartnerDetail::first();
if ($partner) {
    try {
        $partner->invoices()->create([
            'invoice_number' => 'TEST-GST-001',
            'amount' => 1180,
            'description' => 'Test Plan with GST',
            'status' => 'Paid',
            'date' => now()
        ]);
        echo "Invoice TEST-GST-001 Created Successfully\n";
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "No Partner Found\n";
}
exit();
