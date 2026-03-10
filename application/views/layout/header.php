<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title><?= isset($page_title) ? $page_title . ' | Asaan Biz' : 'Asaan Biz' ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?php echo base_url('assets/images/logo/asaanbizfavicon.png') ?>" type="image/x-icon"> <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/tabler-icons.min.css') ?>">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/feather.css') ?>">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome.css') ?>">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/material.css') ?>">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>" id="main-style-link">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font@2.2.0/dist/css/material-design-iconic-font.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style-preset.css') ?>">
    <style>
        #supplierTable th,
        #supplierTable td {
            padding: 4px 6px !important;
            font-size: 12px !important;
        }
    /* Hide Google Translate top bar completely */
    .goog-te-banner-frame.skiptranslate,
    iframe.goog-te-banner-frame,
    .VIpgJd-ZVi9od-ORHb-OEVmcd,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
    #goog-gt-tt,
    .goog-te-balloon-frame {
        display: none !important;
    }
    
    body {
        top: 0px !important;
        position: static !important;
    }
    
    /* Remove any Google Translate tooltips */
    .goog-text-highlight {
        background: none !important;
        box-shadow: none !important;
    }
    
    .goog-tooltip {
        display: none !important;
    }
    
    .goog-tooltip:hover {
        display: none !important;
    }
    
    /* Style the Google Translate dropdown */
    .google-translate-container {
        display: inline-block;
        width: 130px;
        margin: 0 10px;
    }
    
    .google-translate-container select {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        background-color: #fff;
        font-size: 13px;
        cursor: pointer;
        outline: none;
    }
    
    .google-translate-container select:hover {
        border-color: #2196f3;
    }
    
    .goog-te-gadget {
        font-family: inherit !important;
        color: transparent !important;
    }
    
    .goog-te-gadget .goog-te-combo {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        background-color: #fff;
        font-size: 13px;
        cursor: pointer;
        outline: none;
        margin: 0 !important;
    }
    
    .goog-te-gadget .goog-te-combo:hover {
        border-color: #2196f3;
    }
.goog-te-banner-frame.skiptranslate {
    display: none !important;
}
body {
    top: 0 !important;
    position: static !important;
}

/* Hide Google icon inside dropdown */
.goog-te-gadget img {
    display: none !important;
}

/* Style dropdown */
.google-translate-container select {
    width: 140px;
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 20px;
    background-color: #fff;
    font-size: 13px;
    cursor: pointer;
    outline: none;
}

/* Hover effect */
.google-translate-container select:hover {
    border-color: #2196f3;
}

/* Mobile fix */
@media (max-width: 768px) {
    .google-translate-container select {
        width: 120px;
        font-size: 12px;
        padding: 4px 8px;
    }
}

    /* Fix for mobile */
    @media (max-width: 768px) {
        .google-translate-container {
            width: 100px;
        }
        
        .goog-te-gadget .goog-te-combo {
            font-size: 11px;
            padding: 4px 6px;
        }
    }
</style>

    <!-- CSS for better alignment and design -->
    <!--<style>-->


    <!--    .btn-success {-->
    <!--        padding: 10px 20px;-->
    <!--        font-size: 16px;-->
    <!--        border-radius: 5px;-->
    <!--    }-->

    <!--    @media (max-width: 768px) {-->
    <!--        .permission-item {-->
    <!--            width: calc(50% - 10px);-->
    <!--        }-->
    <!--    }-->

    <!--    @media (max-width: 480px) {-->
    <!--        .permission-item {-->
    <!--            width: 100%;-->
    <!--        }-->
    <!--    }-->

    <!--    .form-group label {-->
    <!--        font-weight: bold;-->
    <!--        font-size: 16px;-->
    <!--    }-->

    <!--    .breadcrumb {-->
    <!--        background-color: transparent;-->
    <!--        margin-bottom: 0;-->
    <!--        padding: 0;-->
    <!--    }-->

    <!--    .breadcrumb-item a {-->
    <!--        color: #5f6368;-->
    <!--    }-->

    <!--    .breadcrumb-item.active {-->
    <!--        color: #007bff;-->
    <!--    }-->

    <!--    .loader-bg {-->
    <!--        position: fixed;-->
    <!--        top: 0;-->
    <!--        left: 0;-->
    <!--        width: 100%;-->
    <!--        height: 100%;-->
    <!--        background-color: rgba(0, 0, 0, 0.5);-->
    <!--        z-index: 9999;-->
    <!--        display: flex;-->
    <!--        justify-content: center;-->
    <!--        align-items: center;-->
    <!--    }-->

    <!--    .loader-track {-->
    <!--        width: 80px;-->
    <!--        height: 80px;-->
    <!--        border-radius: 50%;-->
    <!--        border: 8px solid #f3f3f3;-->
    <!--        border-top: 8px solid #3498db;-->
    <!--        animation: spin 1s linear infinite;-->
    <!--    }-->

    <!--    @keyframes spin {-->
    <!--        0% { transform: rotate(0deg); }-->
    <!--        100% { transform: rotate(360deg); }-->
    <!--    }-->
    <!--</style>-->


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->


<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="dropdown pc-h-item d-inline-flex d-md-none">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none m-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-search"></i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3">
                            <div class="form-group mb-0 d-flex align-items-center">
                                <i data-feather="search"></i>
                                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                            </div>
                        </form>
                    </div>
                </li>
                <li class="pc-h-item d-none d-md-inline-flex">
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="pc-h-item">
                    <div id="google_translate_element" class="google-translate-container"></div>
                </li>
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-mail"></i>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Message</h5>
                            <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                            <div class="list-group list-group-flush w-100">
                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">3:00 AM</span>
                                            <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.</p>
                                            <span class="text-muted">2 min ago</span>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar">
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">6:00 PM</span>
                                            <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                                            <span class="text-muted">5 August</span>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar">
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">2:45 PM</span>
                                            <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                                            <span class="text-muted">7 hours ago</span>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="user-avtar">
                                        </div>
                                        <div class="flex-grow-1 ms-1">
                                            <span class="float-end text-muted">9:10 PM</span>
                                            <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b> Meeting.</b></p>
                                            <span class="text-muted">Daily scrum meeting time</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center py-2">
                            <a href="#!" class="link-primary">View all</a>
                        </div>
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false">

                        <?php
                        $first_name = $this->session->userdata('first_name') ?? '';
                        $last_name  = $this->session->userdata('last_name') ?? '';
                        $company    = $this->session->userdata('company') ?? '';
                        $logo       = $this->session->userdata('logo') ?? '';

                        // Set logo path
                        if (!empty($logo)) {
                            $logo_path = base_url('assets/images/logo/' . $logo);
                        } else {
                            $logo_path = base_url('assets/images/logo/asaanbiz.png');
                        }
                        ?>

                        <!-- User avatar -->
                        <img src="<?= $logo_path ?>" alt="user-image" class="user-avtar">
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">

                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1"><?php echo $first_name . '  ' . $last_name ?></h6>
                                    <span><?php echo $company ?></span>
                                </div>
                                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
                            </div>
                        </div>
                        <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active"
                                    id="drp-t1"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-1"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-1"
                                    aria-selected="true"><i class="ti ti-user"></i> Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link"
                                    id="drp-t2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-2"
                                    aria-selected="false"><i class="ti ti-settings"></i> Setting</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="mysrpTabContent">
                            <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                <a href="<?= base_url('account'); ?>" class="dropdown-item">
                                    <i class="ti ti-edit-circle"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <a href="<?= base_url('account/profile') ?>" class="dropdown-item">
                                    <i class="ti ti-user"></i>
                                    <span>View Profile</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="ti ti-clipboard-list"></i>
                                    <span>Social Profile</span>
                                </a>
                                <!--<a href="#!" class="dropdown-item">-->
                                <!--    <i class="ti ti-wallet"></i>-->
                                <!--    <span>Billing</span>-->
                                <!--</a>-->
                                <a href="<?php echo base_url('Auth/logout'); ?>" class="dropdown-item">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                            <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                <a href="<?php echo base_url('support'); ?>" class="dropdown-item">
                                    <i class="ti ti-help"></i>
                                    <span>Support</span>
                                </a>
                                <a href="<?= base_url('account'); ?>" class="dropdown-item">
                                    <i class="ti ti-user"></i>
                                    <span>Account Settings</span>
                                </a>
                                <a href="<?= base_url('account/privacy') ?>" class="dropdown-item">
                                    <i class="ti ti-lock"></i>
                                    <span>Privacy Center</span>
                                </a>
                                <a href="<?= base_url('feedback') ?>" class="dropdown-item">
                                    <i class="ti ti-messages"></i>
                                    <span>Feedback</span>
                                </a>
                                <a href="<?= base_url('history') ?>" class="dropdown-item">
                                    <i class="ti ti-list"></i>
                                    <span>History</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->


<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,ur,hi',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
    }, 'google_translate_element');

    // Wait for the select to appear and rename options
    const container = document.getElementById('google_translate_element');

    const observer = new MutationObserver(() => {
        const combo = container.querySelector('select');
        if (combo) {
            for (let i = 0; i < combo.options.length; i++) {
                switch(combo.options[i].value) {
                    case 'en': combo.options[i].text = 'English'; break;
                    case 'ur': combo.options[i].text = 'Urdu'; break;
                    case 'hi': combo.options[i].text = 'Hindi'; break;
                }
                combo.options[i].text = combo.options[i].text.replace(/›\s*/g, '');
            }

            // **Do NOT override combo.value** — keep user selection
            observer.disconnect(); // stop observing
        }
    });

    observer.observe(container, { childList: true, subtree: true });
}

// Remove Google bar completely
function removeGoogleBarAndFix() {
    const googleBar = document.querySelector('.goog-te-banner-frame.skiptranslate');
    if (googleBar) googleBar.remove();

    const googleTooltip = document.getElementById('goog-gt-tt');
    if (googleTooltip) googleTooltip.remove();

    document.body.style.top = '0px';
    document.body.style.position = 'static';
}

// Ensure bar is removed on page load
window.onload = removeGoogleBarAndFix;
</script>

<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>