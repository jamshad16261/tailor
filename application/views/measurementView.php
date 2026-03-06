
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Measurement</h5>
                        </div>
                        <div class="card-body">
                            <form id="measurementForm">
                                <input type="hidden" name="id" value="<?= isset($editMeasurement) ? $editMeasurement->id : '' ?>">

                                <div class="row g-3">

                                    <!-- Measurement Type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Measurement Type</label>
                                        <select class="form-control form-control-sm" name="type" id="measurement_type">
                                            <option value="">Select Type</option>
                                            <option value="shirt" <?= isset($editMeasurement) && $editMeasurement->type == 'shirt' ? 'selected' : '' ?>>Shirt</option>
                                            <option value="kurta" <?= isset($editMeasurement) && $editMeasurement->type == 'kurta' ? 'selected' : '' ?>>Kurta</option>
                                            <option value="coat" <?= isset($editMeasurement) && $editMeasurement->type == 'coat' ? 'selected' : '' ?>>Coat</option>
                                            <option value="suit" <?= isset($editMeasurement) && $editMeasurement->type == 'suit' ? 'selected' : '' ?>>Suit</option>
                                            <option value="pan" <?= isset($editMeasurement) && $editMeasurement->type == 'pant' ? 'selected' : '' ?>>Pant</option>
                                            <option value="shalwar" <?= isset($editMeasurement) && $editMeasurement->type == 'shalwar' ? 'selected' : '' ?>>Shalwar</option>
                                        </select>
                                        <small class="text-danger error-measurement_type"></small>
                                    </div>

                                    <!-- Customer -->
                                    <div class="col-md-3">
                                        <label class="form-label">Customer</label>
                                        <select class="form-control form-control-sm" name="customer_id">
                                            <option value="">Select Customer</option>
                                            <?php
                                            $user_id = $_SESSION['user_id'];
                                            $business_id = $_SESSION['business_id'];
                                            $qry = $this->db->query("SELECT * FROM customers WHERE is_deleted=0 AND business_id = $business_id");
                                            $resForDD = $qry->result();
                                            foreach ($resForDD as $row) {
                                                $selected = isset($editMeasurement) && $editMeasurement->customer_id == $row->id ? 'selected' : '';
                                                echo "<option value='$row->id' $selected>$row->name</option>";
                                            }
                                            ?>
                                        </select>
                                        <small class="text-danger error-customer_id"></small>
                                    </div>

                                    <!-- Fitting -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fitting</label>
                                        <select class="form-control form-control-sm" name="fitting_type">
                                            <option value="normal" <?= isset($editMeasurement) && $editMeasurement->fitting_type == 'normal' ? 'selected' : '' ?>>Normal</option>
                                            <option value="tight" <?= isset($editMeasurement) && $editMeasurement->fitting_type == 'tight' ? 'selected' : '' ?>>Tight</option>
                                            <option value="loose" <?= isset($editMeasurement) && $editMeasurement->fitting_type == 'loose' ? 'selected' : '' ?>>Loose</option>
                                        </select>
                                        <small class="text-danger error-fitting_type"></small>
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-md-3">
                                        <label class="form-label">Special Instructions</label>
                                        <input class="form-control form-control-sm" type="text" name="special_instructions" placeholder="Write notes..." value="<?= isset($editMeasurement) ? $editMeasurement->special_instructions : '' ?>">
                                        <small class="text-danger error-special_instructions"></small>
                                    </div>
                                </div>

                                <!-- UPPER BODY SECTION -->
                                <div id="upperBody">
                                    <h6 class="mt-3 text-primary">Upper Body Measurements</h6>
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Length</label>
                                            <input type="number" class="form-control form-control-sm" name="length" placeholder="Length (inches)" value="<?= isset($editMeasurement) ? $editMeasurement->length : '' ?>">
                                            <small class="text-danger error-length"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Shoulder</label>
                                            <input type="number" class="form-control form-control-sm" name="shoulder" placeholder="Shoulder width" value="<?= isset($editMeasurement) ? $editMeasurement->shoulder : '' ?>">
                                            <small class="text-danger error-shoulder"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Chest</label>
                                            <input type="number" class="form-control form-control-sm" name="chest" placeholder="Chest size" value="<?= isset($editMeasurement) ? $editMeasurement->chest : '' ?>">
                                            <small class="text-danger error-chest"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Belly</label>
                                            <input type="number" class="form-control form-control-sm" name="belly" placeholder="Belly size" value="<?= isset($editMeasurement) ? $editMeasurement->belly : '' ?>">
                                            <small class="text-danger error-belly"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Hip</label>
                                            <input type="number" class="form-control form-control-sm" name="hip" placeholder="Hip round" value="<?= isset($editMeasurement) ? $editMeasurement->hip : '' ?>">
                                            <small class="text-danger error-hip"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Sleeve Length</label>
                                            <input type="number" class="form-control form-control-sm" name="sleeve_length" placeholder="Sleeve length" value="<?= isset($editMeasurement) ? $editMeasurement->sleeve_length : '' ?>">
                                            <small class="text-danger error-sleeve_length"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Cuff</label>
                                            <input type="number" class="form-control form-control-sm" name="cuff" placeholder="Cuff size" value="<?= isset($editMeasurement) ? $editMeasurement->cuff : '' ?>">
                                            <small class="text-danger error-cuff"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Neck</label>
                                            <input type="number" class="form-control form-control-sm" name="neck" placeholder="Neck round" value="<?= isset($editMeasurement) ? $editMeasurement->neck : '' ?>">
                                            <small class="text-danger error-neck"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Armhole</label>
                                            <input type="number" class="form-control form-control-sm" name="armhole" placeholder="Armhole size" value="<?= isset($editMeasurement) ? $editMeasurement->armhole : '' ?>">
                                            <small class="text-danger error-armhole"></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- LOWER BODY SECTION -->
                                <div id="lowerBody" class="mt-4">
                                    <h6 class="mt-3 text-primary">Lower Body Measurements</h6>
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Pant Length</label>
                                            <input type="number" class="form-control form-control-sm" name="pant_length" placeholder="Pant length" value="<?= isset($editMeasurement) ? $editMeasurement->pant_length : '' ?>">
                                            <small class="text-danger error-pant_length"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Inseam</label>
                                            <input type="number" class="form-control form-control-sm" name="inseam_length" placeholder="Inseam length" value="<?= isset($editMeasurement) ? $editMeasurement->inseam_length : '' ?>">
                                            <small class="text-danger error-inseam_length"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Waist</label>
                                            <input type="number" class="form-control form-control-sm" name="trouser_waist" placeholder="Waist size" value="<?= isset($editMeasurement) ? $editMeasurement->trouser_waist : '' ?>">
                                            <small class="text-danger error-trouser_waist"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Thigh</label>
                                            <input type="number" class="form-control form-control-sm" name="thigh" placeholder="Thigh round" value="<?= isset($editMeasurement) ? $editMeasurement->thigh : '' ?>">
                                            <small class="text-danger error-thigh"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Knee</label>
                                            <input type="number" class="form-control form-control-sm" name="knee" placeholder="Knee round" value="<?= isset($editMeasurement) ? $editMeasurement->knee : '' ?>">
                                            <small class="text-danger error-knee"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Bottom</label>
                                            <input type="number" class="form-control form-control-sm" name="bottom" placeholder="Bottom width" value="<?= isset($editMeasurement) ? $editMeasurement->bottom : '' ?>">
                                            <small class="text-danger error-bottom"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Shalwar Length</label>
                                            <input type="number" class="form-control form-control-sm" name="shalwar_length" placeholder="Shalwar length" value="<?= isset($editMeasurement) ? $editMeasurement->shalwar_length : '' ?>">
                                            <small class="text-danger error-shalwar_length"></small>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Paicha</label>
                                            <input type="number" class="form-control form-control-sm" name="paicha" placeholder="Paicha width" value="<?= isset($editMeasurement) ? $editMeasurement->paicha : '' ?>">
                                            <small class="text-danger error-paicha"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <?php if (can('measurement', 'add')): ?>
                                        <button class="btn btn-primary btn-sm mt-2" type="submit" id="saveUpdateButton">
                                            <i id="saveUpdateIcon" class="bi"></i> <span id="saveUpdateText">Save Measurement</span>
                                        </button>
                                    <?php endif; ?>

                                    <?php if (can('measurement', 'view')): ?>
                                        <a href="<?php echo base_url('Measurement/measurementList') ?>" class="btn btn-primary btn-sm mt-2 ms-3" id="saveUpdateButton">
                                            <i id="saveUpdateIcon" class="bi"></i> <span id="saveUpdateText">Show Measurement</span>
                                        </a>
                                    <?php endif; ?>
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
                // Check if we are in edit mode or create mode
                if (<?= isset($editMeasurement) ? 'true' : 'false' ?>) {
                    // If we are editing an existing measurement
                    $("#saveUpdateIcon").removeClass("bi-save").addClass("bi-pencil");
                    $("#saveUpdateText").text("Update Measurement");
                } else {
                    // If we are creating a new measurement
                    $("#saveUpdateIcon").removeClass("bi-pencil").addClass("bi-save");
                    $("#saveUpdateText").text("Save Measurement");
                }

                // On form submission
                $("#measurementForm").on("submit", function(e) {
                    e.preventDefault();

                    let url =
                        $("input[name='id']").val() === "" ?
                        "<?php echo base_url('Measurement/saveMeasurement'); ?>" :
                        "<?php echo base_url('Measurement/updateMeasurement'); ?>";

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            $(".text-danger").html("");

                            if (response.status == "error") {
                                $.each(response.errors, function(key, val) {
                                    $(".error-" + key).html(val);
                                });
                            } else if (response.status == "success") {
                                showToast("success", response.message || "Measurement saved!");

                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('Measurement'); ?>";
                                }, 800);
                            }
                        }
                    });
                });
            });



            $("#measurement_type").change(function() {
                let type = $(this).val();

                $("#upperBody").hide();
                $("#lowerBody").hide();

                if (type === "shirt" || type === "kurta" || type === "coat") {
                    $("#upperBody").show();
                }

                if (type === "pant" || type === "shalwar") {
                    $("#lowerBody").show();
                }

                if (type === "suit") {
                    $("#upperBody").show();
                    $("#lowerBody").show();
                }
            });

        </script>

</body>
<!-- [Body] end -->

</html>