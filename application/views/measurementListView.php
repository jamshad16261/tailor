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
                                <h4 class="mb-0">Measurement</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Measurements</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Measurement Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            $user = $this->session->userdata('business_id');
            ?>

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
                            <h5>Measurement</h5>
                        </div>

                        <div class="table-responsive container mt-3">
                            <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Type</th>
                                        <th>Customer</th>
                                        <th>Fitting</th>
                                        <th>Instruction</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showMeasurement">
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
            var CAN_VIEW = <?= can('measurement', 'view') ? 'true' : 'false'; ?>;
            var CAN_EDIT = <?= can('measurement', 'edit') ? 'true' : 'false'; ?>;
            var CAN_DELETE = <?= can('measurement', 'delete') ? 'true' : 'false'; ?>;


            getMeasurement();

            function getMeasurement() {
                if (!CAN_VIEW) {
                    $('#showMeasurement').html(
                        '<tr><td colspan="6" class="text-center text-danger fw-bold">' +
                        'You do not have permission to view fabrics.' +
                        '</td></tr>'
                    );
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Measurement/getMeasurement') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].type + '</td>' +
                                '<td>' + data[i].customer_name + '</td>' +
                                '<td>' + data[i].fitting_type + '</td>' +
                                '<td>' + data[i].special_instructions + '</td>' +
                                '<td class="no-print">';
                            if (CAN_EDIT) {
                                html += '<a href="javascript:;" class="item_edit text-primary me-2" title="Edit" data-id="' + data[i].id + '">' +
                                    '<i class="zmdi zmdi-edit zmdi-hc-18"></i>' +
                                    '</a>';
                            }
                            if (CAN_DELETE) {
                                html += '<a href="javascript:;" class="item-delete text-danger" title="Delete" data-id="' + data[i].id + '">' +
                                    '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                    '</a>';
                            }
                            html += '</td>' + '</tr>';
                        }

                        $('#showMeasurement').html(html);
                    },
                    error: function() {
                        alert('Could not fetch Fabrics data.');
                    }
                });
            }

            $(document).ready(function() {

                $(document).on("click", ".item_edit", function() {
                    let id = $(this).data("id");
                    window.location.href = "<?php echo base_url('Measurement'); ?>?id=" + id;
                });


                let deleteId = null;
                // Jab delete icon pe click ho
                $(document).on("click", ".item-delete", function() {
                    deleteId = $(this).data("id");
                    $("#deleteModal").modal("show");
                });

                // Jab modal me Delete button click ho
                $("#confirmDeleteBtn").click(function() {
                    if (deleteId) {
                        $.ajax({
                            url: '<?php echo base_url('Measurement/deleteMeasurement') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                getMeasurement();
                                showToast("success", "Measuremtn deleted successfully!");
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