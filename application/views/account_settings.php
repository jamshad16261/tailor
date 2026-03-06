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
            <!-- [ Account Settings Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="mb-3">Account Settings</h2>
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

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle me-2"></i>
                    <?= $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('info')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="ti ti-info-circle me-2"></i>
                    <?= $this->session->flashdata('info'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Account Settings Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">
                                        <i class="ti ti-user me-2"></i>Profile Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#password" role="tab">
                                        <i class="ti ti-lock me-2"></i>Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <!-- Tab Content -->
                            <div class="tab-content">
                                <!-- Profile Tab -->
                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                    <form method="post" action="<?= base_url('account/update_profile') ?>" id="profileForm">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-user"></i></span>
<input type="text" class="form-control" name="name" id="name" value="<?= set_value('name', $user->name); ?>" placeholder="Enter your full name">
                                                </div>
                                                <div class="invalid-feedback" id="nameError"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-mail"></i></span>
<input type="email" class="form-control" name="email" id="email" value="<?= set_value('email', $user->email); ?>" placeholder="Enter your email">
                                                </div>
                                                <div class="invalid-feedback" id="emailError"></div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-phone"></i></span>
<input type="text" class="form-control" name="phone" id="phone" value="<?= set_value('phone', $user->phone ?? ''); ?>" placeholder="Enter your phone number">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Timezone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-world"></i></span>
                                                    <select class="form-select" name="timezone" id="timezone">
    <option value="UTC" <?= ($user->timezone ?? '') == 'UTC' ? 'selected' : '' ?>>UTC</option>
                                    <option value="EST" <?= ($user->timezone ?? '') == 'EST' ? 'selected' : '' ?>>Eastern Time</option>
    <option value="CST" <?= ($user->timezone ?? '') == 'CST' ? 'selected' : '' ?>>Central Time</option>
    <option value="MST" <?= ($user->timezone ?? '') == 'MST' ? 'selected' : '' ?>>Mountain Time</option>
    <option value="PST" <?= ($user->timezone ?? '') == 'PST' ? 'selected' : '' ?>>Pacific Time</option>
</select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr class="my-3">
                                                <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                                                    <i class="ti ti-device-floppy me-2"></i>Save Changes
                                                </button>
                                                <button type="button" class="btn btn-light ms-2" onclick="resetProfileForm()">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="profileWarning" class="warning-message" style="display: none; color: #dc3545; margin-top: 10px; padding: 10px; background-color: #fff5f5; border: 1px solid #dc3545; border-radius: 5px;">
                                        <i class="ti ti-alert-circle me-2"></i>Please make some changes to update your profile
                                    </div>
                                </div>

                                <!-- Password Tab -->
                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <form method="post" action="<?= base_url('account/change_password') ?>" id="passwordForm">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter current password">
                                                </div>
                                                <div class="invalid-feedback" id="currentPasswordError"></div>
                                                <small class="text-muted">Enter your current password to verify</small>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-key"></i></span>
                                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter new password">
                                                </div>
                                                <div class="invalid-feedback" id="newPasswordError">Please fill this field</div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ti ti-key"></i></span>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password">
                                                </div>
                                                <div class="invalid-feedback" id="confirmPasswordError">Please fill this field</div>
                                            </div>

                                            <!-- Password Hint -->
                                            <div class="col-md-12 mb-3">
                                                <div class="alert alert-info py-2">
                                                    <i class="ti ti-info-circle me-2"></i>
                                                    Password must be exactly <strong>6 digits</strong> (numbers only)
                                                </div>
                                            </div>

                                            <!-- Password Validation Status -->
                                            <div class="col-md-12 mb-3">
                                                <div id="passwordValidation" class="small"></div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr class="my-3">
                                                <button type="submit" class="btn btn-primary" id="updatePasswordBtn">
                                                    <i class="ti ti-lock-check me-2"></i>Update Password
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
            <!-- [ Account Settings Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <style>
    /* Additional custom styles */
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
        padding: 12px 20px;
        border: none;
        border-bottom: 2px solid transparent;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: var(--bs-primary);
    }

    .nav-tabs .nav-link.active {
        color: var(--bs-primary);
        background: transparent;
        border-bottom: 2px solid var(--bs-primary);
    }

    .nav-tabs .nav-link i {
        font-size: 1.1em;
    }

    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .input-group-text {
        background: #f8f9fa;
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
    }

    .input-group .form-control:focus {
        border-color: #ced4da;
        box-shadow: none;
    }

    .input-group:focus-within .input-group-text {
        border-color: var(--bs-primary);
    }

    /* Alert animations */
    .alert {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Validation styling */
    .is-invalid {
        border-color: #dc3545 !important;
    }

    .is-invalid + .invalid-feedback {
        display: block;
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .warning-message {
        animation: slideDown 0.3s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 8px 12px;
            font-size: 0.9em;
        }
        
        .nav-tabs .nav-link i {
            margin-right: 5px;
        }
    }
    </style>

    <script>
    // Store original profile values for change detection
    const originalProfile = {
        name: document.getElementById('name')?.value || '',
        email: document.getElementById('email')?.value || '',
        phone: document.getElementById('phone')?.value || '',
        timezone: document.getElementById('timezone')?.value || ''
    };

    // Check if profile has changes
    function hasProfileChanges() {
        const currentName = document.getElementById('name')?.value || '';
        const currentEmail = document.getElementById('email')?.value || '';
        const currentPhone = document.getElementById('phone')?.value || '';
        const currentTimezone = document.getElementById('timezone')?.value || '';
        
        return currentName !== originalProfile.name ||
               currentEmail !== originalProfile.email ||
               currentPhone !== originalProfile.phone ||
               currentTimezone !== originalProfile.timezone;
    }

    // Profile form validation on submit
    document.getElementById('profileForm').addEventListener('submit', function(e){
        e.preventDefault(); // Always prevent default first
        
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const warningDiv = document.getElementById('profileWarning');
        
        let valid = true;

        // Hide warning initially
        warningDiv.style.display = 'none';

        // Check if any changes were made
        if(!hasProfileChanges()) {
            warningDiv.style.display = 'block';
            valid = false;
        }

        // Reset previous errors
        nameInput.classList.remove('is-invalid');
        emailInput.classList.remove('is-invalid');
        document.getElementById('nameError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';

        // Name validation
        if(nameInput.value.trim() === ''){
            nameInput.classList.add('is-invalid');
            document.getElementById('nameError').innerHTML = 'Full name is required';
            valid = false;
        }

        // Email validation
        if(emailInput.value.trim() === ''){
            emailInput.classList.add('is-invalid');
            document.getElementById('emailError').innerHTML = 'Email is required';
            valid = false;
        } else if(!/^\S+@\S+\.\S+$/.test(emailInput.value.trim())){
            emailInput.classList.add('is-invalid');
            document.getElementById('emailError').innerHTML = 'Email is invalid';
            valid = false;
        }

        if(valid){
            this.submit(); // Submit only if all validations pass
        }
    });

    // Reset profile form
    function resetProfileForm() {
        document.getElementById('name').value = originalProfile.name;
        document.getElementById('email').value = originalProfile.email;
        document.getElementById('phone').value = originalProfile.phone;
        document.getElementById('timezone').value = originalProfile.timezone;
        
        // Remove validation errors
        document.getElementById('name').classList.remove('is-invalid');
        document.getElementById('email').classList.remove('is-invalid');
        document.getElementById('nameError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';
        
        // Hide warning
        document.getElementById('profileWarning').style.display = 'none';
    }

    // Hide warning when user starts typing
    document.getElementById('name')?.addEventListener('input', function() {
        document.getElementById('profileWarning').style.display = 'none';
        this.classList.remove('is-invalid');
        document.getElementById('nameError').innerHTML = '';
    });

    document.getElementById('email')?.addEventListener('input', function() {
        document.getElementById('profileWarning').style.display = 'none';
        this.classList.remove('is-invalid');
        document.getElementById('emailError').innerHTML = '';
    });

    document.getElementById('phone')?.addEventListener('input', function() {
        document.getElementById('profileWarning').style.display = 'none';
    });

    document.getElementById('timezone')?.addEventListener('change', function() {
        document.getElementById('profileWarning').style.display = 'none';
    });

    // Password validation for exactly 6 digits
    function validatePassword() {
        const newPass = document.getElementById('new_password')?.value || '';
        const confirmPass = document.getElementById('confirm_password')?.value || '';
        const validationDiv = document.getElementById('passwordValidation');
        
        let messages = [];
        
        // Clear validation if both fields are empty
        if (!newPass && !confirmPass) {
            validationDiv.innerHTML = '<div class="text-muted">🔵 Enter new password to continue</div>';
            return;
        }
        
        // Check if new password is exactly 6 digits
        const isSixDigits = /^\d{6}$/.test(newPass);
        
        if (newPass) {
            if (!isSixDigits) {
                messages.push('<div class="text-danger">❌ Password must be exactly 6 digits</div>');
            } else {
                messages.push('<div class="text-success">✅ Password format is correct</div>');
            }
        }
        
        // Check if passwords match
        if (newPass && confirmPass) {
            if (newPass !== confirmPass) {
                messages.push('<div class="text-danger">❌ Passwords do not match</div>');
            } else if (newPass === confirmPass && isSixDigits) {
                messages.push('<div class="text-success">✅ Passwords match</div>');
            }
        } else if (newPass && !confirmPass) {
            messages.push('<div class="text-warning">⚠️ Please confirm your password</div>');
        }
        
        // Update validation display
        validationDiv.innerHTML = messages.join('');
    }

    // Add password validation listeners
    document.getElementById('new_password')?.addEventListener('input', validatePassword);
    document.getElementById('confirm_password')?.addEventListener('input', validatePassword);

    // Password form validation on submit
    document.getElementById('passwordForm')?.addEventListener('submit', function(e){
        e.preventDefault(); // Always prevent default first
        
        const currentPassInput = document.getElementById('current_password');
        const newPassInput = document.getElementById('new_password');
        const confirmPassInput = document.getElementById('confirm_password');

        const currentPass = currentPassInput.value.trim();
        const newPass = newPassInput.value.trim();
        const confirmPass = confirmPassInput.value.trim();

        let valid = true;

        // Reset previous error messages
        document.getElementById('currentPasswordError').innerHTML = '';
        document.getElementById('newPasswordError').innerHTML = 'Please fill this field';
        document.getElementById('confirmPasswordError').innerHTML = 'Please fill this field';
        
        currentPassInput.classList.remove('is-invalid');
        newPassInput.classList.remove('is-invalid');
        confirmPassInput.classList.remove('is-invalid');

        // Current Password Validation
        if(currentPass === '') {
            currentPassInput.classList.add('is-invalid');
            document.getElementById('currentPasswordError').innerHTML = 'Please fill this field';
            valid = false;
        }

        // New Password Validation
        if(newPass === '') {
            newPassInput.classList.add('is-invalid');
            document.getElementById('newPasswordError').innerHTML = 'Please fill this field';
            valid = false;
        } else if(!/^\d{6}$/.test(newPass)) {
            newPassInput.classList.add('is-invalid');
            document.getElementById('newPasswordError').innerHTML = 'Password must be exactly 6 digits';
            valid = false;
        }

        // Confirm Password Validation
        if(confirmPass === '') {
            confirmPassInput.classList.add('is-invalid');
            document.getElementById('confirmPasswordError').innerHTML = 'Please fill this field';
            valid = false;
        } else if(confirmPass !== newPass) {
            confirmPassInput.classList.add('is-invalid');
            document.getElementById('confirmPasswordError').innerHTML = 'Passwords do not match';
            valid = false;
        }

        if(valid){
            this.submit(); // Submit only if all validations pass
        }
    });

    // Remove error when user starts typing
    document.getElementById('current_password')?.addEventListener('input', function() {
        this.classList.remove('is-invalid');
        document.getElementById('currentPasswordError').innerHTML = '';
    });

    document.getElementById('new_password')?.addEventListener('input', function() {
        this.classList.remove('is-invalid');
        document.getElementById('newPasswordError').innerHTML = '';
    });

    document.getElementById('confirm_password')?.addEventListener('input', function() {
        this.classList.remove('is-invalid');
        document.getElementById('confirmPasswordError').innerHTML = '';
    });

    // Auto-hide alerts after 5 seconds
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
    </script>

    <?php $this->load->view('layout/footer'); ?>
</body>
</html>