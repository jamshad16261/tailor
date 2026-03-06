
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
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
                                <h4 class="mb-0">Payment</h4>
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
                            <h5>Payment</h5>
                        </div>
                        <div class="card-body">
                            <form id="PaymentForm">

                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <label class="form-label">Order #</label>

                                        <?php
                                        $bId = $_SESSION['business_id'];
                                        $query = $this->db->query("SELECT o.id , o.order_no ,c.id AS customer_id, c.name AS customerName FROM orders AS o, 
                                        customers AS c WHERE o.is_deleted = 0 AND o.business_id = $bId AND o.business_id = c.business_id AND o.customer_id = c.id;")->result();
                                        ?>

                                    <select name="order_id" id="order_id" class="form-control form-control-sm">
                                        <option value="">Select Order</option>

                                        <?php foreach ($query as $row) { ?>
                                            <option value="<?php echo $row->id; ?>">
                                                <?php echo $row->order_no . ' - ' . $row->customerName; ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                        <small class="text-danger error-order_id"></small>

                                    </div>


                                    <div class="col-md-2">
                                        <label class="form-label">Balance</label>
                                        <input type="number" class="form-control form-control-sm" name="balance" id="balance" placeholder="0.00">
                                        <small class="text-danger error-balance"></small>

                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Payment Amount</label>
                                        <input type="number" class="form-control form-control-sm" name="payment_amount" id="payment_amount" placeholder="0.00">
                                        <small class="text-danger error-payment_amount"></small>

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Remaining Balance</label>
                                        <input type="text" id="remaining_balance" name="remaining_balance" class="form-control form-control-sm" placeholder="0.00" readonly>
                                        <small class="text-danger error-remaining_balance"></small>

                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Payment Method</label>
                                        <select class="form-select form-select-sm" name="method">
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="online">Online</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Entry Date</label>
                                        <input type="date" class="form-control form-control-sm"name="entry_date" id="entry_date" value="<?php echo date('Y-m-d')?>">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control form-control-sm"name="remarks" placeholder="Optional notes">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button class="btn btn-primary btn-sm w-100">
                                            Save Payment
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>


        </div>


        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            $(document).ready(function() {

                $('#order_id').change(function() {

                    let order_id = $(this).val();
                    if (order_id == '') return;

                    $.ajax({
                        url: "<?= base_url('Payment/getOrderBalance') ?>",
                        type: "POST",
                        data: {
                            order_id: order_id
                        },
                        dataType: "json",
                        success: function(res) {
                            $('#balance').val(res.balance);
                            $('#remaining_balance').val(res.balance);
                            $('#amount').val('');
                        }
                    });
                });

                // Amount type karte hi remaining balance update
                $('#payment_amount').on('keyup change', function() {

                    let balance = parseFloat($('#balance').val()) || 0;
                    let amount = parseFloat($(this).val()) || 0;

                    let remaining = balance - amount;

                    if (remaining < 0) {
                        remaining = 0;
                    }

                    $('#remaining_balance').val(remaining.toFixed(2));
                });


                $("#PaymentForm").on("submit", function(e) {
                    e.preventDefault();
                    $('#btnSave').attr('disabled', true);

                    $.ajax({
                        url: "<?php echo base_url('Payment/savePayment'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            $(".text-danger").html("");

                            if (response.status == "error") {
                                $.each(response.errors, function(key, val) {
                                    $(".error-" + key).html(val);
                                });
                                showToast("warning", "Please fill all required fields!");
                            } else if (response.status == "success") {
                                $("#PaymentForm")[0].reset();
                                showToast("success", "Payment saved successfully!");
                            }

                            $('#btnSave').attr('disabled', false);
                        }
                    });

                });




            });
        </script>
</body>
<!-- [Body] end -->

</html>