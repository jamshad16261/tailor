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
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">

                        <!-- Heading Left -->
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">User</h4>
                            </div>
                        </div>

                        <!-- Breadcrumb Right -->
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

            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Add User & Admin User</h5>
                        </div>
                        <div class="card-body">
                            <form id="userForm" method="POST" action="user_store.php">

                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-md-4">
                                        <label class="form-label mb-1">Name <small style="color:red;">*</small></label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="user_name" placeholder="e.g. Muhammad Ali" >
                                        <small class="text-danger error-user_name"></small>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Phone <small style="color:red;">*</small></label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="user_phone" placeholder="+92 300 1234567" >
                                        <small class="text-danger error-user_phone"></small>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Email <small style="color:red;">*</small></label>
                                        <input type="email" class="form-control form-control-sm"
                                            name="user_email" placeholder="user@email.com" >
                                        <small class="text-danger error-user_email"></small>
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-2">
                                        <label class="form-label mb-1">Role <small style="color:red;">*</small></label>
                                        <select class="form-select form-select-sm" name="role" >
                                            <option value="">Select</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="tailor">Tailor</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                        <small class="text-danger error-role"></small>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Password <small style="color:red;">*</small></label>
                                        <input type="password" class="form-control form-control-sm"
                                            name="password" placeholder="Min 8 chars" >
                                        <small class="text-danger error-password"></small>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Status <small style="color:red;">*</small></label>
                                        <select class="form-select form-select-sm" name="User_status" >
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                        <small class="text-danger error-User_status"></small>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">
                                            Save User
                                        </button>
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
            $("#userForm").on("submit", function(e) {
                $('#btnSave').attr('disabled', true);
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url('User/saveUser'); ?>",
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
                            $("#userForm")[0].reset();
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


    <?php $this->load->view('layout/footer'); ?>


</body>
<!-- [Body] end -->

</html>