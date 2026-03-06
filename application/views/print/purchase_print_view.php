<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Print</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <style>
        body {
            background: #fff;
            padding: 20px;
            font-family: "Segoe UI", sans-serif;
        }

        .invoice-container {
            max-width: 900px;
            margin: auto;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        @media print {
            body {
                padding: 0 !important;
                background: #fff !important;
            }
            .invoice-container {
                border: none;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<?php
// ===========================
// FETCH INVOICE DATA BY ID
// ===========================
$invoice = $this->db->select('invoices.*, accounts.name as customer_name, accounts.phone, accounts.email, accounts.address')
    ->from('invoices')
    ->join('accounts', 'accounts.id = invoices.customer_id', 'left')
    ->where('invoices.id', $invoice_id)
    ->get()
    ->row();

// ===========================
// FETCH INVOICE ITEMS
// ===========================
$items = $this->db->select('invoice_items.*, products.name as product_name')
    ->from('invoice_items')
    ->join('products', 'products.id = invoice_items.product_id', 'left')
    ->where('invoice_items.invoice_id', $invoice_id)
    ->get()
    ->result();
?>

<div class="invoice-container">

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold">YOUR BUSINESS NAME</h3>
            <p class="mb-0">Address: Your Company Address</p>
            <p class="mb-0">Phone: 000-0000000</p>
            <p class="mb-0">Email: company@email.com</p>
        </div>
        <div class="col-md-6 text-end">
            <h4 class="fw-bold text-primary">INVOICE</h4>
            <p class="mb-0"><strong>Invoice No:</strong> <?php echo $invoice->invoice_no; ?></p>
            <p class="mb-0"><strong>Date:</strong> <?php echo $invoice->entry_date; ?></p>
        </div>
    </div>

    <hr />

    <!-- Customer Information -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h6 class="fw-bold">Bill To:</h6>
            <p class="mb-0"><strong><?php echo $invoice->customer_name; ?></strong></p>
            <p class="mb-0">Phone: <?php echo $invoice->phone; ?></p>
            <p class="mb-0">Email: <?php echo $invoice->email; ?></p>
            <p class="mb-0">Address: <?php echo $invoice->address; ?></p>
        </div>
        <div class="col-md-6 text-end">
            <h6 class="fw-bold">Payment Info:</h6>
            <p class="mb-0"><strong>Payment Mode:</strong> <?php echo $invoice->payment_mode; ?></p>
            <p class="mb-0"><strong>Status:</strong> <?php echo $invoice->status; ?></p>
        </div>
    </div>

    <!-- Items Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($items as $item): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $item->product_name; ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><?php echo number_format($item->sale_price,2); ?></td>
                <td><?php echo number_format($item->discount_amount,2); ?></td>
                <td><?php echo number_format($item->tax_amount,2); ?></td>
                <td><?php echo number_format($item->grand_total,2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Totals Section -->
    <div class="row justify-content-end mt-4">
        <div class="col-md-4">
            <table class="table table-borderless">
                <tr>
                    <th class="text-end">Sub Total:</th>
                    <td class="text-end"><?php echo number_format($invoice->sub_total,2); ?></td>
                </tr>
                <tr>
                    <th class="text-end">Discount:</th>
                    <td class="text-end"><?php echo number_format($invoice->discount_amount,2); ?></td>
                </tr>
                <tr>
                    <th class="text-end">Grand Total:</th>
                    <td class="text-end fw-bold"><?php echo number_format($invoice->grand_total,2); ?></td>
                </tr>
                <tr>
                    <th class="text-end">Paid:</th>
                    <td class="text-end"><?php echo number_format($invoice->paid_amount,2); ?></td>
                </tr>
                <tr>
                    <th class="text-end">Balance:</th>
                    <td class="text-end text-danger fw-bold"><?php echo number_format($invoice->balance,2); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-5">
        <p class="mb-0">Thank you for your business!</p>
        <small>This is a computer-generated invoice and does not require a signature.</small>
    </div>

</div>

<!-- Print Button -->
<div class="text-center mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
</div>

</body>
</html>
