<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="pc-container">
        <div class="pc-content">
            
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="page-header-title">
                                <h4 class="mb-0"><?= $page_title ?? 'Activity History' ?></h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <ul class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Activity History</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <!-- Total Activities Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Total Activities</h6>
                            <h4 class="mb-3">
                                <?= $stats['total'] ?? 0 ?>
                                <span class="badge bg-light-primary border border-primary">
                                    <i class="ti ti-history"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">All time activities</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Activities Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Today's Activities</h6>
                            <h4 class="mb-3">
                                <?= $stats['today'] ?? 0 ?>
                                <span class="badge bg-light-success border border-success">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Activities recorded today</p>
                        </div>
                    </div>
                </div>

                <!-- This Week Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">This Week</h6>
                            <h4 class="mb-3">
                                <?= $stats['week'] ?? 0 ?>
                                <span class="badge bg-light-info border border-info">
                                    <i class="ti ti-calendar-week"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Last 7 days activities</p>
                        </div>
                    </div>
                </div>

                <!-- This Month Card -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">This Month</h6>
                            <h4 class="mb-3">
                                <?= $stats['month'] ?? 0 ?>
                                <span class="badge bg-light-warning border border-warning">
                                    <i class="ti ti-calendar-month"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Last 30 days activities</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats for Admin -->
            <?php if($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super_admin'): ?>
            <div class="row">
                <!-- Unique Users Card -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Active Users</h6>
                            <h4 class="mb-3">
                                <?= $stats['unique_users'] ?? 0 ?>
                                <span class="badge bg-light-secondary border border-secondary">
                                    <i class="ti ti-users"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Users with activities</p>
                        </div>
                    </div>
                </div>

                <!-- Insert Operations Card -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Insert Operations</h6>
                            <h4 class="mb-3">
                                <?= $stats['inserts'] ?? 0 ?>
                                <span class="badge bg-light-success border border-success">
                                    <i class="ti ti-plus"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Total insert activities</p>
                        </div>
                    </div>
                </div>

                <!-- Update Operations Card -->
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-400 text-muted">Update Operations</h6>
                            <h4 class="mb-3">
                                <?= $stats['updates'] ?? 0 ?>
                                <span class="badge bg-light-info border border-info">
                                    <i class="ti ti-edit"></i>
                                </span>
                            </h4>
                            <p class="mb-0 text-muted text-sm">Total update activities</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Filters Section -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="text-white mb-0">
                                <i class="ti ti-filter me-2"></i>Filter Activities
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <form method="GET" action="" class="row g-2">
                                <div class="col-md-2">
                                    <label class="form-label small mb-1">Action</label>
                                    <select name="action" class="form-select form-select-sm">
                                        <option value="">All Actions</option>
                                        <?php foreach($actions as $a): ?>
                                            <option value="<?= $a->action ?>" <?= $this->input->get('action') == $a->action ? 'selected' : '' ?>>
                                                <?= ucfirst($a->action) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label small mb-1">Module</label>
                                    <select name="module" class="form-select form-select-sm">
                                        <option value="">All Modules</option>
                                        <?php foreach($modules as $m): ?>
                                            <option value="<?= $m->table_name ?>" <?= $this->input->get('module') == $m->table_name ? 'selected' : '' ?>>
                                                <?= ucfirst(str_replace('_', ' ', $m->table_name)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label small mb-1">From Date</label>
                                    <input type="date" name="date_from" class="form-control form-control-sm" value="<?= $this->input->get('date_from') ?>">
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label small mb-1">To Date</label>
                                    <input type="date" name="date_to" class="form-control form-control-sm" value="<?= $this->input->get('date_to') ?>">
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label small mb-1">Search</label>
                                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="<?= $this->input->get('search') ?>">
                                </div>
                                
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-sm me-1">
                                        <i class="ti ti-search"></i> Filter
                                    </button>
                                    <a href="<?= base_url('history') ?>" class="btn btn-secondary btn-sm">
                                        <i class="ti ti-refresh"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Buttons for Admin -->
            <?php if($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'super_admin'): ?>
            <div class="row mt-2">
                <div class="col-md-12 text-end">
                    <a href="<?= base_url('history/export') ?>" class="btn btn-success btn-sm">
                        <i class="ti ti-download"></i> Export to CSV
                    </a>
                    <?php if($this->session->userdata('role') == 'super_admin'): ?>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                        <i class="ti ti-trash"></i> Clear Old Logs
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- History Table -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="text-white mb-0">
                                <i class="ti ti-history me-2"></i>Activity History
                            </h5>
                            <span class="badge bg-light text-dark">Total: <?= count($history) ?></span>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table id="supplierTable" class="table table-bordered table-sm" style="font-size:12px; border-collapse: collapse; width:100%;">
                                    <thead class="thead-light" style="background:#f8f9fa;">
                                        <tr>
                                            <th width="150">Date & Time</th>
                                            <th width="120">User</th>
                                            <th width="100">Action</th>
                                            <th width="120">Module</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($history)): ?>
                                            <?php foreach ($history as $row): ?>
                                                <tr>
                                                    <td>
                                                        <i class="ti ti-clock text-muted me-1"></i>
                                                        <?= date('d M Y h:i A', strtotime($row->created_at)) ?>
                                                    </td>
                                                    <td>
                                                        <i class="ti ti-user text-primary me-1"></i>
                                                        <?= $row->user_name ?? 'System' ?>
                                                        <?php if($row->user_id == $this->session->userdata('user_id')): ?>
                                                            <span class="badge bg-light text-dark ms-1">You</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $badge_class = 'bg-primary';
                                                            if($row->action == 'insert') $badge_class = 'bg-success';
                                                            if($row->action == 'update') $badge_class = 'bg-info';
                                                            if($row->action == 'delete') $badge_class = 'bg-danger';
                                                            if($row->action == 'login') $badge_class = 'bg-warning';
                                                            if($row->action == 'logout') $badge_class = 'bg-secondary';
                                                        ?>
                                                        <span class="badge <?= $badge_class ?>" style="font-size:11px;">
                                                            <?= ucfirst($row->action) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <i class="ti ti-table text-muted me-1"></i>
                                                        <?= ucfirst(str_replace('_', ' ', $row->table_name)) ?>
                                                    </td>
                                                    <td>
                                                        <?= $row->description ?>
                                                        <?php if($row->record_id): ?>
                                                            <small class="text-muted">(ID: <?= $row->record_id ?>)</small>
                                                        <?php endif; ?>
                                                    </td>
                                                   
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="ti ti-history fa-2x mb-2"></i>
                                                    <p class="mb-0">No Activity Found</p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white">
                        <i class="ti ti-info-circle me-2"></i>Activity Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white py-1">
                                    <h6 class="text-white mb-0">Old Data</h6>
                                </div>
                                <div class="card-body p-2">
                                    <pre id="oldData" class="bg-light p-2 rounded" style="max-height: 300px; overflow: auto; font-size:11px;"></pre>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white py-1">
                                    <h6 class="text-white mb-0">New Data</h6>
                                </div>
                                <div class="card-body p-2">
                                    <pre id="newData" class="bg-light p-2 rounded" style="max-height: 300px; overflow: auto; font-size:11px;"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Clear Old Logs Modal (Only for Super Admin) -->
    <?php if($this->session->userdata('role') == 'super_admin'): ?>
    <div class="modal fade" id="clearLogsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Clear Old Logs</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to clear logs older than 30 days?</p>
                    <p class="text-danger"><small>This action cannot be undone!</small></p>
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i> Total logs to be cleared: <strong><?= $stats['old_logs'] ?? 0 ?></strong>
                    </div>su
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('history/clear_old_logs') ?>" class="btn btn-warning">Clear Logs</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
    // Show details in modal
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function() {
            const oldData = this.dataset.old;
            const newData = this.dataset.new;
            
            document.getElementById('oldData').textContent = oldData && oldData != 'null' ? 
                JSON.stringify(JSON.parse(oldData), null, 2) : 'No old data';
            document.getElementById('newData').textContent = newData && newData != 'null' ? 
                JSON.stringify(JSON.parse(newData), null, 2) : 'No new data';
        });
    });

    // Toast notification function
    function showToast(type, message) {
        let toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Auto refresh every 5 minutes (optional)
    // setTimeout(() => {
    //     location.reload();
    // }, 300000);
    </script>

    <style>
    .table td, .table th {
        vertical-align: middle;
        padding: 0.5rem;
    }
    .badge {
        padding: 4px 8px;
    }
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        margin-bottom: 0;
    }
    .btn-xs {
        padding: 0.2rem 0.4rem;
        font-size: 0.7rem;
    }
    .card .badge {
        float: right;
        margin-top: -5px;
    }
    </style>

</body>