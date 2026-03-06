<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">

                        <!-- Heading Left -->
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Order List</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <!-- [ breadcrumb ] end -->


            <!-- Sale Items Modal -->
            <div class="modal fade" id="orderItemModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content shadow-lg" style="border-radius:12px;">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white" style="padding:10px 15px; border-top-left-radius:12px; border-top-right-radius:12px;">
                            <h5 class="modal-title w-100 text-white" style="font-size:18px; font-weight:600;">Order Items List</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body" style="padding:15px 20px;">

                            <!-- Supplier / Invoice Info -->
                            <!-- Supplier / Invoice Info (Single Row with 3 Columns) -->
                            <div class="row mb-3" style="font-size:14px; border-bottom:1px solid #ddd; padding-bottom:6px;">

                                <!-- Supplier Name -->
                                <div class="col-md-6">
                                    <strong>Customer:</strong> <span id="customer_name">Bilal Traders</span>
                                </div>

                            
                                <!-- Phone & Date -->
                                <div class="col-md-6 ">
                                    <strong>Phone:</strong> <span id="customer_phone">00-000000-00</span> |
                                    <strong>Date:</strong> <span id="sale_date">0000-00-00</span>
                                </div>

                            </div>


                            <!-- Invoice Heading -->
                            <div class="text-center mb-3">
                                <h5 class="fw-bold" style="margin:0; font-size:18px;">ORDER MANAGEMENT</h5>
                                <p style="margin:0; font-size:13px;">ORDER #: <span id="invoice_number"></span></p>
                            </div>

                            <!-- Items Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                        <tr>
                                            <th style="padding:6px;">SR#</th>
                                            <th style="padding:6px;">Deli Date</th>
                                            <th style="padding:6px;">Items</th>
                                            <th style="padding:6px;">QTY</th>
                                            <th style="padding:6px;"> Price</th>
                                            <th style="padding:6px;">Total</th>
                                            <th style="padding:6px;">Disc %</th>
                                            <th style="padding:6px;">Disc Amt</th>
                                            <th style="padding:6px;">Net Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="saleItemList">
                                        <!-- Items rows append dynamically -->
                                    </tbody>
                                    <tfoot style="font-weight:600; background:#f8f9fa;">
                                        <tr>
                                            <td colspan="8" class="text-end">Gross Amount</td>
                                            <td id="gross_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-end">Disc Amount</td>
                                            <td id="disc_amount">0.00</td>
                                        </tr>
                                        <tr style="background:#e9f7ef; color:#155724;">
                                            <td colspan="8" class="text-end">Net Total</td>
                                            <td id="net_total">0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer" style="padding:8px 15px;">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                <i class="zmdi zmdi-close me-1"></i> Close
                            </button>
                            <!-- <button type="button" class="btn btn-primary btn-sm">
                                <i class="zmdi zmdi-print me-1"></i> Print Delivery Challan
                            </button> -->
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="zmdi zmdi-file-text me-1"></i> Print Invoice
                            </button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                       
                                        <tr>
                                            <th style="width:5%;">Sr#</th>
                                            <th style="width:25%;">Customer</th>
                                            <th style="width:10%;">Order Date</th>
                                            <th style="width:10%;">Disc (%)</th>
                                            <th style="width:15%;">Disc Amount</th>
                                            <th style="width:15%;">Net Amount</th>
                                            <th style="width:25%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showOrder">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
        
            var CAN_VIEW = <?= can('orders', 'view') ? 'true' : 'false'; ?>;
            var CAN_EDIT = <?= can('orders', 'edit') ? 'true' : 'false'; ?>;
            var CAN_DELETE = <?= can('orders', 'delete') ? 'true' : 'false'; ?>;
            
            getOrderData()  
            function getOrderData() {
                if (!CAN_VIEW) {
                    $('#showOrder').html(
                        '<tr><td colspan="6" class="text-center text-danger fw-bold">' +
                        'You do not have permission to view Orders.' +
                        '</td></tr>'
                    );
                    return;
                }
                
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Order/getOrderData') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;


                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].customer_name + '</td>' +
                                '<td>' + data[i].order_date + '</td>' +
                                '<td>' + data[i].disc_percent + '</td>' +
                                '<td>' + parseFloat(data[i].disc_amount).toFixed(2) + '</td>' +
                                '<td>' + parseFloat(data[i].net_total).toFixed(2) + '</td>' +
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item_view text-info" title="View Item" data="' + data[i].order_id + '">' +
                                '<i class="zmdi zmdi-eye zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>' +

                                '</tr>';
                        }
                        $('#showOrder').html(html);

                    },
                    error: function() {
                        alert('Could not get Data from Database');
                    }
                });
            }


            $('#showOrder').on('click', '.item_view', function() {
                var id = $(this).attr('data');
                $('#orderItemModal').modal('show');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Order/getOrderItems') ?>',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var c = 0;

                        var grossAmount = 0;
                        var discAmount = 0;
                        var netAmount = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;
                            $('#customer_name').html(data[i].customer_name);
                            $('#invoice_number').html(data[i].order_id);
                            $('#invoice_no').html(data[i].order_id);
                            $('#sale_date').html(data[i].order_date);
                            $('#customer_phone').html(data[i].customer_phone);

                            var qty = parseFloat(data[i].quantity) || 0;
                            var salePrice = parseFloat(data[i].price) || 0;
                            var itemTotal = parseFloat(data[i].item_total) || 0;
                            var discPercent = parseFloat(data[i].item_disc_percent) || 0;
                            var itemDiscAmount = parseFloat(data[i].item_disc_amount) || 0;
                            var netAmount = parseFloat(data[i].item_net_amount) || 0;

                            // Totals
                            grossAmount = parseFloat(data[i].total_amount);
                            discAmount = parseFloat(data[i].disc_amount);
                            netAmount = parseFloat(data[i].net_total);

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].delivery_date + '</td>' +
                                '<td>' + data[i].item_type + '</td>' +
                                '<td>' + qty + '</td>' +
                                '<td>' + salePrice.toFixed(2) + '</td>' +
                                '<td>' + itemTotal.toFixed(2) + '</td>' +
                                '<td>' + discPercent.toFixed(2) + '%</td>' +
                                '<td>' + itemDiscAmount.toFixed(2) + '</td>' +
                                '<td>' + netAmount.toFixed(2) + '</td>' +
                                '</tr>';
                        }

                        $('#saleItemList').html(html);

                        $('#gross_amount').html(parseFloat(grossAmount).toFixed(2));
                        $('#disc_amount').html(parseFloat(discAmount).toFixed(2));
                        $('#net_total').html(parseFloat(netAmount).toFixed(2));
                    },
                    error: function() {
                        showToast('error', 'Something went wrong!');
                    }
                });
            });

            // Update button click
            $('#btnUpdateCustomer').on('click', function() {
                var formData = $('#customerForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Customer/updateCustomer') ?>',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            $('#customerModal').modal('hide');
                            showToast('success', 'Customer updated successfully!');
                            showOrder(); // reload table
                        } else {
                            // agar validation fail hua
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    showToast('warning', value); // har field ka error show karega
                                });
                            } else {
                                showToast('warning', 'Validation failed! Please check fields.');
                            }
                        }
                    },
                    error: function() {
                        showToast('error', 'Something went wrong!');
                    }
                });
            });


            $(document).ready(function() {
                let deleteId = null;
                // Jab delete icon pe click ho
                $(document).on("click", ".item-delete", function() {
                    deleteId = $(this).attr("data");
                    $("#deleteModal").modal("show");
                });

                // Jab modal me Delete button click ho
                $("#confirmDeleteBtn").click(function() {
                    if (deleteId) {
                        $.ajax({
                            url: '<?php echo base_url('Customer/delete_item') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                showToast("success", "Item deleted successfully!");
                            },
                            error: function() {
                                $("#deleteModal").modal("hide");
                                showToast("error", "Error deleting item!");
                            }
                        });
                    }
                });

            });
        </script>
</body>
<!-- [Body] end -->

</html>