<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">

                        <!-- Heading Left -->
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Payment List</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Payment</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Payment List</h5>
                        </div>
                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>#</th>
                                        <th>Order#</th>
                                        <th>Customer</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th class="no-print">Action</th>
                                    </tr>

                                </thead>
                                <tbody id="showPayments">
                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="paidListModal" tabindex="-1" aria-labelledby="paidListModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="paidListModalLabel">
                                Payment List
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>#</th>
                                        <th>Order#</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Remarks</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody id="showPaymentList">
                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            getPayments();

            function getPayments() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Payment/getPayments') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' +
                                '<strong>Order#: </strong>' + data[i].order_no + '<br>' +
                                '<strong>Date: </strong>' + data[i].order_date +
                                '</td>' +
                                '<td>' + data[i].customer_name + '</td>' +

                                /* Discount Column */
                                '<td>' +
                                '<strong>Disc: </strong>' + data[i].disc_percent + '% <br>' +
                                '<strong>DiscAmt: </strong>' + parseFloat(data[i].disc_amount).toFixed(2) +
                                '</td>' +

                                '<td>' +
                                '<strong>Total: </strong>' + parseFloat(data[i].total_amount).toFixed(2) + '<br>' +
                                '<strong>Net Amt: </strong>' + parseFloat(data[i].net_total).toFixed(2) +
                                '</td>' +

                                /* Amount Column */
                                '<td>' +
                                'Advance: ' + parseFloat(data[i].advance).toFixed(2) + '<br>' +
                                'Balance: ' + parseFloat(data[i].balance).toFixed(2) +
                                '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item-view text-info me-2" title="View" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-eye zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>'

                            '</tr>';
                        }


                        $('#showPayments').html(html);
                    },
                    error: function() {
                        alert('Could not fetch customer data.');
                    }
                });
            }



            $(document).ready(function() {
                $('#showPayments').on('click', '.item-view', function() {

                    var id = $(this).attr('data');

                    if (id > 0) {
                        $('#paidListModal').modal('show');
                    } else {
                        showToast('warning', 'Order ID cannot be Null');
                        return;
                    }

                    $.ajax({
                        type: 'GET',
                        url: '<?php echo base_url('Payment/getPaymentList') ?>/' + id,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            $('#paymentTableBody').html('');

                            if (data.length > 0) {

                                $.each(data, function(index, row) {

                                    html += '<tr>' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td>' + row.order_id + '</td>' +
                                        '<td>' + row.amount + '</td>' +
                                        '<td>' + row.method + '</td>' +
                                        '<td>' + (row.remarks ? row.remarks : '') + '</td>' +
                                        '<td>' + row.created_at + '</td>' +
                                        '</tr>';
                                });

                            } else {

                                html += '<tr>' +
                                    '<td colspan="5" class="text-center text-danger">' +
                                    'No payments found' +
                                    '</td>' +
                                    '</tr>';
                            }

                            $('#showPaymentList').html(html);
                        },
                        error: function() {
                            showToast('Error', 'Could not fetch payment details', 'error');
                        }
                    });
                });

            });
        </script>
</body>
<!-- [Body] end -->

</html>