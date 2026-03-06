    <!-- [ Main Content ] end -->

<style>
    html, body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .pc-container {
        flex: 1;
    }

    .pc-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #f8f9fa;
        border-top: 1px solid #ddd;
        z-index: 1030;
        padding: 8px 0;
    }

    /* Content bottom spacing so it doesn't hide behind footer */
    .pc-container {
        padding-bottom: 60px;
    }
</style>

    <!--<footer class="pc-footer bg-light">-->
    <!--    <div class="footer-wrapper container-fluid">-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm my-1">-->
    <!--                <p class="m-0">-->
    <!--                    &copy; <span id="currentYear"></span> &#9829; Developed By-->
    <!--                    <a href="https://themeforest.net/user/codedthemes" target="_blank">Asaan Biz</a>-->
    <!--                </p>-->

    <!--                <script>-->
                        <!--// Current Year auto set karega-->
    <!--                    document.getElementById("currentYear").textContent = new Date().getFullYear();-->
    <!--                </script>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</footer>-->



    <!-- [Page Specific JS] start -->
    <script src="<?php echo base_url('assets/js/plugins/apexcharts.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/pages/dashboard-default.js') ?>"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="<?php echo base_url('assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/fonts/custom-font.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/pcoded.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/feather.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Datatable links-->
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function showToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end', // top-right corner
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: type, // "success", "error", "warning", "info", "question"
                title: message
            });
        }
    </script>


    <!-- jQuery CDN (latest 3.x version) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Data Table Links -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        layout_change('light');
    </script>

        <script>
            $(document).ready(function () {
            $('#supplierTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,  // default rows per page
                "columnDefs": [
                    { "orderable": false, "targets": -1 } // Action column not sortable
                ]
            });
        });

        </script>


    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>