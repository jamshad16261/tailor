<?php $this->load->view('layout/header'); ?>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <?php $this->load->view('layout/sidebar'); ?>

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Support Page Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2 class="mb-3">Support Center</h2>
                        <!--<p class="text-muted"></p>-->
                    </div>
                </div>
            </div>

            <!-- Contact Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card support-card">
                        <div class="card-body text-center">
                            <div class="support-icon">
                                <i class="ti ti-mail"></i>
                            </div>
                            <h5 class="mt-3">Email Support</h5>
                            <p class="mb-1">info@asaanbiz.com</p>
                            <small class="text-muted">Response within 24 hours</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card support-card">
                        <div class="card-body text-center">
                            <div class="support-icon">
                                <i class="ti ti-phone"></i>
                            </div>
                            <h5 class="mt-3">Phone Support</h5>
                            <p class="mb-1">326 4640259</p>
                            <small class="text-muted">Mon-Fri, 9AM-6PM</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card support-card">
                        <div class="card-body text-center">
                            <div class="support-icon">
                                <i class="ti ti-message"></i>
                            </div>
                            <h5 class="mt-3">Live Chat</h5>
                            <p class="mb-1">Available 24/7</p>
                            <span class="badge bg-success">Online</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Help Cards -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="mb-3">Quick Help</h4>
                </div>
                
                <div class="col-md-3">
                    <div class="card quick-help-card" onclick="openTicketForm()">
                        <div class="card-body text-center">
                            <i class="ti ti-ticket fs-1"></i>
                            <h6 class="mt-2">Create Ticket</h6>
                            <small class="text-muted">Report a problem</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card quick-help-card" onclick="window.location.href='mailto:info@asaanbiz.com'">
                        <div class="card-body text-center">
                            <i class="ti ti-mail fs-1"></i>
                            <h6 class="mt-2">Send Email</h6>
                            <small class="text-muted">Write to us</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card quick-help-card" onclick="window.location.href='tel:3264640259'">
                        <div class="card-body text-center">
                            <i class="ti ti-phone fs-1"></i>
                            <h6 class="mt-2">Call Now</h6>
                            <small class="text-muted">Talk to expert</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card quick-help-card" onclick="window.open('https://wa.me/3264640259')">
                        <div class="card-body text-center">
                            <i class="ti ti-brand-whatsapp fs-1"></i>
                            <h6 class="mt-2">WhatsApp</h6>
                            <small class="text-muted">Chat with us</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4 class="mb-3">Frequently Asked Questions</h4>
                </div>

                <div class="col-md-12">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="card mb-2">
                            <div class="card-header" id="faq1">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true">
                                        How do I reset my password?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <!--<div class="card-body">-->
                                <!--    Go to the login page and click on "Forgot Password". Enter your registered email address and we'll send you a password reset link within minutes.-->
                                <!--</div>-->
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="card mb-2">
                            <div class="card-header" id="faq2">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                        How do I upgrade my subscription?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Go to Settings → Subscription → "Change Plan". Select your desired plan and complete the payment. The new plan will be activated immediately.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="card mb-2">
                            <div class="card-header" id="faq3">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                        Can I get a refund?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Yes, we offer a 30-day money-back guarantee. Contact our support team with your order details and we'll process your refund within 5-7 business days.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="card mb-2">
                            <div class="card-header" id="faq4">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                        How do I delete my account?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse4" class="collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Go to Settings → Account → "Delete Account". Please note this action is permanent and all your data will be removed within 30 days.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="card mb-2">
                            <div class="card-header" id="faq5">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                        Do you have a mobile app?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse5" class="collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Yes! Download our mobile app from the App Store (iOS) or Google Play Store (Android). It's free for all users.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Ticket Form -->
            <div class="row mt-4" id="ticketForm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create Support Ticket</h5>
                        </div>
                        <div class="card-body">
                            <form id="supportForm" onsubmit="submitTicket(event)">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" placeholder="John Doe" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" placeholder="john@example.com" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Subject *</label>
                                        <select class="form-select" required>
                                            <option value="">Select a topic</option>
                                            <option>Technical Issue</option>
                                            <option>Billing & Payments</option>
                                            <option>Account Management</option>
                                            <option>Feature Request</option>
                                            <option>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Message *</label>
                                        <textarea class="form-control" rows="5" placeholder="Please describe your issue in detail..." required></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Support Page Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <style>
    /* Support Page Custom Styles */
    .support-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid #e0e0e0;
    }

    .support-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: var(--bs-primary);
    }

    .support-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 24px;
    }

    .quick-help-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid #e0e0e0;
    }

    .quick-help-card:hover {
        border-color: var(--bs-primary);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(var(--bs-primary-rgb), 0.2);
    }

    .quick-help-card i {
        color: var(--bs-primary);
    }

    .accordion .card-header {
        background-color: transparent;
        border-bottom: none;
    }

    .accordion .btn-link {
        color: var(--bs-dark);
        text-decoration: none;
        font-weight: 600;
        width: 100%;
        text-align: left;
    }

    .accordion .btn-link:hover {
        color: var(--bs-primary);
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    /* Phone number formatting */
    .contact-phone {
        font-size: 1.1em;
        font-weight: 500;
        color: var(--bs-primary);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .support-card {
            margin-bottom: 15px;
        }
        
        .quick-help-card {
            margin-bottom: 15px;
        }
    }
    </style>

    <script>
    // Open ticket form
    function openTicketForm() {
        document.getElementById('ticketForm').scrollIntoView({
            behavior: 'smooth'
        });
    }

    // Handle form submission
    function submitTicket(event) {
        event.preventDefault();
        
        // Show success message
        alert('✅ Ticket submitted successfully! We will get back to you within 24 hours.');
        
        // Reset form
        event.target.reset();
        
        // Optional: You can add AJAX call here
        // $.ajax({
        //     url: '<?= base_url("support/submit_ticket") ?>',
        //     type: 'POST',
        //     data: $(event.target).serialize(),
        //     success: function(response) {
        //         alert('Ticket submitted successfully!');
        //     }
        // });
    }

    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Initialize tooltips if you're using Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Format phone number for display
    document.addEventListener('DOMContentLoaded', function() {
        // Add click tracking for support options (optional)
        console.log('Support page loaded with contact: info@asaanbiz.com | 326 4640259');
    });
    </script>

    <?php $this->load->view('layout/footer'); ?>
</body>
</html>