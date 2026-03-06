<style>
        #customerTable th, 
    #customerTable td {
        padding: 4px 6px !important; 
        font-size: 12px !important;
    }

    .text-error{
        color:red;
    }
</style>
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
                                <h4 class="mb-0">Customer</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customer Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            $user = $this->session->userdata('business_id');
            ?>

            <!-- [ breadcrumb ] end -->

            <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="editCustomerModalLabel">
                                <i class="zmdi zmdi-edit"></i> Edit Customer
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="updateCustomerForm">
                                <input type="hidden" name="id" id="customer_id">

                                <div class="row g-3">

                                    <!-- Customer Name -->
                                    <div class="col-md-4">
                                        <label for="edit_name" class="form-label">Customer Name</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_name" id="edit_name" placeholder="Customer Name">
                                        <small class="text-error error-edit_name"></small>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-4">
                                        <label for="edit_phone" class="form-label">Phone</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_phone" id="edit_phone" placeholder="0300-0000000">
                                        <small class="text-error error-edit_phone"></small>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-4">
                                        <label for="edit_address" class="form-label">Address</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_address" id="edit_address" placeholder="Address">
                                        <small class="text-error error-edit_address"></small>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-4">
                                        <label for="edit_gender" class="form-label">Gender</label>
                                        <select class="form-control form-control-sm" name="edit_gender" id="edit_gender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <small class="text-error error-edit_gender"></small>
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-md-8">
                                        <label for="edit_notes" class="form-label">Notes</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_notes" id="edit_notes" placeholder="Any notes...">
                                    </div>

                                </div>
                            </form>


                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btnUpdateCustomer">Update Customer</button>
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

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Customer</h5>
                        </div>
                        <div class="card-body">
                            <form id="CustomerForm">
                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-md-3">
                                        <label class="form-label">Customer Name</label>
                                        <input class="form-control form-control-sm" type="text" name="name" placeholder="Customer Name">
                                        <small class="text-error error-name"></small>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-3">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control form-control-sm" type="text" name="phone" placeholder="0300-0000000">
                                        <small class="text-error error-phone"></small>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-3">
                                        <label class="form-label">Address</label>
                                        <input class="form-control form-control-sm" type="text" name="address" placeholder="Address">
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-3">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control form-control-sm" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <small class="text-error error-gender"></small>
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-md-10">
                                        <label class="form-label">Notes</label>
                                        <input class="form-control form-control-sm" name="notes" placeholder="Any notes...">
                                    </div>

                                    <?php if (can('customers', 'add')): ?>
                                        <!-- Submit -->
                                        <div class="col-md-2">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <button type="submit" id="btnSave" class="btn btn-primary btn-sm w-100">
                                                Save Customer
                                            </button>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </form>

                        </div>
                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showCustomers">
                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>

                    </div>



                </div>
            </div>


        </div>


        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            var CAN_CUSTOMER_VIEW = <?= can('customers', 'view') ? 'true' : 'false'; ?>;
            var CAN_CUSTOMER_EDIT = <?= can('customers', 'edit') ? 'true' : 'false'; ?>;
            var CAN_CUSTOMER_DELETE = <?= can('customers', 'delete') ? 'true' : 'false'; ?>;

            getCustomers();

            function getCustomers() {

                if (!CAN_CUSTOMER_VIEW) {
                    $('#showCustomers').html(
                        '<tr><td colspan="6" class="text-center text-error fw-bold">' +
                        'You do not have permission to view customers.' +
                        '</td></tr>'
                    );
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Customer/getCustomers') ?>',
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td>' + data[i].gender + '</td>' +
                                '<td>' + data[i].address + '</td>' +
                                '<td class="no-print">';

                            if (CAN_CUSTOMER_EDIT) {
                                html += '<a href="javascript:;" class="item_edit text-primary me-2" title="Edit" data="' + data[i].id + '">' +
                                    '<i class="zmdi zmdi-edit zmdi-hc-18"></i>' +
                                    '</a>';
                            }

                            if (CAN_CUSTOMER_DELETE) {
                                html += '<a href="javascript:;" class="item-delete text-danger" title="Delete" data="' + data[i].id + '">' +
                                    '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                    '</a>';
                            }

                            html += '</td></tr>';
                        }

                        $('#showCustomers').html(html);
                    },
                    error: function() {
                        alert('Could not fetch customer data.');
                    }
                });
            }



            $(document).ready(function() {
                $("#CustomerForm").on("submit", function(e) {
                    e.preventDefault();
                    $('#btnSave').attr('disabled', true);

                    $.ajax({
                        url: "<?php echo base_url('Customer/saveCustomer'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            $(".text-error").html("");

                            if (response.status == "error") {
                                $.each(response.errors, function(key, val) {
                                    $(".error-" + key).html(val);
                                });
                                showToast("warning", "Please fill all required fields!");
                            } else if (response.status == "success") {
                                $("#CustomerForm")[0].reset();
                                getCustomers();
                                showToast("success", "Customer saved successfully!");
                            }

                            $('#btnSave').attr('disabled', false);
                        }
                    });

                });



                // When edit button clicked
                // Edit button click
                $('#showCustomers').on('click', '.item_edit', function() {
                    var id = $(this).attr('data');

                    $.ajax({
                        type: 'GET',
                        url: '<?php echo base_url('Customer/getCustomerById') ?>/' + id,
                        dataType: 'json',
                        success: function(data) {
                            // Fill edit form fields
                            $('#customer_id').val(data.id);
                            $('#edit_name').val(data.name);
                            $('#edit_phone').val(data.phone);
                            $('#edit_address').val(data.address);
                            $('#edit_gender').val(data.gender);
                            $('#edit_notes').val(data.notes);

                            // Show modal
                            $('#editCustomerModal').modal('show');
                        },
                        error: function() {
                            Swal.fire('Error', 'Could not fetch customer details', 'error');
                        }
                    });
                });


                // Update button click
                $('#btnUpdateCustomer').on('click', function() {
                    var formData = $('#updateCustomerForm').serialize();

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('Customer/updateCustomer') ?>',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#editCustomerModal').modal('hide');
                                showToast('success', 'Customer updated successfully!');
                                getCustomers(); // reload customer table
                            } else {
                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        $(".error-" + key).html(value);
                                        showToast('warning', value);
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
                            url: '<?php echo base_url('Customer/delete_item') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                getCustomers();
                                showToast("success", "Customer deleted successfully!");
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