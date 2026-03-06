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
                                <h4 class="mb-0">Tailor Assign Task</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Task</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tailor Assign Task</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Tailor Assign Task List</h5>
                        </div>
                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>#</th>
                                        <th>Order</th>
                                        <th>Amount</th>
                                        <th>Method / Tailor</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody id="showTailorAssignTask">

                                    <!-- Dynamic rows will be injected here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="editStatusModalLabel">
                                <i class="zmdi zmdi-edit"></i> Edit Assign Status
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="updateStatusForm">
                                <input type="hidden" name="tailor_work_id" id="tailor_work_id">

                                <div class="row g-3">

                                    <!-- Customer Name -->
                                    <div class="col-md-8">
                                        <label for="edit_remarks" class="form-label">Remarks</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_remarks" id="edit_remarks" placeholder="Enter Remarks">
                                        <small class="text-danger error-edit_remarks"></small>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-md-4">
                                        <label for="edit_status" class="form-label">Status</label>
                                        <select class="form-control form-control-sm" name="edit_status" id="edit_status">
                                            <option value="">Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                        <small class="text-danger error-edit_status"></small>
                                    </div>


                                </div>
                            </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btnUpdateStatus">Update Status</button>
                        </div>

                    </div>
                </div>
            </div>

            
        </div>


        <!-- jQuery CDN (latest 3.x version) -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            getAssignTask();

            function getAssignTask() {
                $.ajax({
                    url: "<?= base_url('Tailor/getAssignTask') ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        var html = '';
                        var c = 0;

                        if (data.length === 0) {
                            html += '<tr>' +
                                '<td colspan="6" class="text-center text-danger">' +
                                'No Record Found' +
                                '</td>' +
                                '</tr>';
                        } else {
                            $.each(data, function(i, row) {
                                c++;

                                html += '<tr>' +

                                    '<td>' + c + '</td>' +

                                    '<td>' +
                                    '<strong>Order#:</strong> ' + row.order_no + '<br>' +
                                    '<small>Date: ' + row.order_date + '</small>' +
                                    '</td>' +

                                    '<td>' +
                                    '<strong>Total:</strong> ' + parseFloat(row.total).toFixed(2) + '<br>' +
                                    '<strong>Qty:</strong> ' + row.qty + ' × ' + parseFloat(row.price).toFixed(2) +
                                    '</td>' +

                                    '<td>' +
                                    '<strong>' + row.work_type + '</strong><br>' +
                                    'Tailor: ' + row.tailor_name +
                                    '</td>' +

                                    '<td>' +
                                    '<span class="badge bg-' + (row.tailor_status === 'Completed' ? 'success' : 'warning') + '">' +
                                    row.tailor_status +
                                    '</span>' +
                                    '</td>' +

                                    '<td>' + row.created_at + '</td>' +
                                    '<td class="text-center">' +
                                    '<i class="fa fa-edit text-primary changeStatusIcon" ' +
                                    'style="cursor:pointer;font-size:18px" ' +
                                    'title="Change Status" ' +
                                    'data-id="' + row.id + '" ' +
                                    'data-status="' + row.tailor_status + '" ' +
                                    'data-remarks="' + (row.remarks ?? '') + '">' +
                                    '</i>' +
                                    '</td>' +

                                    '</tr>';
                            });

                        }

                        $('#showTailorAssignTask').html(html);
                    },
                    error: function() {
                        alert('Could not load tailor tasks');
                    }
                });
            }



            $(document).ready(function() {
                $(document).on('click', '.changeStatusIcon', function() {

                    $('#tailor_work_id').val($(this).data('id'));
                    $('#edit_status').val($(this).data('status'));
                    $('#edit_remarks').val($(this).data('remarks'));

                    $('#editStatusModal').modal('show');
                });


            $('#btnUpdateStatus').on('click', function() {
                    var formData = $('#updateStatusForm').serialize();

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('Tailor/updateAssignTaskStatus') ?>',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#editStatusModal').modal('hide');
                                showToast('success', 'Status updated successfully!');
                                getAssignTask();
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



            });
        </script>
</body>
<!-- [Body] end -->

</html>