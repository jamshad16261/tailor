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
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Customer</h4>
                            </div>
                        </div>

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

            <?php $user = $this->session->userdata('business_id'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                             <h5>Role Permission Management</h5>
                        </div>
                        <div class="card-body">
                            <!-- Single Form for Permissions -->
                            <form id="permissionForm">
                                <div class="container">
                                   

                                    <!-- ROLE SELECT -->
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Role</label>
                                                <select id="role_key" name="role_key" class="form-control form-control-sm">
                                                    <option value="">-- Select Role --</option>
                                                    <?php foreach ($roles as $r): ?>
                                                        <option value="<?= $r->role_key ?>"><?= ucfirst($r->role_key) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                <div class="col-md-12">
                    <!-- Permission Box Wrapper -->
                    <div class="card mt-3">
                        <div class="card-header py-2">
                            <strong>Permissions</strong>
                        </div>

                        <div class="card-body">
                            <div id="permissionBox" class="row g-3">
                                <!-- permissions ajax se yahan load hongi -->
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            Save Permissions
                        </button>
                    </div>
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
        // Load Permissions based on Role Selection
        $('#role_key').change(function() {
            var role = $(this).val();
            if (role == '') return;

            $.post("<?= base_url('admin/loadPermissions') ?>", {
                role: role
            }, function(res) {
                $('#permissionBox').html(res);
            });
        });

        // Handle form submission using AJAX
        $('#permissionForm').submit(function(e) {
            e.preventDefault(); // Prevent form from reloading page

            // Make an AJAX request to save the form data
            $.post("<?= base_url('admin/savePermissions') ?>", $(this).serialize(), function(res) {
                showToast("success",res);
            });
        });
    </script>

    <?php $this->load->view('layout/footer'); ?>

</body>
<!-- [Body] end -->

</html>
