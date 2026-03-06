
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
                                <h4 class="mb-0">Tailor</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Search ORder</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Task Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            $user = $this->session->userdata('business_id');
            ?>

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Search Order</h5>
                        </div>
                        <div class="card-body">

                            <form id="TailorWorkForm">

                                <div class="row g-3">

                                    <!-- Order -->
                                    <div class="col-md-3">
                                        <label class="form-label">Order</label>
                                        <select class="form-control form-control-sm"
                                            name="order_id"
                                            id="order_id"
                                            onchange="getOrderItemsByOrder();">
                                            <option value="">Select Order</option>
                                            <?php
                                            $orders = $this->db->query("SELECT id, order_no FROM orders  WHERE is_deleted = 0")->result();
                                            foreach ($orders as $o) {
                                                echo "<option value='{$o->id}'>{$o->order_no}</option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="text-danger error-order_id"></small>
                                    </div>

                                    <!-- Order Item -->
                                    <div class="col-md-3">
                                        <label class="form-label">Order Item</label>
                                        <select class="form-control form-control-sm"
                                            name="order_item_id"
                                            id="order_item_id"
                                            onchange="getOrderItemDetails();">
                                            <option value="">Select Item</option>
                                        </select>
                                        <small class="text-danger error-order_item_id"></small>
                                    </div>

                                    <!-- Tailor -->
                                    <div class="col-md-3">
                                        <label class="form-label">Tailor</label>
                                        <select class="form-control form-control-sm"
                                            name="tailor_id"
                                            id="tailor_id">
                                            <option value="">Select Tailor</option>
                                            <?php
                                            $bId = $this->session->userdata('business_id');
                                            $tailors = $this->db->query("SELECT id, name FROM users WHERE is_deleted = 0 and business_id = $bId and role = 'tailor' ")->result();
                                            foreach ($tailors as $t) {
                                                echo "<option value='{$t->id}'>{$t->name}</option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="text-danger error-tailor_id"></small>
                                    </div>

                                    <!-- Work Type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Work Type</label>
                                        <select class="form-control form-control-sm"
                                            name="work_type"
                                            id="work_type">
                                            <option value="Stitching">Stitching</option>
                                            <option value="Cutting">Cutting</option>
                                            <option value="Embroidery">Embroidery</option>
                                        </select>
                                    </div>

                                    <!-- Qty -->
                                    <div class="col-md-2">
                                        <label class="form-label">Qty</label>
                                        <input type="number"
                                            class="form-control form-control-sm"
                                            name="qty"
                                            id="qty"
                                            value="1"
                                            min="1">
                                        <small class="text-danger error-qty"></small>
                                    </div>

                                    <!-- Rate -->
                                    <div class="col-md-2">
                                        <label class="form-label">Price</label>
                                        <input type="number"
                                            class="form-control form-control-sm"
                                            name="price"
                                            id="price"
                                            placeholder="0.00"
                                            step="0.01">
                                        <small class="text-danger error-rate"></small>
                                    </div>

                                    <!-- Total -->
                                    <div class="col-md-2">
                                        <label class="form-label">Total</label>
                                        <input type="number"
                                            class="form-control form-control-sm"
                                            name="total"
                                            id="total"
                                            placeholder="0.00"
                                            readonly>
                                    </div>

                                    <!-- Assign Date -->
                                    <div class="col-md-3">
                                        <label class="form-label">Assign Date</label>
                                        <input type="date"
                                            class="form-control form-control-sm"
                                            name="assign_date"
                                            id="assign_date"
                                            value="<?= date('Y-m-d') ?>">
                                    </div>

                                    <!-- Expected Date -->
                                    <div class="col-md-3">
                                        <label class="form-label">Expected Date</label>
                                        <input type="date"
                                            class="form-control form-control-sm"
                                            name="expected_date"
                                            id="expected_date">
                                            <small class="text-danger error-expected_date"></small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control form-control-sm"
                                            name="status"
                                            id="status">
                                            <option value="Pending">Pending</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-md-6">
                                        <label class="form-label">Remarks</label>
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            name="remarks"
                                            id="remarks"
                                            placeholder="Optional notes">
                                    </div>

                                    <!-- Save -->
                                    <div class="col-md-3">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button type="submit"
                                            class="btn btn-primary btn-sm w-100">
                                            Assign Work
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>


            <!-- jQuery CDN (latest 3.x version) -->
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <script>
                function getOrderItemsByOrder() {
                    var order_id = $('#order_id').val();

                    if (order_id == '') {
                        $('#order_item_id').html('<option value="">Select Item</option>');
                        return;
                    }

                    $.ajax({
                        url: "<?php echo base_url('Tailor/getOrderItemsByOrder'); ?>",
                        type: "POST",
                        data: {
                            order_id: order_id
                        },
                        dataType: "json",
                        success: function(response) {
                            var options = '<option value="">Select Item</option>';

                            if (response.status === 'success') {
                                $.each(response.data, function(i, item) {
                                    options += '<option value="' + item.id + '">' + item.item_type + '</option>';
                                });
                            }

                            $('#order_item_id').html(options);
                        }
                    });
                }

                function getOrderItemDetails() {
                    var order_item_id = $('#order_item_id').val();

                    if (order_item_id == '') {
                        $('#qty').val('');
                        $('#rate').val('');
                        $('#total').val('');
                        return;
                    }

                    $.ajax({
                        url: "<?php echo base_url('Tailor/getOrderItemDetails'); ?>",
                        type: "POST",
                        data: {
                            order_item_id: order_item_id
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.status === 'success') {
                                $('#qty').val(response.data.quantity);
                                $('#price').val(response.data.price);
                                $('#total').val(response.data.quantity * response.data.price);
                            }
                        }
                    });
                }

                $('#qty, #price').on('input', function() {
                    var qty = parseFloat($('#qty').val()) || 0;
                    var price = parseFloat($('#price').val()) || 0;
                    $('#total').val(qty * price);
                });

                $(document).ready(function() {
                    $("#TailorWorkForm").on("submit", function(e) {
                        e.preventDefault();
                        $('#btnSave').attr('disabled', true); // Disable the button to prevent multiple submissions

                        $.ajax({
                            url: "<?php echo base_url('Tailor/saveAssignWork'); ?>", // Ensure the URL is correct
                            type: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                $(".text-danger").html(""); // Clear previous error messages

                                if (response.status == "error") {
                                    // Display errors returned from the controller
                                    $.each(response.errors, function(key, val) {
                                        $(".error-" + key).html(val);
                                    });
                                    showToast("warning", "Please fill all required fields!"); // Toast notification
                                } else if (response.status == "success") {
                                    $("#TailorWorkForm")[0].reset(); // Reset the form
                                    showToast("success", response.message); // Toast notification
                                }

                                $('#btnSave').attr('disabled', false); // Re-enable the button
                            },
                            error: function() {
                                showToast("error", "Something went wrong! Please try again.");
                                $('#btnSave').attr('disabled', false);
                            }
                        });
                    });
                });
            </script>
</body>
<!-- [Body] end -->

</html>