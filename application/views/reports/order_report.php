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
                                <h4 class="mb-0">Order Report</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                                <li class="breadcrumb-item active">Order Report</li>
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
                            <i class="fa-solid fa-chart-line me-2"></i> Orders Report Overview
                        </h5>
                        <button class="btn btn-dark btn-sm" id="btnRefresh">
                            <i class="fa-solid fa-rotate me-1"></i> Refresh
                        </button>
                    </div>

                    <!-- Filters -->
                    <div class="row g-2 align-items-end">

                        <!-- Customer -->
                        <div class="col-md-3">
                            <label class="form-label">Customer</label>
                            <select class="form-select form-select-sm"
                                id="customer_id"
                                name="customer_id">
                                <option value="">All Customers</option>
                                <?php
                                $bId = $_SESSION['business_id'];
                                $qry = $this->db->query("SELECT id, name FROM customers WHERE is_deleted = 0 AND business_id = $bId ORDER BY name ASC");
                                foreach ($qry->result() as $row) {
                                    echo "<option value='{$row->id}'>{$row->name}</option>";
                                }
                                ?>
                            </select>
                            <small class="text-danger error-customer_id"></small>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-2">
                            <label class="form-label">Start Date</label>
                            <input type="date"
                                class="form-control form-control-sm"
                                id="start_date"
                                name="start_date"
                                value="<?= date('Y-m-d') ?>">
                            <small class="text-danger error-start_date"></small>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-2">
                            <label class="form-label">End Date</label>
                            <input type="date"
                                class="form-control form-control-sm"
                                id="end_date"
                                name="end_date"
                                value="<?= date('Y-m-d') ?>">
                            <small class="text-danger error-end_date"></small>
                        </div>

                        <!-- Order Status -->
                        <div class="col-md-2">
                            <label class="form-label">Order Status</label>
                            <select class="form-select form-select-sm"
                                id="status"
                                name="status">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="cutting">Cutting</option>
                                <option value="stitching">Stitching</option>
                                <option value="ready">Ready</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-1 d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm w-100" id="btnSearch">
                                <i class="fa-solid fa-magnifying-glass me-1"></i> View
                            </button>
                        </div>
                        
                        <div class="col-md-1 d-flex gap-2">
                            <button type="button" class="btn btn-danger btn-sm w-100" id="btnPdf">
                                <i class="fa-solid fa-file-pdf me-1"></i> PDF
                            </button>
                        </div>
                        
                        <div class="col-md-1 d-flex gap-2">
                            <button type="button" class="btn btn-warning btn-sm w-100" id="btnExport">
                                <i class="fa-solid fa-file-excel me-1"></i>Xls
                            </button>
                        </div>

                    </div>


                    <!-- Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse;">
                            <thead class="table-light">
                                <tr style="padding:2px !important;">
                                    <th style="padding:2px 4px !important;">#</th>
                                    <th style="padding:2px 4px !important;">Order #</th>
                                    <th style="padding:2px 4px !important;">Customer</th>
                                    <th style="padding:2px 4px !important;">Order Date</th>
                                    <th style="padding:2px 4px !important;">Delivery Date</th>
                                    <th style="padding:2px 4px !important;">Total</th>
                                    <th style="padding:2px 4px !important;">Advance</th>
                                    <th style="padding:2px 4px !important;">Balance</th>
                                    <th style="padding:2px 4px !important;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="showOrdersReport"></tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
    
            $('#btnExport').click(function() {
            let table = document.querySelector('table').outerHTML;
            let a = document.createElement('a');
            a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(table);
            a.download = 'Order Report.xls';
            a.click();
        });
        $('#btnPdf').click(() => {
            html2pdf(document.querySelector('.table-responsive'), {
                filename: 'Order Report.pdf',
                margin: 10,
                pagebreak: {
                    mode: ['avoid-all']
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'landscape'
                }
            });
        });
        
        $(document).ready(function() {

            // Search Button Click
            $('#btnSearch').on('click', function() {

                let from_date = $('#start_date').val();
                let to_date = $('#end_date').val();
                let customer_id = $('#customer_id').val();
                let status = $('#status').val();

                if (from_date && to_date && from_date > to_date) {
                    alert('Start Date must be less than End Date..!');
                    return;
                }

                $.ajax({
                    url: "<?= base_url('Reports/getOrdersReport') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        customer_id: customer_id,
                        from_date: from_date,
                        to_date: to_date,
                        status: status
                    },
                    success: function(response) {

                        let html = '';
                        let c = 0;

                        if (response.status && response.data.length > 0) {

                            $.each(response.data, function(i, row) {
                                c++;

                                html += `<tr>
                        <td>${c}</td>
                        <td>${row.order_no}</td>
                        <td>${row.customer_name}</td>
                        <td>${row.order_date}</td>
                        <td>${row.delivery_date}</td>
                        <td class="text-end">${parseFloat(row.net_total).toFixed(2)}</td>
                        <td class="text-end">${parseFloat(row.advance).toFixed(2)}</td>
                        <td class="text-end">${parseFloat(row.balance).toFixed(2)}</td>
                        <td>
                            <span class="badge bg-${row.status_class}">
                                ${row.status}
                            </span>
                        </td>
                    </tr>`;
                            });

                        } else {
                            html = `<tr>
                    <td colspan="9" class="text-center text-danger">
                        No Orders Found
                    </td>
                </tr>`;
                        }

                        $('#showOrdersReport').html(html);
                    }
                });
            });


            // Refresh Button
            $('#btnRefresh').click(function() {
                $('#from_date').val('<?= date("Y-m-01") ?>');
                $('#to_date').val('<?= date("Y-m-d") ?>');
                $('#report_type').val('');
                $('#showOrdersReport').html('');
            });
        });
    </script>

    <?php $this->load->view('layout/footer'); ?>
</body>

</html>