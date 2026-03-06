<div class="pc-container">
    <div class="pc-content">
       <div class="page-header d-flex justify-content-between align-items-center">
    <h4><?= $page_title ?? 'Activity History' ?></h4>
    <div class="page-header-breadcrumb">
        <button class="btn btn-primary btn-sm me-2" onclick="exportHistory()">
            <i class="feather icon-download"></i> Export History
        </button>
        <button class="btn btn-secondary btn-sm" onclick="clearFilters()">
            <i class="feather icon-refresh-cw"></i> Reset
        </button>
    </div>
</div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="feather icon-clock"></i>
                            </div>
                            <div class="stat-content ms-3">
                                <h5 class="mb-0">156</h5>
                                <span>Total Activities</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="feather icon-check-circle"></i>
                            </div>
                            <div class="stat-content ms-3">
                                <h5 class="mb-0">124</h5>
                                <span>Successful</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="feather icon-alert-triangle"></i>
                            </div>
                            <div class="stat-content ms-3">
                                <h5 class="mb-0">23</h5>
                                <span>Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="feather icon-x-circle"></i>
                            </div>
                            <div class="stat-content ms-3">
                                <h5 class="mb-0">9</h5>
                                <span>Failed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mt-3 filter-card">
            <div class="card-header">
                <h5>Filter History</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date Range</label>
                            <select class="form-control">
                                <option>Today</option>
                                <option>Yesterday</option>
                                <option>Last 7 Days</option>
                                <option>This Month</option>
                                <option>Last Month</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Activity Type</label>
                            <select class="form-control">
                                <option>All Activities</option>
                                <option>Login Attempts</option>
                                <option>Profile Updates</option>
                                <option>Project Changes</option>
                                <option>Settings Changes</option>
                                <option>Security Events</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option>All Status</option>
                                <option>Success</option>
                                <option>Pending</option>
                                <option>Failed</option>
                                <option>In Progress</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" class="form-control" placeholder="Search activities...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Section -->
        <div class="card mt-3 timeline-card">
            <div class="card-header">
                <h5>Recent Activities</h5>
                <span class="badge">Last 30 days</span>
            </div>
            <div class="card-body">
                <div class="history-date-header">
                    <h6>Today</h6>
                </div>
                <div class="history-timeline">
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <i class="feather icon-check"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Project Uploaded Successfully</h6>
                                <small>2 hours ago</small>
                            </div>
                            <p>E-Commerce Platform - Version 2.0 uploaded to production server</p>
                            <div class="timeline-meta">
                                <span class="badge">Success</span>
                                <span><i class="feather icon-map-pin"></i> Production Server</span>
                                <span><i class="feather icon-user"></i> Alex Johnson</span>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <i class="feather icon-alert-circle"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6>Security Alert: New Login Detected</h6>
                                <small>5 hours ago</small>
                            </div>
                            <p>New login from unknown device in San Francisco, CA</p>
                            <div class="timeline-meta">
                                <span class="badge">Pending Review</span>
                                <span><i class="feather icon-device"></i> Chrome on Windows</span>
                                <span><i class="feather icon-ip"></i> IP: 192.168.1.1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-responsive mt-4">
            <h6>Detailed History Log</h6>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Activity</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>IP Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-01-15 09:30 AM</td>
                        <td>Login Successful</td>
                        <td>Authentication</td>
                        <td><span class="badge">Success</span></td>
                        <td>192.168.1.100</td>
                        <td>
                            <button class="btn btn-sm btn-icon"><i class="feather icon-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2024-01-15 08:45 AM</td>
                        <td>Password Changed</td>
                        <td>Security</td>
                        <td><span class="badge">Success</span></td>
                        <td>192.168.1.100</td>
                        <td>
                            <button class="btn btn-sm btn-icon"><i class="feather icon-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* ===== Base Colors ===== */
:root {
    --primary: #667eea;
    --primary-dark: #5a5fd1;
    --primary-light: #e0e3ff;
    --accent-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* ===== General ===== */
.pc-container {
    padding: 20px;
    font-family: 'Inter', sans-serif;
    background: #f7f8fc;
}
.pc-content h4 {
    color: var(--primary-dark);
}

/* ===== Stat Cards ===== */
.stat-card {
    background: var(--primary);
    color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(102, 126, 234, 0.15);
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2);
}
.stat-icon i {
    font-size: 28px;
    color: #fff;
}
.page-header-breadcrumb button {
    margin-left: 5px;
}
/* ===== Buttons ===== */
.btn-primary {
    background: var(--primary);
    border: none;
    transition: all 0.3s;
}
.btn-primary:hover {
    background: var(--accent-gradient);
}
.btn-secondary {
    background: var(--primary-light);
    color: var(--primary-dark);
    border: none;
}
.btn-secondary:hover {
    background: #d0d4ff;
}

/* ===== Filter Card ===== */
.filter-card {
    border-left: 4px solid var(--primary);
}
.filter-card h5 {
    color: var(--primary);
}

/* ===== Timeline ===== */
.timeline-card {
    border-radius: 8px;
}
.timeline-badge {
    background: var(--accent-gradient);
    color: #fff;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.timeline-content {
    background: var(--primary-light);
    padding: 12px;
    border-radius: 6px;
    margin-left: 40px;
    transition: all 0.3s;
}
.timeline-content:hover {
    background: #fff;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
}

/* ===== Badges ===== */
.badge {
    background: rgba(102,126,234,0.15);
    color: var(--primary);
    font-weight: 500;
}

/* ===== Table ===== */
.table-hover tbody tr:hover {
    background: rgba(102,126,234,0.08);
}
.table th, .table td {
    vertical-align: middle;
}

/* ===== Inputs & Selects ===== */
.form-control {
    border-color: var(--primary-light);
}

/* ===== Misc ===== */
.history-date-header h6 {
    color: var(--primary-dark);
    font-weight: 600;
}
.page-link {
    color: var(--primary);
}
.page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
}
</style>