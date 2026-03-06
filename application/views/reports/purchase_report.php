<?php $this->load->view('layout/header'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Purchase Report</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                                <li class="breadcrumb-item active">Purchase Report</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-primary fw-semibold mb-0">
                            <i class="fa-solid fa-chart-line me-2"></i> Purchase Report Overview
                        </h5>
                        <button class="btn btn-dark btn-sm" id="btnRefresh">
                            <i class="fa-solid fa-rotate me-1"></i> Refresh
                        </button>
                    </div>

                    <!-- Filters -->
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Supplier</label>
                            <select class="form-control form-control-sm" id="supplier_id" name="supplier_id" onchange="showCurrentSaleItems();">
                                <option value="">Select Supplier</option>
                                <?php
                                $qry = $this->db->query("select * from accounts where is_deleted=0 and type = 'Supplier'");
                                $resForDD = $qry->result();
                                foreach ($resForDD as $row) {
                                    echo "<option value='$row->id'>$row->name</option>";
                                }
                                ?>
                            </select>
                            <small class="text-danger error-supplier_id"></small>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control form-control-sm" id="from_date"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control form-control-sm" id="to_date"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button class="btn btn-dark btn-sm w-100" id="btnSearch">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> View
                            </button>
                            <button class="btn btn-secondary btn-sm w-100">
                                <i class="fa-solid fa-file-excel me-1"></i> Export
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse;">
                            <thead class="table-light">
                                <tr style="padding:2px !important;">
                                    <th style="padding:2px 4px !important;">#</th>
                                    <th style="padding:2px 4px !important;">Date</th>
                                    <th style="padding:2px 4px !important;">Purchase No</th>
                                    <th style="padding:2px 4px !important;">Supplier</th>
                                    <th style="padding:2px 4px !important;">Total</th>
                                    <th style="padding:2px 4px !important;">Discount</th>
                                    <th style="padding:2px 4px !important;">Balance</th>
                                </tr>
                            </thead>
                            <tbody id="showPurchaseReport"></tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {

            // Search Button Click
            $('#btnSearch').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var supplier_id = $('#supplier_id').val();

                $.ajax({
                    url: "<?= base_url('reports/getPurcahseReport') ?>",
                    type: "POST",
                    data: {
                        supplier_id: supplier_id,
                        from_date: from_date,
                        to_date: to_date
                    },
                    dataType: "json",
                    success: function(response) {
                        var html = '';
                        var total = 0,
                            total_amount = 0;

                        if (response.length > 0) {
                            $.each(response, function(i, row) {
                                html += `<tr>
                                    <td>${i + 1}</td>
                                    <td>${row.purchase_date}</td>
                                    <td>${row.id}</td>
                                    <td>${row.customer_name}</td>
                                    <td>${parseFloat(row.total).toFixed(2)}</td>
                                    <td>
                                        <strong>Disc%:</strong> ${parseFloat(row.discount_percent).toFixed(2)} 
                                        <strong> | Disc Amount:</strong> ${parseFloat(row.discount_amount).toFixed(2)}
                                    </td>

                                    <td>${parseFloat(row.total_amount).toFixed(2)}</td>
                                </tr>`;

                                total += parseFloat(row.total || 0);
                                total_amount += parseFloat(row.total_amount || 0);
                            });

                            // Add Subtotal Row
                            html += `<tr class="fw-bold table-secondary">
                                <td colspan="4" class="text-end">Subtotal:</td>
                                <td>${total.toFixed(2)}</td>
                                <td></td>
                                <td>${total_amount.toFixed(2)}</td>
                            </tr>`;
                        } else {
                            html = `<tr><td colspan="7" class="text-center text-danger">No Record Found</td></tr>`;
                        }

                        $('#showPurchaseReport').html(html);
                    }

                });
            });

            // Refresh Button
            $('#btnRefresh').click(function() {
                $('#from_date').val('<?= date("Y-m-01") ?>');
                $('#to_date').val('<?= date("Y-m-d") ?>');
                $('#report_type').val('');
                $('#showPurchaseReport').html('');
            });
        });
    </script>

    <?php $this->load->view('layout/footer'); ?>
</body>

</html>