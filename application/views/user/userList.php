<?php $this->load->view('layout/header'); ?>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->


    <?php $this->load->view('layout/sidebar'); ?>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">User</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="editUserModalLabel">
                                <i class="zmdi zmdi-edit"></i> Edit User
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="updateUserForm">
                                <input type="hidden" name="hidden_user_id" id="hidden_user_id">
                                <input type="hidden" name="id" id="user_id">

                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-md-4">
                                        <label class="form-label">Name</label>
                                        <input class="form-control form-control-sm" type="text"
                                            name="edit_name" id="edit_name">
                                        <small class="text-danger error-edit_name"></small>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-4">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control form-control-sm" type="text"
                                            name="edit_phone" id="edit_phone">
                                        <small class="text-danger error-edit_phone"></small>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-sm" type="email"
                                            name="edit_email" id="edit_email">
                                        <small class="text-danger error-edit_email"></small>
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-4">
                                        <label class="form-label">Role</label>
                                        <select class="form-control form-control-sm"
                                            name="edit_role" id="edit_role">
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="tailor">Tailor</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                        <small class="text-danger error-edit_role"></small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-control form-control-sm"
                                            name="edit_status" id="edit_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <small class="text-danger error-edit_status"></small>
                                    </div>

                                </div>
                            </form>
                        </div>


                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btnUpdateUser">Update User</button>
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
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                        <tr>
                                            <th>Sr#</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showUser">
                                        <!-- Dynamic rows will be injected here -->
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
            showUser()

            function showUser() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('User/getUser') ?>',
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
                                '<strong>' + data[i].name + '</strong><br>' +
                                '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td>' + data[i].email + '</td>' +
                               '<td>' + data[i].role.charAt(0).toUpperCase() + data[i].role.slice(1) + '</td>'+
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item_edit text-primary me-2" title="Edit" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-edit zmdi-hc-18"></i>' +
                                '</a>' +
                                '<a href="javascript:;" class="item-delete text-danger" title="Delete" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                        }

                        $('#showUser').html(html);
                    },
                    error: function() {
                        alert('Could not get Data from Database');
                    }
                });
            }

            $('#showUser').on('click', '.item_edit', function() {
                var id = $(this).attr('data');

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('User/getUserById') ?>/' + id,
                    dataType: 'json',
                    success: function(data) {
                        // Fill edit form fields
                        $('#hidden_user_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_phone').val(data.phone);
                        $('#edit_email').val(data.email);
                        $('#edit_role').val(data.role);
                        $('#edit_status').val(data.status);

                        // Show modal
                        $('#editUserModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error', 'Could not fetch customer details', 'error');
                    }
                });
            });




            // Update button click
            $('#btnUpdateUser').on('click', function() {
                var formData = $('#updateUserForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('User/updateUser') ?>',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            $('#editUserModal').modal('hide');
                            showToast('success', 'User updated successfully!');
                            showUser(); // reload table
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
                            url: '<?php echo base_url('User/delete_item') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                showUser();
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
        <?php $this->load->view('layout/footer'); ?>


</body>
<!-- [Body] end -->

</html>