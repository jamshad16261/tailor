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
                                <h4 class="mb-0">Order Status Management</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Order Status</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Status Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            $user = $this->session->userdata('business_id');
            ?>

            <!-- [ breadcrumb ] end -->

            <div class="modal fade" id="statusHistory" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content shadow-lg" style="border-radius:12px;">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white" style="padding:10px 15px; border-top-left-radius:12px; border-top-right-radius:12px;">
                            <h5 class="modal-title w-100 text-white" style="font-size:18px; font-weight:600;">Order Items History</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body" style="padding:15px 20px;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                        <tr>
                                            <th style="padding:6px;">Order#</th>
                                            <th style="padding:6px;">Status</th>
                                            <th style="padding:6px;">Remarks</th>
                                            <th style="padding:6px;"> Updated By</th>
                                            <th style="padding:6px;">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order_status_history">

                                    </tbody>

                                </table>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Order Status</h5>
                        </div>
                        <div class="card-body">

                            <!-- 🔍 SEARCH CUSTOMER -->

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Customer</label>
                                    <select class="form-control form-control-sm" name="searchCustomer" id="searchCustomer">
                                        <option value="">Select Customer</option>
                                        <!-- Loop through customers in PHP -->
                                        <?php
                                        $customers = $this->db->query("SELECT * FROM customers WHERE is_deleted = 0")->result();
                                        foreach ($customers as $customer) {
                                            echo "<option value='{$customer->id}'>{$customer->phone}</option>";
                                        }
                                        ?>
                                    </select>
                                    <small class="text-danger error-searchCustomer"></small>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary btn-sm w-100" id="btnSearch">
                                        <i class="fa-solid fa-magnifying-glass me-1"></i> Generate Order Status
                                    </button>
                                </div>
                            </div>


                            <div class="" style="margin-top: 2rem;">
                                <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%; margin-top:2rem;" id="supplierTable" style="display:none;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                        <tr>
                                            <th>Order No</th>
                                            <th>Customer</th>
                                            <th>Current Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order_status"></tbody>
                                </table>

                            </div>


                            <hr>

                            <!-- ⭐ ORDER STATUS UPDATE FORM -->
                            <form id="OrderStatusForm" style="display:none;">
                                <div class="row g-3">

                                    <!-- Order Number -->
                                    <div class="col-md-3">
                                        <label class="form-label">Order Number</label>
                                        <input class="form-control form-control-sm" type="text" name="order_no" readonly>
                                    </div>

                                    <!-- Customer Name -->
                                    <div class="col-md-3">
                                        <label class="form-label">Customer</label>
                                        <input class="form-control form-control-sm" type="text" name="customer" readonly>
                                    </div>

                                    <!-- Current Status -->
                                    <div class="col-md-3">
                                        <label class="form-label">Current Status</label>
                                        <input class="form-control form-control-sm" type="text" name="current_status" readonly>
                                    </div>

                                    <!-- Update Status -->

                                    <?php
                                    $role = $this->session->userdata('role');
                                    $allowedStatus = [];

                                    if ($role == 'admin') {
                                        $allowedStatus = ['pending', 'cutting', 'sewing', 'finishing', 'ready', 'delivered', 'cancelled'];
                                    } else if ($role == 'tailor') {
                                        $allowedStatus = ['cutting', 'sewing', 'finishing', 'ready'];
                                    } else if ($role == 'delivery') {
                                        $allowedStatus = ['ready', 'delivered'];
                                    } else if ($role == 'receptionist') {
                                        $allowedStatus = ['pending', 'cancelled'];
                                    }

                                    ?>
                                    <div class="col-md-3">
                                        <label class="form-label">Update Status</label>
                                        <select class="form-select form-select-sm" name="new_status">
                                            <option value="">Select New Status</option>

                                            <?php foreach ($allowedStatus as $s): ?>
                                                <option value="<?= $s ?>"><?= ucfirst($s) ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>


                                    <!-- Remarks -->
                                    <div class="col-md-10">
                                        <label class="form-label">Remarks</label>
                                        <input class="form-control form-control-sm" type="text" name="remarks" placeholder="Add remark (optional)">
                                    </div>

                                    <!-- Submit button -->
                                    <div class="col-md-2">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button type="submit" id="btnUpdate" class="btn btn-primary btn-sm w-100">
                                            Update Status
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
            // 🔍 Search Orders
            $("#btnSearch").click(function() {
                let customer_id = $("#searchCustomer").val();

                // if (name.length < 2) {
                //     showToast("warning", "Please enter at least 2 characters.");
                //     return;
                // }

                $.ajax({
                    url: "<?php echo base_url('Order/searchCustomerOrders') ?>",
                    type: "POST",
                    data: {
                        customer_id: customer_id
                    },
                    dataType: "json",
                    success: function(res) {

                        let html = "";
                        $.each(res, function(i, row) {

                            html += "<tr class='selectOrder'>" +
                            
                                "<td>" + row.order_no + "</td>" +
                                "<td>" + row.customer_name + "</td>" +
                                "<td>" + row.status + "</td>" +

                                "<td>" +

                                // ---- View Button With Data Attributes ----
                                "<button class='btn btn-sm btn-outline-primary viewBtn' " +
                                "data-order_id='" + row.order_id + "' " +
                                "data-order_no='" + row.order_no + "' " +
                                "data-customer='" + row.customer_name + "' " +
                                "data-status='" + row.status + "' " +
                                "style='margin-right:5px;'>" +
                                "<i class='fa fa-eye'></i> View" +
                                "</button>" +

                                // ---- History Button With Data Attributes ----
                                "<button class='btn btn-sm btn-outline-warning historyBtn' " +
                                "data-order_id='" + row.order_id + "'>" +
                                "<i class='fa fa-history'></i> History" +
                                "</button>" +

                                "</td>" +
                                "</tr>";
                        });


                        $("#order_status").html(html);
                        $("#supplierTable").show();
                    }

                });
            });


            $(document).on("click", ".viewBtn", function() {

                let order_id = $(this).data("order_id");
                let order_no = $(this).data("order_no");
                let customer = $(this).data("customer");
                let status = $(this).data("status");

                $("input[name=order_no]").val(order_no);
                $("input[name=customer]").val(customer);
                $("input[name=current_status]").val(status);

                $("#OrderStatusForm").show();

                $("html, body").animate({
                    scrollTop: $("#OrderStatusForm").offset().top - 100
                }, 400);
            });

                $(document).on("click", ".historyBtn", function() {
                    var order_id = $(this).data("order_id");
                    $('#statusHistory').modal('show');
                    $.ajax({
                        url: "<?php echo base_url('Order/getOrderHistory') ?>",
                        type: "POST",
                        data: {
                            order_id: order_id
                        },
                        dataType: "json",
                        success: function(res) {
                            let html = "";
                            $.each(res, function(i, row) {
                                html += "<tr>" +
                                    "<td>" + row.order_id + "</td>" +
                                    "<td>" + row.status + "</td>" +
                                    "<td>" + row.remarks + "</td>" +
                                    "<td>" + row.updated_by_name + "</td>" +
                                    "<td>" + row.created_at + "</td>" +
                                    "</tr>";
                            });
                            $("#order_status_history").html(html);
                            $("#supplierTable").show();
                        }

                    });
                });


            $("#OrderStatusForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url('Order/updateOrderStatus'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(msg) {
                        showToast("success", "Status updated successfully!");
                    }
                });
            });
        </script>
</body>
<!-- [Body] end -->

</html>