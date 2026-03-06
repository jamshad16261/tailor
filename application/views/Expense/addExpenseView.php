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
                                <h4 class="mb-0">Expense</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Expense</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Expense Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Expense</h5>
                        </div>
                        <div class="card-body">
                            <form id="ExpenseForm">

                                <div class="row g-2">

                                    <!-- Expense Title -->
                                    <div class="col-md-3">
                                        <label class="form-label">Expense Title</label>
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            name="title"
                                            id="title"
                                            placeholder="e.g. Rent, Salary, Bill">
                                        <small class="text-danger error-title"></small>
                                    </div>

                                    <!-- Expense Category -->
                                    <div class="col-md-2">
                                        <label class="form-label">Category</label>
                                        <select class="form-select form-select-sm"
                                            name="category"
                                            id="category">
                                            <option value="">Select</option>
                                            <option value="rent">Rent</option>
                                            <option value="utility">Utility</option>
                                            <option value="salary">Salary</option>
                                            <option value="material">Material</option>
                                            <option value="transport">Transport</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <small class="text-danger error-category"></small>
                                    </div>

                                    <!-- Expense Amount -->
                                    <div class="col-md-2">
                                        <label class="form-label">Amount</label>
                                        <input type="number"
                                            class="form-control form-control-sm"
                                            name="amount"
                                            id="amount"
                                            placeholder="0.00">
                                        <small class="text-danger error-amount"></small>
                                    </div>

                                    <!-- Expense Date -->
                                    <div class="col-md-2">
                                        <label class="form-label">Expense Date</label>
                                        <input type="date"
                                            class="form-control form-control-sm"
                                            name="expense_date"
                                            id="expense_date"
                                            value="<?= date('Y-m-d') ?>">
                                        <small class="text-danger error-expense_date"></small>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="col-md-3">
                                        <label class="form-label">Payment Method</label>
                                        <select class="form-select form-select-sm"
                                            name="method"
                                            id="method">
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                            <option value="bank">Bank Transfer</option>
                                        </select>
                                        <small class="text-danger error-method"></small>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-md-10">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control form-control-sm" name="remarks" id="remarks" placeholder="Optional notes">
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-2">
                                        <label class="form-label d-block">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm w-100" id="btnSaveExpense"> Save Expense</button>
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

                $("#ExpenseForm").on("submit", function(e) {
                    e.preventDefault();
                    $('#btnSaveExpense').attr('disabled', true);

                    $.ajax({
                        url: "<?= base_url('Expense/saveExpense') ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(res) {
                            $(".text-danger").html("");

                            if (res.status === 'error') {
                                $.each(res.errors, function(key, val) {
                                    $(".error-" + key).html(val);
                                });
                            } else {
                                $("#ExpenseForm")[0].reset();
                                showToast("success", "Expense saved successfully");
                            }

                            $('#btnSaveExpense').attr('disabled', false);
                        }
                    });
                });

            });
        </script>
</body>
<!-- [Body] end -->

</html>