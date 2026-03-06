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
                                <h4 class="mb-0">OrderManagement</h4>
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

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-danger">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title text-white" id="deleteModalLabel">
                                <i class="zmdi zmdi-alert-triangle"></i> Confirm Delete
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mb-0">Are you sure you want to delete this item? This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Order</h5>
                        </div>
                        <div class="card-body">
                            <form id="OrderForm">
                                <div class="row g-3">
                                    <!-- Order Number, Customer, Order Date -->
                                    <div class="col-md-2">
                                        <label class="form-label">Order Number</label>
                                        <input class="form-control form-control-sm" type="text" name="order_no" id="order_no" aceholder="Order Number" readonly>
                                        <small class="text-danger error-order_no"></small>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Customer</label>
                                        <select class="form-control form-control-sm" name="customer_id" id="customer_id" onchange="getCurrentOrderItems();">
                                            <option value="">Select Customer</option>
                                            <!-- Loop through customers in PHP -->
                                            <?php
                                            $customers = $this->db->query("SELECT * FROM customers WHERE is_deleted = 0")->result();
                                            foreach ($customers as $customer) {
                                                echo "<option value='{$customer->id}'>{$customer->name}</option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="text-danger error-customer_id"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Order Date</label>
                                        <input class="form-control form-control-sm" type="date" name="order_date" id="order_date" value="<?php echo date('Y-m-d') ?>">
                                        <small class="text-danger error-order_date"></small>
                                    </div>


                                    <!-- Delivery Date, Total Amount, Advance -->
                                    <div class="col-md-2">
                                        <label class="form-label">Delivery Date</label>
                                        <input class="form-control form-control-sm" type="date" name="delivery_date" id="delivery_date" value="<?php echo date('Y-m-d') ?>">
                                        <small class="text-danger error-delivery_date"></small>
                                    </div>

                                    <!-- Measurement Field (Previously Item Type) -->
                                    <div class="col-md-3">
                                        <label class="form-label">Item Type</label>
                                        <select class="form-control form-control-sm" name="measurement_id">
                                            <option value="">Select Measurement</option>
                                            <?php
                                            $business_id = $_SESSION['business_id'];
                                            $measurements = $this->db->query("SELECT * FROM measurements WHERE is_deleted = 0 AND business_id  = $business_id and type !=''")->result();
                                            foreach ($measurements as $measurement) {
                                                echo "<option value='{$measurement->id}'>{$measurement->type}</option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="text-danger error-measurement_id"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Price</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="price" id="price" placeholder="Price per Item">
                                        <small class="text-danger error-price"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Quantity</label>
                                        <input class="form-control form-control-sm" type="number" name="quantity" id="quantity" placeholder="Quantity">
                                        <small class="text-danger error-quantity"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Total Amount</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="total_amount" id="total_amount" placeholder="0.00" readonly>
                                        <small class="text-danger error-total_amount"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Disc(%)</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="disc_percent" id="disc_percent" placeholder="Disc %">
                                        <small class="text-danger error-disc_percent"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Disc Amount</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="disc_amount" id="disc_amount" placeholder="Disc Amount">
                                        <small class="text-danger error-disc_amount"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Net Amount</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="net_amount" id="net_amount" placeholder="0.00" readonly>
                                        <small class="text-danger error-net_amount"></small>
                                    </div>

                                    <div class="col-md-11 ">
                                        <label class="form-label">Special Instructions</label>
                                        <input class="form-control form-control-sm" type="text" name="special_instructions" placeholder="Special Instructions">
                                        <small class="text-danger error-special_instructions"></small>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">&nbsp;&nbsp;&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm w-100" id="saveOrderItemBtn">
                                            <i class="bi bi-save"></i> Add Item
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>

                        <div class="modal fade" id="orderConfrimModal" tabindex="-1" aria-labelledby="orderConfrimModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title text-white" id="orderConfrimModal Label">
                                            <i class="zmdi zmdi-edit"></i> Confirm Order
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <form id="customerForm">
                                            <input type="hidden" name="customer_id" id="customer_id">

                                            <div class="row g-3">
                                                <!-- Customer Name -->
                                                <div class="col-md-3">
                                                    <label>Order No</label>
                                                    <input class="mb-0 form-control form-control-sm" type="text" name="modal_order_no" id="modal_order_no" value="0.00" readonly>
                                                    <small class="text-danger error-modal_order_no"></small>
                                                </div>
                                                <!-- Customer Name -->
                                                <div class="col-md-3">
                                                    <label>Total</label>
                                                    <input class="mb-0 form-control form-control-sm" type="text" name="modal_total" id="modal_total" value="0.00" readonly>
                                                    <small class="text-danger error-name"></small>
                                                </div>

                                                <!-- Phone -->
                                                <div class="col-md-3">
                                                    <label>Disc (%)</label>
                                                    <input class="mb-0 form-control form-control-sm" type="text" name="modal_disc_percent" id="modal_disc_percent" value="0.00">
                                                    <small class="text-danger error-phone"></small>
                                                </div>

                                                <!-- Disc Amount -->
                                                <div class="col-md-3">
                                                    <label>Discount Amount</label>
                                                    <input class="mb-0 form-control form-control-sm" type="email" name="modal_disc_amount" id="modal_disc_amount" value="0.00">
                                                    <small class="text-danger error-email"></small>
                                                </div>

                                                <!-- Net Total -->
                                                <div class="col-md-3">
                                                    <label>Net Total</label>
                                                    <input class="mb-0 form-control form-control-sm" type="text" name="modal_net_total" id="modal_net_total" value="0.00" readonly>
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Payment Mode</label>
                                                    <select class="form-control form-control-sm" id="payment_mode" name="payment_mode">
                                                        <option value="">Select</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="bank">Bank</option>
                                                        <option value="card">Card</option>
                                                        <option value="credit">Credit</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label>Paid Amount</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" id="modal_paid_amount" name="modal_paid_amount" placeholder="Paid Amount" onkeyup="calculateInvoice()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Balance</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" id="modal_balance" name="modal_balance" readonly value="0.00">
                                                </div>


                                                <!-- Remarks -->
                                                <div class="col-md-12">
                                                    <label>Remarks</label>
                                                    <input class="mb-0 form-control form-control-sm" type="text" name="remarks" spellcheck="true" id="remarks" placeholder="Enter Remarks">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary btn-sm" id="btnSaveOrder">Cofirm</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Order No</th>
                                        <th>Customer</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showOrderItems">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" style="text-align:right; font-weight: bold;">SubTotal:</td>
                                        <td id="subTotal" style="font-weight: bold;"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- Button row -->
                <div class="row mt-2">
                    <div class="col-md-12 text-center p-3">
                        <button type="button" id="btnConfirm" class="btn btn-primary btn-sm px-4 ">Confirm</button>
                        <a href="<?php echo base_url('Order/orderList') ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm px-4 ">Show Order</button></a>
                    </div>
                </div>

            </div>


        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            function getCurrentOrderItems() {

                var customer_id = $('#customer_id').val();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Order/getCurrentOrderItems') ?>',
                    data: {
                        customer_id: customer_id
                    },
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var c = 0;
                        var subTotal = 0;
                        for (var i = 0; i < data.length; i++) {
                            c++;

                            subTotal += parseInt(data[i].total_amount);
                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].order_no + '</td>' +
                                '<td>' + data[i].customer_name + '</td>' +
                                '<td>' + data[i].order_date + '</td>' +
                                '<td>' + data[i].delivery_date + '</td>' +
                                '<td>' + data[i].quantity + '</td>' +
                                '<td>' + data[i].price + '</td>' +
                                '<td>' + data[i].total_amount + '</td>' +
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item-delete text-danger" title="Delete" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                        }

                        $('#showOrderItems').html(html);
                        $('#subTotal').html(subTotal);
                    },
                    error: function() {
                        alert('Could not fetch Order items data.');
                    }
                });
            }

        $(document).ready(function () {
            $.ajax({
                url: "<?= base_url('Order/getNextOrderNo'); ?>",
                type: "GET",
                dataType: "json",
                success: function (res) {
                    if (res.status) {
                        $('#order_no').val(res.order_no);
                        $('#modal_order_no').val(res.order_no);
                    }
                }
            });
        });



            $(document).ready(function() {
                function calculate() {
                    let quantity = parseFloat($("#quantity").val()) || 0;
                    let price = parseFloat($("#price").val()) || 0;
                    let discPercent = parseFloat($("#disc_percent").val()) || 0;
                    let discAmount = parseFloat($("#disc_amount").val()) || 0;

                    let total = quantity * price;
                    $("#total_amount").val(total.toFixed(2));
                    if ($("#disc_percent").is(":focus")) {
                        discAmount = (total * discPercent) / 100;
                        $("#disc_amount").val(discAmount.toFixed(2));
                    }

                    if ($("#disc_amount").is(":focus")) {
                        if (total > 0) {
                            discPercent = (discAmount / total) * 100;
                            $("#disc_percent").val(discPercent.toFixed(2));
                        }
                    }
                    let net = total - discAmount;
                    $("#net_amount").val(net.toFixed(2));
                }

                // Keyup listeners
                $("#quantity, #price, #disc_percent, #disc_amount").on("keyup change", function() {
                    calculate();
                });

                $("#OrderForm").on("submit", function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "<?= base_url('Order/saveCurrentOrder') ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            $(".text-danger").text("");
                            if (response.status === "error") {
                                $.each(response.errors, function(key, value) {
                                    $(".error-" + key).text(value);
                                    showToast("success", "Order Confirmed Successfully!");
                                });
                                showToast("warning", "Please fill all required fields!");
                            }

                            if (response.status === "success") {
                                showToast("success", "Data Saved successfully!");
                                getCurrentOrderItems();
                                let orderNo = $("#order_no").val();
                                $("#OrderForm")[0].reset();
                                $("#order_no").val(orderNo);
                            }
                        }
                    });
                });

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
                            url: '<?php echo base_url('Order/deleteCurrentItem') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                getCurrentOrderItems();
                                showToast("success", "Item deleted successfully!");
                            },
                            error: function() {
                                $("#deleteModal").modal("hide");
                                showToast("error", "Error deleting item!");
                            }
                        });
                    }
                });


                $('#btnConfirm').click(function() {
                    var invoice_no = $('#order_no').val()
                    var subTotal = $('#subTotal').html();
                    $('#modal_total').val(subTotal)
                    $('#modal_net_total').val(subTotal)
                    $('#modal_order_no').val(invoice_no);
                    $('#orderConfrimModal').modal('show');
                })

                $('#modal_disc_percent').on('keyup change', function() {
                    calculateDiscount();
                });
                $('#modal_disc_amount').on('keyup change', function() {
                    calculateDiscount(true);
                });
                $('#modal_paid_amount').on('keyup change', function() {
                    calculateInvoice();
                });

                function calculateDiscount(fromAmount = false) {
                    var total = parseFloat($('#modal_total').val()) || 0;
                    var discPercent = parseFloat($('#modal_disc_percent').val()) || 0;
                    var discAmount = parseFloat($('#modal_disc_amount').val()) || 0;
                    var netTotal = total;

                    if (fromAmount === true) {
                        discPercent = total > 0 ? (discAmount / total * 100) : 0;
                        $('#modal_disc_percent').val(discPercent.toFixed(2));
                        netTotal = total - discAmount;
                    } else {
                        // Agar discount % enter hua
                        discAmount = (total * discPercent / 100);
                        $('#modal_disc_amount').val(discAmount.toFixed(2));
                        netTotal = total - discAmount;
                    }
                    $('#modal_net_total').val(netTotal.toFixed(2));
                    calculateInvoice();
                }

                function calculateInvoice() {
                    var netTotal = parseFloat($('#modal_net_total').val()) || 0;
                    var paidAmount = parseFloat($('#modal_paid_amount').val()) || 0;
                    var balance = netTotal - paidAmount;

                    $('#modal_balance').val(balance.toFixed(2));
                }

                $('#btnSaveOrder').click(function() {

                    let formData = {
                        customer_id: $('#customer_id').val(),
                        delivery_date: $('#delivery_date').val(),
                        order_date: $('#order_date').val(),
                        modal_order_no: $('#modal_order_no').val(),
                        modal_total: $('#modal_total').val(),
                        modal_disc_percent: $('#modal_disc_percent').val(),
                        modal_disc_amount: $('#modal_disc_amount').val(),
                        modal_net_total: $('#modal_net_total').val(),
                        modal_paid_amount: $('#modal_paid_amount').val(),
                        modal_balance: $('#modal_balance').val(),
                        payment_mode: $('#payment_mode').val(),
                        remarks: $('#remarks').val()
                    };

                    $.ajax({
                        url: '<?php echo base_url('Order/saveOrder') ?>',
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(res) {
                            if (res.status === true) {
                                showToast("success", "Order Confirmed Successfully!");
                                location.reload();
                            } else {
                                showToast("error", res.msg ? res.msg : "Something went wrong!");
                            }

                        }
                    });

                });


            });
        </script>
</body>
<!-- [Body] end -->

</html>