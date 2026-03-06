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
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="row">
                <div class="row">
                    <!-- Pending Orders -->
                    <?php
                        $business_id = $_SESSION['business_id']; // ya jahan se milta ho
                        $query = $this->db->query("SELECT COUNT(id) as pendingOrder FROM orders WHERE business_id = $business_id AND is_deleted = 0 AND status = 'pending' ");
                        $result = $query->row();
                        $totalPendingOrders = $result->pendingOrder ?? 0;
                    ?>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Pending Orders</h6>
                                <h4 class="mb-3">
                                    <?php echo $totalPendingOrders;?>
                                    <span class="badge bg-light-danger border border-danger">
                                        <i class="ti ti-clock"></i> Due
                                    </span>
                                </h4>
                                <p class="mb-0 text-muted text-sm">Orders waiting for stitching</p>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Orders -->
                    <?php
                        $business_id = $_SESSION['business_id']; // ya jahan se milta ho
                        $query = $this->db->query("SELECT COUNT(id) as paidOrder FROM orders WHERE business_id = $business_id AND is_deleted = 0 AND status = 'paid' ");
                        $result = $query->row();
                        $totalPaidOrder = $result->paidOrder ?? 0;
                    ?>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Completed Orders</h6>
                                <h4 class="mb-3">
                                   <?php echo $totalPaidOrder;?>
                                    <span class="badge bg-light-success border border-success">
                                        <i class="ti ti-check"></i>
                                    </span>
                                </h4>
                                <p class="mb-0 text-muted text-sm">Orders delivered this month</p>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Deliveries -->
                    <?php
                        $business_id = $_SESSION['business_id']; // ya jahan se milta ho
                        $query = $this->db->query("SELECT COUNT(id) as todayDeliveries FROM orders WHERE business_id = $business_id 
                        AND is_deleted = 0 and status = 'delivered' AND DATE(delivery_date) = CURDATE() ");
                        $result = $query->row();
                        $todayDeliveries = $result->todayDeliveries ?? 0;
                    ?>
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Today's Deliveries</h6>
                                <h4 class="mb-3">
                                    <?php echo $todayDeliveries;?>
                                    <span class="badge bg-light-primary border border-primary">
                                        <i class="ti ti-truck-delivery"></i> Today
                                    </span>
                                </h4>
                                <p class="mb-0 text-muted text-sm">Suits to be delivered today</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Expense -->
                    <?php
                        $business_id = $_SESSION['business_id'];
                        $query = $this->db->query("SELECT SUM(amount) as totalExpense FROM expenses WHERE business_id = $business_id 
                        AND is_deleted = 0");
                        $result = $query->row();
                        $totalExpense = $result->totalExpense ?? 0;
                    ?>
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2 f-w-400 text-muted">Total Expense</h6>
                                <h4 class="mb-3">
                                    <?php echo $totalExpense;?>
                                    <span class="badge bg-light-warning border border-warning">
                                        <i class="ti ti-cash"></i> Pending
                                    </span>
                                </h4>
                                <p class="mb-0 text-muted text-sm">Remaining payments</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ======= Bottom Small Cards Row ======= -->
                <div class="row mt-3">
                    <?php
                        $business_id = $_SESSION['business_id']; // ya jahan se milta ho
                        $query = $this->db->query("SELECT COUNT(id) as totalCustomers FROM customers WHERE business_id = $business_id AND is_deleted = 0");
                        $result = $query->row();
                        $totalCustomers = $result->totalCustomers ?? 0;
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-2 text-center">
                                <i class="ti ti-users text-primary fs-5 mb-1"></i>
                                <h6 class="mb-0 fw-semibold"><?php echo $totalCustomers;?></h6>
                                <small class="text-muted d-block">Customers</small>
                            </div>
                        </div>
                    </div>
                    <!-- Total Orders -->
                    <?php
                        $business_id = $_SESSION['business_id'];
                        $query = $this->db->query("SELECT COUNT(id) as totalOrders FROM orders WHERE business_id = $business_id AND is_deleted = 0");
                        $result = $query->row();
                        $totalOrders = $result->totalOrders ?? 0;
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-2 text-center">
                                <i class="ti ti-scissors text-success fs-5 mb-1"></i>
                                <h6 class="mb-0 fw-semibold"><?php echo $totalOrders;?></h6>
                                <small class="text-muted d-block">Total Orders</small>
                            </div>
                        </div>
                    </div>
                    <!-- Suit Designs -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-2 text-center">
                                <i class="ti ti-shirt text-info fs-5 mb-1"></i>
                                <h6 class="mb-0 fw-semibold">500</h6>
                                <small class="text-muted d-block">Suit Designs</small>
                            </div>
                        </div>
                    </div>

                    <!-- Total Earnings -->
                    <?php
                        $business_id = $_SESSION['business_id'];
                        $query = $this->db->query("SELECT SUM(amount) as totalEarning FROM payments WHERE business_id = $business_id AND is_deleted = 0");
                        $result = $query->row();
                        $totalEarning = $result->totalEarning ?? 0;
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-2 text-center">
                                <i class="fas fa-money-bill-wave text-warning fs-5"></i>

                                <h6 class="mb-0 fw-semibold"><?php echo $totalEarning;?></h6>
                                <small class="text-muted d-block">Total Earnings</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-8 mt-3">
                    <h5 class="mb-3">Recent Vouchers</h5>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="supplierTable" class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tran#</th>
                                            <th>TYPE</th>
                                            <th>NAME</th>
                                            <th>DATE</th>
                                            <th class="text-end">TOTAL AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1001</td>
                                            <td><span class="badge bg-light-primary">Stitching</span></td>
                                            <td>Ali Khan</td>
                                            <td>09-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 3,500</td>
                                        </tr>
                                        <tr>
                                            <td>#1002</td>
                                            <td><span class="badge bg-light-success">Advance</span></td>
                                            <td>Ahmed Tailors</td>
                                            <td>09-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 2,000</td>
                                        </tr>
                                        <tr>
                                            <td>#1003</td>
                                            <td><span class="badge bg-light-warning">Expense</span></td>
                                            <td>Cloth Purchase</td>
                                            <td>08-Oct-2025</td>
                                            <td class="text-end fw-semibold text-danger">PKR 1,200</td>
                                        </tr>
                                        <tr>
                                            <td>#1004</td>
                                            <td><span class="badge bg-light-info">Delivered</span></td>
                                            <td>Usman Raza</td>
                                            <td>08-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 4,800</td>
                                        </tr>
                                        <tr>
                                            <td>#1005</td>
                                            <td><span class="badge bg-light-primary">Stitching</span></td>
                                            <td>Bilal Ahmed</td>
                                            <td>07-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 6,200</td>
                                        </tr>
                                        <tr>
                                            <td>#1006</td>
                                            <td><span class="badge bg-light-success">Advance</span></td>
                                            <td>Sara Khan</td>
                                            <td>07-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 3,700</td>
                                        </tr>
                                        <tr>
                                            <td>#1007</td>
                                            <td><span class="badge bg-light-warning">Expense</span></td>
                                            <td>Thread & Buttons</td>
                                            <td>06-Oct-2025</td>
                                            <td class="text-end fw-semibold text-danger">PKR 950</td>
                                        </tr>
                                        <tr>
                                            <td>#1008</td>
                                            <td><span class="badge bg-light-info">Delivered</span></td>
                                            <td>Hassan Ali</td>
                                            <td>06-Oct-2025</td>
                                            <td class="text-end fw-semibold">PKR 5,400</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-12 col-xl-4 mt-3">
                    <h5 class="mb-3">Transaction History</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">

                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex">
                                    <!-- LEFT ICON -->
                                    <div class="flex-shrink-0">
                                        <div class="avtar avtar-s rounded-circle ">
                                            <i class="f-18"></i>
                                        </div>
                                    </div>

                                    <!-- MID TEXT -->
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">100</h6>
                                        <p class="mb-0 text-muted">2025-10-09</p>
                                    </div>

                                    <!-- RIGHT AMOUNTS -->
                                    <div class="flex-shrink-0 text-end">
                                        <small class="text-muted">Dr: </small>
                                        <h6 class="mb-0 text-danger d-inline">300</h6><br>
                                        <small class="text-muted">Cr: </small>
                                        <h6 class="mb-0 text-success d-inline">500</h6>
                                        <p class="mb-0 text-muted mt-1"><strong style="color: black;">Type: </strong>Remarks</p>
                                    </div>
                                </div>
                            </a>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>


</body>
<!-- [Body] end -->

</html>