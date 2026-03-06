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
                                <h4 class="mb-0">Business</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
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

            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Add Business & Admin User</h5>
                        </div>
                        <div class="card-body">
                            <form id="BusinessForm">

                                <!-- Business Info -->
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label mb-1">Business Name *</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="business_name"
                                            placeholder="e.g. Royal Stitch Tailors">
                                        <small class="text-danger error-business_name"></small>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Business Phone *</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="business_phone"
                                            placeholder="e.g. +92 300 1234567">
                                        <small class="text-danger error-business_phone"></small>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label mb-1">Business Email</label>
                                        <input type="email" class="form-control form-control-sm"
                                            name="business_email"
                                            placeholder="e.g. info@royalstitch.com">
                                        <small class="text-danger error-business_email"></small>
                                    </div>
                                </div>

                                <!-- Address + Status -->
                                <div class="row g-3 mb-2">
                                    <div class="col-md-7">
                                        <label class="form-label mb-1">Address</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="address"
                                            placeholder="Shop #12, Main Market, Lahore">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label mb-1">Status *</label>
                                        <select class="form-select form-select-sm" name="business_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
 
                                <!-- User Info -->
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Owner Name *</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="user_name"
                                            placeholder="e.g. Muhammad Ali">
                                        <small class="text-danger error-user_name"></small>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label mb-1">User Phone *</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="user_phone"
                                            placeholder="e.g. +92 301 9876543">
                                        <small class="text-danger error-user_email"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label mb-1">User Email *</label>
                                        <input type="email" class="form-control form-control-sm"
                                            name="user_email"
                                            placeholder="e.g. owner@royalstitch.com">
                                        <small class="text-danger error-user_email"></small>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label mb-1">Role *</label>
                                        <select class="form-select form-select-sm" name="role">
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="tailor">Tailor</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label mb-1">Password *</label>
                                        <input type="password" class="form-control form-control-sm"
                                            name="password"
                                            placeholder="Minimum 8 characters">
                                        <small class="text-danger error-password"></small>
                                    </div>

                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>


    <!-- jQuery CDN (latest 3.x version) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#BusinessForm").on("submit", function(e) {
                $('#btnSave').attr('disabled', true);
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url('Business/save'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        // Clear old errors
                        $(".text-danger").html("");

                        if (response.status == "error") {
                            $.each(response.errors, function(key, val) {
                                $(".error-" + key).html(val);
                            });
                            showToast("warning", "Please fill all required fields!");
                            $('#btnSave').attr('disabled', false);
                        } else if (response.status == "success") {
                            $("#BusinessForm")[0].reset();
                            showToast("success", "Data saved successfully!");
                            $('#btnSave').attr('disabled', false);
                        }
                    },
                    error: function() {
                        showToast("error", "Something went wrong!");
                        $('#btnSave').attr('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
<!-- [Body] end -->

</html>