
<style>
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
                                <h4 class="mb-0">Fabric</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Fabrics</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Fabric Management</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
            $user = $this->session->userdata('business_id');
            ?>

            <!-- [ breadcrumb ] end -->

            <div class="modal fade" id="editFabricModal" tabindex="-1" aria-labelledby="editFabricModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="editFabricModalLabel">
                                <i class="zmdi zmdi-edit"></i> Edit Fabric
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <form id="updateFabricForm">
                                <input type="hidden" name="id" id="fabric_id">

                                <div class="row g-3">

                                    <!-- Fabric Name -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fabric Name</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_name" id="edit_name" placeholder="Fabric Name">
                                        <small class="text-error error-edit_name"></small>
                                    </div>

                                    <!-- Color -->
                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_color" id="edit_color" placeholder="Color">
                                        <small class="text-error error-edit_color"></small>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Type</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_type" id="edit_type" placeholder="Fabric Type (e.g., Cotton, Silk)">
                                        <small class="text-error error-edit_type"></small>
                                    </div>

                                    <!-- Meter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Meters</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="edit_meter" id="edit_meter" placeholder="Total Meters">
                                        <small class="text-error error-edit_meter"></small>
                                    </div>

                                    <!-- Unit Price -->
                                    <div class="col-md-2">
                                        <label class="form-label">Unit Price</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="edit_unit_price" id="edit_unit_price" placeholder="Price per Meter">
                                        <small class="text-error error-edit_unit_price"></small>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-10">
                                        <label class="form-label">Description</label>
                                        <input class="form-control form-control-sm" type="text" name="edit_description" id="edit_description" placeholder="Enter Description">
                                    </div>

                                </div>
                            </form>
                        </div>


                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btnUpdateFabric">Update Fabric</button>
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
                            <h5>Fabric</h5>
                        </div>
                        <div class="card-body">
                            <form id="FabricForm">
                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fabric Name</label>
                                        <input class="form-control form-control-sm" type="text" name="name" placeholder="Fabric Name">
                                        <small class="text-error error-name"></small>
                                    </div>

                                    <!-- Color -->
                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <input class="form-control form-control-sm" type="text" name="color" placeholder="Color">
                                        <small class="text-error error-color"></small>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Type</label>
                                        <input class="form-control form-control-sm" type="text" name="type" placeholder="Fabric Type (e.g., Cotton, Silk)">
                                        <small class="text-error error-type"></small>
                                    </div>

                                    <!-- Meter -->
                                    <div class="col-md-3">
                                        <label class="form-label">Meters</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="meter" placeholder="Total Meters">
                                        <small class="text-error error-meter"></small>
                                    </div>

                                    <!-- Unit Price -->
                                    <div class="col-md-2">
                                        <label class="form-label">Unit Price</label>
                                        <input class="form-control form-control-sm" type="number" step="0.01" name="unit_price" placeholder="Price per Meter">
                                        <small class="text-error error-unit_price"></small>
                                    </div>

                                    <!-- Created At -->
                                    <div class="col-md-8">
                                        <label class="form-label">Description</label>
                                        <input class="form-control form-control-sm" type="text" name="description" placeholder="Enter Description">
                                    </div>

                                    <!-- Submit Button -->
                                    <?php if (can('fabrics', 'add')): ?>
                                        <div class="col-md-2">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <button type="submit" id="btnSave" class="btn btn-primary btn-sm w-100">Save Fabric</button>
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
                                        <th>Color</th>
                                        <th>type</th>
                                        <th>Meter</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="showFabrics">
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

            var CAN_VIEW = <?= can('fabrics', 'view') ? 'true' : 'false'; ?>;
            var CAN_EDIT = <?= can('fabrics', 'edit') ? 'true' : 'false'; ?>;
            var CAN_DELETE = <?= can('fabrics', 'delete') ? 'true' : 'false'; ?>;

            getFabrics();

            function getFabrics() {
                if (!CAN_VIEW) {
                    $('#showFabrics').html(
                        '<tr><td colspan="6" class="text-center text-error fw-bold">' +
                        'You do not have permission to view fabrics.' +
                        '</td></tr>'
                    );
                    return;
                }
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('Fabrics/getFabrics') ?>',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var c = 0;

                        for (var i = 0; i < data.length; i++) {
                            c++;

                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + data[i].color + '</td>' +
                                '<td>' + data[i].type + '</td>' +
                                '<td>' + data[i].meter + '</td>' +
                                '<td>' + data[i].unit_price + '</td>' +
                                '<td class="no-print">';

                                if(CAN_EDIT){

                                html += '<a href="javascript:;" class="item_edit text-primary me-2" title="Edit" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-edit zmdi-hc-18"></i>' +
                                '</a>';
                                }
                                if(CAN_DELETE){

                                html += '<a href="javascript:;" class="item-delete text-danger" title="Delete" data="' + data[i].id + '">' +
                                '<i class="zmdi zmdi-delete zmdi-hc-18"></i>' +
                                '</a>';
                                }
                                '</td>' +
                                '</tr>';
                        }

                        $('#showFabrics').html(html);
                    },
                    error: function() {
                        alert('Could not fetch Fabrics data.');
                    }
                });
            }


            $(document).ready(function() {
                $("#FabricForm").on("submit", function(e) {
                    e.preventDefault();
                    $('#btnSave').attr('disabled', true);

                    $.ajax({
                        url: "<?php echo base_url('Fabrics/saveFabric'); ?>",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            $(".text-error").html("");

                            if (response.status == "error") {
                                $.each(response.errors, function(key, val) {
                                    $(".error-" + key).html(val);
                                    $('#btnSave').attr('disabled', false);
                                });
                                showToast("warning", "Please fill all required fields!");
                            } else if (response.status == "success") {
                                $("#FabricForm")[0].reset();
                                getFabrics();
                                showToast("success", "Fabrics saved successfully!");
                            }

                            $('#btnSave').attr('disabled', false);
                        }
                    });

                });



                // When edit button clicked
                // Edit button click
                $('#showFabrics').on('click', '.item_edit', function() {
                    var id = $(this).attr('data');

                    $.ajax({
                        type: 'GET',
                        url: '<?php echo base_url('Fabrics/getFabricsById') ?>/' + id,
                        dataType: 'json',
                        success: function(data) {
                            // Fill edit form fields
                            $('#fabric_id').val(data.id);
                            $('#edit_name').val(data.name);
                            $('#edit_color').val(data.color);
                            $('#edit_type').val(data.type);
                            $('#edit_meter').val(data.meter);
                            $('#edit_unit_price').val(data.unit_price);
                            $('#edit_description').val(data.description);

                            // Show modal
                            $('#editFabricModal').modal('show');
                        },
                        error: function() {
                            Swal.fire('Error', 'Could not fetch Fabrics details', 'error');
                        }
                    });
                });


                // Update button click
                $('#btnUpdateFabric').on('click', function() {
                    var formData = $('#updateFabricForm').serialize();

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('Fabrics/updateFabrics') ?>',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                $('#editFabricModal').modal('hide');
                                showToast('success', 'Fabric updated successfully!');
                                getFabrics(); // reload Fabrics table
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
                            url: '<?php echo base_url('Fabrics/deleteFabric') ?>',
                            type: "POST",
                            data: {
                                id: deleteId
                            },
                            success: function(response) {
                                $("#deleteModal").modal("hide");
                                getFabrics();
                                showToast("success", "Fabrics deleted successfully!");
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