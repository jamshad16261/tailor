<?php $this->load->view('layout/header'); ?>
<style>
    .report-card {
        transition: 0.2s ease-in-out;
        border-radius: 10px;
        padding: 10px 14px;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
    }

    .report-icon {
        font-size: 20px;
        margin-right: 10px;
    }

    .section-title {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 6px;
        color: black;
        text-transform: uppercase;
    }
</style>
<!-- Font Awesome Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php $this->load->view('layout/sidebar'); ?>

    <div class="pc-container">
        <div class="pc-content">

            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0">Reports List</h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reports Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="mb-4 text-primary fw-semibold">
                                <i class="fa-solid fa-chart-line me-2"></i>Reports Dashboard
                            </h5>

                            <!-- ORDERS & PRODUCTION -->
                            <div class="section-title">Orders & Production</div>
                            <div class="row g-2">

                                    <div class="col-6 col-md-3">
                                        <a href="<?= base_url('Reports/ordersReport') ?>" target="_blank" class="text-decoration-none">
                                            <div class="bg-primary bg-opacity-10 d-flex align-items-center gap-2 p-2 rounded">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-25 rounded">
                                                    <i class="fa-solid fa-clipboard-list text-primary report-icon"></i>
                                                </div>
                                                <span class="text-primary small">Orders Report</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="<?= base_url('Reports/workAssigReport') ?>" target="_blank" class="text-decoration-none">
                                            <div class="bg-primary bg-opacity-10 d-flex align-items-center gap-2 p-2 rounded">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-25 rounded">
                                                    <i class="fa-solid fa-scissors text-primary report-icon"></i>
                                                </div>
                                                <span class="text-primary small">Work Assign Report</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="<?= base_url('Reports/sale_report') ?>" target="_blank" class="text-decoration-none">
                                            <div class="bg-primary bg-opacity-10 d-flex align-items-center gap-2 p-2 rounded">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-25 rounded">
                                                    <i class="fa-solid fa-id-card text-primary fs-6"></i>
                                                </div>
                                                <span class="text-primary small">Sales Report</span>
                                            </div>
                                        </a>
                                    </div>
                                
                                 
                                    <div class="col-6 col-md-3">
                                        <a href="<?= base_url('Reports/pendingPaymentReport') ?>" target="_blank" class="text-decoration-none">
                                            <div class="bg-primary bg-opacity-10 d-flex align-items-center gap-2 p-2 rounded">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-25 rounded">
                                                    <i class="fa-solid fa-user text-primary fs-6"></i>
                                                </div>
                                                <span class="text-primary small">Pending Payment Report</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="<?= base_url('Reports/tailorPerformanceReport') ?>" target="_blank" class="text-decoration-none">
                                            <div class="bg-primary bg-opacity-10 d-flex align-items-center gap-2 p-2 rounded">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-25 rounded">
                                                    <i class="fa-solid fa-user text-primary fs-6"></i>
                                                </div>
                                                <span class="text-primary small">Tailor Performance Report</span>
                                            </div>
                                        </a>
                                    </div>                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <?php $this->load->view('layout/footer'); ?>
</body>

</html>