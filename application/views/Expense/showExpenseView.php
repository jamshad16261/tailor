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
                                <h4 class="mb-0">Expense List</h4>
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
                            <h5>Expense List</h5>
                        </div>
                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Expense Title</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th class="no-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showExpenseList"></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="editExpenseModalLabel">
                                <i class="zmdi zmdi-edit"></i> Edit Expense
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="ExpenseForm">
                                <div class="row g-2">
                                    <input type="hidden" id="expense_id" name="expense_id">
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
                                    <div class="col-md-12">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control form-control-sm" name="remarks" id="remarks" placeholder="Optional notes">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btnUpdateExpense">Update Expense</button>
                        </div>

                    </div>
                </div>
            </div>


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
        </div>


        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            getExpenseList();

            function getExpenseList() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Expense/getExpenseList') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].expense_date + '</td>' +
                                '<td>' + data[i].title + '</td>' +
                                '<td>' + data[i].category + '</td>' +
                                '<td>' + parseFloat(data[i].amount).toFixed(2) + '</td>' +
                                '<td>' + (data[i].remarks ?? '-') + '</td>' +
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item_edit text-primary me-2" ' +
                                'data="' + data[i].id + '" title="Edit">' +
                                '<i class="zmdi zmdi-edit zmdi-hc-18"></i>' +
                                '</a>' +

                                '<a href="javascript:;" class="item-delete text-danger" ' +
                                'data="' + data[i].id + '" title="Delete">' +
                                '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                        }

                        $("#showExpenseList").html(html);

                    },
                    error: function() {
                        alert('Could not fetch customer data.');
                    }
                });
            }


            $(document).ready(function() {
                $('#showExpenseList').on('click', '.item_edit', function() {

                    var id = $(this).attr('data');

                    if (id > 0) {
                        $('#editExpenseModal').modal('show');
                    } else {
                        showToast('warning', 'ID cannot be Null');
                        return;
                    }
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo base_url('Expense/getExpenseById') ?>/' + id,
                        dataType: 'json',
                        success: function(data) {
                            // Fill edit form fields
                            $('#expense_id').val(data.id);
                            $('#title').val(data.title);
                            $('#category').val(data.category);
                            $('#amount').val(data.amount);
                            $('#expense_date').val(data.expense_date);
                            $('#method').val(data.method);
                            $('#remarks').val(data.remarks);

                            // Show modal
                            $('#editExpenseModal').modal('show');
                        },
                        error: function() {
                            Swal.fire('Error', 'Could not fetch customer details', 'error');
                        }
                    });
                });


                // Update button click
                $('#btnUpdateExpense').on('click', function() {
                    var formData = $('#ExpenseForm').serialize();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('Expense/updateExpense') ?>',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#editExpenseModal').modal('hide');
                                showToast('success', 'Expense updated successfully!');
                                getExpenseList(); // reload customer table
                            } else {
                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        $(".error-" + key).html(value);
                                        showToast('warning', 'Please Fill Required Fields');
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
                            url: '<?php echo base_url('Expense/deleteExpense') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                getExpenseList();
                                showToast("success", "Expense deleted successfully!");
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