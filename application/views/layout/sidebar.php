<!-- [ Sidebar Menu ] start -->
<style>
  .pc-item .pc-micon i {
    display: inline-block !important;
  }
</style>

</style>
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="<?php echo base_url('Home') ?>" class="b-brand text-primary d-flex align-items-center">
        <?php $company = $this->session->userdata('company'); ?>
        <img src="<?php echo base_url('assets/images/logo/asaanbiz.png') ?>"
          alt="user-image" width="70" height="70" class="user-avtar rounded-circle">
        <h5 class="mb-0 me-2 mt-3"><?php echo $company ?></h5>
      </a>
    </div>

    <div class="navbar-content">
      <ul class="pc-navbar">

  <!-- Dashboard -->
  <li class="pc-item">
    <a href="<?php echo base_url('Home') ?>" class="pc-link">
      <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
      <span class="pc-mtext">Dashboard</span>
    </a>
  </li>

  <!-- ================== CUSTOMER FLOW ================== -->
  <li class="pc-item pc-caption"><label>Customer Management</label></li>

  <li class="pc-item">
    <a href="<?php echo base_url('Customer') ?>" class="pc-link">
      <span class="pc-micon"><i class="ti ti-user"></i></span>
      <span class="pc-mtext">Customer</span>
    </a>
  </li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-ruler-2"></i></span>
      <span class="pc-mtext">Measurement</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Measurement') ?>" class="pc-link">Add Measurement</a></li>
      <li><a href="<?php echo base_url('Measurement/measurementList') ?>" class="pc-link">Show Measurement</a></li>
    </ul>
  </li>

  <li class="pc-item">
    <a href="<?php echo base_url('Fabrics') ?>" class="pc-link">
      <span class="pc-micon"><i class="ti ti-scissors"></i></span>
      <span class="pc-mtext">Fabrics</span>
    </a>
  </li>

  <!-- ================== ORDER FLOW ================== -->
  <li class="pc-item pc-caption"><label>Order Process</label></li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-shirt"></i></span>
      <span class="pc-mtext">Order Management</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Order') ?>" class="pc-link">Add Order</a></li>
      <li><a href="<?php echo base_url('Order/orderList') ?>" class="pc-link">Show Order</a></li>
      <li><a href="<?php echo base_url('Order/order_status') ?>" class="pc-link">Order Status Manage</a></li>
    </ul>
  </li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
      <span class="pc-mtext">Tailor Assign Task</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Tailor/tailorAssignTask') ?>" class="pc-link">Assign Task</a></li>
      <li><a href="<?php echo base_url('Tailor/tailorAssignTaskList') ?>" class="pc-link">Task List</a></li>
    </ul>
  </li>

  <!-- ================== FINANCIAL ================== -->
  <li class="pc-item pc-caption"><label>Financial Management</label></li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
      <span class="pc-mtext">Payments</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Payment') ?>" class="pc-link">Add Payment</a></li>
      <li><a href="<?php echo base_url('Payment/showPaymets') ?>" class="pc-link">Show Payment</a></li>
    </ul>
  </li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-trending-down"></i></span>
      <span class="pc-mtext">Expense</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Expense') ?>" class="pc-link">Add Expense</a></li>
      <li><a href="<?php echo base_url('Expense/showExpense') ?>" class="pc-link">Show Expense</a></li>
    </ul>
  </li>

  <li class="pc-item">
    <a href="<?php echo base_url('Reports') ?>" class="pc-link">
      <span class="pc-micon"><i class="ti ti-chart-bar"></i></span>
      <span class="pc-mtext">Reports</span>
    </a>
  </li>

  <!-- ================== ADMIN ================== -->
  <li class="pc-item pc-caption"><label>Administration</label></li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-briefcase"></i></span>
      <span class="pc-mtext">Business</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('Business') ?>" class="pc-link">Add Business</a></li>
      <li><a href="<?php echo base_url('Business/show_business') ?>" class="pc-link">Show Business</a></li>
    </ul>
  </li>

  <li class="pc-item pc-hasmenu">
    <a href="javascript:void(0)" class="pc-link">
      <span class="pc-micon"><i class="ti ti-users"></i></span>
      <span class="pc-mtext">User</span>
      <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu">
      <li><a href="<?php echo base_url('User') ?>" class="pc-link">Add User</a></li>
      <li><a href="<?php echo base_url('User/showUsers') ?>" class="pc-link">Show User</a></li>
    </ul>
  </li>

  <li class="pc-item">
    <a href="<?php echo base_url('Admin/role_permissions') ?>" target="_blank" class="pc-link">
      <span class="pc-micon"><i class="ti ti-key"></i></span>
      <span class="pc-mtext">Permission</span>
    </a>
  </li>

</ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->