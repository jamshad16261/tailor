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
                                    <?php echo $totalPendingOrders; ?>
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
                                    <?php echo $totalPaidOrder; ?>
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
                                    <?php echo $todayDeliveries; ?>
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
                                    <?php echo $totalExpense; ?>
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
                                <h6 class="mb-0 fw-semibold"><?php echo $totalCustomers; ?></h6>
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
                                <h6 class="mb-0 fw-semibold"><?php echo $totalOrders; ?></h6>
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

                                <h6 class="mb-0 fw-semibold"><?php echo $totalEarning; ?></h6>
                                <small class="text-muted d-block">Total Earnings</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $business_id = $_SESSION['business_id'];

                $query = $this->db->query("
                SELECT 
                o.order_no,
                o.order_date,
                o.total_amount,
                o.status,
                c.name as customer_name
                FROM orders o
                LEFT JOIN customers c ON c.id = o.customer_id
                WHERE o.business_id = $business_id 
                AND o.is_deleted = 0
                ORDER BY o.id DESC
                 LIMIT 8
                 ");

                $orders = $query->result();
                ?>
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
                                        <?php if (!empty($orders)) { ?>
                                            <?php foreach ($orders as $row) { ?>

                                                <tr>
                                                    <td>#<?php echo $row->order_no; ?></td>

                                                    <td>
                                                        <span class="badge bg-light-primary">
                                                            <?php echo ucfirst($row->status); ?>
                                                        </span>
                                                    </td>

                                                    <td><?php echo $row->customer_name; ?></td>

                                                    <td><?php echo date('d-M-Y', strtotime($row->order_date)); ?></td>

                                                    <td class="text-end fw-semibold">
                                                        PKR <?php echo number_format($row->total_amount); ?>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No Orders Found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $business_id = $_SESSION['business_id'];

                $query = $this->db->query("
                SELECT 
                p.id,
                p.amount,
                p.method,
                p.remarks,
                p.entry_date,
                o.order_no
                FROM payments p
                LEFT JOIN orders o ON o.id = p.order_id
                WHERE p.business_id = $business_id 
                AND p.is_deleted = 0
                ORDER BY p.id DESC
                LIMIT 3
                ");
                $payments = $query->result();
                ?>
                <div class="col-md-12 col-xl-4 mt-3">
                    <h5 class="mb-3">Transaction History</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">

                            <?php if (!empty($payments)) { ?>

                                <?php foreach ($payments as $row) { ?>

                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex">

                                            <!-- LEFT ICON -->
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s rounded-circle bg-light-primary">
                                                    <i class="ti ti-cash f-18"></i>
                                                </div>
                                            </div>

                                            <!-- MID TEXT -->
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Order #<?php echo $row->order_no; ?></h6>
                                                <p class="mb-0 text-muted">
                                                    <?php echo date('d-M-Y', strtotime($row->entry_date)); ?>
                                                </p>
                                            </div>

                                            <!-- RIGHT AMOUNT -->
                                            <div class="flex-shrink-0 text-end">
                                                <h6 class="mb-0 text-success">
                                                    PKR <?php echo number_format($row->amount); ?>
                                                </h6>

                                                <p class="mb-0 text-muted mt-1">
                                                    <strong>Method:</strong> <?php echo $row->method; ?>
                                                </p>

                                                <?php if (!empty($row->remarks)) { ?>
                                                    <small class="text-muted">
                                                        <?php echo $row->remarks; ?>
                                                    </small>
                                                <?php } ?>
                                            </div>

                                        </div>
                                    </a>

                                <?php } ?>

                            <?php } else { ?>

                                <div class="text-center p-3">
                                    No Transaction Found
                                </div>

                            <?php } ?>

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