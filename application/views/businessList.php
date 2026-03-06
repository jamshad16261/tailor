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
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Business</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Business</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Business Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="BusinessModal" tabindex="-1" aria-labelledby="BusinessModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="BusinessModalLabel">
                                 Business Users
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-l   ight" style="background:#f8f9fa;">
                                        <tr>
                                            <th>Sr#</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Status</th>
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
                                            <th>Business Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Total User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showBusiness">
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
            showBusiness()

            function showBusiness() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Business/getBusiness') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;
                            html += '<tr>' +
                                '<td>' + c + '</td>' +

                                // Business Name + Phone
                                '<td>' +
                                '<strong>' + data[i].name + '</strong><br>' +
                                '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td>' + data[i].email + '</td>' +
                                '<td>' + (data[i].total_users || '-') + '</td>' +

                                // Actions
                                '<td class="no-print">' +
                                '<a href="javascript:;" class="item_edit text-primary me-2" title="Edit" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-eye zmdi-hc-18"></i>' +
                                '</a>' +
                                '<a href="javascript:;" class="item-delete text-danger" title="Delete" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                        }

                        $('#showBusiness').html(html);
                    },
                    error: function() {
                        alert('Could not get Data from Database');
                    }
                });
            }



            // When edit button clicked
            $('#showBusiness').on('click', '.item_edit', function() {
                var business_id = $(this).attr('data');

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Business/getUserList') ?>/' + business_id,
                    dataType: 'json',
                    success: function(data) {
                        var tbody = '';
                        if (data.length > 0) {
                            $.each(data, function(index, user) {
                                tbody += '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + user.name + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' + user.role + '</td>' +
                                    '<td>' + user.status + '</td>' +
                                    '</tr>';
                            });
                        } else {
                            tbody = '<tr><td colspan="5">No users found</td></tr>';
                        }

                        $('#showUser').html(tbody);
                        $('#BusinessModal').modal('show');
                    },
                    error: function(err) {
                        console.error(err);
                        alert('Something went wrong!');
                    }
                });
            });



            // Update button click
            $('#btnUpdateBusiness').on('click', function() {
                var formData = $('#BusinessForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('Business/updateBusiness') ?>',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            $('#BusinessModal').modal('hide');
                            showToast('success', 'Business updated successfully!');
                            showBusiness(); // reload table
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
                            url: '<?php echo base_url('Business/delete_item') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                showBusiness();
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