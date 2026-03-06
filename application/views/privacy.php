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
            <!-- [ Privacy Center Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="mb-3">Privacy Center</h2>
                        <!--<p class="text-muted">Your privacy and security matter to us</p>-->
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check me-2"></i>
                    <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Privacy Stats Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary">
                                    <i class="ti ti-shield"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Privacy Score</h6>
                                    <h4 class="mb-0">85%</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success">
                                    <i class="ti ti-device-analytics"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Data Requests</h6>
                                    <h4 class="mb-0">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-info">
                                    <i class="ti ti-clock"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Last Review</h6>
                                    <h4 class="mb-0">2d ago</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning">
                                    <i class="ti ti-cookie"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-1">Active Sessions</h6>
                                    <h4 class="mb-0">2</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacy Settings Tabs -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#privacy-controls" role="tab">
                                        <i class="ti ti-lock me-2"></i>Privacy Controls
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#data-requests" role="tab">
                                        <i class="ti ti-database me-2"></i>Data Requests
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#security-logs" role="tab">
                                        <i class="ti ti-history me-2"></i>Security Logs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#legal" role="tab">
                                        <i class="ti ti-file-text me-2"></i>Legal Documents
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Privacy Controls Tab -->
                                <div class="tab-pane fade show active" id="privacy-controls" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h5>Privacy Settings</h5>
                                            <p class="text-muted">Manage your privacy preferences and data sharing options</p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Profile Visibility</h6>
                                                        <small class="text-muted">Control who can see your profile</small>
                                                    </div>
                                                    <div>
                                                        <select class="form-select form-select-sm" style="width: 130px;">
                                                            <option>Public</option>
                                                            <option selected>Private</option>
                                                            <option>Friends Only</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Activity Status</h6>
                                                        <small class="text-muted">Show when you're active</small>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Search Engines</h6>
                                                        <small class="text-muted">Allow indexing by search engines</small>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Data Collection</h6>
                                                        <small class="text-muted">Allow anonymous data collection</small>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Location Sharing</h6>
                                                        <small class="text-muted">Share your location</small>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="privacy-card mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Email Privacy</h6>
                                                        <small class="text-muted">Hide email from others</small>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <hr class="my-3">
                                            <button class="btn btn-primary">
                                                <i class="ti ti-device-floppy me-2"></i>Save Privacy Settings
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Requests Tab -->
                                <div class="tab-pane fade" id="data-requests" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h5>Data Requests</h5>
                                            <p class="text-muted">Request your data or manage existing requests</p>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card request-card" onclick="requestData('export')">
                                                <div class="card-body text-center">
                                                    <i class="ti ti-download fs-1 text-primary"></i>
                                                    <h6 class="mt-2">Export Data</h6>
                                                    <small class="text-muted">Download all your data</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card request-card" onclick="requestData('rectify')">
                                                <div class="card-body text-center">
                                                    <i class="ti ti-edit fs-1 text-success"></i>
                                                    <h6 class="mt-2">Rectify Data</h6>
                                                    <small class="text-muted">Correct inaccurate data</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card request-card" onclick="requestData('delete')">
                                                <div class="card-body text-center">
                                                    <i class="ti ti-trash fs-1 text-danger"></i>
                                                    <h6 class="mt-2">Delete Data</h6>
                                                    <small class="text-muted">Request data deletion</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <h5 class="mb-3">Recent Requests</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Request Type</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Data Export</td>
                                                            <td>2024-01-15</td>
                                                            <td><span class="badge bg-success">Completed</span></td>
                                                            <td><a href="#" class="text-primary">Download</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Data Rectification</td>
                                                            <td>2024-01-10</td>
                                                            <td><span class="badge bg-warning">Pending</span></td>
                                                            <td><a href="#" class="text-muted">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Data Deletion</td>
                                                            <td>2024-01-05</td>
                                                            <td><span class="badge bg-info">Processing</span></td>
                                                            <td><a href="#" class="text-muted">Track</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Logs Tab -->
                                <div class="tab-pane fade" id="security-logs" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h5>Recent Security Activity</h5>
                                            <p class="text-muted">Monitor access to your account</p>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="timeline">
                                                <div class="timeline-item">
                                                    <div class="timeline-badge bg-success">
                                                        <i class="ti ti-check"></i>
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h6>Successful Login</h6>
                                                        <small class="text-muted">Chrome on Windows • New York, US</small>
                                                        <p class="mt-1">10 minutes ago</p>
                                                    </div>
                                                </div>

                                                <div class="timeline-item">
                                                    <div class="timeline-badge bg-primary">
                                                        <i class="ti ti-device-mobile"></i>
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h6>New Device Login</h6>
                                                        <small class="text-muted">Safari on iPhone • London, UK</small>
                                                        <p class="mt-1">2 hours ago</p>
                                                    </div>
                                                </div>

                                                <div class="timeline-item">
                                                    <div class="timeline-badge bg-warning">
                                                        <i class="ti ti-alert-triangle"></i>
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h6>Failed Login Attempt</h6>
                                                        <small class="text-muted">Firefox on Mac • Unknown location</small>
                                                        <p class="mt-1">Yesterday at 11:30 PM</p>
                                                    </div>
                                                </div>

                                                <div class="timeline-item">
                                                    <div class="timeline-badge bg-info">
                                                        <i class="ti ti-lock"></i>
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h6>Password Changed</h6>
                                                        <small class="text-muted">Security setting updated</small>
                                                        <p class="mt-1">3 days ago</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-outline-primary mt-3">
                                                <i class="ti ti-download me-2"></i>Download Full Logs
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Legal Documents Tab -->
                                <div class="tab-pane fade" id="legal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h5>Legal Documents</h5>
                                            <p class="text-muted">Review our privacy policies and terms</p>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="legal-card">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-file-text fs-1 text-primary"></i>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="mb-1">Privacy Policy</h6>
                                                        <small class="text-muted">Last updated: Jan 1, 2024</small>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-light">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="legal-card">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-file-text fs-1 text-success"></i>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="mb-1">Terms of Service</h6>
                                                        <small class="text-muted">Last updated: Jan 1, 2024</small>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-light">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="legal-card">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-cookie fs-1 text-warning"></i>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="mb-1">Cookie Policy</h6>
                                                        <small class="text-muted">Last updated: Jan 1, 2024</small>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-light">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="legal-card">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-shield fs-1 text-info"></i>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="mb-1">GDPR Compliance</h6>
                                                        <small class="text-muted">Last updated: Jan 1, 2024</small>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-light">
                                                        <i class="ti ti-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="alert alert-info">
                                                <i class="ti ti-info-circle me-2"></i>
                                                By using our services, you agree to our legal terms. For any questions, contact our Data Protection Officer at <strong>privacy@codinater.com</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Privacy Resources -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Privacy Resources</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="resource-item">
                                        <i class="ti ti-shield-lock text-primary"></i>
                                        <h6>Data Encryption</h6>
                                        <small>Learn how we protect your data</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="resource-item">
                                        <i class="ti ti-users text-success"></i>
                                        <h6>Your Rights</h6>
                                        <small>Understand your privacy rights</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="resource-item">
                                        <i class="ti ti-question-mark text-info"></i>
                                        <h6>FAQ</h6>
                                        <small>Common privacy questions</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="resource-item">
                                        <i class="ti ti-headset text-warning"></i>
                                        <h6>Contact DPO</h6>
                                        <small>Reach our privacy team</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Privacy Center Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <style>
    /* Privacy Center Custom Styles */
    .stat-card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .privacy-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .privacy-card:hover {
        border-color: var(--bs-primary);
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .request-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e0e0e0;
    }

    .request-card:hover {
        border-color: var(--bs-primary);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(var(--bs-primary-rgb), 0.2);
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 30px;
    }

    .timeline-badge {
        position: absolute;
        left: -30px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .timeline-content {
        padding-left: 10px;
        border-left: 2px solid #e0e0e0;
        padding-bottom: 20px;
    }

    .timeline-item:last-child .timeline-content {
        border-left: 2px solid transparent;
    }

    .legal-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .legal-card:hover {
        border-color: var(--bs-primary);
        background: white;
    }

    .resource-item {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .resource-item:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
    }

    .resource-item i {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .resource-item h6 {
        margin-bottom: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline {
            padding-left: 20px;
        }
        
        .timeline-badge {
            left: -20px;
        }
        
        .resource-item {
            margin-bottom: 15px;
        }
    }
    </style>

    <script>
    // Request data function
    function requestData(type) {
        let message = '';
        switch(type) {
            case 'export':
                message = 'Your data export request has been submitted. You will receive an email when your data is ready.';
                break;
            case 'rectify':
                message = 'Your data rectification request has been submitted. Our team will review it shortly.';
                break;
            case 'delete':
                message = 'Your data deletion request has been submitted. This process may take up to 30 days.';
                break;
        }
        
        // Show success message
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show';
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
            <i class="ti ti-check me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Insert at the top of content
        const pcContent = document.querySelector('.pc-content');
        pcContent.insertBefore(alertDiv, pcContent.firstChild);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            alertDiv.style.transition = 'opacity 0.5s';
            alertDiv.style.opacity = '0';
            setTimeout(function() {
                alertDiv.remove();
            }, 500);
        }, 5000);
    }

    // Auto-hide existing alerts after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Save privacy settings
    document.querySelector('.btn-primary')?.addEventListener('click', function(e) {
        if(e.target.textContent.includes('Save Privacy Settings')) {
            e.preventDefault();
            alert('Privacy settings saved successfully!');
        }
    });
    </script>

    <?php $this->load->view('layout/footer'); ?>
</body>
</html>